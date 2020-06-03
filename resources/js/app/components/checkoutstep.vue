<template>
  <div class="checkoutstep">
    <div :class="{current:step>=1}">
      <div>
        <img v-if="step<1" src="@/assets/panier2.svg" />
        <img v-else src="@/assets/panier3.svg" />
      </div>
      <label>Panier</label>
    </div>
    <div :class="{current:step>=2}">
      <div>
        <img v-if="step<2" src="@/assets/truck.svg" />
        <img v-else src="@/assets/truck2.svg" />
      </div>
      <label>Livraison</label>
    </div>
    <div :class="{current:step>=3}">
      <div>
        <img v-if="step<3" src="@/assets/carteo.png" />
        <img v-else src="@/assets/carteb.png" />
      </div>
      <label>Paiement</label>
    </div>
    <div :class="{current:step>=4}">
      <div>
        <img v-if="step<4" src="@/assets/flago.png" />
        <img v-else src="@/assets/flagb.png" />
      </div>
      <label>Confirmation</label>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    step: Number
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

.checkoutstep {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  width: 100%;
  max-width: 700px;
  margin: auto;
  margin-bottom: 40px;

  +for_s() {
    margin-bottom: 20px;
    margin-top: 20px;
  }

  &>div {
    label {
      font-size: 13pt;

      +for_xs() {
        font-size: 10pt;
      }
    }

    &>div {
      position: relative;

      &:before {
        content: ' ';
        height: 10px;
        width: 100%;
        background-color: #e6e6e6;
        display: block;
        position: absolute;
        top: 50%;
        right: 0;
        transform: translate(-50%, -50%);
        z-index: 1;

        +for_xs() {
          height: 5px;
        }
      }

      img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        background-color: #e6e6e6;
        border-radius: 35%;
        padding: 10px;
        z-index: 2;
        position: relative;

        +for_xs() {
          width: 25px;
          height: 25px;
          padding: 5px;
        }
      }
    }

    &.current {
      & div:before {
        background-color: orange;
      }

      img {
        background-color: orange;
      }
    }

    &:first-child div:before {
      display: none;
    }

    &:last-child div:after {
      display: none;
    }
  }
}
</style>
