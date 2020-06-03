<template>
  <div class="double-slider">
    <input ref="from" :value="value.from" :min="min" :max="max" type="range" @input="updateValue()" />
    <input ref="to" :value="value.to" :min="min" :max="max" type="range" @input="updateValue()" />
  </div>
</template>

<script>
export default {
  props: {
    value: Object,
    min: Number,
    max: Number
  },
  data: function() {
    return {
      backgroundColor: {
        normal: "#dadada",
        selected: "orange"
      }
    };
  },
  mounted: function() {
    this.colorizeRange();
  },
  updated: function() {
    this.colorizeRange();
  },
  methods: {
    colorizeRange: function() {
      let from = this.$refs.from;
      let to = this.$refs.to;

      let stopfrom = (from.value - this.min) / (this.max - this.min);
      let stopto = (to.value - this.min) / (this.max - this.min);

      // coloring the range
      if (from.value >= this.min || to.value <= this.max) {
        from.style.background = to.style.background =
          "-webkit-gradient(linear, 0 0,100% 0, color-stop(0, " +
          this.backgroundColor.normal +
          "), color-stop(" +
          stopfrom +
          ", " +
          this.backgroundColor.normal +
          "),color-stop(" +
          stopfrom +
          ", " +
          this.backgroundColor.selected +
          "), color-stop(" +
          stopto +
          ", " +
          this.backgroundColor.selected +
          "), color-stop(" +
          stopto +
          ", " +
          this.backgroundColor.normal +
          "))";
      } else {
        from.style.background = to.style.background = "";
      }
    },
    updateValue: function() {
      let from = this.$refs.from;
      let to = this.$refs.to;

      // Avoiding overlap
      if (from.value >= to.value) {
        from.value = to.value - 3;
        return;
      }

      // Avoiding overlap
      if (to.value <= from.value) {
        to.value = from.value + 3;
        return;
      }

      this.colorizeRange();

      this.$emit("input", {
        from: parseInt(from.value),
        to: parseInt(to.value)
      });
    }
  }
};
</script>

<style lang="stylus" scoped>
$thumbColor = orange;
$sliderHeight = 5px;
$thumbSize = 20px;

.double-slider {
  position: relative;
  height: 35px;
  text-align: center;

  input {
    -webkit-appearance: none;
    appearance: none;
    pointer-events: none;
    position: absolute;
    left: 0;
    top: 15px;
    width: 100%;
    outline: none;
    background: #dadada;
    height: $sliderHeight;
    margin: 0;
    padding: 0;
    border-radius: 8px;

    &::-webkit-slider-thumb {
      pointer-events: all;
      position: relative;
      z-index: 1;
      outline: 0;
      -webkit-appearance: none;
      width: $thumbSize;
      height: $thumbSize;
      background: $thumbColor;
    }

    &::-moz-range-thumb {
      pointer-events: all;
      position: relative;
      z-index: 1;
      outline: 0;
      -webkit-appearance: none;
      width: $thumbSize;
      height: $thumbSize;
      background: $thumbColor;
    }
  }
}
</style>