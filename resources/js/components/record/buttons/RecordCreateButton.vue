<template>

    <a role="button" :href="this.createRecordRoute" class="btn btn-primary float-right"><i class="fas fa-money-check-alt"></i> Add New Record</a>
                  
</template>

<script>
    export default {
        mounted() {
            console.log('Add New Record Button mounted.')
        },
        props: ['createRecordRoute']
    }
</script>
