<template>
  <div class="app-container">
    <p class="warn-content">
      {{ $t('guide.description') }}
      <a href="https://github.com/kamranahmedse/driver.js" target="_blank">driver.js.
      </a>
    </p>
<<<<<<< HEAD
    <el-button icon="el-icon-question" type="primary" @click.prevent.stop="guide">{{ $t('guide.button') }}</el-button>
=======
    <el-button icon="el-icon-question" type="primary" @click.prevent.stop="guide">
      {{ $t('guide.button') }}
    </el-button>
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
  </div>
</template>

<script>
import Driver from 'driver.js'; // import driver.js
import 'driver.js/dist/driver.min.css'; // import driver.js css
import steps from './define-steps';

export default {
  name: 'Guide',
  data() {
    return {
      driver: null,
    };
  },
  mounted() {
    this.driver = new Driver();
  },
  methods: {
    guide() {
      this.driver.defineSteps(steps);
      this.driver.start();
    },
  },
};
</script>
