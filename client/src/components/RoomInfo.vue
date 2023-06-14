<template>

  <div class="room_block shadow">


    <div id="roomName">{{ title }}</div>

    <div style="padding-top: 5px">
      <div class="item_block" :style="{color: data?.temp.level === 1 ? 'black' : (data?.temp.level === 2 ? 'orange' : 'red') }">
        <div class="icon_block"><img src="../assets/thermometer.svg" width="30" onload="SVGInject(this)"/></div>
        <div class="curtain param_name">Температура</div>
        <div class="curtain param_value"><span id="temperature1">{{ data?.temp.val }}</span> º</div>
      </div>


      <div class="item_block" :style="{color: data?.hum.level === 1 ? 'black' : (data?.hum.level === 2 ? 'orange' : 'red') }">
        <div class="icon_block"><img src="../assets/water-percent.svg" width="30" onload="SVGInject(this)"/></div>
        <div class="curtain param_name" >Влажность</div>
        <div class="curtain param_value"><span id="humidity1">{{ data?.hum.val }}</span> %</div>
      </div>


      <div class="item_block" v-if="data?.co2" :style="{color: data?.co2.level === 1 ? 'black' : (data?.co2.level === 2 ? 'orange' : 'red') }">
        <div class="icon_block"><img src="../assets/cloud.svg" width="24" onload="SVGInject(this)" style="padding-right: 3px; padding-left: 3px"/></div>
        <div class="curtain param_name">Воздух</div>
        <div class="curtain param_value"><span id="co21">{{ data?.co2.val }}</span> ppm</div>
      </div>
      <div class="item_block" v-else>
        <div class="curtain param_name">&nbsp;</div>
      </div>
    </div>


  </div>
</template>

<script setup>
import { useScriptTag } from '@vueuse/core'
useScriptTag('/assets/svg-inject.js')

import {SVGInject} from "@iconfu/svg-inject"
import {computed, ref} from "vue";

// const props = defineProps(['data', 'title'])

defineProps({
  title: {
    type: String,
  },
  data: {
    type: Object
  }
});

// const data = ref({
//   email: "",
//   password: "",
// });

// const fontcolor = computed(
//     () => {
//         return this.data.hum.level === 1 ? 'black' : (this.data.hum.level === 2 ? 'yellow' : 'red');
//     }
// )

</script>

<style scoped>

.room_block{
  /*opacity: 70.5%;*/

  background-color: #fff;
  border-radius: 30px;
  padding: 40px;
  min-width: 370px;
  max-width: 400px;
  /*text-align: center;*/
  /*display: inline-block;*/
  /*float: left;*/
  /*padding-right: 100px;*/
}
.shadow {
  box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
}
#roomName {

  /*text-align: center;*/
  /*-border: 1px solid white;*/

  /*font-family: 'Nunito';*/
  font-style: normal;
  font-weight: bold;
  font-size: 36px;
  line-height: 49px;
  /*-text-shadow: 4px 4px 4px #aaa;*/

  /*color: gray;*/
  padding-bottom: 15px;

  /*width: 270px;*/
}
.item_block{
  /*width: 190px; */

  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 10px;
}
.curtain {
  /*text-align: center;*/
  /*-border: 1px solid white;*/
  /*position: relative;*/
  /*top: -50px;*/

  /*font-family: 'Nunito';*/
  font-style: normal;
  font-weight: 500;
  font-size: 26px;
  line-height: 49px;
  /*-text-shadow: 4px 4px 4px #aaa;*/

  /*color: #D4D4D4;*/

  /*  height: 50px;*/
  /*width: 170px;*/
  display: inline-block;
  float: left;
}

.param_name{
  flex-grow: 1;
  /*font-size: 22px;*/
}

.param_value{
  text-align: left;
  flex-basis: content;
}

</style>