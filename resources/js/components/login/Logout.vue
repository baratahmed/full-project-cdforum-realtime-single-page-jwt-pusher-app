<template>

</template>

<style scoped>

</style>

<script>
    export default {
        created(){
            EventBus.$emit('logout')
        }
    } 
</script>
