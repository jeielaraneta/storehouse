<template>
  <div class="text-center">
  	<a role="button" :href="this.route" class="btn btn-info btn-sm">{{this.btnText}}</a>
  </div>
</template>

<script>
  export default {
      mounted() {
          console.log('Component mounted.')  
      },
      props: ['route', 'btnText']
  }

</script>
