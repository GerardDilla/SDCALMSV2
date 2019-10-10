



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
	 <form method="post" action="<?php echo base_url(); ?>index.php/Report/Class_list">
		   <input type="hidden" value="<?php echo base_url(); ?>"  id="base_urlSS">
		   <div class="row">
		      <div class="col-md-12">
			  <section class="panel shadowed-box">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>
                        <h2 class="panel-title text-success bold">Class List Report</h2>
                        <p class="panel-subtitle">
                        </p>
                    </header>
                    <div class="panel-body">
						 <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label">School Year:</label>
									<div class="col-md-8">

									<?php 
										//SELECT School Year
										$class = array('class' => 'form-control populatek',
														'data-plugin-selectTwo'  => 'data-plugin-selectTwo', 
														'id'   =>  'sy',
														
												);
										$options =  array('' => 'Select SchoolYear:');
										foreach($this->data['get_schoolyear'] as $row) {

											$options[$row['School_Year']] = $row['School_Year'];
											}
										echo form_dropdown('School_Year', $options, $this->input->post('School_Year'),$class);
									?>    
									
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Semester:</label>
									<div class="col-md-8">
										<?php 
											//Semester DROPDOWN
											$class = array('class' => 'form-control populate',
														   'data-plugin-selectTwo'  => 'data-plugin-selectTwo', 
														   'id'   =>  'sem',  
														 
														   );
											$options =  array(
											''        => 'Select Semester',
											'FIRST'   => 'FIRST',
											'SECOND'  => 'SECOND',
											'SUMMER'  => 'SUMMER',
											);

											echo form_dropdown('Sem', $options, $this->input->post('Sem'),$class);

										?>  
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label">Section Handle:</label>
									<div class="col-md-8">

									<?php 
										
										$class = array('class' => 'form-control populate',
														'id'   => 'Section',
														'data-plugin-selectTwo'   => ' data-plugin-selectTwo',
													);
										$options =  array('' => 'Select Section');
								
										echo form_dropdown('Section', $options, $this->input->post('Section'),$class);
									?>    
									<input type="hidden" value="<?php echo $this->input->post('Section'); ?>"  id="Section">
									 
									</div>
								</div>
								
								
							</div>
                         </div>
                      
				
                    </div>
			
                    <footer class="panel-footer">
                        <button type="submit" name="submit" class="btn btn-success">View Students</button>
                        <button type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                        <span class="searchloader">
                            <img src="http://10.0.0.65/SDCALMSv2/assets/images/loading.gif" height="42" width="42">
                        </span>
						
                    </footer>
                </section>
			  </div>
		   </div>
		   </form>
        <div class="row">
		    <div class="col-md-12">
				<section class="panel shadowed-box">
						<div class="panel-body">
						<table id="example" class="table table-bordered table-striped mb-none">
							<thead>
								<tr class="success">
									<th>#</th>
									<th>Student Number</th>
									<th>Name </th>
									<th>Course</th>
								
									<th>Year Level</th>
								</tr>
							</thead>
							<tbody>
									<?php
										$count = 1;
										foreach($this->data['get_classlist']  as $row):     
									?>
									   <tr style="text-transform: uppercase;">
												<td><?php echo $count;  ?></td>
												<td><?php echo $row['Student_Number'];  ?></td>
												<td><?php echo $row['Last_Name'];  ?>, <?php echo $row['First_Name']; ?>  <?php echo $row['Middle_Name']; ?></td>
												<td><?php echo $row['Program'];  ?></td>
												<td><?php echo $row['Year_Level'];  ?></td> 	

									    </tr>
										

									<?php  $count = $count + 1; endforeach; ?>
							</tbody>
						</table>
						</div>
					</section>
			</div>
		</div>	
			<!-- end: page -->
			
</section>    


<script src="<?php echo base_url(); ?>assets/javascripts/Report/Class_List.js"></script>



