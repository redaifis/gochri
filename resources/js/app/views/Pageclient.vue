<template>
  <div>
    <pageclientimage />

    <div class="pageclient">
      <div>
        <img src="@/assets/compteclient.svg" />
        <label>Compte Client</label>
      </div>
      <div>
        <a href="/customer/compte">
          <img src="@/assets/compteetsecuritericon.svg" />
          <label>Compte et sécurité</label>
        </a>
        <a href="/customer/orders">
          <img src="@/assets/historiquedesachatsicon.svg" />
          <label>Historique des achats</label>
        </a>
        <a href="/customer/wishlist">
          <img src="@/assets/heart.svg" />
          <label>Wishlist</label>
        </a>
        <a href="/contact">
          <img src="@/assets/contacticon.svg" />
          <label>Contact</label>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  name: "Pageclient",
  components: {
    pageclientimage
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

.pageclient {
  background-image: url('~@/assets/arriereplanicon.svg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: auto 77%;
  margin: 30px;

  +for_m() {
    width: calc(100% - 20px);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    box-sizing: border-box;
  }

  div:first-child {
    display: flex;
    flex-direction: column;
    align-items: center;

    label {
      font-size: 30pt;
      font-weight: bold;

      +for_s() {
        font-size: 20pt;
        margin-top: 10px;
      }
    }

    img {
      width: 65px;

      +for_s() {
        width: 50px;
      }
    }
  }

  div:nth-child(2) {
    display: grid;
    grid-template-columns: repeat(2, max-content);
    grid-gap: 10px;
    width: max-content;
    margin: 10px auto;

    +for_xs() {
      grid-template-columns: repeat(1, max-content);
    }

    img {
      width: 155px;
      height: 155px;
      border: 1px solid orange;
      border-radius: 10px;
      background-color: white;
      padding: 20px;
      margin: 20px;
      box-shadow: 5px 5px 5px #8c8b8a59;
      object-fit: contain;

      +for_s() {
        width: 100px;
        height: 100px;
      }

      +for_xs() {
        width: 80px;
        height: 80px;
      }
    }

    a {
      text-decoration: none;
      margin-top: 20px;
      transition: transform 0.2s;

      &:hover {
        transform: scale(1.03);
      }
    }

    label {
      color: #666666;
      display: flex;
      flex-direction: column;
      font-size: 18pt;

      +for_s() {
        font-size: 15pt;
      }
    }
  }
}
</style>
