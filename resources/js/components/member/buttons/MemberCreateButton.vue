<template>

    <a role="button" :href="this.createMemberRoute" class="btn btn-primary float-right"><font-awesome-icon icon="user-plus" /> Add New Member</a>
                  
</template>

<script>
    export default {
        mounted() {
            console.log('Add New Member Button mounted.')
        },
        props: ['createMemberRoute']
    }
</script>
