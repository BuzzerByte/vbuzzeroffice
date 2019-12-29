<template>
  <div class="components-container">
<<<<<<< HEAD

=======
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
    <el-drag-select v-model="value" style="width:500px;" multiple placeholder="请选择">
      <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value" />
    </el-drag-select>

    <div style="margin-top:30px;">
<<<<<<< HEAD
      <el-tag v-for="item of value" :key="item" style="margin-right:15px;">{{ item }}</el-tag>
    </div>

=======
      <el-tag v-for="item of value" :key="item" style="margin-right:15px;">
        {{ item }}
      </el-tag>
    </div>
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
  </div>
</template>

<script>
import ElDragSelect from '@/components/DragSelect'; // base on element-ui

export default {
  name: 'DragSelectDemo',
  components: { ElDragSelect },
  data() {
    return {
      value: ['Apple', 'Banana', 'Orange'],
      options: [{
        value: 'Apple',
        label: 'Apple',
      }, {
        value: 'Banana',
        label: 'Banana',
      }, {
        value: 'Orange',
        label: 'Orange',
      }, {
        value: 'Pear',
        label: 'Pear',
      }, {
        value: 'Strawberry',
        label: 'Strawberry',
      }],
    };
  },
};
</script>
