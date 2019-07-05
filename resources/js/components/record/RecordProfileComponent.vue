<template>
	<div class="col-md-12">
		
		<div class="card">
			<span class="border-top"></span>
		  	<div class="card-header bg-transparent border-primary">
	        	<h5>Record Profile</h5> 
	        </div>
	        <div class="card-body">

	        	<div class="row mb-5">
	        		<div class="col-sm-6">
	        			<h6 class="card-title">Identification: <span>{{this.recordData.agc}}</span></h6>
		        	</div>

		        	<div class="col-sm-6">
		        		<h6 class="card-title">Record ID: <span>{{this.recordData.id}}</span></h6>
		        	</div>
	        	</div>
				
	        	<div class="col-sm-12">
	        		<form method="POST" enctype="multipart/form-data">
		                <input type="hidden" name="_token" :value="csrf">
		                <div class="form-group row">
		                	<label for="marital_status" class="col-sm-2 col-form-label">Service Type</label>
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
		                	<label for="record_type" class="col-sm-2 col-form-label">Record Type</label>
						    <div class="col-sm-8">

						    	<select id="record_type" class="custom-select custom-select mb-3" name="record_type" v-model:value="record_type" :disabled="toEditRecordType">
	                                <option value="ob">Offering Box</option>
	                                <option value="dd">Bank Deposit</option>
		                        </select>

						    </div>

						    <div class="col-sm-2" v-if="toEditRecordType">
						    	<button class="btn btn-secondary btn-sm float-right mx-3" type="button"  @click="toEditRecordType = false">Edit</button>
						    </div>
						    
						    <div class="col-sm-2" v-else>

						    	<button class="btn btn-danger btn-sm float-right mx-1" type="button" @click="toEditRecordType = true">Cancel</button>
						    	<button class="btn btn-success btn-sm float-right mx-1" type="button" @click="updateRecordType" v-on:click="isHidden = true">Save</button>

						    </div>
						</div>
					</form>

					<form method="POST" enctype="multipart/form-data">
		                <input type="hidden" name="_token" :value="csrf">

						<div class="form-group row">
							
							<label for="givenAt" class="col-sm-2 col-form-label">Given At</label>
						    <div class="col-sm-8">

						    	<date-picker id="givenAt" name="givenAt" v-model:value="given_at" :config="options" autocomplete="off" :disabled="toEditGivenAt"></date-picker>

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
	        	
	        	{{this.recordData}}

	        	{{this.specialOfferingsData}}
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
          	 
      	},

      	props: ['recordData', 'specialOfferingsData', 'givenAt', 'updateRecordRoute'],

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
                	defaultDate: this.recordData.given_at
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

                service_type: this.recordData.service_type,
                record_type: this.recordData.record_type,
                given_at: this.recordData.given_at,
                status: this.recordData.status
               
            }
        },
	    methods: {

	    	updateServiceType() {

	    	},

	    	updateRecordType() {

	    	},

	    	updateStatus() {

	    	}
	    	
	    }
  	}

</script>
