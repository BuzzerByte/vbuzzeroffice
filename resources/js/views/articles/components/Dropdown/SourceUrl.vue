<template>
  <el-dropdown :show-timeout="100" trigger="click">
    <el-button plain>
      External URL
<<<<<<< HEAD
      <i class="el-icon-caret-bottom el-icon--right"/>
=======
      <i class="el-icon-caret-bottom el-icon--right" />
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
    </el-button>
    <el-dropdown-menu slot="dropdown" class="no-padding no-border" style="width:400px">
      <el-form-item label-width="0px" style="margin-bottom: 0px" prop="source_uri">
        <el-input v-model="source_uri" placeholder="Enter the content">
<<<<<<< HEAD
          <template slot="prepend">Fill in the URL</template>
=======
          <template slot="prepend">
            Fill in the URL
          </template>
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
        </el-input>
      </el-form-item>
    </el-dropdown-menu>
  </el-dropdown>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: '',
    },
  },
  computed: {
    source_uri: {
      get() {
        return this.value;
      },
      set(val) {
        this.$emit('input', val);
      },
    },
  },
};
</script>
