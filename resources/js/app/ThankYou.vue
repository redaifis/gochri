<template>
  <div id="app">


    <Header></Header>

    <!-- Thank you -->
    <Thanks></Thanks>

    <Footer></Footer>

  </div>
</template>
<script>
import Header from '@/partials/Header.vue'
import Footer from '@/partials/Footer.vue'
import Thanks from '@/checkout/ThankYou.vue'
export default{
    // props:['product'],
    components: {
        Header,
        Footer,
        Thanks
    },
}
</script>
<style lang="stylus">

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
