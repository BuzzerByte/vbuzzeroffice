<template>
  <div class="dashboard-container">
<<<<<<< HEAD
    <component :is="currentRole"/>
=======
    <component :is="currentRole" />
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
import adminDashboard from './admin';
import editorDashboard from './editor';

export default {
  name: 'Dashboard',
  components: { adminDashboard, editorDashboard },
  data() {
    return {
      currentRole: 'adminDashboard',
    };
  },
  computed: {
    ...mapGetters([
      'roles',
    ]),
  },
  created() {
    if (!this.roles.includes('admin')) {
      this.currentRole = 'editorDashboard';
    }
  },
};
</script>
