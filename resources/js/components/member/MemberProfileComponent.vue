<template>
	<div class="card">
        <div class="card-header">Personal Profile <button role="button" class="btn btn-info btn-sm float-right"><!-- <font-awesome-icon icon="user-alt" /> --> Edit</button>
        </div>
        <div class="card-body">
        	
    		<div class="row">
        		<p> {{this.memberData.first_name}} {{this.memberData.middle_name}} {{this.memberData.last_name}}</p>
        	</div>
        	<div class="row">
        		<p> {{this.memberData.birthday}} </p>
        	</div>
        	<div class="row">
        		<p> {{this.memberData.marital_status}} </p>
        	</div>
        </div>

        <div class="card-header">Contact Information <button role="button" class="btn btn-info btn-sm float-right"><!-- <font-awesome-icon icon="user-alt" /> --> Edit</button></div>
        <div class="card-body">
        	<div class="row">
        		<p> {{this.memberData.email}}</p>
        	</div>
        	<div class="row">
        		<p> {{this.memberData.contact_number}}</p>
        	</div>
        	<div class="row">
        		<p> {{this.memberData.address_line_1}} {{this.memberData.barangay}} {{this.memberData.city}} {{this.memberData.province}} </p>
        	</div>
        </div>

        <div class="card-header">Membership Profile <button role="button" class="btn btn-info btn-sm float-right"><!-- <font-awesome-icon icon="user-alt" /> --> Edit</button></div>
        <div class="card-body">
        	<div class="row">
        		<p> {{this.memberData.code}}</p>
        	</div>
        	<div class="row">
        		<p> {{this.memberData.membership_status}}</p>
        	</div>
        </div>
    </div>
</template>

<script>
  export default {
      	mounted() {
          	console.log('Component mounted.')  
      	},

      	props: ['memberData']
  }

</script>
