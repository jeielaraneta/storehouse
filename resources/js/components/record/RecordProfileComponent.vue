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

		<div class="card text-white bg-secondary mb-3" v-if="status === 'Unverified'">
			<div class="card-body">
			    Unverified
			</div>
		</div>

		<div class="card text-white bg-success mb-3" v-else-if="status === 'Verified'">
			<div class="card-body">
			    Verified
			</div>
		</div>

		<div class="card text-white bg-danger mb-3" v-else-if="status === 'For Correction'">
			<div class="card-body">
			    For Correction
			</div>
		</div>
		
		<div class="card text-white bg-primary mb-3" v-else-if="status === 'Corrected'">
			<div class="card-body">
			    Corrected
			</div>
		</div>

		<div class="card text-white bg-info mb-3" v-else-if="status === 'For Archive'">
			<div class="card-body">
			    For Archive
			</div>
		</div>

		<div class="card text-white bg-dark mb-3" v-else-if="status === 'Archived'">
			<div class="card-body">
			    Archived
			</div>
		</div>
		
		<div class="card">
			<span class="border-top"></span>
		  	<div class="card-header bg-transparent border-primary">
	        	<h5>Record Profile</h5> 
	        </div>
	        <div class="card-body">

	        	<div class="row mb-5">

	        		<div class="col-sm-2">
		        		<h6 class="card-title">Record ID: <span>{{this.records.id}}</span></h6>
		        	</div>

	        		<div class="col-sm-3">
	        			<h6 class="card-title">Identification: <span>{{this.records.agc}}</span></h6>
		        	</div>

		        	<div class="col-sm-4">
		        		<h6 class="card-title">Record Type: <span>{{this.records.record_type}}</span></h6>
		        	</div>

		        	<div class="col-sm-3">
		        		<h6 class="card-title">Total Amount: <span>&#8369;{{this.records.total_amount}}</span></h6>
		        	</div>

	        	</div>
				
				<div class="row">
		        	<div class="col-sm-12">
		        		<form method="POST" enctype="multipart/form-data">
			                <input type="hidden" name="_token" :value="csrf">
			                <div class="form-group row">
			                	<label for="service_type" class="col-sm-2 col-form-label">Service Type</label>
							    <div class="col-sm-8">

							    	<select id="service_type" class="custom-select custom-select mb-3" name="service_type" v-model:value="service_type" :disabled="toEditServiceType">
		                                <option value="ews">EWS</option>
		                                <option value="mmws">MMWS</option>
		                                <option value="vws">VWS</option>
		                                <option value="ss">Sunday School</option>
		                                <option value="pm">Prayer Meeting</option>
		                                <option value="na">Not Applicable</option>
			                        </select>

							    </div>

							    <div class="col-sm-2" v-if="toEditServiceType">
							    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditServiceType = false">Edit</button>
							    </div>
							    
							    <div class="col-sm-2" v-else>

							    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditServiceType = true">Cancel</button>
							    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateServiceType" v-on:click="isHidden = true">Save</button>

							    </div>
							</div>
						</form>

						<form method="POST" enctype="multipart/form-data">
			                <input type="hidden" name="_token" :value="csrf">

							<div class="form-group row">
								
								<label for="givenAt" class="col-sm-2 col-form-label">Given At</label>
							    <div class="col-sm-8">
							    	<date-picker id="givenAt" name="givenAt" v-model:value="given_at" :config="options" autocomplete="off" :disabled="toEditGivenAt" v-validate="'required'" :class="{'form-control': true, error: errors.has('givenAt')}"></date-picker>
							    	<span class="error text-danger" v-if="errors.has('givenAt')">{{errors.first('givenAt')}}</span>
							    </div>

							    <div class="col-sm-2" v-if="toEditGivenAt">
							    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditGivenAt = false">Edit</button>
							    </div>
							    
							    <div class="col-sm-2" v-else>
							    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditGivenAt = true">Cancel</button>
							    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateGivenAt" v-on:click="isHidden = true">Save</button>
							    </div>
								
							</div>
						</form>

						<form method="POST" enctype="multipart/form-data">
			                <input type="hidden" name="_token" :value="csrf">
			                <div class="form-group row">
			                	<label for="status" class="col-sm-2 col-form-label">Status</label>
							    <div class="col-sm-8">

							    	<select id="status" class="custom-select custom-select mb-3" name="status" v-model:value="status" :disabled="toEditStatus">
		                                <option value="Unverified">Unverified</option>
		                                <option value="Verified">Verified</option>
		                                <option value="For Correction">For Correction</option>
		                                <option value="For Archive">For Archive</option>
		                                <option value="Archived">Archived</option>
			                        </select>

							    </div>

							    <div class="col-sm-2" v-if="toEditStatus">
							    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditStatus = false">Edit</button>
							    </div>
							    
							    <div class="col-sm-2" v-else>

							    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditStatus = true">Cancel</button>
							    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateStatus" v-on:click="isHidden = true">Save</button>

							    </div>
							</div>
						</form>
		        	</div>
		        </div>

	        	<div class="row">
	        		<div class="col-sm-6">
	        			<GChart type="PieChart" :data="regularGivingChart" :options='regularGivingChartOptions'/>	
	        		</div>

	        		<div class="col-sm-6">
	        			<GChart type="PieChart" :data="specialOfferingChart" :options='specialOfferingChartOptions'/>	
	        		</div>
			    </div>

			    <div class="row">
	        		<div class="col-sm-12">
	        			<h6 class="card-title">List of Regular Giving</h6>
		        	</div>
	        	</div>

			    <div class="row">
			    	<div class="col-sm-12 table-responsive">
	        			<table class="table table-sm">
	        				<caption>List of Regular Giving</caption>
							<thead class="thead-dark">
							    <tr>
							      	<th scope="col">Tithes</th>
							      	<th scope="col">Love</th>
							      	<th scope="col">Faith</th>
							      	<th scope="col">Total Amount</th>
							      	<th scope="col">Created At</th>
							    </tr>
							</thead>
							<tbody>
							    <tr>
							    	<td>&#8369;{{this.records.tithe_amount}}</td>
							    	<td>&#8369;{{this.records.love_amount}}</td>
							    	<td>&#8369;{{this.records.faith_amount}}</td>
							    	<td>&#8369;{{this.sumOfRegularGiving()}}</td>
							    	<td>{{this.records.created_at}}</td>
							    </tr>
							</tbody>
						</table>
			    	</div>
			    </div>

			    <div class="row">
	        		<div class="col-sm-12">
	        			<h6 class="card-title">List of Special Offerings</h6>
		        	</div>
	        	</div>

			    <div class="row">
			    	<div class="col-sm-12 table-responsive">
	        			<table class="table table-sm">
	        				<caption>List of Special Offerings</caption>
							<thead class="thead-dark">
							    <tr>
							      	<th scope="col">#</th>
							      	<th scope="col">Designation</th>
							      	<th scope="col">Specifically For</th>
							      	<th scope="col">Amount</th>
							      	<th scope="col">Created At</th>
							    </tr>
							</thead>
							<tbody>
							    <tr v-for="(specialOffering, index) in specialOfferings">
							      	<th scope="row"> {{ index+1}} </th>
							      	<td>{{specialOffering.designation || 'None'}}</td>
							      	<td>{{specialOffering.designated_for || 'None' }}</td>
							      	<td>&#8369;{{specialOffering.designated_amount}}</td>
							      	<td>{{specialOffering.created_at}}</td>
							    </tr>
							</tbody>
						</table>
			    	</div>
			    </div>
	        
	        </div>
	        <div class="card-footer text-muted">
			    Last updated: 2019-08-16 by: aranej (Sample only) 
			</div>
		</div>

	</div>

