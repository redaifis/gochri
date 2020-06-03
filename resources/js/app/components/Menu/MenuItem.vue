<template>
<a :href="data.category_id !== undefined ? `/search/subcategory/${data.name}` : `/search/category/${data.name}`" :class="{selected : selected}" @mouseover="menuClicked();$emit('menuItemClicked', data);">
  <li >
    <i class="fas fa-angle-right" v-if="data.category_id !== undefined"></i>
    <img :src="'/storage/images/categories/' + data.image" alt="" v-if="data.category_id === undefined">
    {{data.name}}
    <span v-if="!data.slug">&gt;</span>
    <span v-if="!data.slug">&lt;</span>
  </li>

</a>
</template>

<script>
export default {
  props: ['data','selected'],
  methods: {
    menuClicked: function() {}
  }
};
</script>

<style lang="stylus" scoped>
a {
    text-decoration: none
    color: #F29537
}

li {
  list-style: none;
  display: grid;
  grid-template-columns: auto 1fr 10px;
  grid-gap: 5px;
  align-items: center;
  cursor: pointer;
  text-align: left;
  padding: 5px 10px;
    margin: 20px;

  &.selected {
    background-color: orange;
    color: white;
  }

  &:not(.link) span {
    font-weight: bold;
  }

  &.last {
    & span:last-child {
      display: block;
    }

    & span:nth-of-type(1) {
      display: none;
    }
  }

  img {
    width: 35px;
    height: 35px;
    object-fit: contain;
    padding: 3px;
    box-sizing: border-box;
    border: 1px solid orange;
    border-radius: 50%;
  }

  span:last-child {
    display: none;
  }
}
</style>
