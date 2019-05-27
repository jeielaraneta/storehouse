<template>
	<div class="card">		
        <div class="card-header">Personal Profile <!-- <font-awesome-icon icon="user-alt" /> -->
        	<div class="btn-group float-right">
			  	<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Actions
			  	</button>
			  	<div class="dropdown-menu">
			  		<button class="dropdown-item" type="button">Deactivate</button>
				    <a class="dropdown-item" href="#">Delete</a>
			  	</div>
			</div> 
        </div>
        <div class="card-body">

        	<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" class="form-control" id="id" name="id" :value="this.memberData.id">
                <div class="form-group row">
                	<label for="first_name" class="col-sm-2 col-form-label">First Name</label>
				    <div class="col-sm-8">
				      	<input type="text" class="form-control" id="first_name" name="first_name" :value="this.memberData.first_name" :disabled="toEditFirstName">
				    </div>

				    <div class="col-sm-2" v-if="toEditFirstName">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditFirstName = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditFirstName = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
				<div class="form-group row">
					<label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
				    <div class="col-sm-8">
				    	<input type="text" class="form-control" id="middle_name" name="middle_name" :value="this.memberData.middle_name" :disabled="toEditMiddleName">
				    </div>

				    <div class="col-sm-2" v-if="toEditMiddleName">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditMiddleName = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditMiddleName = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">

				<div class="form-group row">
					<label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
				    <div class="col-sm-8">
				    	<input type="text" class="form-control" id="last_name" name="last_name" :value="this.memberData.last_name" :disabled="toEditLastName">
				    </div>

				    <div class="col-sm-2" v-if="toEditLastName">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditLastName = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditLastName = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">

				<div class="form-group row">
					
					<label for="birthday" class="col-sm-2 col-form-label">Birthday</label>
				    <div class="col-sm-8">
				    	<date-picker id="birthday" name="birthday" v-bind:value="birthday" :config="options" :disabled="toEditBirthday" autocomplete="off"></date-picker>
				    </div>
				    <div class="col-sm-2" v-if="toEditBirthday">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditBirthday = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditBirthday = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
					
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
				<div class="form-group row">
					<label for="marital_status" class="col-sm-2 col-form-label">Marital Status</label>
				    <div class="col-sm-8">
				    	<select id="marital_status" class="custom-select custom-select mb-3" name="marital_status" :value="this.memberData.marital_status" :disabled="toEditMaritalStatus">
                            <option selected>Select martital status</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="separate">Separated</option>
                            <option value="divorced">Divorced</option>
                            <option value="single">Single</option>
                        </select>
				    </div>

				    <div class="col-sm-2" v-if="toEditMaritalStatus">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditMaritalStatus = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditMaritalStatus = true">Cancel</button>
				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

				 <div class="form-group row" v-if="!isHidden">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success float-right">Save changes</button>
                        <!-- <button class="btn btn-danger float-right mx-3" v-on:click="isHidden = true" @click="isDisabled = true">Cancel</button> -->
                    </div>
                </div>
        	<!-- <div class="row">
        		<p> {{this.memberData.birthday}} </p>
        	</div> -->
        </div>

        <div class="card-header">Contact Information</div>
        <div class="card-body">
        	<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                	<label for="email" class="col-sm-2 col-form-label">Email</label>
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="email" name="email" :value="this.memberData.email" :disabled="toEditEmail">
				    </div>

				    <div class="col-sm-2" v-if="toEditEmail">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditEmail = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditEmail = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                	<label for="contact_number" class="col-sm-2 col-form-label">Contact Number</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="contact_number" name="contact_number" :value="this.memberData.contact_number" :disabled="toEditContactNumber">
				    </div>

				    <div class="col-sm-2" v-if="toEditContactNumber">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditContactNumber = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditContactNumber = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                	<label for="address_line_1" class="col-sm-2 col-form-label">Address Line 1</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="address_line_1" name="address_line_1" :value="this.memberData.address_line_1" :disabled="toEditAddressLine1">
				    </div>

				    <div class="col-sm-2" v-if="toEditAddressLine1">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditAddressLine1 = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditAddressLine1 = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                	<label for="barangay" class="col-sm-2 col-form-label">Barangay</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="barangay" name="barangay" :value="this.memberData.barangay" :disabled="toEditBarangay">
				    </div>

				    <div class="col-sm-2" v-if="toEditBarangay">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditBarangay = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditBarangay = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                	<label for="city" class="col-sm-2 col-form-label">City</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="city" name="city" :value="this.memberData.address_line_1" :disabled="toEditCity">
				    </div>

				    <div class="col-sm-2" v-if="toEditCity">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditCity = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditCity = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                	<label for="province" class="col-sm-2 col-form-label">Province</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="province" name="province" :value="this.memberData.province" :disabled="toEditCity">
				    </div>

				    <div class="col-sm-2" v-if="toEditProvince">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditProvince = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditProvince = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>
        </div>

        <div class="card-header">Membership Profile</div>
        <div class="card-body">
        	<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                	<label for="code" class="col-sm-2 col-form-label">Code</label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="code" name="code" :value="this.memberData.code" :disabled="toEditCode">
				    </div>

				    <div class="col-sm-2" v-if="toEditCode">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditCode = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditCode = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button">Save</button>

				    </div>
				</div>
			</form>

			<form method="POST" :action="this.updateMemberRoute" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" class="form-control" id="id" name="id" :value="this.memberData.id">
                <div class="form-group row">
                	<label for="membership_status" class="col-sm-2 col-form-label">Membership Status</label>
				    <div class="col-sm-8">
                        <select id="membership_status" class="custom-select custom-select mb-3" name="membership_status" :value="this.memberData.membership_status" :disabled="toEditmembershipStatus">
                            <option selected>Select membership status</option>
                            <option value="active">Active</option>
                            <option value="regular attendee">Regular Attendee</option>
                            <option value="visitor">Visitor</option>
                            <option value="inactive">Inactive</option>
                        </select>

				    </div>

				    <div class="col-sm-2" v-if="toEditmembershipStatus">
				    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditmembershipStatus = false">Edit</button>
				    </div>
				    
				    <div class="col-sm-2" v-else>

				    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditmembershipStatus = true">Cancel</button>

				    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="update">Save</button>

				    </div>
				</div>
			</form>
        </div>
    </div>
