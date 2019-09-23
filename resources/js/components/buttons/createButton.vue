<template>

    <a role="button" :href="this.route" class="btn btn-primary float-right"> <i :class="this.btnIcon"></i> {{ this.btnText }}</a> <!-- fas fa-user-plus -->

</template>

<script>
    export default {
        mounted() {
            
        },
        props: ['route', 'btnIcon', 'btnText']
    }
</script>
