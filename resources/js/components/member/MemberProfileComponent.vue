<template>
	<div class="col-md-12">
		<div v-if="!isHidden">
			<div class="alert alert-success" role="alert" v-show="isSuccesful">
				{{alertMessage}}
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		    </div>

		    <div class="alert alert-danger" role="alert" v-show="!isSuccesful">
		    	{{alertMessage}}
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		</div>
		

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
	                <div class="form-group row">
	                	<label for="first_name" class="col-sm-2 col-form-label">First Name</label>
					    <div class="col-sm-8">
					      	<input type="text" class="form-control" id="first_name" name="first_name" v-model:value="first_name" :disabled="toEditFirstName">
					    </div>

					    <div class="col-sm-2" v-if="toEditFirstName">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditFirstName = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditFirstName = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateFirstName" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
					<div class="form-group row">
						<label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
					    <div class="col-sm-8">
					    	<input type="text" class="form-control" id="middle_name" name="middle_name" v-model:value="middle_name" :disabled="toEditMiddleName">
					    </div>

					    <div class="col-sm-2" v-if="toEditMiddleName">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button" @click="toEditMiddleName = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditMiddleName = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateMiddleName" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">

					<div class="form-group row">
						<label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
					    <div class="col-sm-8">
					    	<input type="text" class="form-control" id="last_name" name="last_name" v-model:value="last_name" :disabled="toEditLastName">
					    </div>

					    <div class="col-sm-2" v-if="toEditLastName">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditLastName = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditLastName = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateLastName" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">

					<div class="form-group row">
						
						<label for="birthday" class="col-sm-2 col-form-label">Birthday</label>
					    <div class="col-sm-8">

					    	<date-picker id="birthday" name="birthday" v-model:value="birth_day" :config="options" autocomplete="off" :disabled="toEditBirthday"></date-picker>

					    </div>

					    <div class="col-sm-2" v-if="toEditBirthday">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditBirthday = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditBirthday = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateBirthday" v-on:click="isHidden = true">Save</button>

					    </div>
						
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
					<div class="form-group row">

						<label for="marital_status" class="col-sm-2 col-form-label">Marital Status</label>
					    <div class="col-sm-8">

					    	<select id="marital_status" class="custom-select custom-select mb-3" name="marital_status" v-model:value="marital_status" :disabled="toEditMaritalStatus">
	                            <option disabled selected>Select martital status</option>
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
					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateMaritalStatus" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

	        </div>

	        <div class="card-header">Contact Information</div>
	        <div class="card-body">
	        	<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
	                <div class="form-group row">
	                	<label for="email" class="col-sm-2 col-form-label">Email</label>
					    <div class="col-sm-8">
					      <input type="email" class="form-control" id="email" name="email" v-model:value="email" :disabled="toEditEmail">
					    </div>

					    <div class="col-sm-2" v-if="toEditEmail">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditEmail = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditEmail = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateEmail" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
	                <div class="form-group row">
	                	<label for="contact_number" class="col-sm-2 col-form-label">Contact Number</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="contact_number" name="contact_number" v-model:value="contact_number" :disabled="toEditContactNumber">
					    </div>

					    <div class="col-sm-2" v-if="toEditContactNumber">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditContactNumber = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditContactNumber = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateContactNumber" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
	                <div class="form-group row">
	                	<label for="address_line_1" class="col-sm-2 col-form-label">Address Line 1</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="address_line_1" name="address_line_1" v-model:value="address_line_1" :disabled="toEditAddressLine1">
					    </div>

					    <div class="col-sm-2" v-if="toEditAddressLine1">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditAddressLine1 = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditAddressLine1 = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateAddressLine1" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
	                <div class="form-group row">
	                	<label for="barangay" class="col-sm-2 col-form-label">Barangay</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="barangay" name="barangay" v-model:value="barangay" :disabled="toEditBarangay">
					    </div>

					    <div class="col-sm-2" v-if="toEditBarangay">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditBarangay = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditBarangay = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateBarangay" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
	                <div class="form-group row">
	                	<label for="city" class="col-sm-2 col-form-label">City</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="city" name="city" v-model:value="city" :disabled="toEditCity">
					    </div>

					    <div class="col-sm-2" v-if="toEditCity">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditCity = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditCity = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateCity" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
	                <div class="form-group row">
	                	<label for="province" class="col-sm-2 col-form-label">Province</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="province" name="province" v-model:value="province" :disabled="toEditProvince">
					    </div>

					    <div class="col-sm-2" v-if="toEditProvince">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditProvince = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditProvince = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateProvince" v-on:click="isHidden = true">Save</button>

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
					      <input type="text" class="form-control" id="code" name="code" v-model:value="code" :disabled="toEditCode">
					    </div>

					    <div class="col-sm-2" v-if="toEditCode">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditCode = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditCode = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateCode" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

				<form method="POST" enctype="multipart/form-data">
	                <input type="hidden" name="_token" :value="csrf">
	                <div class="form-group row">
	                	<label for="membership_status" class="col-sm-2 col-form-label">Membership Status</label>
					    <div class="col-sm-8">

					    	<select id="membership_status" class="custom-select custom-select mb-3" name="membership_status" v-model:value="membership_status" :disabled="toEditMembershipStatus">
	                            <option disabled selected>Select membership status</option>
	                            <option value="active">Active</option>
	                            <option value="regular attendee">Regular Attendee</option>
	                            <option value="visitor">Visitor</option>
	                            <option value="inactive">Inactive</option>
	                        </select>

					    </div>

					    <div class="col-sm-2" v-if="toEditMembershipStatus">
					    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditMembershipStatus = false">Edit</button>
					    </div>
					    
					    <div class="col-sm-2" v-else>

					    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditMembershipStatus = true">Cancel</button>

					    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateMembershipStatus" v-on:click="isHidden = true">Save</button>

					    </div>
					</div>
				</form>

	        </div>
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
          	console.log(marital_status) 
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
                alertMessage: "",
                isHidden: true,
                isSuccesful: true,
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
                toEditMembershipStatus: true,
                
                first_name: this.memberData.first_name,
                middle_name: this.memberData.middle_name,
                last_name: this.memberData.last_name,
                birth_day: this.memberData.birthday,
                marital_status: this.memberData.martital_status,
                email: this.memberData.email,
                contact_number: this.memberData.contact_number,
                address_line_1: this.memberData.address_line_1,
                barangay: this.memberData.barangay,
                city: this.memberData.city,
                province: this.memberData.province,
                code: this.memberData.code,
                membership_status: this.memberData.membership_status

            }
        },
	    methods: {

	    	updateFirstName() {

	      		var first_name = $('#first_name').val();

	      		window.axios.put(this.updateMemberRoute, {first_name: first_name})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditFirstName = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateMiddleName() {

	      		var middle_name = $('#middle_name').val();

	      		window.axios.put(this.updateMemberRoute, {middle_name: middle_name})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditMiddleName = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateLastName() {

	      		var last_name = $('#last_name').val();

	      		window.axios.put(this.updateMemberRoute, {last_name: last_name})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditLastName = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateBirthday() {

	      		var birthday = $('#birthday').val();

	      		window.axios.put(this.updateMemberRoute, {birthday: birthday})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditBirthday = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateMaritalStatus() {

	      		var marital_status = $('#marital_status').val();

	      		window.axios.put(this.updateMemberRoute, {marital_status: marital_status})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditMaritalStatus = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateEmail() {

	      		var email = $('#email').val();

	      		window.axios.put(this.updateMemberRoute, {email: email})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditEmail = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateContactNumber() {

	      		var contact_number = $('#contact_number').val();

	      		window.axios.put(this.updateMemberRoute, {contact_number: contact_number})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditContactNumber = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateAddressLine1() {

	      		var address_line_1 = $('#address_line_1').val();

	      		window.axios.put(this.updateMemberRoute, {address_line_1: address_line_1})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditAddressLine1 = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateBarangay() {

	      		var barangay = $('#barangay').val();

	      		window.axios.put(this.updateMemberRoute, {barangay: barangay})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditBarangay = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateCity() {

	      		var city = $('#city').val();

	      		window.axios.put(this.updateMemberRoute, {city: city})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditCity = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateProvince() {

	      		var province = $('#province').val();

	      		window.axios.put(this.updateMemberRoute, {province: province})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditProvince = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateCode() {

	      		var province = $('#code').val();

	      		window.axios.put(this.updateMemberRoute, {code: code})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditCode = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	updateMembershipStatus() {

	      		var membership_status = $('#membership_status').val();

	      		window.axios.put(this.updateMemberRoute, {membership_status: membership_status})
	      			.then( response => {
			      		console.log(response.data.success)
			      		this.toEditMembershipStatus = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"
			    	});
	      	},

	      	del(id) {
	        // To do
	      	}
	    }
  	}

</script>
