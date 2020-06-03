<template>
  <div class="promotion">
    <label>A NE PAS RATER !</label>
    <div>
      <Product
        v-for="product in promotions"
        :key="product.id"
        :image="product.image"
        :name="product.name"
        :price="product.price"
        :slug="product.slug"
        :discount="product.discount"
      />
    </div>
  </div>
</template>

<script>
import Product from "@/components/promotion/product.vue";
export default {
    props:['promotions'],
  components: {
    Product
  },
  data: function() {
    return {
      products: [
        {
          id: 1,
          img: "img/valencia.jpg",
          titre: "Jus Valencia 1L",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 5
        },
        {
          id: 2,
          img: "img/nescafe.jpg",
          titre: "Nescafe caffe intenso dolse gusto",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
        },
        {
          id: 3,
          img: "img/eau.jpg",
          titre: "Pack Sidi Ali",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
        },
        {
          id: 4,
          img: "img/panzani.png",
          titre: "Pates Panzani 1Kg",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
        },
        {
          id: 5,
          img: "img/nutella.jpg",
          titre: "Nutella pâte à tartiner pot 750g",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
        },
        {
          id: 6,
          img: "img/banane.png",
          titre: "Yaourt naturel Danone",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
        },
        {
          id: 7,
          img: "img/huileor.jpg",
          titre: "Huile de table Huilor",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
        },
        {
          id: 8,
          img: "img/kiri.png",
          titre: "Fromage Kiri 432g",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
        },
        {
          id: 9,
          img: "img/sucre.jpg",
          titre: "Sachet sucre en poudre 1Kg",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
        },
        {
          id: 10,
          img: "img/charcutrie.jpg",
          titre: "Charcutrie koutobia 250g",
          lien: "https://www.google.com/?hl=fr",
          prix: {
            avant: 250,
            apres: 200
          },
          promo: 20
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

.promotion {
  background-color: #F2F2F2;
  padding: 40px;

  div {
    display: grid;
    grid-template-columns: repeat(5, calc(((100% - 40px) / 5)));
    grid-gap: 10px;
    width: 100%;
    margin: auto;

    +for_m() {
      grid-template-columns: repeat(3, calc(((100% - 20px) / 3)));
    }

    +for_s() {
      grid-template-columns: repeat(2, calc(((100% - 10px) / 2)));
    }
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
