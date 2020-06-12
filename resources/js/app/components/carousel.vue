<template>
  <agile :initial-slide="3">
    <img v-for="banner in banners" :key="banner.id"
      class="slide"
      :src="banner.img"
    />
  </agile>
</template>

<script>
import { VueAgile } from "vue-agile";
export default {
  components: {
    agile: VueAgile
  },
  data(){
      return{
          banners: [
            {
                id: 1,
                img: '/storage/images/banners/banner1.jpg',
            },
            {
                id: 2,
                img: '/storage/images/banners/banner2.jpg',
            },
            {
                id: 3,
                img: '/storage/images/banners/banner3.jpg',
            },
            {
                id: 4,
                img: '/storage/images/banners/banner4.jpg',
            },
          ]
      }
  }
};
</script>

<style lang="stylus" >
.agile__nav-button {
  background: transparent;
  border: none;
  color: #fff;
  cursor: pointer;
  font-size: 24px;
  height: 100%;
  position: absolute;
  top: 0;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  width: 80px;
}

.agile__nav-button:hover {
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 1;
}

.agile__nav-button--prev {
  left: 0;
}

.agile__nav-button--next {
  right: 0;
}

.agile__dots {
  bottom: 10px;
  left: 50%;
  position: absolute;
  -webkit-transform: translateX(-50%);
  transform: translateX(-50%);
}

.agile__dot {
  margin: 0 10px;
}

.agile__dot button {
  background-color: transparent;
  border: 1px solid #fff;
  border-radius: 50%;
  cursor: pointer;
  display: block;
  height: 10px;
  font-size: 0;
  line-height: 0;
  margin: 0;
  padding: 0;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  width: 10px;
}

.agile__dot--current button, .agile__dot:hover button {
  background-color: #fff;
}

.slide {
  display: block;
  height: 500px;
  -o-object-fit: cover;
  object-fit: cover;
  width: 100%;
}
</style>
