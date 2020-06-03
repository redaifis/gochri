<template>
  <div>
    <img :src="img" />
    <label>{{title}}</label>
  </div>
</template>

<script>
export default {
  props: {
    img: String,
    title: String
  }
};
</script>

<style lang="stylus" scoped>
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
div {
  position: relative;

  img {
    width: 100%;
    height: 300px;
    object-fit: cover;

    +for_s() {
      height: 200px;
    }
  }

  label {
    position: absolute;
    color: white;
    font-size: 80pt;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);

    +for_s() {
      font-size: 60pt;
    }
  }
}
</style>
