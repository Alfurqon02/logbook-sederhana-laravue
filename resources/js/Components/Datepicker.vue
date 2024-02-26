<script setup>
import { ref } from 'vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
// import { ref } from 'vue';

const date = ref(new Date());

// const calendarFn = (weeks) => {
//   return weeks
//         .filter((week) => week.days.some((day) => day.text === 15))
//         .map((week) => ({
//           ...week,
//           days: week.days.map((day) => {
//             day.classData['custom-class'] = true;
//             return day;
//           }),
//         }));
// }
</script>
<template>
    <Datepicker v-model="date" :enable-time-picker="false" :teleport="true" ></Datepicker>
</template>

