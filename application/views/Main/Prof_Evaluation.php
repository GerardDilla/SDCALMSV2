


<section role="main" class="content-body">
	<header class="page-header">
		<h2></h2>
					
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
						   <i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Faculty Evaluation</span></li>
				</ol>
				<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
			</div>
	</header>
	<div id="particles-js"></div>
			<!-- start: page -->
			<form method="post" action="<?php echo base_url(); ?>index.php/Faculty_Evaluation/Insert">

					<input name="instrutor_id" type="hidden" value="<?php echo $this->data['getinstructor'][0]['ID']; ?>">
					<input name="sched_code"   type="hidden" value="<?php echo $this->data['sched_code']; ?>">
					<input name="sem"          type="hidden" value="<?php echo $this->data['sem']; ?>">
					<input name="term"         type="hidden" value="<?php echo $this->data['term']; ?>">
					<input name="sy"           type="hidden" value="<?php echo $this->data['sy']; ?>">

			<div class="row">
				<div class="col-md-12">
			                <section class="panel panel text-dark">
								<header class="panel-heading heading-title">
									<h2 class="panel-title text-center text-danger text-bold" >Student Assesment of Teaching Evaluation Form</h2>
								</header>
								<div class="panel-body">
									 <h2 class="text-center text-dark text-bold"><?php echo $this->data['getinstructor'][0]['Instructor_Name']; ?></h2>
									 <hr>
									 <h4 style="text-align">One of the major responsibilities of SDCA is to promote high teaching standards among its faculty. Please take time to evaluate your professor and his/her teaching competencies. </h4>
									 <hr>
									 <h4 style="text-align"><span class="text-dark">Direction:</span> Read the statement carefully. Choose the number per item that corresponds to your assessment.</h4>
									 <hr>
									 <h4 class="text-dark text-center">(5 - ALWAYS; 4 - OFTEN; 3 - SOMETIMES; RARELY - 2; NEVER - 1)</h4>
									 <hr>


						<?php $area = ''; ?>
							 <?php foreach($this->data['getdescript'] as $row): ?>
					             <?php if($area != $row['category_name']): ?>
							
										<table class="table table-striped table-bordered table-hover text-dark" style="font-size: 16px; ">
										   <thead class=" text-center">
												<tr>
											    	<th class="text-danger heading-title" colspan="7"><?php echo $row['orderr']; ?>.<?php echo $row['category_name']; ?></th>
												</tr>
                                             
												<?php $ideval = $row['eval_type']; ?>
												<?php if($ideval=='Rating'): ?>
												<tr>
												    <th>AREA/S</th>
											     	<?php foreach($this->data['getscriteria'] as $row1): ?>
											        <th class="text-center"><?php echo $row1['ratings']; ?></th>
												    <?php endforeach; ?>
												</tr>
												<?php endif; ?>
											</thead>
										
											<?php $area = $row['category_name']; ?>
											<?php endif; ?>
											<?php $ideval = $row['eval_type']; ?>
											<?php $idd = $row['eval_id']; ?>
                                            
											<tbody>

								
											
										          <?php if($ideval=='Rating'): ?>
													  <tr>
														<td><?php echo $row['question_name']; ?></td>
														<td class="center score"><input type="radio" name="eval_<?php echo $idd; ?>" value="5" required></td>
														<td class="center score"><input type="radio" name="eval_<?php echo $idd; ?>" value="4" required></td>
														<td class="center score"><input type="radio" name="eval_<?php echo $idd; ?>" value="3" required></td>
														<td class="center score"><input type="radio" name="eval_<?php echo $idd; ?>" value="2" required></td>
														<td class="center score"><input type="radio" name="eval_<?php echo $idd; ?>" value="1" required></td>
													  </tr>
												
													<?php elseif($ideval=='Essay'): ?>
													<tr>
														<td colspan="7">
															<p><?php echo $row['question_name']; ?></p> 
														    <textarea id="6" class="form-control" required name="eval_<?php echo $idd; ?>" 
															 style="background-color: #E8E8E8"></textarea>
														</td>
																	
													</tr>

													<?php elseif($ideval=='YesNo'): ?>
														<tr>
															<td colspan="7">
																<p>
																<?php echo $row['question_name']; ?> 
																	<label>
																	<input type="radio" required name="eval_<?php echo $idd; ?>" value="Yes">
																	YES
																	</label>
																<label>
																	<input type="radio" required  name="eval_<?php echo $idd; ?>" value="No">
																	NO 
																</label>	
																</p>
															</td>
														</tr>

													<?php elseif($ideval=='Overall Rating'): ?>
													<tr>
													<td></td>
														<td>
															<p> <?php echo $row['question_name']; ?> -
															  <label> 
														     	<?php foreach($this->data['getscale'] as $row2): ?>
														    	   <input type="radio"  name="eval_<?php echo $idd; ?>" value="<?php echo $row2['ecale']; ?>"> 
																	<?php echo $row2['ecale']; ?>
														     	<?php endforeach; ?>
															   </label> 
															</p>
														<td>
														
													<tr>


											</tbody>
											<?php endif; ?>
											<?php endforeach; ?>	
										 </table>
										
										 <div class="text-center">
										    <button  type="submit" class="btn btn-lg btn-danger">Submit Evaluation</button>

                                       </div>

								</div>
								
						    </section>
				 </div>
             </div>
			 </form>
			<!-- end: page -->
			
</section>    