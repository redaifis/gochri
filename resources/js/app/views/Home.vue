<template>
  <div class="Home">
    <carousel />
    <div class="section2">
      <div>
        <img src="@/assets/pc.png" />
        <label>Je sélectionne mes produits</label>
      </div>
      <div>
        <img src="@/assets/panier4.svg" />
        <label>Je valide ma commande</label>
      </div>
      <div>
        <img src="@/assets/home.png" />
        <label>Je récupére mes courses</label>
      </div>
    </div>
    <actualites :latestProducts="ressources.latestProducts" />
    <lesplusvisite :categories="ressources.categories"/>
    <selectionproduit :recommandedProducts="ressources.recommandedProducts" />
    <!-- <magasinfruit /> -->
    <promotion :promotions="ressources.promotions" />
  </div>
</template>

<script>
// @ is an alias to /src
import carousel from "@/components/carousel.vue";
// import magasinfruit from "@/components/magasinfruit/magasinfruit.vue";
import promotion from "@/components/promotion/promotion.vue";
import selectionproduit from "@/components/Selectionproduit/selectionproduit.vue";
import lesplusvisite from "@/components/Lesplusvisite/lesplusvisite.vue";
import actualites from "@/components/actualites/actualites.vue";
export default {
  name: "Home",
  props:['ressources'],
  components: {
    actualites,
    lesplusvisite,
    selectionproduit,
    promotion,
    // magasinfruit,
    carousel
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

.section2 {
  display: flex;
  background-color: #F2F2F2;
  justify-content: space-between;
  border-radius: 15px;
  padding: 30px 20px;
  max-width: 1000px;
  margin: 50px auto;

  div {
    display: flex;
    align-items: center;

    img {
      width: 50px;
    }

    label {
      margin-left: 10px;
      color: orange;
    }
  }

  +for_s() {
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    margin: 20px;
    max-width: 260px;
    margin: 20px auto;
    padding: 10px 20px;

    div {
      padding: 10px 0px;
    }
  }
}
</style>
