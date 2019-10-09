<template>
	<div class="card-body">
        
        <div class="row mb-5">
        	<div class="col-sm-3">
        		<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title"><i class="fas fa-file-invoice-dollar fa-lg"></i> Total Amount Recorded</h5>
					    <h1 class="card-text font-weight-bold text-primary">158,900</h1>
					    <a href="#" class="card-link">See all records</a>
				  	</div>
				</div>
        	</div>

        	<div class="col-sm-3">
        		<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title"><i class="fas fa-receipt fa-lg"></i> Verified Records</h5>
					    <h1 class="card-text font-weight-bold text-success">326</h1>
					    <a href="#" class="card-link">See verified rcords</a>
				  	</div>
				</div>
        	</div>

        	<div class="col-sm-3">
        		<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title"><i class="fas fa-coins fa-lg"></i> Unverified Records</h5>
					    <h1 class="card-text font-weight-bold text-danger">156</h1>
					    <a href="#" class="card-link">See unverified records</a>
				  	</div>
				</div>
        	</div>

        	<div class="col-sm-3">
        		<div class="card">
				  	<div class="card-body">
					    <h5 class="card-title"><i class="far fa-edit fa-lg"> </i>For Correction</h5>
					    <h1 class="card-text font-weight-bold text-warning">130</h1>
					    <a href="#" class="card-link">See records for corrections</a>
				  	</div>
				</div>
        	</div>
        </div>

        <div class="row">
        	<div class="col-sm-6">
        		<div class="card" >
        			<div class="card-header">
					   	<div class="row">
				        	<div class="col-md-6">
				        		Population of Giver Types and Service Types
				        	</div>
				        	<div class="col-md-6">
				        		<form class="float-right">
								  	<div class="form-row align-items-right">
									    <div class="col-auto">
									      	<label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
									      	<select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
										        <option selected>October</option>
										        <option value="1">Januray</option>
										        <option value="2">Febuary</option>
										        <option value="3">March</option>
										        <option value="3">April</option>
										        <option value="3">May</option>
										        <option value="3">June</option>
										        <option value="3">July</option>
										        <option value="3">August</option>
										        <option value="3">September</option>
									      	</select>
									    </div>
									    <div class="col-auto">
									      	<button type="button" class="btn btn-primary">Generate Report</button>
									    </div>
								  	</div>
								</form>
				        	</div>
						</div>
					</div>
				  	<div class="card-body overflow-auto">
				  		<div class="row">
				  			<div class="col-sm-6">
				  				<GChart type="PieChart" :data="giverTypePercentage" :options="giverTypePercentageOptions" style="width: 400px; height: 400px;" :resizeDebounce="500"/>
				  			</div>
				  			<div class="col-sm-6">
				  				<GChart type="PieChart" :data="serviceTypePercentage" :options="serviceTypePercentageOptions" style="width: 400px; height: 400px;" :resizeDebounce="500"/>
				  			</div>
				  		</div>
					    
				  	</div>
				</div>
			</div>

			<div class="col-sm-6">
        		<div class="card">
        			<div class="card-header">
        				<div class="row">
				        	<div class="col-md-6">
				        		October Tithes and Offerings Record
				        	</div>
				        	<div class="col-md-6">
				        		<form class="float-right">
								  	<div class="form-row align-items-right">
									    <div class="col-auto">
									      	<label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
									      	<select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
										        <option selected>October</option>
										        <option value="1">Januray</option>
										        <option value="2">Febuary</option>
										        <option value="3">March</option>
										        <option value="3">April</option>
										        <option value="3">May</option>
										        <option value="3">June</option>
										        <option value="3">July</option>
										        <option value="3">August</option>
										        <option value="3">September</option>
									      	</select>
									    </div>
									    <div class="col-auto">
									      	<button type="button" class="btn btn-primary">Generate Report</button>
									    </div>
								  	</div>
								</form>
				        	</div>
						</div>
					 </div>
				  	<div class="card-body overflow-auto">
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
			        ['April', 1030, 540, 350, 890],
			        ['May', 1030, 540, 350, 890],
			        ['June', 1030, 540, 350, 890],
			        ['July', 1030, 540, 350, 890],
			        ['April', 1030, 540, 350, 890],
			        ['April', 1030, 540, 350, 890],
			        ['April', 1030, 540, 350, 890],
			    ],

			    monthlyChartOptions: {
			        chart: {
			           title: 'Offering',
			           subtitle: 'Tithes, Love, Faith and Special Offerings: 2014-2017',
			        }
			    },

			    giverTypePercentage: [
		          	['Giver Type', 'Population'],
		          	['Anonymous', 11000],
		          	['Identified', 6500],
		          	['Group', 3256]
		        ],

		        giverTypePercentageOptions: {
		        	title: 'Giver Types Population',
		        	chartArea: {
		        		left:5,
		        		top:0,
		        		width:'100%',
		        		height:'100%'
		        	},
		        },

		        serviceTypePercentage: [
		          	['Service Type', 'Population'],
		          	['EWS', 3200],
		          	['MMWS', 6500],
		          	['VWS', 258],
		          	['Prayer Meeting', 95],
		          	['Sunday School', 2547],
		          	['Not Applicable', 1698],
		        ],

		        serviceTypePercentageOptions: {
		        	title: 'Service Types Population',
		        	chartArea: {
		        		left:5,
		        		top:0,
		        		width:'100%',
		        		height:'100%'
		        	},

		        },
  			}
  		}
    }

</script>