<template>

    <a role="button" :href="this.route" class="btn btn-primary float-right"> <i class="fas fa-user-plus"></i> {{ this.btnText }}</a>

</template>

<script>
    export default {
        mounted() {
            
        },
        props: ['route', 'btnText']
    }
</script>
