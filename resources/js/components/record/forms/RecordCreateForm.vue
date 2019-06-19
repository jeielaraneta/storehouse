<template>
    <div class="card" >
        <div class="card-header bg-transparent border-primary"><h5>Create New Record</h5></div>
        <div class="card-body">
            <form method="POST" :action="this.submitRecordRoute" enctype="multipart/form-data" @reset.prevent="resetForm">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="record_type" id="record_type1" value="dd" v-model="record_type" @change="onChange">
                            <label class="form-check-label" for="record_type1">Bank Deposit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="record_type" id="record_type2" value="ob" v-model="record_type" checked="" @change="onChange">
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
                        <select id="giver_type" class="custom-select custom-select mb-3" v-model="isSelected" name="giver_type" @change="onChange">
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
                        <multiselect v-model="gic" :options="searchValues" :custom-label="nameWithCode" placeholder="Search for Member's name or GIC" label="name" track-by="name" id="gic" name="gic" @input="onChange"></multiselect>
                    </div>
                </div>
            
                <div class="form-row" v-show="isSelected == 'group'">
                    <div class="form-group col-md-12">
                        <label for="">Group's Name</label>
                        <input type="text" class="form-control" name="agc" v-model="agc" @change="onChange">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="service_type">Service Type</label>
                        <select id="service_type" class="custom-select custom-select mb-3" name="service_type" v-model="service_type" @change="onChange">
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
                        <date-picker id="giventAt" name="giventAt" v-bind:value="giventAt" autocomplete="off" :config="options" v-model="givent_at" @input="onChange"></date-picker>
                    </div>

                     <div class="form-group col-md-4">
                        <label for="service_type">Status</label>
                        <select id="status" class="custom-select custom-select mb-3" name="status" v-model="status" @change="onChange">
                            <option value="0">Unverified</option>
                            <option value="1">Verified</option>
                        </select>
                    </div>
                    
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tithe_amount">Tithe</label>
                        <input type="number" class="form-control" id="tithe_amount" v-model.number="tithe" name="tithe_amount" @input="onChange">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="love_amount">Love</label>
                        <input type="number" class="form-control" id="love_amount" v-model.number="love" name="love_amount" @input="onChange">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="faith_amount">Faith</label>
                        <input type="number" class="form-control" id="faith_amount" v-model.number="faith" name="faith_amount" @input="onChange">
                    </div>
                </div>

                <div class="form-row">
                    <label for="designation">Special Offering</label>
                </div>
                
                <div class="form-row" v-for="(input,k) in des_offerings" :key="k">
                    <div class="form-group col-md-4">
                        <select id="designation" class="custom-select custom-select mb-3" name="designation" v-model="input.designation">
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
                        <input type="text" id="designated_for" name="designated_for" class="form-control" v-model="input.designated_for" placeholder="Designated for">
                    </div>

                    <div class="form-group col-md-2">
                        <input type="number" id="designated_amount" name="designated_amount" class="form-control amount" v-model.number="input.amount" placeholder="Enter amount">
                    </div>

                    <div class="form-group col-md-2">
                        <span>
                            <i class="fas fa-minus-circle fa-lg" @click="remove(k)" v-show="k || ( !k && des_offerings.length > 1)"></i>
                            <i class="fas fa-plus-circle fa-lg" @click="add(k)" v-show="k == des_offerings.length-1"></i>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="total_amount" class="col-sm-2 col-form-label">Total Amount</label>
                    <div class="col-md-2">
                        <input type="text" id="total_amount" name="total_amount" class="form-control" v-model:value="total_amount" disabled @change="onChange">
                    </div>
                </div>

                <!-- <pre class="language-json"><code>{{ value }}</code></pre> -->

               <!--  {{gic}} {{record_type}} {{isSelected}} {{service_type}} {{agc}} {{givent_at}} {{status}}

                {{tithe}} {{faith}} {{love}} {{des_offerings}} {{total_amount}} -->

                {{record_data}}

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success float-right">Submit</button>
                        <button type="reset" class="btn btn-danger float-right mx-3">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['giventAt', 'submitRecordRoute', 'memberSearch', 'memberSearchRoute'],

        data() {
            return {

                gic: '',
                record_type: '',
                service_type: '',
                agc: '',
                givent_at: '',
                status: '',
                tithe: 0,
                faith: 0,
                love: 0,

                des_offerings: [
                    {
                        amount: 0,
                        designation: 'select',
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

                record_data: []
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

            onChange() {
                return this.record_data = {
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
                    total_amount: this.total_amount

                }
                //this.record_data.push(event)
            }

            /*submitValue({ type, target, name }) {
                const event = {
                    type,
                    isCheckbox: target.type === 'checkbox',
                    target: {
                        value: target.value,
                        checked: target.checked,
                        named: name
                    }
                }
                this.recordValues.push(event)
            }*/
        },

        mounted() {
            this.searchMembers();
            console.log('Component mounted.')
        }
    }
    
</script>
