<template>
  <div class="magasinfruit">
    <label>Magasin de fruits</label>
    <div>
      <bigproduct
        :titre="bigproduct.titre"
        :img="bigproduct.img"
        :prix="bigproduct.prix"
        :promo="bigproduct.promo"
        :lien="bigproduct.lien"
      />
      <Product
        v-for="product in products"
        :key="product.id"
        :img="product.img"
        :titre="product.titre"
        :prix="product.prix"
        :lien="product.lien"
      />
    </div>
  </div>
</template>

<script>
import Product from "@/components/magasinfruit/product.vue";
import bigproduct from "@/components/magasinfruit/bigproduct.vue";
export default {
  components: {
    Product,
    bigproduct
  },
  data: function() {
    return {
      bigproduct: {
        id: 1,
        img: "img/kiwi.png",
        titre: "Kiwi",
        lien: "https://www.google.com/?hl=fr",
        prix: 150,
        promo: "Acheter 2kg obtenir 1kg gratuit"
      },
      products: [
        {
          id: 1,
          img: "img/orange.png",
          titre: "Orange",
          lien: "https://www.google.com/?hl=fr",
          prix: 150
        },
        {
          id: 2,
          img: "img/fraise.png",
          titre: "Fraise",
          lien: "https://www.google.com/?hl=fr",
          prix: 150
        },
        {
          id: 3,
          img: "img/banane.png",
          titre: "Banane",
          lien: "https://www.google.com/?hl=fr",
          prix: 150
        },
        {
          id: 4,
          img: "img/peche.png",
          titre: "Pêche",
          lien: "https://www.google.com/?hl=fr",
          prix: 150
        },
        {
          id: 5,
          img: "img/ananas.png",
          titre: "Ananas",
          lien: "https://www.google.com/?hl=fr",
          prix: 150
        },
        {
          id: 6,
          img: "img/framboise.png",
          titre: "Framboise",
          lien: "https://www.google.com/?hl=fr",
          prix: 150
        }
      ]
    };
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

.magasinfruit {
  padding: 40px 0;
  width: max-content;
  margin: auto;

  div {
    display: grid;
    grid-template-columns: repeat(4, max-content);
    grid-gap: 20px;

    & :first-child {
      grid-row: span 2;
    }

    +for_m() {
      grid-template-columns: repeat(3, max-content);
    }

    +for_s() {
      grid-template-columns: repeat(2, max-content);
    }
  }

  a {
    text-decoration: none;
  }

  label {
    color: orange;
    font-size: 30pt;
    display: block;
    text-align: center;
    margin-bottom: 40px;

    +for_s() {
      font-size: 24pt;
    }
  }
}
</style>
