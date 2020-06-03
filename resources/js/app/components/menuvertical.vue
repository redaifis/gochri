<template>
  <div class="categories">
      <ul>
          <li v-for="category in categories" :key="category.id"><a :href="'/search/category/' + category.name" @click.prevent="selectCategory(category)" :class="{selected: selectedCategory.id == category.id}"><i class="fas fa-angle-right icon"></i> {{category.name}}</a></li>
      </ul>
      <ul class="subcategories" v-if="selectedCategory != null">
          <li v-for="subcategory in selectedCategory.subcategories" :key="subcategory.id"><a :href="'/search/subcategory/' + subcategory.name"><i class="fas fa-angle-right icon"></i> {{subcategory.name}}</a></li>
      </ul>
  </div>
</template>

<script>
export default {
    props: ['categories'],
    data(){
        return {
            selectedCategory: {}
        }
    },
    methods:{
        selectCategory(category){
            this.selectedCategory = category
        }
    }
};
</script>

<style lang="stylus" scoped>
.categories
    // border: .5px solid #f29537
    margin 30px
    border-radius 10px
ul
    margin: 20px auto
    list-style: none
    padding: 0

li
    text-align: left
    padding: 10px 0
    color: #f29537

li a
    color: #f29537
    text-decoration: none
    padding: 5px 10px

.selected
    background-color: #f29537
    color: #fff


.icon
    margin-right: 10px
</style>

