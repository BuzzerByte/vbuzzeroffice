<template>
    <div class="app-container">
        <el-form :model="user" v-if="user">
          <el-row :gutter="20">
            <el-col :span="6">
              <client-card :user="user" />
              <client-bio />
            </el-col>
            <el-col :span="18">
              <client-activity :user="user" />
            </el-col>
          </el-row>
        </el-form>
    </div>
</template>

<script>
import Resource from '@/api/resource';
import ClientBio from './components/ClientBio';
import ClientCard from './components/ClientCard';
import ClientActivity from './components/ClientActivity';

const clientResource = new Resource('clients');
export default {
  name: 'EditUser',
  components: { ClientBio, ClientCard, ClientActivity },
  data() {
    return {
      user: {},
    };
  },
  watch: {
    '$route': 'getUser',
  },
  created() {
    const id = this.$route.params && this.$route.params.id;
    this.getUser(id);
  },
  methods: {
    async getUser(id) {
      const { data } = await clientResource.get(id);
      this.user = data;
    },
  },
};
</script>
