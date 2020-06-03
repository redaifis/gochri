<template>
  <div>
    <input
      type="range"
      :min="min"
      :max="max"
      ref="range"
      class="slider"
      :value="value"
      @input="updateValue"
    />
  </div>
</template>

<script>
export default {
  props: {
    value: Number,
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
      let range = this.$refs.range;

      let stopVal = (range.value - this.min) / (this.max - this.min);

      // coloring the range
      if (range.value > this.min || range.value < this.max) {
        range.style.background =
          "-webkit-gradient(linear, 0 0, 100% 0, from(" +
          this.backgroundColor.selected +
          "), color-stop(" +
          stopVal +
          ", " +
          this.backgroundColor.selected +
          "), color-stop(" +
          stopVal +
          ", " +
          this.backgroundColor.normal +
          "))";
      } else {
        range.style.background = "";
      }
    },
    updateValue: function() {
      this.colorizeRange();

      this.$emit("input", parseInt(this.$refs.range.value));
    }
  }
};
</script>

<style lang="stylus" scoped>
$sliderColor = #dadada;
$thumbColor = orange;
$sliderHeight = 5px;
$thumbSize = 20px;

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: $sliderHeight;
  border-radius: 5px;
  background: $sliderColor;
  outline: none;
  -webkit-transition: 0.2s;
  transition: opacity 0.2s;
  margin: 0;
  margin-bottom: 20px;

  &::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: $thumbSize;
    height: $thumbSize;
    background: $thumbColor;
    cursor: pointer;
  }

  &::-moz-range-thumb {
    -moz-appearance: none;
    appearance: none;
    width: $thumbSize;
    height: $thumbSize;
    background: $thumbColor;
    cursor: pointer;
  }
}
</style>