</template>

<style>
    .form-control.error {
        border-color: #E84444;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(232,68,68,.6);
    }
</style>

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

	import { Validator } from 'vee-validate'; 

  	export default {

      	mounted() {
      		this.arrangeSpecialOfferingData()
      	},

      	props: ['records', 'specialOfferings', 'givenAt', 'updateRecordRoute'],

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
                	defaultDate: this.records.given_at
                },

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                alertMessage: "",
                isHidden: true,
                isSuccesful: true,
                isDisabled: true,

                toEditServiceType: true,
                toEditRecordType: true,
                toEditGivenAt: true,
                toEditStatus: true,

                service_type: this.records.service_type,
                record_type: this.records.record_type,
                given_at: this.records.given_at,
                status: this.records.status,

                regularGivingChart: [
			        ["Type", "Amount"],
			        ["Tithe", this.records.tithe_amount],
			        ["Love", this.records.love_amount],
			        ["Faith", this.records.faith_amount]
			    ],

			    specialOfferingChart: [],

			    regularGivingChartOptions: {
		          	title: 'Regular Giving Summary',
		          	height: 400,
		          	//pieHole: 0.4,
		        },

		        specialOfferingChartOptions: {
		          	title: 'Special Offering Summary',
		          	height: 400,
		          	//pieHole: 0.4,
		        },
		    }
        },

        computed: {

        },

        created() {

        	const customMessages = {
                custom: {

                    givenAt: {
                        required: "Please select a date"
                    }
                }
            };

            Validator.localize('en', customMessages);
        },
       
	    methods: {

	    	sumOfRegularGiving() {
	    		var total = Number(this.records.tithe_amount)+Number(this.records.love_amount)+Number(this.records.faith_amount);

	    		return total;
	    	}, 

	    	arrangeSpecialOfferingData() {
        		var arrayA = [["Type", "Amount"]];

        		this.specialOfferings.forEach(function (value, key) {
        			var newArray = [value.designation, value.designated_amount]
				    arrayA.push(newArray);
				});

				this.specialOfferingChart = arrayA;
        	},

	    	updateServiceType() {

	    		var service_type = $('#service_type').val();

	      		window.axios.put(this.updateRecordRoute, {service_type: service_type})
	      			.then( response => {
			      		this.toEditServiceType = true
			      		this.isHidden = false
			      		this.isSuccesful = response.data.success ? true : false;
			      		this.alertMessage = response.data.success ? "Record's service type has been updated sucessfully!" : "Error"
			    	});
 
	    	},

	    	updateStatus() {

	    		var status = $('#status').val(); // == 'Unverified' ? 0 : 1

	    		console.log(status);

	      		window.axios.put(this.updateRecordRoute, {status: status})
	      			.then( response => {
			      		this.toEditStatus = true
			      		this.isHidden = false
			      		this.isSuccesful = response.data.success ? true : false;
			      		this.alertMessage = response.data.success ? "Record's status has been updated sucessfully!" : "Error"
			    	});

	    	},

	    	updateGivenAt() {

	    		var givenAt = $('#givenAt').val();

	    		this.$validator.validateAll().then((result) => {
                  if (result) {
                    window.axios.put(this.updateRecordRoute, {given_at: givenAt})
	      			.then( response => {
			      		this.toEditGivenAt = true
			      		this.isSuccesful = true
			      		this.isHidden = false
			      		this.alertMessage = response.data.success ? "Record's given date has been updated sucessfully!" : "Error"
			    	});
                  }

                  if(!result){
                    this.isSuccesful = false
                    this.isHidden = false
                    this.alertMessage = "Unable to update a record due to insufficient data."
                  }

                });

	      		

	    	}
	    	
	    }
  	}

</script>
