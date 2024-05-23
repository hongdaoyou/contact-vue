
<template>
    <a-layout>
        <a-layout-header  :style="layoutHeader"   >
            <HeaderContact></HeaderContact>
        </a-layout-header>

        <ContentContact></ContentContact>
        
        <a-layout-footer :style="layoutFooter">
            <FooterContact></FooterContact>

        </a-layout-footer>
    </a-layout>

</template>

<script setup>
import FooterContact from "./FooterContact.vue";
import ContentContact from "./ContentContact.vue";
import HeaderContact from "./HeaderContact.vue";

import { layoutHeader, layoutContent,layoutFooter  } from "./style.vue";

</script>

<style scoped>

</style>

