<template>
  <div class="product">
    <img :src="'/storage/images/products/' + product.image" />
    <div>
      <label><a style="text-decoration:none;color: #2c3e50;" :href="'/products/' + product.slug">{{product.name.length > 50 ? product.name.slice(0,50) : product.name}}</a></label>
      <label>'</label>
    </div>
    <div>
      <label>
        {{product.price}}
        <span>Dhs</span>
      </label>
      <div>
        <label>x{{product.pivot.quantity}}</label>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['product']
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

.product {
  display: grid;
  grid-template-columns: 90px auto max-content max-content;
  grid-gap: 10px;
  margin: 10px 10px;

  +for_s() {
    grid-template-columns: 50px auto max-content max-content;
    margin: 30px 10px;
    border: 1px solid orange;
    background-color: #ffffffc9;
    border-radius: 5px;
    padding: 10px;
    grid-gap: 10px;
  }

  +for_xs() {
    grid-template-columns: 50px auto auto 35px;
  }

  img {
    width: 100%;
  }

  div:nth-child(2) {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-end;
    margin-left: 10px;

    +for_s() {
      font-size: 13pt;
      text-align: left;
      grid-column: span 3;
    }

    label:first-child {
      font-size: 15pt;

      +for_s() {
        font-size: 14pt;
      }
    }

    &>label:nth-child(2) {
      font-size: 16pt;
      color: orange;

      +for_s() {
        font-size: 13pt;
      }
    }
  }

  div:nth-child(3) {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-end;

    +for_s() {
      grid-column-start: 3;
    }

    label:first-child {
      font-size: 18pt;
      font-weight: bold;

      +for_s() {
        font-size: 15pt;
        margin-top: 0px;
        margin-bottom: 10px;
      }

      span {
        font-size: 13pt;

        +for_s() {
          font-size: 13pt;
        }
      }
    }

    div:nth-child(2) {
      font-size: 15pt;
      color: orange;
      display: flex;
      align-items: center;
      flex-direction: row;

      button {
        border: none;
        background: none;
        outline: none;

        &.hide {
          opacity: 0.4;
        }

        img {
          width: 20px;
          height: 20px;
          display: block;
        }

        &:nth-child(3) {
          transform: rotate(180deg);
        }
      }

      +for_s() {
        font-size: 13pt;
      }
    }
  }

  &>button {
    align-self: center;
    border: none;
    background-color: orange;
    color: white;
    border-radius: 10px;
    padding: 8px 13px;
    font-size: 13pt;
    outline: none;

    +for_s() {
      font-size: 10pt;
      justify-self: flex-start;
    }
  }
}
</style>
