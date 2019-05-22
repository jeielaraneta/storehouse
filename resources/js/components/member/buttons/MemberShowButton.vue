<template>
  <div class="text-center">
  	<a role="button" :href="this.showMemberRoute" class="btn btn-info btn-sm"><!-- <font-awesome-icon icon="user-alt" /> --> View</a>
  </div>
</template>

<script>
  export default {
      mounted() {
          console.log('Component mounted.')  
      },
      props: ['showMemberRoute']
  }

</script>
