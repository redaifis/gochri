<template>
  <div class="suggestions">
    <label>Vous pourriez aussi aimer :</label>
    <div>
      <suggestion v-for="suggestion in suggestions" :key="suggestion.id" :suggestion="suggestion" />
    </div>
  </div>
</template>

<script>
import suggestion from "@/components/productdetails/suggestion.vue";
export default {
  components: {
    suggestion
  },
  props: ['product'],
  data(){
      return {
          suggestions: []
      }
  },
  methods: {
      getSuggestions(){
          axios.get('/api/products/suggestions/'+this.product.subcategory.id)
          .then(res => this.suggestions = res.data.products)
          .catch(err => console.log(err))
      }
  },
  mounted(){
      this.getSuggestions()
  }
};
</script>

<style lang="stylus" scoped>
.suggestions {
  label {
    display: block;
    text-align: left;
    color: orange;
    font-weight: bold;
    font-size: 25pt;
    margin-top: 50px;
  }

  &>div {
    display: flex;
    margin: 30px 0px;
    width: 100%;
    overflow: hidden;
    flex-wrap: wrap;
  }
}
</style>
