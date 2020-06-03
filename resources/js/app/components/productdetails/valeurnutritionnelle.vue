<template>
  <div>
    <label>{{name}}</label>
    <label>{{value}}</label>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    value: String
  }
};
</script>

<style lang="stylus" scoped>
div {
  display: flex;
  justify-content: space-between;
  border-bottom: 1px solid lightgrey;
  padding: 5px 0px;
  margin: 2px 0px;

  label {
    font-size: 14pt;
  }
}
</style>