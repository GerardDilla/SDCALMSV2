


<section role="main" class="content-body">
	<header class="page-header">
		<h2></h2>
					
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
		   <input type="hidden" value="<?php echo base_url(); ?>"  id="base_urlSS">
		   <div class="row">
		      <div class="col-md-12">
			  <section class="panel shadowed-box">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>
                        <h2 class="panel-title">Search Student</h2>
                        <p class="panel-subtitle">
                        </p>
                    </header>
                    <div class="panel-body">
						 <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label">School Year:</label>
									<div class="col-md-8">
										<select data-plugin-selectTwo class="form-control populate" id="sy">
												<option selected value="">Select School Year:</option>
												<?php foreach($this->data['get_sy'] as $row): ?>
												<option><?php echo $row['School_Year']; ?></option>
												<?php endForeach; ?>
										</select>   
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Semester:</label>
									<div class="col-md-8">
									   <select data-plugin-selectTwo class="form-control populate" id="sem">
												<option selected value="">Select Semester:</option>
												<?php foreach($this->data['get_sem'] as $row): ?>
												<option><?php echo $row['Semester']; ?></option>
												<?php endForeach; ?>
										</select>   
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-8">
										<select data-plugin-selectTwo class="form-control populate">	
											<option value="AK">Evaluate</option>
											<option value="HI">Non Evaluate</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label">Course:</label>
									<div class="col-md-8">
								     	<select data-plugin-selectTwo class="form-control populate" name="Program" id="Program">
												<option selected value="">Select Course:</option>
												<?php foreach($this->data['get_course'] as $row): ?>
												<option><?php echo $row['Program_Code']; ?></option>
												<?php endForeach; ?>
										</select>   
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Section:</label>
									<div class="col-md-8">
									   <select data-plugin-selectTwo class="form-control populate" name="Section" id="Section">
												<option selected value="">Select Section:</option>
										</select>  
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Year Level:</label>
									<div class="col-md-8">
									      <select data-plugin-selectTwo class="form-control populate" name="yrlvl" id="yrlvl">
												<option selected value="">Select Level:</option>
												<?php foreach($this->data['get_yrlvl'] as $row): ?>
												<option><?php echo $row['Program_Duration']; ?></option>
												<?php endForeach; ?>
										 </select>   
									</div>
								</div>
							</div>
                         </div>
                      
					  <div class="message_box">
                           
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <button type="button" class="btn btn-default" onclick="Get_Students()" >View Students</button>
                        <button type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                        <span class="searchloader">
                            <img src="http://10.0.0.65/SDCALMSv2/assets/images/loading.gif" height="42" width="42">
                        </span>
                    </footer>
                </section>
			  </div>
		   </div>
	
        <div class="row">
		    <div class="col-md-12">
				<section class="panel shadowed-box">
						<div class="panel-body">
						<table class="table table-bordered table-striped mb-none">
							<thead>
								<tr>
									<th>#</th>
									<th>Student Number</th>
									<th>Name </th>
									<th>Course</th>
									<th>Section</th>
									<th>Year Level</th>
								</tr>
							</thead>
							<tbody id="Search_Student">

							</tbody>
						</table>
						</div>
					</section>
			</div>
		</div>	
			<!-- end: page -->
			
</section>    


