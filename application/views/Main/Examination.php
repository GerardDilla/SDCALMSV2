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
									<h2 id="timerdisplay" data-timeleft="<?php echo $this->data['Session']['Timeleft']; ?>" style="color:green; font-size:40px; padding:10px">
										
									</h2> 
								</th>
							</tr>
						</table>

						<hr>
						<h4 class="mt-lg">PROGRESS: 
							<div class="progress progress-xl progress-squared m-md light">
								<div id="ExamProgress" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
									0%
								</div>
								<input type="hidden" id="totalquestions" value="<?php echo $this->data['TotalQuestions']; ?>">
							</div>
						</h4>
					</div>
				</div>
				<br>

			<form action="<?php echo base_url(); ?>index.php/Assessment/SubmitAssessment" method="POST" id="ExamForm">
			<div class="row">

				<?php foreach($this->data['AssessmentQuestions'] as $question): ?>
					
					<?php echo $question; ?>

				<?php endForeach; ?>	

				<div class="col-md-12">
					<section class="panel shadowed-box" style="">
						<div class="panel-body" style="text-align:center; padding-left:20%; padding-right:20%">
							<input type="hidden" name="AssessmentCode" value="<?php echo $this->data['AssessmentData'][0]['AssessmentCode']; ?>">
							<button type="submit" class="mb-xs mt-xs mr-xs btn btn-lg btn-primary btn-block" >SUBMIT</button>
						</div>
					</section> 
				</div>

			</div>
			</form>

			<br><br><br><br>

		</div>

		
		
		<!-- end: page -->
</section>

<!-- JS for portfolio page -->
<script src="<?php echo base_url(); ?>assets/javascripts/examination.js"></script>

