<template>
  <div class="selectionproduit">
    <label>Nos meilleurs articles</label>
    <div>
      <Product
        v-for="product in recommandedProducts"
        :key="product.id"
        :product="product"
      />
    </div>
  </div>
</template>

<script>
import Product from "@/components/Selectionproduit/product.vue";
export default {
    props:['recommandedProducts'],
  components: {
    Product
  },
  data() {
    return {
        productsToShow: this.recommandedProducts

    }
  }

};
</script>

<style lang="stylus" scoped>
orange = #F29537;

for_xs()
  @media screen and (max-width: 600px)
    {block}
for_s()
  @media screen and (max-width: 768px)
    {block}
for_m()
  @media screen and (max-width: 992px)
    {block}
for_l()
  @media screen and (max-width: 1200px)
    {block}

.selectionproduit {
  background-color: #F2F2F2;
  padding: 40px 0;

  label {
    font-size: 30pt;
    color: #ffa500;
  }

  div {
    display: grid;
    grid-template-columns: repeat(4, max-content);
    grid-gap: 20px;
    width: max-content;
    margin: auto;
    margin-top: 30px;
  }

  +for_m() {
    div {
      grid-template-columns: repeat(2, max-content);
    }
  }

  +for_s() {
    label {
      font-size: 24pt;
    }

    div {
      grid-template-columns: repeat(1, max-content);
    }
  }
}
</style>
