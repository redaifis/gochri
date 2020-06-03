<template>
  <div class="actualites">
    <label>Nos actualités</label>
    <div>
      <Actualite
        v-for="actualite in actualites"
        :key="actualite.id"
        :actualite="actualite"
      />
    </div>
  </div>
</template>

<script>
import Actualite from "@/components/actualites/Actualite.vue";
export default {
    props:["latestProducts"],
  components: {
    Actualite
  },
  data: function() {
    return {
      actualites: [
        {
          id: 1,
          image: "img/Jus_bio.jpg",
          name: "Faites le plein d'énergie",
          slug: "category/Boissons"
        },
        {
          id: 2,
          image: "img/plat.jpg",
          name: "Le plaisir d'une petite pause de gourmandise",
          slug: "category/Pains Et Pâtisseries"
        },
        {
          id: 3,
          image: "img/chocolatmms.jpg",
          name: "Un régal pour tous",
          slug: "category/Epicerie Sucrée"
        },
        {
          id: 4,
          image: "img/viande.jpg",
          name: "A consommer avec passion",
          slug: "category/Viandes Et Poissons"
        },
        {
          id: 5,
          image: "img/fromage.png",
          name: "Pour les enfants",
          slug: "category/Crémerie Et Fromages"
        },
        {
          id: 6,
          image: "img/bio.jpg",
          name: "100% BIO",
          slug: "category/Fruits Et Légumes"
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
.actualites {
  width: max-content;
  margin: auto;

  div {
    display: grid;
    grid-template-columns: repeat(3, 320px);
    grid-gap: 40px;
    margin-top: 30px;
  }

  label {
    font-size: 30pt;
    color: orange;
  }

  +for_m() {
    &>div {
      grid-template-columns: repeat(2, 320px);
    }
  }

  +for_s() {
    &>div {
      grid-template-columns: repeat(1, 320px);
    }
  }
}
</style>
