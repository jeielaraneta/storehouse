<template>
	<div class="card">
        <div class="card-header">Personal Profile <!-- <font-awesome-icon icon="user-alt" /> -->
        	<div class="btn-group float-right">
			  	<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    	Actions
			  	</button>
			  	<div class="dropdown-menu">
			  		<button class="dropdown-item" type="button" v-on:click="isHidden = false" @click="isDisabled = false">Edit</button>
				    <a class="dropdown-item" href="#">Delete</a>
			  	</div>
			</div>
        </div>
        <div class="card-body">

        	<form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-group row">
                	<label for="first_name" class="col-sm-2 col-form-label">First Name</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="first_name" name="first_name" :value="this.memberData.first_name" :disabled="isDisabled">
				    </div>
				</div>

				<div class="form-group row">
					<label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
				    <div class="col-sm-10">
				    	<input type="text" class="form-control" id="middle_name" name="middle_name" :value="this.memberData.middle_name" :disabled="isDisabled">
				    </div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
				    <div class="col-sm-10">
				    	<input type="text" class="form-control" id="last_name" name="last_name" :value="this.memberData.last_name" :disabled="isDisabled">
				    </div>
				</div>

				<div class="form-group row">
					<label for="birthday" class="col-sm-2 col-form-label">Birthday</label>
				    <div class="col-sm-10">
				    	<date-picker id="birthday" name="birthday" v-bind:value="birthday" :config="options" :disabled="isDisabled" autocomplete="off"></date-picker>
				    </div>
				</div>

				<div class="form-group row">
					<label for="marital_status" class="col-sm-2 col-form-label">Marital Status</label>
				    <div class="col-sm-10">
				    	<select id="marital_status" class="custom-select custom-select mb-3" name="marital_status" :value="this.memberData.marital_status" :disabled="isDisabled">
                            <option selected>Select martital status</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="separate">Separated</option>
                            <option value="divorced">Divorced</option>
                            <option value="single">Single</option>
                        </select>
				    </div>
				</div>

				 <div class="form-group row" v-if="!isHidden">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success float-right">Save changes</button>
                        <button class="btn btn-danger float-right mx-3" v-on:click="isHidden = true" @click="isDisabled = true">Cancel</button>
                    </div>
                </div>

            </form>
        	
        	<!-- <div class="row">
        		<p> {{this.memberData.birthday}} </p>
        	</div> -->
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

        <div class="card-header">Membership Profile
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

      	props: ['memberData', 'birthday'],

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
                isDisabled: true
            }
        },
  	}

</script>
