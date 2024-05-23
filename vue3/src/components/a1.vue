
<template>
    <div>1111</div>

    <button @click="fun">111</button>
</template>

<script setup>


const fun = (event) => {
    // console.log("");

    const userInfo = JSON.parse(localStorage.getItem('userInfo'));
    console.log(userInfo);

};



</script>
