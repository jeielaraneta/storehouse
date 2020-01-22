<template>
	<form ref="restoreMember" method="POST" enctype="multipart/form-data" :action="this.route" @submit.prevent="restore">
  		<input type="hidden" name="_token" :value="csrf">
  		<input type="hidden" name="_method" value="PUT">
		<div class="text-center">
  			<button class="btn btn-info btn-sm" type="submit"><i class="fas fa-eye"></i> {{this.btnText}}</button>
  		</div>
  	</form>
</template>

<script>
  export default {
	    mounted() {
	         
	    },

      	props: ['route', 'btnText'],

      	data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
      	},

      	methods: {

	      	restore() {
	      		this.$refs.restoreMember.submit();
	      	}
      	}
  }

</script>
