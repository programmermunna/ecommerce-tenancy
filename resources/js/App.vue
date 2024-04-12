<template>
    <h1>Hello Worlds</h1>


    <router-link :to="{name:'register'}"> Register </router-link> || 
    <router-link :to="{name:'login'}"> Login </router-link>
    <router-view />
</template>

<script>
export default {};
</script>

<style>

</style>

