<template></template>

<script>

	$(document).ready(function() {

	    $('#membersTable').DataTable({
	          
	    });

	    $('#recordsTable').DataTable({
	          
	    });
	});

	export default {
	    mounted() {
	        console.log('Datatable Component mounted.')  
	    }
	}

</script>
