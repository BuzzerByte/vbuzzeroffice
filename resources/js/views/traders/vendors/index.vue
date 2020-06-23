<template>
    <div class="app-container">
        <div class="filter-container">
            <el-input v-model="query.keyword" :placeholder="$t('table.keyword')" style="width: 200px;"
                class="filter-item" @keyup.enter.native="handleFilter" />
            <el-select v-model="query.role" :placeholder="$t('table.role')" clearable style="width: 90px"
                class="filter-item" @change="handleFilter">
                <el-option v-for="item in roles" :key="item" :label="item | uppercaseFirst" :value="item" />
            </el-select>
            <el-button v-waves class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter">
                {{ $t('table.search') }}
            </el-button>
            <el-button class="filter-item" style="margin-left: 10px;" type="primary" icon="el-icon-plus"
                @click="handleCreate">
                {{ $t('table.add') }}
            </el-button>
            <el-button v-waves :loading="downloading" class="filter-item" type="primary" icon="el-icon-download"
                @click="handleDownload">
                {{ $t('table.export') }}
            </el-button>
        </div>
        <el-table v-loading="loading" :data="list" border fit highlight-current-row style="width: 100%">
            <el-table-column align="center" label="ID" width="80">
                <template slot-scope="scope">
                    <span>{{ scope.row.index }}</span>
                </template>
            </el-table-column>

            <el-table-column align="center" label="Name">
                <template slot-scope="scope">
                    <span>{{ scope.row.name }}</span>
                </template>
            </el-table-column>

            <el-table-column align="center" label="Email">
                <template slot-scope="scope">
                    <span>{{ scope.row.email }}</span>
                </template>
            </el-table-column>

            <el-table-column align="center" label="Actions" width="350">
                <template slot-scope="scope">
                    <router-link :to="'/trader/vendors/edit/'+scope.row.id">
                        <el-button type="primary" size="small" icon="el-icon-edit">
                            Edit
                        </el-button>
                    </router-link>
                    <el-button type="warning" size="small" icon="el-icon-edit"
                        v-permission="['manage permission']" @click="handleEditPermissions(scope.row.id);">
                        Permissions
                    </el-button>
                    <el-button type="danger" size="small" icon="el-icon-delete" v-permission="['manage user']"
                         @click="handleDelete(scope.row.id, scope.row.name);">
                        Delete
                    </el-button>
                </template>
            </el-table-column>
        </el-table>

        <pagination v-show="total>0" :total="total" :page.sync="query.page" :limit.sync="query.limit" @pagination="getList"/>
        <el-dialog :visible.sync="dialogPermissionVisible" :title="'Edit Permissions - ' + currentUser.name">
            <div class="form-container" v-loading="dialogPermissionLoading" v-if="currentUser.name">
                <div class="permissions-container">
                    <div class="block">
                        <el-form :model="currentUser" label-width="80px" label-position="top">
                            <el-form-item label="Menus">
                                <el-tree ref="menuPermissions" :data="normalizedMenuPermissions"
                                    :default-checked-keys="permissionKeys(userMenuPermissions)" :props="permissionProps"
                                    show-checkbox node-key="id" class="permission-tree" />
                            </el-form-item>
                        </el-form>
                    </div>
                    <div class="block">
                        <el-form :model="currentUser" label-width="80px" label-position="top">
                            <el-form-item label="Permissions">
                                <el-tree ref="otherPermissions" :data="normalizedOtherPermissions"
                                    :default-checked-keys="permissionKeys(userOtherPermissions)"
                                    :props="permissionProps" show-checkbox node-key="id" class="permission-tree" />
                            </el-form-item>
                        </el-form>
                    </div>
                    <div class="clear-left"></div>
                </div>
                <div style="text-align:right;">
                    <el-button type="danger" @click="dialogPermissionVisible=false">
                        {{ $t('permission.cancel') }}
                    </el-button>
                    <el-button type="primary" @click="confirmPermission">
                        {{ $t('permission.confirm') }}
                    </el-button>
                </div>
            </div>
        </el-dialog>

        <el-dialog :title="'Create new vendor'" :visible.sync="dialogFormVisible">
            <div class="form-container" v-loading="userCreating">
                <el-form ref="userForm" :rules="rules" :model="newUser" label-position="left" label-width="150px"
                    style="max-width: 500px;">
                    <el-form-item :label="$t('user.name')" prop="name">
                        <el-input v-model="newUser.name" />
                    </el-form-item>
                    <el-form-item :label="$t('user.email')" prop="email">
                        <el-input v-model="newUser.email" />
                    </el-form-item>
                    <el-form-item :label="$t('user.company')" prop="company">
                        <el-input v-model="newUser.company" />
                    </el-form-item>
                    <el-form-item :label="$t('user.phone')" prop="phone">
                        <el-input v-model="newUser.phone" />
                    </el-form-item>
                    <el-form-item :label="$t('user.open_balance')" prop="open_balance">
                        <el-input v-model="newUser.open_balance" />
                    </el-form-item>
                    <el-form-item :label="$t('user.fax')" prop="fax">
                        <el-input v-model="newUser.fax" />
                    </el-form-item>
                    <el-form-item :label="$t('user.website')" prop="website">
                        <el-input v-model="newUser.website" />
                    </el-form-item>
                    <el-form-item :label="$t('user.billing_address')" prop="billing_address">
                        <el-input v-model="newUser.billing_address" />
                    </el-form-item>
                    <el-form-item :label="$t('user.note')" prop="note">
                        <el-input v-model="newUser.note" />
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click="dialogFormVisible = false">
                        {{ $t('table.cancel') }}
                    </el-button>
                    <el-button type="primary" @click="createUser()">
                        {{ $t('table.confirm') }}
                    </el-button>
                </div>
            </div>
        </el-dialog>
    </div>
