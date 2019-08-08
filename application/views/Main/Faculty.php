<section role="main" class="content-body">
	<header class="page-header">
		<h2>INSTRUCTORS</h2>
					
			<div class="right-wrapper pull-right" style="padding-right:20px">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
						   <i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Faculty Evaluation</span></li>
				</ol>
			</div>
	</header>
	<div id="particles-js"></div>
			<!-- start: page -->
			<div class="row"> 
				<?php	if($this->data['getenrolled']->num_rows() > 0):  ?>
				<div class="col-md-12">
			        <section class="panel panel text-dark">
						<header class="panel-heading heading-title">
							<h2 class="panel-title">
						      <div class="col-md-4">
								  Semester: <span class="text-success text-bold"> <?php echo $this->data['getlegend'][0]['semester']; ?> </span>
							  </div>
							  <div class="col-md-4">
								  Term: <span class="text-success text-bold">  <?php echo $this->data['getlegend'][0]['term']; ?> </span>
							  </div>
							  <div class="col-md-4 ">
							      Academic Year: <span class="text-success text-bold"> <?php echo $this->data['getlegend'][0]['schoolyear']; ?> </span>
							  </div>
						   </h2>
						   <br>
						</header>
							<div class="panel-body">
							<div class="table-responsive">
							<table class="table table-bordered mb-none">
								<thead>
									<tr class="text-danger">
										<th>Section</th>
										<th>Sched Code</th>
										<th>Course Title</th>
										<th>Professor(s)</th>
										<th>Lec/Lab</th>
										<th></th>
									</tr>
								</thead>
									<tbody>
									<?php foreach($this->data['data'] as $row) { ?>

							<?php 
									
									   if($row['Course_Lab_Unit'] > 0){							  
										  $lab = 'LAB/';
									   }else{
										  $lab = '';
									   }

									   if($row['Course_Lec_Unit'] > 0){							  
										$lec = 'LEC';
									    }else{
										$lec = '';
									 }
										 
							?>

										<tr>
											<td><?php echo $row['Section'] ?></td>
											<td><?php echo $row['Sched_Code'] ?></td>
											<td><?php echo $row['Course_Title'] ?></td>
											<td><?php echo $row['Instructor_Name'] ?></td>
											<td><?php echo $lab; ?><?php echo  $lec; ?></td>


										<?php	if($this->data['getdone'][$row['Sched_Code']] > 0):  ?>

											     	<td class="text-center">
													  <p class="text-success text-bold">
														Evaluated
										             </p>
													</td>

								      	<?php else: ?>
  
												<form method="post" action="<?php echo base_url(); ?>index.php/Faculty_Evaluation/Form">
														<input name="instrutor_id" type="hidden" value="<?php echo $row['Instructor_ID']; ?>">
														<input name="sched_code"   type="hidden" value="<?php echo $row['Sched_Code']; ?>">
														<input name="sem"          type="hidden" value="<?php echo $this->data['getlegend'][0]['semester']; ?>">
														<input name="term"         type="hidden" value="<?php echo $this->data['getlegend'][0]['term']; ?>">
														<input name="school_year"  type="hidden" value="<?php echo $this->data['getlegend'][0]['schoolyear']; ?>">

													<td class="text-center">
														<button  type="submit" class="btn btn-danger">
														Evaluate Now
														</button>
													</td>
												</form>
										
										<?php endif; ?>
    
										</tr>	
									<?php } ?>
									</tbody>
							</table>
							</div>			
							</div>
					</section>	
				 </div>
				 <?php else: ?>
					<div class="col-md-12">
				     	<section class="panel panel text-dark">
							<div class="panel-body">
							  <h1 class="text-center text-bold text-danger">Not Enrolled</h1>
							</div>
				     	</section>		
					</div>
				<?php endif; ?>
             </div>
			<!-- end: page -->
			
</section>    