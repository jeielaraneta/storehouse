<template>
	<div class="col-md-12">
		
		<div class="card">
		  	<div class="card-header bg-transparent border-primary">
	        	<h5>Record Profile</h5> 
	        </div>
	        <div class="card-body">
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

      	props: ['recordData', 'specialOfferingsData', 'birthday', 'updateRecordRoute'],

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
                	defaultDate: this.memberData.birthday
                },

                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                alertMessage: "",
                isHidden: true,
                isSuccesful: true,
                isDisabled: true,
               
            }
        },
	    methods: {

	    	
	    }
  	}

</script>
