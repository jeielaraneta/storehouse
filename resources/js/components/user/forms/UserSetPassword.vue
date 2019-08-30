<template>
    <div class="card">
        <div class="card-header bg-transparent border-primary"><h5>Create New User</h5></div>
        <div class="card-body">
            <form ref="createUser" id="createUser" method="POST" :action="this.submitUserPasswordRoute" @submit.prevent="submitForm" @reset.prevent="resetForm" enctype="multipart/form-data" >
                <input type="hidden" name="_token" :value="csrf">

                <div class="form-row">
                    <label for="username" class="col-md-2 col-form-label text-md-left">Username</label>
                    <div class="form-group col-md-10">
                        <input type="text" id="username" name="username" v-model="username" v-validate="'required|alpha'" :class="{'form-control': true, error: errors.has('username')}">
                        <span class="error text-danger" v-if="errors.has('username')">{{errors.first('username')}}</span>
                    </div>
                </div>

                <div class="form-row">
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

    import { Validator } from 'vee-validate'; 

    export default {
        props: ['submitUserPasswordRoute'],

        data() {
            return {
                username: '',
                password: '',
                password_confirmation: '',

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },

        mounted() {
            console.log('Set Password mounted.')
        },

        created() {
            /*this.$validator.extend('truthy', {
                getMessage: field => 'The ' + field + ' value is not truthy.',
                validate: value => value === 'A'
            });

            let instance = new Validator({ trueField: 'truthy' });*/

            this.$validator.extend('verify_password', {
                getMessage: field => `The password must contain at least: 1 uppercase letter, 1 lowercase letter, 1 number, and one special character (E.g. , . _ & ? etc)`,
                validate: value => {
                    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                    return strongRegex.test(value);
                }
            });
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
