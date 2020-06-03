<template>
  <a :href="lien">
    <label>{{titre}}</label>
    <label>{{promo}}</label>
    <img v-bind:src="img" />
    <label>{{prix}}Dh</label>
  </a>
</template>

<script>
export default {
  props: {
    titre: String,
    promo: String,
    lien: String,
    prix: Number,
    img: String
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
a {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  padding: 20px;
  width: 200px;
  border: 1px solid grey;
  border-radius: 10px;
  box-shadow: 1px 2px 5px #0000002b;

  label {
    color: #67760F;
    font-size: 15pt;
    padding: 0px 0px 10px 0px;
  }

  img {
    padding-bottom: 10px;
    width: 150px;
    height: 150px;
    object-fit: contain;
  }
}
</style>
