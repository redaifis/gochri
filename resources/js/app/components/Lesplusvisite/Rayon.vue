<template>
        <a :href="'/search/category/'+name">
            <div>
            <img :src="'/storage/images/categories/'+image"/>
            <label>{{name}}</label>
            </div>
        </a>


</template>

<script>
export default {
  props: {
    name: String,
    slug: String,
    image: String
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
  text-decoration: none;
  background-color: white;
  color: black;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 10px;
  width: 200px;
  height: 200px;
  border-radius: 50%;
  justify-content: center;
  border: 5px solid #f9cc9f;
  box-shadow: 6px 5px 5px #0000002e;
  transition: transform 0.2s;

  &:hover {
    transform: rotate(-10deg) scale(1.03);
  }

  img {
    object-fit: contain;
    height: 100px;
    width: 100px;
  }

  div {
    display: flex;
    flex-direction: column;
    align-items: center;

    label {
      margin-top: 10px;
    }
  }

  +for_s() {
    width: 150px;
    height: 150px;

    div {
      label {
        font-size: 10pt;
        margin: 0px;
      }
    }
  }
}
</style>
