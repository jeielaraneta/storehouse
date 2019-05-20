<template>
	
	<button :href="this.showMemberRoute" class="btn btn-info btn-sm"><font-awesome-icon icon="user-alt" /> Show Profile</button>

</template>

<script>

  $(document).ready(function() {
      
  });

  export default {
      mounted() {
          console.log('Component mounted.')  
      },
      props: ['showMemberRoute']
  }

</script>
