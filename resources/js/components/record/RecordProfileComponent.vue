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
		
		<div class="card">		
	        
	        <div class="card-body">

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

      	props: ['recordData', 'birthday', 'updateRecordRoute'],

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
