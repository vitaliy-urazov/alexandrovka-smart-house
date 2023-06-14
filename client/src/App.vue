<script setup xmlns="http://www.w3.org/1999/html">
// This starter template is using Vue 3 <script setup> SFCs
// Check out https://v3.vuejs.org/api/sfc-script-setup.html#sfc-script-setup

import RoomInfo from './components/RoomInfo.vue'
import {onMounted} from "vue";

onMounted(()=>{


})


</script>
<script>
import { useFetch } from './composables/fetch'
import { useRoomInfo } from './composables/useRoomInfo'
import {ref} from "vue";

const roomData = ref(null);
const roomData2 = ref(null);
const roomData3 = ref(null);

const interval = 60000;
const updateInfo = async() => {
  const { data, error } = await useFetch('http://192.168.0.24/index.php')
  // console.log (data.value)
  // console.log (error.value)

  roomData.value = useRoomInfo(data, 'bedroom')
  roomData2.value = useRoomInfo(data, 'livingroom')
  roomData3.value = useRoomInfo(data, 'bathroom')
}


updateInfo();
let timerId = setInterval(updateInfo, interval);


</script>
<template>
  <RoomInfo :data="roomData" title="Спальня"/>
  <RoomInfo :data="roomData2" title="Гостиная"/>
  <RoomInfo :data="roomData3" title="Ванная"/>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Wix+Madefor+Display&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Prompt&family=Wix+Madefor+Display:wght@700&display=swap');

@font-face {
  font-family: "WixMade";
  src: local("WixMade"),
  url(/assets/WixMadeforDisplay-VariableFont_wght.ttf) format("truetype");
}

#app {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 50px 50px;
  padding: 50px;
  flex-wrap:wrap;
}

body{
  /*background: hsla(0, 87%, 79%, 1);*/
  /*background: linear-gradient(90deg, hsla(0, 87%, 79%, 1) 0%, hsla(6, 77%, 85%, 1) 100%);*/
  /*background: -moz-linear-gradient(90deg, hsla(0, 87%, 79%, 1) 0%, hsla(6, 77%, 85%, 1) 100%);*/
  /*background: -webkit-linear-gradient(90deg, hsla(0, 87%, 79%, 1) 0%, hsla(6, 77%, 85%, 1) 100%);*/
  /*filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#F89999", endColorstr="#F6C0BA", GradientType=1 );*/


  background: hsla(18, 76%, 85%, 1);
  background: linear-gradient(180deg, hsla(18, 76%, 85%, 1) 0%, hsla(203, 77%, 85%, 1) 100%);
  background: -moz-linear-gradient(180deg, hsla(18, 76%, 85%, 1) 0%, hsla(203, 69%, 84%, 1) 100%);
  background: -webkit-linear-gradient(180deg, hsla(18, 76%, 85%, 1) 0%, hsla(203, 69%, 84%, 1) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#F6CFBE", endColorstr="#B9DCF2", GradientType=1 );

  /*background: linear-gradient(180deg, hsla(18, 76%, 85%, 1) 0%, hsla(203, 69%, 84%, 1) 100%);*/
  animation: gradient 10s infinite linear;
  background-size: 300%;

  /*background-color: #EEEEEE;*/

  /*font-family: 'Nunito'*/
  font-family: 'WixMade', 'Wix Madefor Display', sans-serif;
}
@keyframes gradient {
  0% {
    background-position: 80% 0%;
  }
  50% {
    background-position: 20% 100%;
  }
  100% {
    background-position: 80% 0%;
  }
}
</style>