</template>

<script>
import Pagination from '@/components/Pagination'; // Secondary package based on el-pagination
import VendorResource from '@/api/vendor';
import Resource from '@/api/resource';
import waves from '@/directive/waves'; // Waves directive
import permission from '@/directive/permission'; // Waves directive
import checkPermission from '@/utils/permission'; // Permission checking

const vendorResource = new VendorResource();
const permissionResource = new Resource('permissions');

export default {
  name: 'VendorList',
  components: { Pagination },
  directives: { waves, permission },
  data() {
    var validateConfirmPassword = (rule, value, callback) => {
      if (value !== this.newUser.password) {
        callback(new Error('Password is mismatched!'));
      } else {
        callback();
      }
    };
    return {
      list: null,
      total: 0,
      loading: true,
      downloading: false,
      userCreating: false,
      query: {
        page: 1,
        limit: 15,
        keyword: '',
        role: '',
      },
      roles: ['admin', 'manager', 'editor', 'user', 'visitor'],
      nonAdminRoles: ['editor', 'user', 'visitor'],
      newUser: {},
      dialogFormVisible: false,
      dialogPermissionVisible: false,
      dialogPermissionLoading: false,
      currentUserId: 0,
      currentUser: {
        name: '',
        permissions: [],
        rolePermissions: [],
      },
      rules: {
        role: [{ required: true, message: 'Role is required', trigger: 'change' }],
        name: [{ required: true, message: 'Name is required', trigger: 'blur' }],
        email: [
          { required: true, message: 'Email is required', trigger: 'blur' },
          { type: 'email', message: 'Please input correct email address', trigger: ['blur', 'change'] },
        ],
        company: [{ required: true, message: 'Company is required', trigger: 'blur' }],
        phone: [{ required: true, message: 'Phone is required', trigger: 'blur' }],
        open_balance: [{ required: true, message: 'Open Balance is required', trigger: 'blur' }],
        fax: [{ required: true, message: 'Fax is required', trigger: 'blur' }],
        website: [{ required: true, message: 'Website is required', trigger: 'blur' }],
        billing_address: [{ required: true, message: 'Billing address is required', trigger: 'blur' }],
        shipping_address: [{ required: true, message: 'Shipping address is required', trigger: 'blur' }],
        password: [{ required: true, message: 'Password is required', trigger: 'blur' }],
        confirmPassword: [{ validator: validateConfirmPassword, trigger: 'blur' }],
      },
      permissionProps: {
        children: 'children',
        label: 'name',
        disabled: 'disabled',
      },
      permissions: [],
      menuPermissions: [],
      otherPermissions: [],
    };
  },
  computed: {
    normalizedMenuPermissions() {
      let tmp = [];
      this.currentUser.permissions.role.forEach(permission => {
        tmp.push({
          id: permission.id,
          name: permission.name,
          disabled: true,
        });
      });
      const rolePermissions = {
        id: -1, // Faked ID
        name: 'Inherited from role',
        disabled: true,
        children: this.classifyPermissions(tmp).menu,
      };

      tmp = this.menuPermissions.filter(permission => !this.currentUser.permissions.role.find(p => p.id === permission.id));
      const userPermissions = {
        id: 0, // Faked ID
        name: 'Extra menus',
        children: tmp,
        disabled: tmp.length === 0,
      };

      return [rolePermissions, userPermissions];
    },
    normalizedOtherPermissions() {
      let tmp = [];
      this.currentUser.permissions.role.forEach(permission => {
        tmp.push({
          id: permission.id,
          name: permission.name,
          disabled: true,
        });
      });
      const rolePermissions = {
        id: -1,
        name: 'Inherited from role',
        disabled: true,
        children: this.classifyPermissions(tmp).other,
      };

      tmp = this.otherPermissions.filter(permission => !this.currentUser.permissions.role.find(p => p.id === permission.id));
      const userPermissions = {
        id: 0,
        name: 'Extra permissions',
        children: tmp,
        disabled: tmp.length === 0,
      };

      return [rolePermissions, userPermissions];
    },
    userMenuPermissions() {
      return this.classifyPermissions(this.userPermissions).menu;
    },
    userOtherPermissions() {
      return this.classifyPermissions(this.userPermissions).other;
    },
    userPermissions() {
      return this.currentUser.permissions.role.concat(this.currentUser.permissions.user);
    },
  },
  created() {
    this.resetNewUser();
    this.getList();
    if (checkPermission(['manage permission'])) {
      this.getPermissions();
    }
  },
  methods: {
    checkPermission,
    async getPermissions() {
      const { data } = await permissionResource.list({});
      const { all, menu, other } = this.classifyPermissions(data);
      this.permissions = all;
      this.menuPermissions = menu;
      this.otherPermissions = other;
    },

    async getList() {
      const { limit, page } = this.query;
      this.loading = true;
      const { data, meta } = await vendorResource.list(this.query);
      this.list = data;
      this.list.forEach((element, index) => {
        element['index'] = (page - 1) * limit + index + 1;
      });
      this.total = meta.total;
      this.loading = false;
    },
    handleFilter() {
      this.query.page = 1;
      this.getList();
    },
    handleCreate() {
      this.resetNewUser();
      this.dialogFormVisible = true;
      this.$nextTick(() => {
        this.$refs['userForm'].clearValidate();
      });
    },
    handleDelete(id, name) {
      this.$confirm('This will permanently delete user ' + name + '. Continue?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      }).then(() => {
        vendorResource.destroy(id).then(response => {
          this.$message({
            type: 'success',
            message: 'Delete completed',
          });
          this.handleFilter();
        }).catch(error => {
          console.log(error);
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Delete canceled',
        });
      });
    },
    async handleEditPermissions(id) {
      this.currentUserId = id;
      this.dialogPermissionLoading = true;
      this.dialogPermissionVisible = true;
      const found = this.list.find(user => user.id === id);
      const { data } = await vendorResource.permissions(id);
      this.currentUser = {
        id: found.id,
        name: found.name,
        permissions: data,
      };
      this.dialogPermissionLoading = false;
      this.$nextTick(() => {
        this.$refs.menuPermissions.setCheckedKeys(this.permissionKeys(this.userMenuPermissions));
        this.$refs.otherPermissions.setCheckedKeys(this.permissionKeys(this.userOtherPermissions));
      });
    },
    createUser() {
      this.$refs['userForm'].validate((valid) => {
        if (valid) {
          this.newUser.roles = [this.newUser.role];
          this.userCreating = true;
          vendorResource
            .store(this.newUser)
            .then(response => {
              this.$message({
                message: 'New user ' + this.newUser.name + '(' + this.newUser.email + ') has been created successfully.',
                type: 'success',
                duration: 5 * 1000,
              });
              this.resetNewUser();
              this.dialogFormVisible = false;
              this.handleFilter();
            })
            .catch(error => {
              console.log(error);
            })
            .finally(() => {
              this.userCreating = false;
            });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    resetNewUser() {
      this.newUser = {
        name: '',
        email: '',
        company: '',
        phone: '',
        open_balance: '',
        fax: '',
        website: '',
        billing_address: '',
        shipping_address: '',
        password: '',
        confirmPassword: '',
        role: 'user',
      };
    },
    handleDownload() {
      this.downloading = true;
      import('@/vendor/Export2Excel').then(excel => {
        const tHeader = ['id', 'user_id', 'name', 'email', 'role'];
        const filterVal = ['index', 'id', 'name', 'email', 'role'];
        const data = this.formatJson(filterVal, this.list);
        excel.export_json_to_excel({
          header: tHeader,
          data,
          filename: 'user-list',
        });
        this.downloading = false;
      });
    },
    formatJson(filterVal, jsonData) {
      return jsonData.map(v => filterVal.map(j => v[j]));
    },
    permissionKeys(permissions) {
      return permissions.map(permssion => permssion.id);
    },
    classifyPermissions(permissions) {
      const all = []; const menu = []; const other = [];
      permissions.forEach(permission => {
        const permissionName = permission.name;
        all.push(permission);
        if (permissionName.startsWith('view menu')) {
          menu.push(this.normalizeMenuPermission(permission));
        } else {
          other.push(this.normalizePermission(permission));
        }
      });
      return { all, menu, other };
    },

    normalizeMenuPermission(permission) {
      return { id: permission.id, name: this.$options.filters.uppercaseFirst(permission.name.substring(10)), disabled: permission.disabled || false };
    },

    normalizePermission(permission) {
      const disabled = permission.disabled || permission.name === 'manage permission';
      return { id: permission.id, name: this.$options.filters.uppercaseFirst(permission.name), disabled: disabled };
    },

    confirmPermission() {
      const checkedMenu = this.$refs.menuPermissions.getCheckedKeys();
      const checkedOther = this.$refs.otherPermissions.getCheckedKeys();
      const checkedPermissions = checkedMenu.concat(checkedOther);
      this.dialogPermissionLoading = true;

      vendorResource.updatePermission(this.currentUserId, { permissions: checkedPermissions }).then(response => {
        this.$message({
          message: 'Permissions has been updated successfully',
          type: 'success',
          duration: 5 * 1000,
        });
        this.dialogPermissionLoading = false;
        this.dialogPermissionVisible = false;
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.edit-input {
  padding-right: 100px;
}
.cancel-btn {
  position: absolute;
  right: 15px;
  top: 10px;
}
.dialog-footer {
  text-align: left;
  padding-top: 0;
  margin-left: 150px;
}
.app-container {
  flex: 1;
  justify-content: space-between;
  font-size: 14px;
  padding-right: 8px;
  .block {
    float: left;
    min-width: 250px;
  }
  .clear-left {
    clear: left;
  }
}
</style>