</template>

<script>

	/*	
		DATETIME PICKER ICONS

		time: 'far fa-clock',
	    date: 'far fa-calendar',
	    up: 'fas fa-arrow-up',
	    down: 'fas fa-arrow-down',
	    previous: 'fas fa-chevron-left',
	    next: 'fas fa-chevron-right',
	    today: 'fas fa-calendar-check',
	    clear: 'far fa-trash-alt',
	    close: 'far fa-times-circle'
	*/

  	export default {

      	mounted() {
          	console.log('Component mounted.') 
      	},

      	props: ['memberData', 'birthday', 'updateMemberRoute'],

      	data() {
            return {
                options: {
                    format: 'MM/DD/YYYY',
                    useCurrent: false,
                    showClear: true,
                    icons: {
					    previous: 'fas fa-chevron-left',
					    next: 'fas fa-chevron-right',
					    today: 'fas fa-calendar-check',
					    clear: 'far fa-trash-alt',
					    close: 'far fa-times-circle'
					},
                	defaultDate: this.memberData.birthday
                },
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                isHidden: true,
                isDisabled: true,
                toEditFirstName: true,
                toEditMiddleName: true,
                toEditLastName: true,
                toEditBirthday: true,
                toEditMaritalStatus: true,
                toEditEmail: true,
                toEditContactNumber: true,
                toEditAddressLine1: true,
                toEditBarangay: true,
                toEditCity: true,
                toEditProvince: true,
                toEditCode: true,
                toEditmembershipStatus: true
            }
        },
	    methods: {
	      	update() {

	      		var membership_status = $('#membership_status').val();

	      		window.axios.put(this.updateMemberRoute, {membership_status: membership_status})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditmembershipStatus = true
			    	});
	      	},
	      	del(id) {
	        // To do
	      	}
	    }
  	}

</script>
