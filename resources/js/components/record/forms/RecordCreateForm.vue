<template>
    <div class="card">
        <div class="card-header">Create New Record</div>
        <div class="card-body">
            <form method="POST" :action="this.submitRecordRoute" enctype="multipart/form-data" @reset.prevent="resetForm">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="record_type" id="record_type1" value="dd">
                            <label class="form-check-label" for="record_type1">Direct Deposit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="record_type" id="record_type2" value="ob">
                            <label class="form-check-label" for="record_type2">Offering Box</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="anonymous" v-model="isAnonymous">
                            <label class="form-check-label" for="anonymous">
                                Anonymous Giver
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="gic">Giver Identification Code</label>
                        <input type="text" class="form-control" id="gic" name="gic" :disabled="isAnonymous">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="member_id">Member's Name</label>
                        <input type="text" class="form-control" id="member_id" name="member_id" :disabled="isAnonymous">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="service_type">Service Type</label>
                        <select id="service_type" class="custom-select custom-select mb-3" name="service_type">
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
                        <label for="givent_at">Given At</label>
                        <date-picker id="givent_at" name="givent_at" v-bind:value="givent_at" autocomplete="off" :config="options"></date-picker>
                    </div>

                     <div class="form-group col-md-4">
                        <label for="service_type">Status</label>
                        <select id="status" class="custom-select custom-select mb-3" name="status">
                            <option value="0">Unverified</option>
                            <option value="1">Verified</option>
                        </select>
                    </div>
                    
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="tithe_amount">Tithe</label>
                        <input type="text" class="form-control" id="tithe_amount" name="tithe_amount">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="love_amount">Love</label>
                        <input type="text" class="form-control" id="love_amount" name="love_amount">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="faith_amount">Faith</label>
                        <input type="text" class="form-control" id="faith_amount" name="faith_amount">
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
                        <input type="text" id="designated_amount" name="designated_amount" class="form-control" v-model.number="input.amount" placeholder="Enter amount">
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
                        <input type="text" id="total_amount" name="total_amount" class="form-control" :value="total_amount" disabled>
                    </div>
                    
                </div>

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
        props: ['givent_at', 'submitRecordRoute'],
        data() {
            return {
                des_offerings: [
                    {
                        amount: '',
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
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                isAnonymous: false,
            }
        },
        computed: {
            total_amount() {
                return this.des_offerings.reduce((total, input) => {
                    return total + input.amount;
                }, 0);
            }
        },
        methods: {
            add(index) {
                this.des_offerings.push({ amount: '', designation: 'select', designated_for: ''});
            },
            remove(index) {
                this.des_offerings.splice(index, 1);
            },
            resetForm(e){
                this.des_offerings = [
                    {
                        amount: '',
                        designation: 'select',
                        designated_for: ''
                    }
                ];
                this.isAnonymous = false;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
    
</script>
