<template>
  <div class="main-menu">
    <ul>
      <MenuItem
        v-for="item in categories"
        :key="item.name"
        :data="item"
        :selected="selected[0] == item.name"
        v-on:menuItemClicked="menuItemClicked(0,$event)"
      />
    </ul>
    <ul :class="{visible:selected[0]!=null}">
      <MenuItem
        v-for="item in menus[1]"
        :key="item.name"
        :data="item"
        :selected="selected[1] == item.name"
        v-on:menuItemClicked="menuItemClicked(1,$event)"
      />
    </ul>
    <!-- <ul :class="{visible:selected[1]!=null}">
      <MenuItem
        class="last"
        v-for="item in menus[2]"
        :key="item.name"
        :data="item"
        :selected="selected[2] == item.name"
        v-on:menuItemClicked="menuItemClicked(2,$event)"
      />
    </ul> -->
  </div>
</template>

<script>
import MenuItem from "@/components/Menu/MenuItem.vue";
export default {
  props: ['categories'],
  data: function() {
    return {
      menus: [null, [], []],
      selected: [null, null, null]
    };
  },
  methods: {
    menuItemClicked: function(rank, data) {
      let menuIndex = rank + 1;
      if (menuIndex > 2) menuIndex = 1;

      this.selected[rank] = data.name;
      for (let i = rank + 1; i < 3; i++) {
        this.selected[i] = null;
      }

      for (let i = rank + 2; i < 3; i++) {
        this.menus[i].splice(0, this.menus[i].length);
      }

      if (data.link) this.$router.push(data.link);
      else if (rank != -1) {
        this.menus[menuIndex].splice(0, this.menus[menuIndex].length);
        if(data.subcategories !== null && data.subcategories !== undefined) this.menus[menuIndex].push(...data.subcategories);
      }
    }
  },
  components: {
    MenuItem
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

.main-menu {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-column-gap: 5px;
  margin: 5px;
    position: fixed;
  +for_s() {
    display: none;
  }

  ul {
    margin: 0;
    padding: 0;
    border: 1px solid orange;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 4px 1px 8px #00000052;
    background-color: white;
    transition: transform 1s;

    &:first-child {
      z-index: 9;
    }

    &:nth-child(2) {
      transform: translate(-100%);
      z-index: 8;
    }

    &:nth-child(3) {
      transform: translate(-200%);
      z-index: 7;
    }

    &.visible {
      transform: translate(0px);
    }
  }

  li {
    list-style: none;
  }
}
li {
  list-style: none;
  display: grid;
  grid-template-columns: auto 1fr 10px;
  grid-gap: 5px;
  align-items: center;
  padding: 5px;
  cursor: pointer;
  text-align: left;

  &.selected {
    background-color: orange;
    color: white;
  }

  &:not(.link) span {
    font-weight: bold;
  }

  &.last {
    & span:last-child {
      display: block;
    }

    & span:nth-of-type(1) {
      display: none;
    }
  }

  img {
    width: 35px;
    height: 35px;
    object-fit: contain;
    padding: 3px;
    box-sizing: border-box;
    border: 1px solid orange;
    border-radius: 50%;
  }

  span:last-child {
    display: none;
  }
}
</style>
