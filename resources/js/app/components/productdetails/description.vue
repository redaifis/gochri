<template>
  <div class="description">
    <label class="title">Description</label>
    <p>{{product.description}}</p>
    <!-- <label class="title">Ingrédients / Composition</label>
    <label class="title">Ingrédients :</label>
    <label>{{data.ingredients.title}}</label>
    <label class="title">Valeurs nutritionnelles {{data.ingredients.unit}}:</label>
    <valeurnutritionnelle
      v-for="item in data.ingredients.items"
      :key="item.name"
      :name="item.name"
      :value="item.value"
    /> -->
  </div>
</template>

<script>
import valeurnutritionnelle from "@/components/productdetails/valeurnutritionnelle.vue";
export default {
  components: {
    valeurnutritionnelle
  },
  props: ['product']
};
</script>

<style lang="stylus" scoped>
.description {
  display: flex;
  flex-direction: column;
  text-align: left;
  width: 700px;
  margin: 40px 0px 30px 0px;
  max-width: 100%;

  .title {
    font-weight: bold;
    font-size: 16pt;
    margin: 2px 0px;
    margin-top: 10px;

    &:first-child {
      font-size: 20pt;
    }
  }
}
</style>
