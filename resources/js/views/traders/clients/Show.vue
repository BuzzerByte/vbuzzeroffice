<template>
  <div class="app-container">
    <!-- <el-form :model="client" v-if="client"> -->
    <el-form v-if="client" v-loading="updating" :model="client" label-width="120px">
      <el-form-item label="">
        <el-col :span="11">
          <el-form-item label="Name">
            <el-input v-model="client.name" />
          </el-form-item>
        </el-col>
        <el-col :span="11">
          <el-form-item label="Email">
            <el-input v-model="client.email" />
          </el-form-item>
        </el-col>
      </el-form-item>
      <el-form-item label="">
        <el-col :span="11">
          <el-form-item label="Company">
            <el-input v-model="client.company" />
          </el-form-item>
        </el-col>
        <el-col :span="11">
          <el-form-item label="Phone">
            <el-input v-model="client.phone" />
          </el-form-item>
        </el-col>
      </el-form-item>
      <el-form-item label="">
        <el-col :span="11">
          <el-form-item label="Open Balance">
            <el-input v-model="client.open_balance" />
          </el-form-item>
        </el-col>
        <el-col :span="11">
          <el-form-item label="Fax">
            <el-input v-model="client.fax" />
          </el-form-item>
        </el-col>
      </el-form-item>
      <el-form-item label="Website">
        <el-input v-model="client.website" />
      </el-form-item>
      <el-form-item label="Shipping Address">
        <el-input v-model="client.shipping_address" type="textarea" />
      </el-form-item>
      <el-form-item label="Billing Address">
        <el-input v-model="client.billing_address" type="textarea" />
      </el-form-item>
      <el-form-item label="Note">
        <el-input v-model="client.note" type="textarea" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="onSubmit">Create</el-button>
        <el-button @click="onCancel">Cancel</el-button>
      </el-form-item>
    </el-form>
    <!-- </el-form> -->
  </div>
</template>

<script>
import Resource from '@/api/resource';
// import ClientBio from './components/ClientBio';
// import ClientCard from './components/ClientCard';
// import ClientActivity from './components/ClientActivity';

const clientResource = new Resource('clients');
export default {
  name: 'EditUser',
  components: {},
  data() {
    return {
      client: {},
      updating: false,
    };
  },
  watch: {
    $route: 'getUser',
  },
  created() {
    const id = this.$route.params && this.$route.params.id;
    this.getUser(id);
  },
  methods: {
    async getUser(id) {
      const { data } = await clientResource.get(id);
      this.client = data;
    },
    onSubmit() {
      this.updating = true;
      clientResource
        .update(this.client.id, this.client)
        .then(response => {
          this.updating = false;
          this.$message({
            message: 'Client information has been updated successfully',
            type: 'success',
            duration: 5 * 1000,
          });
        })
        .catch(error => {
          console.log(error);
          this.updating = false;
        });
    },
    onCancel() {
      this.$message({
        message: 'cancel!',
        type: 'warning',
      });
    },
  },
};
</script>
