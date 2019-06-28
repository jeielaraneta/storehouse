<template>

    <a role="button" :href="this.route" class="btn btn-primary float-right"><font-awesome-icon :icon="this.btnIcon" /> {{ this.btnText }}</a>
                  
</template>

<script>
    export default {
        mounted() {
            console.log('Add Button mounted.')
        },
        props: ['route', 'btnText', 'btnIcon']
    }
</script>
