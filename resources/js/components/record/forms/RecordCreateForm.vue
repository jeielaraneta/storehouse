<template>
    <div class="card">
        <div class="card-header">Create New Member</div>
        <div class="card-body">
            <form method="POST" :action="this.submitMemberRoute" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="reference_no">Reference No.</label>
                        <input type="text" class="form-control" id="reference_no" name="reference_no">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="member_id">Member's Name</label>
                        <input type="text" class="form-control" id="member_id" name="member_id">
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
                        <date-picker id="givent_at" name="givent_at" v-bind:value="givent_at" :config="options"></date-picker>
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
                    <div class="form-group col-md-4">
                        <label for="special_offering">Special Offering</label>
                        <input type="text" class="form-control" id="special_offering" name="special_offering">
                    </div>

                    <div class="form-group col-md-8">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation">
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
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
    
</script>
