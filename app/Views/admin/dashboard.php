<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<style>
	h5.text-primary, .card-body p {
		color: #000 !important;
	}
</style>
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<!-- <div class="row">
			<div class="col-xxl-12 mb-6 order-0">
				<div class="card">
					<div class="d-flex align-items-start row">
						<div class="col-sm-7">
							<div class="card-body">
								<h5 class="card-title text-primary mb-3">Welcome Super Admin! 🎉</h5>
								<p class="mb-6"><?php echo date('d M, Y'); ?><br><?php echo date('l'); ?></p>
								<a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
							</div>
						</div>
						<div class="col-sm-5 text-center text-sm-left">
							<div class="card-body pb-0 px-0 px-md-6">
								<img src="<?php echo base_url('public/assets/img/illustrations/man-with-laptop.png'); ?>" height="175" class="scaleX-n1-rtl" alt="View Badge User">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="row mt-5">
			<div class="col-xxl-12 col-lg-12">
				<div class="card h-100">
					<div class="card-body">
						<div class="row">
							<div class="col-xxl-12">
								<canvas id="myChart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
	var page_title = "Dashboard";
	$(document).ready(function(){
		load_income_chart();
	});
	function load_income_chart()
	{
		var ctx = $('#myChart');

		// Destroy the previous chart instance before creating a new one
	    if (window.myIncomeChart instanceof Chart) {
	        window.myIncomeChart.destroy();
	    }
		$.ajax({
			url: "<?php echo base_url('load-revenue'); ?>",
			type: "GET",
			dataType: "json",
			success:function(response){
		        window.myIncomeChart = new Chart(ctx, {
	                type: 'line',
	                data: {
	                    labels: response.labels,
	                    datasets: [{
	                        label: 'Revenue (2025)',
	                        data: response.data,
	                        backgroundColor: '#696cff',
	                        borderColor: '#696cff',
	                        borderWidth: 1,
	                        anchor: 'end',
			                align: 'top',
			                font: {
			                    family: "'Nunito', sans-serif",
			                    weight: 'bold',
			                    size: 14
			                },
			                color: '#000',
	                        formatter: function(value, context) {
			                    // Display total when hovered
			                    if (context.datasetIndex === 0) {
			                        // Calculate total of all data points
			                        const total = context.dataset.data.reduce((sum, currentValue) => sum + currentValue, 0);
			                        return total;
			                    }
			                    return value; // Default behavior: display the individual value
			                }
	                    }]
	                },
	                options: {
	                    plugins: {
	                        datalabels: {
	                            anchor: 'end',
	                            align: 'top',
	                            font: {
	                            	family: "'Nunito', sans-serif",
	                                weight: 'bold',
	                                size: 14
	                            },
	                            color: '#000', // Text color
	                            formatter: function(value, context) {
				                    // Display total when hovered
				                    if (context.datasetIndex === 0) {
				                        // Calculate total of all data points
				                        const total = context.dataset.data.reduce((sum, currentValue) => sum + currentValue, 0);
				                        return total;
				                    }
				                    return value; // Default behavior: display the individual value
				                }
	                        }
	                    },
	                    scales: {
	                        x: {
	                            ticks: {
	                                font: {
	                                    family: "'Nunito', sans-serif", // Custom font family for x-axis labels
	                                    size: 10
	                                }
	                            }
	                        },
	                        y: {
	                            beginAtZero: true,
	                            ticks: {
	                                font: {
	                                    family: "'Nunito', sans-serif", // Custom font family for y-axis labels
	                                    size: 10,
	                                    weight: 500
	                                }
	                            }
	                        }
	                    }
	                }
	            });
			}
		});
	}
</script>
<?= $this->endSection(); ?>