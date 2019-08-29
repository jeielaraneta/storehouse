<template>
    <div class="card">
        <div class="card-header bg-transparent border-primary"><h5>Create New User</h5></div>
        <div class="card-body">
            <form ref="createUser" id="createUser" method="POST" :action="this.submitUserRoute" @submit.prevent="submitForm" @reset.prevent="resetForm" enctype="multipart/form-data" >
                <input type="hidden" name="_token" :value="csrf">

                <div class="form-row">
                    <label for="first_name" class="col-md-2 col-form-label text-md-left">First Name</label>
                    <div class="form-group col-md-10">
                        <input type="text" id="first_name" name="first_name" v-model="first_name" v-validate="'required|alpha_spaces'" data-vv-as="first name" :class="{'form-control': true, error: errors.has('first_name')}">
                        <span class="error text-danger" v-if="errors.has('first_name')">{{errors.first('first_name')}}</span>
                    </div>
                </div>

                <div class="form-row">
                    <label for="middle_name" class="col-md-2 col-form-label text-md-left">Middle Name</label>
                    <div class="form-group col-md-10">
                        <input type="text" id="middle_name" name="middle_name" v-model="middle_name" v-validate="'required|alpha_spaces'" data-vv-as="middle name" :class="{'form-control': true, error: errors.has('middle_name')}">
                        <span class="error text-danger" v-if="errors.has('middle_name')">{{errors.first('middle_name')}}</span>
                    </div>
                </div>

                <div class="form-row">
                    <label for="last_name" class="col-md-2 col-form-label text-md-left">Last Name</label>
                    <div class="form-group col-md-10">
                        <input type="text" id="last_name" name="last_name" v-model="last_name" v-validate="'required|alpha_spaces'" data-vv-as="last name" :class="{'form-control': true, error: errors.has('last_name')}">
                        <span class="error text-danger" v-if="errors.has('last_name')">{{errors.first('last_name')}}</span>
                    </div>
                </div>

                <div class="form-row">
                    <label for="birth_day" class="col-md-2 col-form-label text-md-left">Birthday</label>
                    <div class="form-group col-md-10">
                        <date-picker id="birth_day" name="birthday" autocomplete="off" v-model="birthday" v-bind:value="birth_day" :config="options" v-validate="'required'" :class="{'form-control': true, error: errors.has('birthday')}"></date-picker>
                        <span class="error text-danger" v-if="errors.has('birthday')">{{errors.first('birthday')}}</span>
                    </div>
                </div>
                    
                <input type="hidden" class="form-control" id="age" name="age">

                <div class="form-row">
                    <label for="email" class="col-md-2 col-form-label text-md-left">Email</label>
                    <div class="form-group col-md-10">
                        <input type="text" id="email" name="email" v-model="email" v-validate="'required|email'" data-vv-as="email" :class="{'form-control': true, error: errors.has('email')}">
                        <span class="error text-danger" v-if="errors.has('email')">{{errors.first('email')}}</span>
                    </div>
                </div>

                <div class="form-row">
                    <label for="contact_number" class="col-md-3 col-form-label text-md-left">Contact Number</label>
                    <div class="form-group col-md-9">
                        <input type="text" id="contact_number" name="contact_number" v-model="contact_number" v-validate="'required|digits:11'" data-vv-as="contact number" :class="{'form-control': true, error: errors.has('contact_number')}">
                        <span class="error text-danger" v-if="errors.has('contact_number')">{{errors.first('contact_number')}}</span>
                    </div>
                </div>

                <!-- <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input v-validate="'required|min:8|verify_password'" name="password" type="password" v-model="password" :class="{'form-control': true, error: errors.has('password')}" placeholder="Password" ref="password">
                        <span class="error text-danger" v-if="errors.has('password')">{{errors.first('password')}}</span>

                    </div>
                    <div class="form-group col-md-6">
                        <label for="password-confirm">Confirm Password</label>
                        <input v-validate="'required|confirmed:password'" name="password_confirmation" type="password" v-model="password_confirmation" :class="{'form-control': true, error: errors.has('password_confirmation')}"  placeholder="Password, Again" data-vv-as="password">
                        <span class="error text-danger" v-if="errors.has('password_confirmation')">{{errors.first('password_confirmation')}}</span>
                    </div>
                </div> -->

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

    import { Validator } from 'vee-validate'; 

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
            /*this.$validator.extend('truthy', {
                getMessage: field => 'The ' + field + ' value is not truthy.',
                validate: value => value === 'A'
            });

            let instance = new Validator({ trueField: 'truthy' });*/

            /*this.$validator.extend('verify_password', {
                getMessage: field => `The password must contain at least: 1 uppercase letter, 1 lowercase letter, 1 number, and one special character (E.g. , . _ & ? etc)`,
                validate: value => {
                    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                    return strongRegex.test(value);
                }
            });*/
        },

        methods: {
            submitForm(e) {   
                 
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$refs.createUser.submit();
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
