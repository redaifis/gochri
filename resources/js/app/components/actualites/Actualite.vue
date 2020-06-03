<template>
  <a :href="'/search/'+actualite.slug">
    <img :src="actualite.image" />
    <label>{{actualite.name}}</label>
  </a>
</template>

<script>
export default {
  name: "Actualite",
  props: ['actualite']
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
  text-decoration: none;
  background-color: orange;
  border-radius: 10px;
  box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.169);
  transition: transform 0.2s;

  &:hover {
    transform: scale(1.03);
  }

  img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
  }

  label {
    color: white;
    font-size: 18pt;
    height: 130px;
    padding: 20px;
    box-sizing: border-box;
    padding-top: 30px;
  }

  +for_s() {
    label {
      height: auto;
      margin-bottom: 20px;
    }
  }
}
</style>
