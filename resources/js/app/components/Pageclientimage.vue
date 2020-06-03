<template>
  <div class="pageclientimage">
    <img src="@/assets/pageclientimage.png" />
    <div>
      <label>
        Avec
        <img src="@/assets/logo.svg" /> ne bouger surtout pas on arrive
      </label>
    </div>
  </div>
</template>

<script>
export default {};
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

.pageclientimage {
  position: relative;

  &>img {
    height: 500px;
    width: 100%;
    object-fit: cover;

    +for_s() {
      height: 300px;
    }
  }

  div {
    position: absolute;
    bottom: 120px;
    background-color: #ffffffe3;
    font-size: 22pt;
    right: 0px;
    left: 0px;
    padding: 45px 0px;

    +for_s() {
      font-size: 13pt;
      bottom: 100px;
    }

    img {
      width: 250px;
      margin: 0px 10px;
      margin-bottom: -16px;

      +for_s() {
        width: 120px;
        margin-bottom: -9px;
      }
    }
  }
}
</style>
