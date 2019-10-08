<template>
	<div class="card-body">
        
        <div class="row mb-5">
        	<div class="col-sm-3">
        		<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title">Total Amount Recorded</h5>
					    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
					    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					    <a href="#" class="card-link">Card link</a>
					    <a href="#" class="card-link">Another link</a>
				  	</div>
				</div>
        	</div>

        	<div class="col-sm-3">
        		<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title">Verified Records</h5>
					    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
					    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					    <a href="#" class="card-link">Card link</a>
					    <a href="#" class="card-link">Another link</a>
				  	</div>
				</div>
        	</div>

        	<div class="col-sm-3">
        		<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title">Unverified Records</h5>
					    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
					    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					    <a href="#" class="card-link">Card link</a>
					    <a href="#" class="card-link">Another link</a>
				  	</div>
				</div>
        	</div>

        	<div class="col-sm-3">
        		<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title">For Correction</h5>
					    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
					    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					    <a href="#" class="card-link">Card link</a>
					    <a href="#" class="card-link">Another link</a>
				  	</div>
				</div>
        	</div>
        </div>

        <div class="row">
        	<div class="col-sm-6">
        		<div class="card" >
        			<div class="card-header">
					   Year 2019 Tithes and Offerings Record
					 </div>
				  	<div class="card-body">
					    <GChart type="ColumnChart" :data="monthlyChartData" :options="monthlyChartOptions" style="width: 800px; height: 400px;" :resizeDebounce="500"/>
				  	</div>
				</div>
				
			</div>

			<div class="col-sm-6">
        		<div class="card">
        			<div class="card-header">
					    October Tithes and Offerings Record
					 </div>
				  	<div class="card-body">
					    <GChart type="ColumnChart" :data="weeklyChartData" :options="weeklyChartOptions" style="width: 800px; height: 400px;" :resizeDebounce="500"/>
				  	</div>
				</div>
				
			</div>
			
        </div>

    </div>
</template>

<script>
	export default {

      	mounted() {
          	
      	},

  		data() {
  			return{
  				weeklyChartData: [
			        ['Week', 'Tithes', 'Love', 'Faith', 'Special Offerings'],
			        ['Week 1', 1000, 400, 200, 900],
			        ['Week 2', 1170, 460, 250, 502],
			        ['Week 3', 660, 1120, 300, 309],
			        ['Week 4', 1030, 540, 350, 890]
			    ],

			    weeklyChartOptions: {
			        chart: {
			          title: 'Offering',
			          subtitle: 'Tithes, Love, Faith and Special Offerings: 2014-2017',
			        }
			    },

			    monthlyChartData: [
			        ['Month', 'Tithes', 'Love', 'Faith', 'Special Offerings'],
			        ['Januray', 1000, 400, 200, 900],
			        ['Febuary', 1170, 460, 250, 502],
			        ['March', 660, 1120, 300, 309],
			        ['April', 1030, 540, 350, 890]
			    ],

			    monthlyChartOptions: {
			        chart: {
			          title: 'Offering',
			          subtitle: 'Tithes, Love, Faith and Special Offerings: 2014-2017',
			        }
			    }
  			}
  		}
    }

</script>