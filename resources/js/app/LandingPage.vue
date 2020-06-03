<template>
  <div id="app">


    <Header :categories="ressources.categories"></Header>

    <!-- Content -->
    <Home :ressources="ressources"></Home>

    <div class="info_footer">
      <div>
        <img src="@/assets/Gicon.svg" />
        <img src="@/assets/delivery.jpg" />
        <label>Un service de livraison assurée</label>
      </div>
      <div>
        <img src="@/assets/Gicon.svg" />
        <img src="@/assets/payement.jpg" />
        <label>Un mode de paiement sécurisé</label>
      </div>
      <div>
        <img src="@/assets/Gicon.svg" />
        <img src="@/assets/serviceclient.jpg" />
        <label>Un service client a votre disponibilité</label>
      </div>
    </div>

    <Footer></Footer>

  </div>
</template>
<script>
import Header from '@/partials/Header.vue'
import Footer from '@/partials/Footer.vue'
import Home from '@/views/Home.vue'
export default{
    components: {
        Header,
        Footer,
        Home
    },
    data(){
        return{
            ressources: {
                categories: [],
                latestProducts: [],
                // PopularCategories: [],
                RecommandedProducts: [],
                Promotions: []
            }

        }
    },
    methods: {
        getRessources(){
            axios.get(`/api/mainpage`)
            .then(res => this.ressources = res.data)
            .catch(err => console.log(err))
        },

    },
    mounted(){
        this.getRessources()
    }
}
</script>
<style lang="stylus">
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

@import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap');

* {
  font-family: 'Source Sans Pro', sans-serif;
}

.navlinks {
  +for_l() {
    background-color: green;
  }

  +for_m() {
    background-color: yellow;
  }

  +for_s() {
    background-color: orange;
  }

  +for_xs() {
    background-color: red;
  }
}

.info_footer {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(365px, 1fr));
  grid-gap: 40px;
  background-color: #f2f2f2;
  padding: 40px 40px 70px 40px;

  div {
    display: flex;
    background-color: orange;
    color: white;
    align-items: center;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 2px 2px 4px #0000004a;
    position: relative;
    transition: transform 0.5s;

    &:hover {
      transform: scale(1.025);
    }

    &:hover img:nth-of-type(1) {
      transform: scale(1.2);
    }

    img {
      &:nth-of-type(2) {
        width: 200px;
        height: 200px;
        object-fit: cover;
      }

      &:nth-of-type(1) {
        width: 25px;
        position: absolute;
        bottom: 10px;
        left: 10px;
        transition: transform 0.25s;
      }
    }

    label {
      font-size: 16pt;
      text-align: left;
      padding: 30px;
      font-weight: bold;
    }
  }
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

body {
  margin: 0;
}
</style>
