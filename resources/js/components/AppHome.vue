<template>
    <div>
        <app-toolbar></app-toolbar>
        <router-view></router-view>
        <app-footer></app-footer>
    </div>
</template>


<style scoped>

</style>

<script>
    import AppToolbar from './AppToolbar';

    import AppFooter from './AppFooter';

    export default {
        components:{AppToolbar, AppFooter},
    }
</script>
