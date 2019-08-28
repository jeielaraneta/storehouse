<template>
    <div class="card">
        <div class="card-header bg-transparent border-primary"><h5>Create New User</h5></div>
        <div class="card-body">
            <form ref="createMember" id="createMember" method="POST" :action="this.submitUserRoute" @submit.prevent="submitForm" @reset.prevent="resetForm" enctype="multipart/form-data" >
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" v-model="first_name" v-validate="'required|alpha_spaces'" data-vv-as="first name" :class="{'form-control': true, error: errors.has('first_name')}">
                        <span class="error text-danger" v-if="errors.has('first_name')">{{errors.first('first_name')}}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" v-model="middle_name" v-validate="'required|alpha_spaces'" data-vv-as="middle name" :class="{'form-control': true, error: errors.has('middle_name')}">
                        <span class="error text-danger" v-if="errors.has('middle_name')">{{errors.first('middle_name')}}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" v-model="last_name" v-validate="'required|alpha_spaces'" data-vv-as="last name" :class="{'form-control': true, error: errors.has('last_name')}">
                        <span class="error text-danger" v-if="errors.has('last_name')">{{errors.first('last_name')}}</span>
                    </div>
                    
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="birth_day">Birthday</label>
                        <date-picker id="birth_day" name="birthday" autocomplete="off" v-model="birthday" v-bind:value="birth_day" :config="options" v-validate="'required'" :class="{'form-control': true, error: errors.has('birthday')}"></date-picker>
                        <span class="error text-danger" v-if="errors.has('birthday')">{{errors.first('birthday')}}</span>
                    </div>
                    
                    <input type="hidden" class="form-control" id="age" name="age">

                    <div class="form-group col-md-8">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" v-model="email" v-validate="'email'" data-vv-as="email" :class="{'form-control': true, error: errors.has('email')}">
                        <span class="error text-danger" v-if="errors.has('email')">{{errors.first('email')}}</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" v-model="contact_number" v-validate="'digits:11'" data-vv-as="contact number" :class="{'form-control': true, error: errors.has('contact_number')}">
                        <span class="error text-danger" v-if="errors.has('contact_number')">{{errors.first('contact_number')}}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address_line_1">Address Line 1</label>
                    <input type="text" class="form-control" id="address_line_1" name="address_line_1" v-model="address_line_1" placeholder="House Number, Street, Building Name">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="barangay">Barangay</label>
                        <input type="text" name="barangay" v-model="barangay" class="form-control" id="barangay">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="city">City</label>
                        <input type="text" name="city" v-model="city" class="form-control" id="city">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="province">Province</label>
                        <input type="text" name="province" v-model="province" class="form-control" id="province">
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

<style>
    .form-control.error {
        border-color: #E84444;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(232,68,68,.6);
    }
</style>

<script>

    export default {
        props: ['birth_day', 'submitUserRoute'],

        data() {
            return {
                first_name: '',
                middle_name: '',
                last_name: '',
                birthday: '',
                email: '',
                contact_number: '',
                

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

                validations: {
                    date: {
                        required: true,
                        date_format: 'MM/DD/YYYY'
                    }
                }
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        created() {

        },

        methods: {
            submitForm(e) {   
                 
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$refs.createMember.submit();
                    }

                    /*if(!result){
                        this.isSuccesful = false
                        this.isHidden = false
                        this.alertMessage = "Unable to create a record due to insufficient data."
                    }*/

                });
            },

            resetForm(e) {
                e.preventDefault();


                e.target.reset();
                this.$validator.reset();
            }
        }
    }
    
</script>
