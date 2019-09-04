<template></template>

<script>

	$(document).ready(function() {

	    $('#membersTable').DataTable({
	          
	    });

	    $('#recordsTable').DataTable({
	          
	    });

	    $('#usersTable').DataTable({
	          
	    });
	});

	export default {
	    mounted() {
	        console.log('Datatable Component mounted.')  
	    }
	}

</script>
