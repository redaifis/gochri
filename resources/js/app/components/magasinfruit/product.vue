<template>
  <a :href="lien">
    <label>{{titre}}</label>
    <img v-bind:src="img" />
    <label>{{prix}}Dh</label>
  </a>
</template>

<script>
export default {
  props: {
    titre: String,
    lien: String,
    prix: Number,
    img: String
  }
};
</script>

<style lang="stylus" scoped>
a {
  display: flex;
  flex-direction: column;
  align-items: center;
  border: 1px solid grey;
  border-radius: 10px;
  color: grey;
  padding: 20px;
  box-shadow: 1px 2px 5px #0000002b;

  img {
    margin: 10px;
    width: 100px;
    height: 100px;
    object-fit: contain;
  }
}
</style>