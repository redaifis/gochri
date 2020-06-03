<template>
  <a :href="'/products/'+slug">
    <img v-bind:src="'/storage/images/products/'+ image" />
    <label>{{name}}</label>
    <label>{{price}}Dh</label>
    <div>
      <label>{{discount}}%</label>
      <label>Promotion</label>
      <img src="@/assets/promotionarrow.svg" />
    </div>
  </a>
</template>

<script>
export default {
  props: ['name','price','discount','image','slug']
};
</script>

<style lang="stylus" scoped>
a {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-decoration: none;
  color: black;
  width: 100%;
  box-sizing: border-box;
  padding: 20px;
  border: 1px solid grey;
  border-radius: 10px;
  background-color: white;
  overflow: hidden;
  box-shadow: 1px 2px 5px #0000002b;
  position: relative;
  transition: transform 0.5s;

  &:hover {
    transform: scale(1.03);
    border: 1px solid orange;
  }

  label {
    color: orange;
  }

  &>label:nth-child(2) {
    margin-bottom: 30px;
    color: #656C72;
  }

  &>label:nth-child(3) {
    font-weight: bold;
    font-size: 15pt;
    position: absolute;
    bottom: 20px;
  }

  div:nth-child(4) {
    display: flex;
    flex-direction: column;
    position: absolute;
    left: 0;
    top: 0;

    label {
      background-color: orange;
      color: white;
      font-size: 10pt;
      padding: 0px 10px;
      font-weight: bold;
      font-style: italic;

      &:nth-child(1) {
        font-size: 25pt;
        padding-top: 10px;
      }

      &:nth-child(2) {
        padding-bottom: 10px;
      }
    }

    img {
      width: 20px;
      height: 20px;
      display: block;
      margin-top: -2px;
    }
  }

  &>img {
    width: 150px;
    height: 150px;
    object-fit: contain;
    padding: 10px;
    box-sizing: border-box;
    margin-bottom: 10px;
  }
}
</style>
