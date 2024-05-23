
<template>
    <a-layout>
        <a-layout-header  :style="layoutHeader"   >
            <HeaderContact></HeaderContact>
        </a-layout-header>

        <a-layout-content :style="layoutContent">
            <LoginContact></LoginContact>
        </a-layout-content>

        <a-layout-footer :style="layoutFooter">
            <FooterContact></FooterContact>

        </a-layout-footer>
    </a-layout>

</template>


<style >


</style>

<script setup>
import FooterContact from "./FooterContact.vue";
import LoginContact from "./LoginContact.vue";
import HeaderContact from "./HeaderContact.vue";

import { layoutHeader, layoutContent,layoutFooter  } from "./style.vue";

// const headerStyle = {
//     backgroundColor:'blue',
//     color:'white',
//     height:'60px',

// };

</script>
