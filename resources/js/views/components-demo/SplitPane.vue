<template>
  <div class="components-container">
    <split-pane split="vertical" @resize="resize">
      <template slot="paneL">
<<<<<<< HEAD
        <div class="left-container"/>
=======
        <div class="left-container" />
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
      </template>
      <template slot="paneR">
        <split-pane split="horizontal">
          <template slot="paneL">
<<<<<<< HEAD
            <div class="top-container"/>
          </template>
          <template slot="paneR">
            <div class="bottom-container"/>
=======
            <div class="top-container" />
          </template>
          <template slot="paneR">
            <div class="bottom-container" />
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
          </template>
        </split-pane>
      </template>
    </split-pane>
  </div>
</template>

<script>
import splitPane from 'vue-splitpane';

export default {
  name: 'SplitpaneDemo',
  components: { splitPane },
  methods: {
    resize() {
      console.log('resize');
    },
  },
};
</script>

<style  scoped>
  .components-container {
    position: relative;
    height: 100vh;
  }

  .left-container {
    background-color: #F38181;
    height: 100%;
  }

  .right-container {
    background-color: #FCE38A;
    height: 200px;
  }

  .top-container {
    background-color: #FCE38A;
    width: 100%;
    height: 100%;
  }

  .bottom-container {
    width: 100%;
    background-color: #95E1D3;
    height: 100%;
  }
</style>
