<template>
    <div> 333</div>
    <div> {{ a }}</div>

    <a-button type="primary">Primary Button</a-button> 

    <button @click="fun">111</button>
</template>



<script setup>


import { ref } from "vue";

const a = ref(10);

a.value = 20;
a.value++;

console.log(a.value);


function fun() {
    a.value++;
}

</script>
