<template>
    <div class="card">
        <div class="card-header">Create New Member</div>
        <div class="card-body">
            <form method="POST" :action="this.submitMemberRoute" enctype="multipart/form-data">
                <input type="hidden" name="_token" :value="csrf">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                    
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="birthday">Birthday</label>
                        <date-picker id="birthday" name="birthday" v-bind:value="birthday" :config="options"></date-picker>
                    </div>
                    
                    <input type="hidden" class="form-control" id="age" name="age">

                    <div class="form-group col-md-8">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="martial_status">Marital Status</label>
                        <select id="martial_status" class="custom-select custom-select mb-3">
                            <option selected>Select martital status</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="separate">Separated</option>
                            <option value="divorced">Divorced</option>
                            <option value="single">Single</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="membership_status">Membership Status</label>
                        <select id="membership_status" class="custom-select custom-select mb-3">
                            <option selected>Select membership status</option>
                            <option value="active">Active</option>
                            <option value="regular attendee">Regular Attendee</option>
                            <option value="visitor">Visitor</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address_line_1">Address Line 1</label>
                    <input type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder="House Number, Street, Building Name">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="barangay">Barangay</label>
                        <input type="text" name="barangay" class="form-control" id="barangay">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" id="city">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="province">Province</label>
                        <input type="text" name="province" class="form-control" id="province">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                        <button type="reset" class="btn btn-danger float-right mx-3">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['birthday', 'submitMemberRoute'],
        data() {
            return {
                options: {
                    format: 'MM/DD/YYYY',
                    useCurrent: false,
                    showClear: true,
                    showClose: true
                },
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }

    $.extend(true, $.fn.datetimepicker.defaults, {
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'far fa-times-circle'
        }
    });
</script>
