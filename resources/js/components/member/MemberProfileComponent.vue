<template>
	<div class="card">
        <div class="card-header">Personal Profile <!-- <font-awesome-icon icon="user-alt" /> -->
        	<div class="btn-group float-right">
			  	<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Actions
			  	</button>
			  	<div class="dropdown-menu">
			  		<button class="dropdown-item" type="button">Action</button>
				    <a class="dropdown-item" href="#">Delete</a>
			  	</div>
			</div>
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

        <div class="card-header">Contact Information 
        	<div class="btn-group float-right">
			  	<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Actions
			  	</button>
			  	<div class="dropdown-menu">
			    	<button class="dropdown-item" type="button">Edit</button>
				    <a class="dropdown-item" href="#">Delete</a>
			  	</div>
			</div>
        </div>
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

        <div class="card-header">Membership Profile >
        	<div class="btn-group float-right">
			  	<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Actions
			  	</button>
			  	<div class="dropdown-menu">
			    	<button class="dropdown-item" type="button">Edit</button>
				    <a class="dropdown-item" href="#">Delete</a>
			  	</div>
			</div>
        </div>
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
