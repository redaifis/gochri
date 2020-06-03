<template>
  <div class="img_acceuil">
    <img src="https://via.placeholder.com/1000x400" />
    <div>
      <label>Faite vos courses en ligne</label>
      <button>Je me connecte</button>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

export default {};
</script>
<style lang="stylus" scoped>
.img_acceuil {
  position: relative;

  img {
    width: 100%;
    height: 400px;
    object-fit: cover;
  }

  div {
    position: absolute;
    right: 300px;
    top: 154px;
    display: flex;
    flex-direction: column;
    align-items: center;

    label {
      color: white;
      font-size: 24pt;
      margin-bottom: 30px;
    }

    button {
      background-color: white;
      color: orange;
      border-radius: 5px;
      border: none;
      padding: 5px 10px;
    }
  }

  +for_s() {
    img {
      height: 200px;
    }

    div {
      right: auto;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;

      label {
        margin-bottom: 10px;
      }
    }
  }
}
</style>
