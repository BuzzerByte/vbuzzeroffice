<template>
  <div class="tab-container">
    <el-tag>mounted times ：{{ createdTimes }}</el-tag>
<<<<<<< HEAD
    <el-alert :closable="false" style="width:200px;display:inline-block;vertical-align: middle;margin-left:30px;" title="Tab with keep-alive" type="success"/>
    <el-tabs v-model="activeName" style="margin-top:15px;" type="border-card">
      <el-tab-pane v-for="item in tabMapOptions" :label="item.label" :key="item.key" :name="item.key">
        <keep-alive>
          <tab-pane v-if="activeName==item.key" :type="item.key" @create="showCreatedTimes"/>
=======
    <el-alert :closable="false" style="width:200px;display:inline-block;vertical-align: middle;margin-left:30px;" title="Tab with keep-alive" type="success" />
    <el-tabs v-model="activeName" style="margin-top:15px;" type="border-card">
      <el-tab-pane v-for="item in tabMapOptions" :key="item.key" :label="item.label" :name="item.key">
        <keep-alive>
          <tab-pane v-if="activeName==item.key" :type="item.key" @create="showCreatedTimes" />
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
        </keep-alive>
      </el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
import TabPane from './components/TabPane';

export default {
  name: 'Tab',
  components: { TabPane },
  data() {
    return {
      tabMapOptions: [
        { label: 'USA', key: 'US' },
        { label: 'Vietnam', key: 'VI' },
        { label: 'China', key: 'CN' },
        { label: 'Eurozone', key: 'EU' },
      ],
      activeName: 'VI',
      createdTimes: 0,
    };
  },
  methods: {
    showCreatedTimes() {
      this.createdTimes = this.createdTimes + 1;
    },
  },
};
</script>

<style scoped>
  .tab-container {
    margin: 30px;
  }
</style>
