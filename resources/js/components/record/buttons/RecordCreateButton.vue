<template>

    <a role="button" :href="this.createRecordRoute" class="btn btn-primary float-right"><font-awesome-icon icon="user-plus" /> Add New Record</a>
                  
</template>

<script>
    export default {
        mounted() {
            console.log('Add New Record Button mounted.')
        },
        props: ['createRecordRoute']
    }
</script>
