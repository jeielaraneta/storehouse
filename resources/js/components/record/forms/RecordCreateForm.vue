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
        <div class="card" >
            <div class="card-header bg-transparent border-primary"><h5>Create New Record</h5></div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" @submit.prevent="submitForm" @reset.prevent="resetForm" id="recordForm">
                    <input type="hidden" id="_token" name="_token" :value="csrf">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="record_type1" value="dd" v-model="record_type" @change="getValues" @click="isDirectDeposit = true">
                                <label class="form-check-label" for="record_type1">Bank Deposit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="record_type2" value="ob" v-model="record_type" @change="getValues" @click="isDirectDeposit = false">
                                <label class="form-check-label" for="record_type2">Offering Box</label>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <!-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="anonymous" v-model="isAnonymous">
                                <label class="form-check-label" for="anonymous">
                                    Anonymous Giver
                                </label>
                            </div> -->
                            <select id="giver_type" class="custom-select custom-select mb-3" v-model="isSelected" @change="getValues" :disabled="isDirectDeposit">
                                <!-- <option disabled selected value="">Select Giver Type</option> -->
                                <option value="identified">Identified Giver</option>
                                <option selected value="anonymous">Anonymous Giver</option>
                                <option value="group">Group</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row" v-show="isSelected == 'identified'&&!isDirectDeposit">
                        <div class="form-group col-md-12">
                            <label for="gic">Member's Name or Giver Indentification Code (GIC) </label>
                            <multiselect v-model="gic" name="gic" :options="searchValues" :custom-label="nameWithCode" placeholder="Search for Member's name or GIC" label="name" track-by="name" id="gic"  @input="getValues"
                            v-validate="isSelected == 'identified'&&!isDirectDeposit ? 'required' : '' " ></multiselect>
                            <span class="error text-danger" v-if="errors.has('gic')">{{errors.first('gic')}}</span>
                        </div>
                    </div>
                
                    <div class="form-row" v-show="isSelected == 'group'&&!isDirectDeposit">
                        <div class="form-group col-md-12">
                            <label for="">Group's Name</label>
                            <input type="text" class="form-control" v-model="group_name" @change="getValues" autocomplete="off" name="group_name" v-validate="isSelected == 'group'&&!isDirectDeposit ? 'required|alpha_spaces' : '' " :class="{'form-control': true, error: errors.has('group_name')}">
                            <span class="error text-danger" v-if="errors.has('group_name')">{{errors.first('group_name')}}</span>
                        </div>
                    </div>

                    <div class="form-row" v-show="record_type == 'dd'">
                        <div class="form-group col-md-12">
                            <label for="">Bank Deposit Reference Number</label>
                            <input type="text" class="form-control" name="bank_ref" v-model="bank_ref" @change="getValues" autocomplete="off" v-validate="isDirectDeposit ? 'required|alpha_num' : '' " :class="{'form-control': true, error: errors.has('bank_ref')}">
                            <span class="error text-danger" v-if="errors.has('bank_ref')">{{errors.first('bank_ref')}}</span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="service_type">Service Type</label>
                            <select id="service_type" name="service_type" class="custom-select custom-select" v-model="service_type" @change="getValues" v-validate="'required'" :class="{'form-control': true, error: errors.has('service_type')}">
                                <option disabled selected>Select Service Type</option>
                                <option value="ews">EWS</option>
                                <option value="mmws">MMWS</option>
                                <option value="vws">VWS</option>
                                <option value="ss">Sunday School</option>
                                <option value="pm">Prayer Meeting</option>
                                <option value="na">Not Applicable</option>
                            </select>
                            <span class="error text-danger" v-if="errors.has('service_type')">{{errors.first('service_type')}}</span>
                        </div>

                        <div class="form-group col-md-4" >
                            <label for="givenAt">Given At</label>
                            <date-picker id="givenAt" name="given_at" v-bind:value="givenAt" autocomplete="off" :config="options" v-model="given_at" @input="getValues" v-validate="'required'" :class="{'form-control': true, error: errors.has('given_at')}"></date-picker>
                            <span class="error text-danger" v-if="errors.has('given_at')">{{errors.first('given_at')}}</span>
                        </div>

                         <div class="form-group col-md-4">
                            <label for="service_type">Status</label>
                            <select id="status" class="custom-select custom-select mb-3" v-model="status" @change="getValues">
                                <option value="0">Unverified</option>
                                <option value="1">Verified</option>
                            </select>
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="tithe_amount">Tithe</label>
                            <div class="input-group" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">&#8369;</div>
                                </div>
                                <input type="text" name="tithe" class="form-control" id="tithe_amount" v-model="tithe" @input="getValues" v-validate="'required|decimal'" :class="{'form-control': true, error: errors.has('tithe')}">
                            </div>
                            <span class="error text-danger" v-if="errors.has('tithe')">{{errors.first('tithe')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="love_amount">Love</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">&#8369;</div>
                                </div>
                                <input type="text" name="love" class="form-control" id="love_amount" v-model="love" @input="getValues" v-validate="'required|decimal'" :class="{'form-control': true, error: errors.has('love')}">
                            </div>
                            <span class="error text-danger" v-if="errors.has('love')">{{errors.first('love')}}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="faith_amount">Faith</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">&#8369;</div>
                                </div>
                                <input type="text" name="faith" class="form-control" id="faith_amount" v-model="faith" @input="getValues" v-validate="'required|decimal'" :class="{'form-control': true, error: errors.has('faith')}">
                            </div>
                            <span class="error text-danger" v-if="errors.has('faith')">{{errors.first('faith')}}</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="designation">Special Offering</label>
                    </div>
                    
                    <div class="form-row" v-for="(input,k) in des_offerings" :key="k">
                        <div class="form-group col-md-4">
                            <select id="designation" name="designation" class="custom-select custom-select mb-3" v-model="input.designation" @change="getValues" v-validate="input.designated_amount > 0 ? 'required' : ''" :class="{'form-control': true, error: errors.has('designation')}">
                                <option disabled selected>Select designation</option>
                                <option value="ce">C.E Ministry</option>
                                <option value="music">Music Ministry</option>
                                <option value="outreach">Community Outreach Ministry</option>
                                <option value="local_missions">Local Missions</option>
                                <option value="foreign_missions">Foreign Missions</option>
                                <option value="dorcas">Dorcas</option>
                                <option value="switch">SWITCh</option>
                                <option value="gauis">Gauis</option>
                                <option value="vop">VOP</option>
                                <option value="rsg">RSG</option>
                                <option value="youth_ministry">Youth Ministry</option>
                                <option value="des_love_gift">Designated Love Gift</option>
                                <option value="financial_assistance">Financial Assistance</option>
                                <option value="others">Others</option>
                            </select>
                            <span class="error text-danger" v-if="errors.has('designation')">{{errors.first('designation')}}</span>
                        </div>

                        <div class="form-group col-md-4" v-if="designationCondition(input.designation)">
                            <input type="text" name="designated_for" id="designated_for" class="form-control" v-model="input.designated_for" placeholder="Designated for" @input="getValues" v-validate="designationCondition(input.designation) ? 'required|alpha_spaces' : ''" :class="{'form-control': true, error: errors.has('designated_for')}">
                            <span class="error text-danger" v-if="errors.has('designated_for')">{{errors.first('designated_for')}}</span>
                        </div>

                        <div class="form-group col-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">&#8369;</div>
                                </div>
                                <input type="text" name="designated_amount" id="designated_amount" class="form-control amount" v-model.number="input.designated_amount" placeholder="Enter amount" @input="getValues" v-validate="'required|decimal'" :class="{'form-control': true, error: errors.has('designated_amount')}">
                                <span class="error text-danger" v-if="errors.has('designated_amount')">{{errors.first('designated_amount')}}</span>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <span>
                                <i class="fas fa-minus-circle fa-lg" @click="remove(k)" v-show="k || (!k && des_offerings.length > 1)"></i>
                                <i class="fas fa-plus-circle fa-lg" @click="add(k)" v-show="k == des_offerings.length-1"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="total_amount" class="col-sm-2 col-form-label">Total Amount</label>
                        <div class="input-group col-md-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">&#8369;</div>
                            </div>
                            <input type="text" name="total_amount" id="total_amount" class="form-control" v-model:value="total_amount" readonly @change="getValues" v-validate="'min_value:1'" :class="{'form-control': true, error: errors.has('total_amount')}">
                            <span class="error text-danger" v-if="errors.has('total_amount')">{{errors.first('total_amount')}}</span>
                        </div>
                        
                    </div>

                    <!-- <pre class="language-json"><code>{{ value }}</code></pre> -->
                    
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                            <button type="reset" class="btn btn-danger float-right mx-3">Cancel</button>
                        </div>
                    </div>

                </form>
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

import { Validator } from 'vee-validate'; 

    export default {

        props: ['givenAt', 'submitRecordRoute', 'memberSearch', 'memberSearchRoute'],

        data() {
            return {
                alertMessage: "",
                isHidden: true,
                isSuccesful: true,
                isDirectDeposit: false,

                gic: '',
                record_type: 'ob',
                service_type: '',
                group_name: '',
                agc: '',
                given_at: '',
                status: 0,
                tithe: 0,
                faith: 0,
                love: 0,
                bank_ref: '',

                des_offerings: [
                    {
                        designation: 'select',
                        designated_amount: 0,
                        designated_for: ''
                    }
                ],

                options: {
                    format: 'MM/DD/YYYY',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                    icons: {
                        previous: 'fas fa-chevron-left',
                        next: 'fas fa-chevron-right',
                        today: 'fas fa-calendar-check',
                        clear: 'far fa-trash-alt',
                        close: 'far fa-times-circle'
                    }
                },

                searchValues: [],

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                isSelected: 'anonymous',

                record_data: [],
                submit_record: [],
            }
        },

        computed: {
            total_amount() {
                var special_offering = this.des_offerings.reduce((total, input) => {
                    return total + Number(input.designated_amount);
                }, 0);

                return Number(this.tithe) + Number(this.love) + Number(this.faith) + special_offering;
            },
        },

        created() {

            const customMessages = {
                custom: {

                    gic: {
                        required: "Giver's identification should not be empty"
                    },

                    group_name: {
                        required: 'Group name should not be empty',
                        alpha_spaces: 'Group name should not contain special characters or numbers'
                    },

                    bank_ref: {
                        required: 'Deposit reference should not be empty',
                        alpha_num: 'Deposit reference should contain numbers and letters only'
                    },  

                    tithe: {
                        required: 'Tithe amount should not be empty',
                        decimal: 'Tithe amount should contain numbers only'
                    },

                    love: {
                        required: 'Love amount should not be empty',
                        decimal: 'Love amount should contain numbers only'
                    },

                    faith: {
                        required: 'Faith amount should not be empty',
                        decimal: 'Faith amount should contain numbers only'
                    },

                    service_type: {
                        required: 'Please select a service type'
                    },

                    given_at: {
                        required: 'Please select a date'
                    },

                    designated_amount: {
                        required: 'Designated amount should not be empty',
                        decimal: 'Designated amount should contain numbers only'
                    }, 

                    designation: {
                        required: 'Please select a designation'
                    },

                    designated_for: {
                        required: 'Specific designation should not be empty',
                        alpha_spaces: 'Specific designation should not contain special characters or numbers'
                    },

                    total_amount: {
                        min_value: 'Total amount must be more than 1'
                    }

                    /* name: {
                        required: () => 'Your name is empty'
                    }*/
                }
            };

            Validator.localize('en', customMessages);

            /*this.$validator.extend('truthy', {
                getMessage: field => 'The ' + field + ' value is not truthy.',
                validate: value => value === 'A'
            });

            let instance = new Validator({ trueField: 'truthy' });*/

            // or use the instance method
            //this.$validator.localize('en', dict);

            // Also there is an instance 'extend' method for convenience.
            /*instance.extend('falsy', (value) => ! value);

            instance.attach({
              name: 'falseField',
              rules: 'falsy'
            });*/
        },

        methods: {
            add(index) {
                this.des_offerings.push({ designated_amount: 0, designation: 'select', designated_for: ''});
            },

            remove(index) {
                this.des_offerings.splice(index, 1);
            },

            resetForm(e){
                e.preventDefault();
                this.des_offerings = [
                    {
                        designated_amount: 0,
                        designation: 'select',
                        designated_for: ''
                    }
                ];
                
                this.isAnonymous = false;
                this.bank_ref = '';
                this.gic = "";
                this.tithe = 0;
                this.love = 0;
                this.faith = 0;
                this.service_type = '';
                this.record_type = 'ob';
                this.given_at = '';
                this.status = 0;
                this.isSelected = 'anonymous';
            },

            nameWithCode ({ name, code }) {
                return `${name} — ${code}`
            },

            searchMembers() {
                window.axios.get(this.memberSearchRoute)
                    .then( response => {
                        this.searchValues = response.data.data;
                        this.gic = "";
                });
            },

            getValues() {
                return this.record_data = {
                    _token: this.csrf,
                    record_type: this.record_type,
                    giver_type: this.isSelected,
                    gic: this.gic['id'],
                    agc: this.agc,
                    group_name: this.group_name,
                    bank_ref: this.bank_ref,
                    service_type: this.service_type,
                    given_at: this.given_at,
                    status: this.status,
                    tithe: this.tithe,
                    love: this.love,
                    faith: this.faith,
                    total_amount: this.total_amount,
                    special_offering: this.des_offerings
                }
            },

            submitForm(e) {
                e.preventDefault();

                this.$validator.validateAll().then((result) => {
                  if (result) {
                    window.axios.post(this.submitRecordRoute, this.record_data)
                        .then( response => {
                            this.isSuccesful = true
                            this.isHidden = false
                            this.isDirectDeposit = false
                            this.alertMessage = response.data.success ? "Record succesfully added!" : "Error"

                        e.target.reset();
                        this.$validator.reset();
                    });
                  }

                  if(!result){
                    this.isSuccesful = false
                    this.isHidden = false
                    this.alertMessage = "Unable to create a record due to insufficient data."
                  }

                });
            },

            designationCondition(input) {
                if(input == 'others' || input == 'des_love_gift' || input == 'financial_assistance'){
                    return true;
                }
            }
        },

        mounted() {
            this.searchMembers();
            console.log('Component mounted.')
        }
    }
    
</script>
