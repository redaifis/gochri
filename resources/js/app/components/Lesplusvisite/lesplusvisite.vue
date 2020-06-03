<template>
  <div class="lesplusvisite">
    <label>Nos rayons les plus visité</label>
    <div>
      <Rayon
        v-for="rayon in rayons"
        :key="rayon.id"
        :image="rayon.image"
        :name="rayon.name"
        :slug="rayon.slug"
      />
    </div>
  </div>
</template>

<script>
import Rayon from "@/components/Lesplusvisite/Rayon.vue";
export default {
  components: {
    Rayon
  },
  props:['categories'],
  data: function() {
    return {

    };

  },
  computed: {
        rayons(){
            let categoriesToShow = this.categories.slice(0,4)
            categoriesToShow.push({name:'tous les rayons',slug:'categories',image:'buttonplus.png'})
            return categoriesToShow
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

.lesplusvisite {
  background-color: orange;
  padding: 40px 0;
  margin: 60px 0;

  div {
    display: flex;
    width: max-content;
    margin: auto;

    +for_m() {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      justify-content: center;
    }

    +for_s() {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  label {
    color: white;
    font-size: 30pt;
    margin-bottom: 20px;
    display: block;
  }

  +for_s() {
    label {
      font-size: 24pt;
    }
  }
}
</style>
