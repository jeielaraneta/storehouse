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
                <form method="POST" enctype="multipart/form-data" @submit.prevent="submitForm" @reset.prevent="resetForm" >
                    <input type="hidden" id="_token" name="_token" :value="csrf">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="record_type1" value="dd" v-model="record_type" @change="getValues">
                                <label class="form-check-label" for="record_type1">Bank Deposit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="record_type2" value="ob" v-model="record_type" @change="getValues">
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
                            <select id="giver_type" class="custom-select custom-select mb-3" v-model="isSelected" @change="getValues">
                                <!-- <option disabled selected value="">Select Giver Type</option> -->
                                <option value="identified">Identified Giver</option>
                                <option selected value="">Anonymous Giver</option>
                                <option value="group">Group</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row" v-show="isSelected == 'identified'">
                        <div class="form-group col-md-12">
                            <label for="gic">Member's Name or Giver Indentification Code (GIC) </label>
                            <multiselect v-model="gic" :options="searchValues" :custom-label="nameWithCode" placeholder="Search for Member's name or GIC" label="name" track-by="name" id="gic"  @input="getValues"></multiselect>
                        </div>
                    </div>
                
                    <div class="form-row" v-show="isSelected == 'group'">
                        <div class="form-group col-md-12">
                            <label for="">Group's Name</label>
                            <input type="text" class="form-control" v-model="agc" @change="getValues">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="service_type">Service Type</label>
                            <select id="service_type" class="custom-select custom-select mb-3" v-model="service_type" @change="getValues">
                                <option disabled selected>Select Service Type</option>
                                <option value="ews">EWS</option>
                                <option value="mmws">MMWS</option>
                                <option value="vws">VWS</option>
                                <option value="ss">Sunday School</option>
                                <option value="pm">Prayer Meeting</option>
                                <option value="na">Not Applicable</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="giventAt">Given At</label>
                            <date-picker id="giventAt" v-bind:value="giventAt" autocomplete="off" :config="options" v-model="givent_at" @input="getValues"></date-picker>
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
                            <input type="number" class="form-control" id="tithe_amount" v-model.number="tithe" @input="getValues">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="love_amount">Love</label>
                            <input type="number" class="form-control" id="love_amount" v-model.number="love" @input="getValues">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="faith_amount">Faith</label>
                            <input type="number" class="form-control" id="faith_amount" v-model.number="faith" @input="getValues">
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="designation">Special Offering</label>
                    </div>
                    
                    <div class="form-row" v-for="(input,k) in des_offerings" :key="k">
                        <div class="form-group col-md-4">
                            <select id="designation" class="custom-select custom-select mb-3" v-model="input.designation" @change="getValues">
                                <option disabled selected value="select">Select designation</option>
                                <option value="ce">C.E Ministry</option>
                                <option value="music">Music Ministry</option>
                                <option value="outreach">Community Outreach Ministry</option>
                                <option value="local_missions">Local Missions</option>
                                <option value="intl_missions">International Missions</option>
                                <option value="others">Others</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4" v-if="input.designation == 'others'">
                            <input type="text" id="designated_for" class="form-control" v-model="input.designated_for" placeholder="Designated for" @input="getValues">
                        </div>

                        <div class="form-group col-md-2">
                            <input type="number" id="designated_amount" class="form-control amount" v-model.number="input.amount" placeholder="Enter amount" @input="getValues">
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
                        <div class="col-md-2">
                            <input type="text" id="total_amount" class="form-control" v-model:value="total_amount" disabled @change="getValues">
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

<script>
    export default {

        props: ['giventAt', 'submitRecordRoute', 'memberSearch', 'memberSearchRoute'],

        data() {
            return {
                alertMessage: "",
                isHidden: true,
                isSuccesful: true,

                gic: '',
                record_type: 'ob',
                service_type: '',
                agc: '',
                givent_at: '',
                status: 0,
                tithe: 0,
                faith: 0,
                love: 0,

                des_offerings: [
                    {
                        designation: 'select',
                        amount: 0,
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
                isSelected: '',

                record_data: [],
                submit_record: [],
            }
        },

        computed: {
            total_amount() {
                var special_offering = this.des_offerings.reduce((total, input) => {
                    return total + Number(input.amount);
                }, 0);

                return Number(this.tithe) + Number(this.love) + Number(this.faith) + special_offering;
            }
        },

        methods: {
            add(index) {
                this.des_offerings.push({ amount: 0, designation: 'select', designated_for: ''});
            },

            remove(index) {
                this.des_offerings.splice(index, 1);
            },

            resetForm(e){
                this.des_offerings = [
                    {
                        amount: 0,
                        designation: 'select',
                        designated_for: ''
                    }
                ];
                this.isAnonymous = false;
                this.gic = "";
                this.tithe = 0;
                this.love = 0;
                this.faith = 0;
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
                    service_type: this.service_type,
                    givent_at: this.givent_at,
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

                window.axios.post(this.submitRecordRoute, this.record_data)
                    .then( response => {
                        /*console.log(response.data.success)
                        this.toEditMaritalStatus = true
                        this.isSuccesful = true
                        this.isHidden = false
                        this.alertMessage = response.data.success ? "Member's profile updated sucessfully!" : "Error"*/
                    });
            }
        },

        mounted() {
            this.searchMembers();
            console.log('Component mounted.')
        }
    }
    
</script>
