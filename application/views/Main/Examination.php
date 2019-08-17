<section data-base_url='<?php echo base_url(); ?>'>

		<!-- start: page -->


		<div class="container">

			<br><br><br><br>


				<h2 class="mt-lg"><?php echo $this->data['AssessmentData'][0]['AssessmentName']; ?></h2>

				<div class="row">
					<div class="col-md-8">
						<p style="color:green"><?php echo $this->data['AssessmentData'][0]['Instructor_Name']; ?></p>
						<hr>
						<h4 class="mb-lg"><?php echo $this->data['AssessmentData'][0]['Description']; ?></h4>
					</div>
					<div class="col-md-4" style="border-left: 5px solid red;">
						<table>
							<tr>	
								<th>
									<h4 class="mt-lg">
										TIME REMAINING: 
									</h4>
								</th>
								<th>
									<h1 style="color:green; font-size:40px; padding:10px">60</h1>
								</th>
							</tr>
						</table>

						<hr>
						<h4 class="mt-lg">PROGRESS: 
							<div class="progress progress-xl progress-squared m-md light">
								<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
									60%
								</div>
							</div>
						</h4>
					</div>
				</div>
				<br>

			<form action="" method="">
			<div class="row">

				<?php foreach($this->data['AssessmentQuestions'] as $question): ?>
					
					<?php echo $question; ?>

				<?php endForeach; ?>	

				<div class="col-md-12">
					<section class="panel shadowed-box" style="">
						<div class="panel-body" style="text-align:center; padding-left:20%; padding-right:20%">
							<button type="button" class="mb-xs mt-xs mr-xs btn btn-lg btn-primary btn-block">SUBMIT</button>
						</div>
					</section> 
				</div>

			</div>
			</form>

			<br><br><br><br>

		</div>

		
		
		<!-- end: page -->
</section>

