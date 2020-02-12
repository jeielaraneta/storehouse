<template>
  <div class="text-center">
  	<a role="button" :href="this.route" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> {{this.btnText}}</a>
  </div>
</template>

<script>
  export default {
      mounted() {
         
      },
      props: ['route', 'btnText']
  }

</script>
