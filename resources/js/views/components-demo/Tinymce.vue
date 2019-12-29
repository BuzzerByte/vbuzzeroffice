<template>
  <div class="components-container">
    <code>
      {{ $t('components.tinymceTips') }}
      <a target="_blank" class="link-type" href="https://panjiachen.github.io/vue-element-admin-site/feature/component/rich-editor.html"> {{ $t('components.documentation') }}</a>
    </code>
    <div>
<<<<<<< HEAD
      <tinymce :height="300" v-model="content"/>
    </div>
    <div class="editor-content" v-html="content"/>
=======
      <tinymce v-model="content" :height="300" />
    </div>
    <div class="editor-content" v-html="content" />
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
  </div>
</template>

<script>
import Tinymce from '@/components/Tinymce';

export default {
  name: 'TinymceDemo',
  components: { Tinymce },
  data() {
    return {
      content:
<<<<<<< HEAD
      `<h1 style="text-align: center;">Welcome to the TinyMCE demo!</h1><p style="text-align: center; font-size: 15px;"><img title="TinyMCE Logo" src="//www.tinymce.com/images/glyph-tinymce@2x.png" alt="TinyMCE Logo" width="110" height="97" /><ul>
=======
        `<h1 style="text-align: center;">Welcome to the TinyMCE demo!</h1><p style="text-align: center; font-size: 15px;"><img title="TinyMCE Logo" src="//www.tinymce.com/images/glyph-tinymce@2x.png" alt="TinyMCE Logo" width="110" height="97" /><ul>
>>>>>>> e4f5078caabc533ff96e7c2a910b55e0a2db0278
        <li>Our <a href="//www.tinymce.com/docs/">documentation</a> is a great resource for learning how to configure TinyMCE.</li><li>Have a specific question? Visit the <a href="https://community.tinymce.com/forum/">Community Forum</a>.</li><li>We also offer enterprise grade support as part of <a href="https://tinymce.com/pricing">TinyMCE premium subscriptions</a>.</li>
      </ul>`,
    };
  },
};
</script>

<style scoped>
.editor-content{
  margin-top: 20px;
}
</style>

