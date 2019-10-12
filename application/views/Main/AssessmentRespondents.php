<section role="main" class="content-body" id="CourseWall" data-base_url='<?php //echo base_url(); ?>' data-usertype="<?php //echo $this->data['Usertype']; ?>" data-usertoken="<?php //echo $this->data['Usertoken']; ?>">
		<header class="page-header">
			
			<h2><i class="fa fa-book"></i> <?php //echo $this->data['SchedData'][0]['Course_Code']; ?> : <?php //echo $this->data['SchedData'][0]['Sched_Code']; ?></h2>
		
			<div class="right-wrapper pull-right" style="padding-right:20px">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Pages</span></li>
					<li><span>User Profile</span>
					 
					</li>
				</ol>
			</div>
		</header>
		<div id="particles-js"></div>
		<!-- start: page -->

		<!--General Class info-->
		<div class="row">

		</div>
		<!--//General Class info-->

		<!--Class Feed-->
		<div class="row flex-column-reverse flex-md-row">
			<div class="col-sm-8 col-lg-8 order-2">
				<h1>Assessment Takers</h1>
				<hr>
				<h3 id="active-filter-panel">Filters:	
					<span id="addedfilters">		
						<span class="active-filter" data-schedcode='20123213'>
							<button class="btn btn-sm btn-default">Subject : 21231321</button>
						</span>
					</span>
				</h3>
				<div class="tabs">
					<ul class="nav nav-tabs nav-justified">
						<li class="active">
							<a href="#popular10" data-toggle="tab" class="text-center"><i class="fa fa-star"></i> Assessment Report</a>
						</li>
						<li>
							<a href="#recent10" data-toggle="tab" class="text-center"> Summary</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="popular10" class="tab-pane active ">
							<br>
							<div class="form-group row">
								<div class="col-md-6">
									<div class="input-group mb-md">
										<input type="text" id="filter_search" class="form-control" placeholder="Search...">
										<span class="input-group-btn">
											<button class="btn btn-success" id="filter_button" type="button">Search</button>
										</span>
									</div>
								</div>
								<div class="col-md-5">
									<div class="input-group btn-group" style="width:100%" >
										<span class="input-group-addon">
											<i class="fa fa-th-list"></i>
										</span>
										<select class="form-control" multiple="multiple" data-plugin-multiselect="" id="ms_filter" style="display: none;">
											<option value="Recently">Recently Taken</option>
											<option value="Passed">Passed</option>
											<option value="Failed">Failed</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<hr>
								</div>
								<div class="col-md-12">
									<div class="table-responsive">
										<table id="respondent_table" class="table table-hover mb-none">
											<thead>
												<tr>
													<th>#</th>
													<th>Student Number</th>
													<th>Name</th>
													<th>Score</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-12">
									<br>
								</div>
							</div>
						</div>
						<div id="recent10" class="tab-pane">
							<div class="row">

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-lg-4 order-2">
				<section class="panel panel-group">
					<header class="panel-heading bg-primary">

						<div class="widget-profile-info">
							<div class="profile-info assessment-info" data-assessment-code="<?php echo $this->data['AssessmentData'][0]['AssessmentCode']; ?>">
								<h4 class="name text-semibold"><?php echo $this->data['AssessmentData'][0]['AssessmentName']; ?> (<?php echo $this->data['AssessmentData'][0]['AssessmentCode']; ?>)</h4>
								<hr>
								<h5 class="role"><?php echo $this->data['AssessmentData'][0]['Description']; ?></h5>
							</div>
						</div>

					</header>
					<div id="accordion">
						<div class="panel panel-accordion panel-accordion-first">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1One">
										<i class="fa fa-check"></i> Handled Classes
									</a>
								</h4>
							</div>
							<div id="collapse1One" class="accordion-body collapse in">
								<div class="panel-body">
									<p style="font-size:12px; color:#666">Choose which of your handled classes to display on the report</p>
									<ul class="widget-todo-list">
										<li>
											<?php 
												$syoption[''] = 'test';
												foreach($this->data['HandledSubjects'] as $handled){
													$syoption[$handled['SchoolYear']] = $handled['SchoolYear'];
												}
												$attr = array(
													'class' => 'form-control mb-md class_filter',
													'id' => 'sy_filter'
												);
												echo form_dropdown('SchoolYear', $syoption, $this->data['Legend'][0]['School_Year'], $attr);

											?>
											<?php 
												$syoption[''] = 'test';
												foreach($this->data['HandledSubjects'] as $handled){
													$semoption[$handled['Semester']] = $handled['Semester'];
												}
												$attr = array(
													'class' => 'form-control mb-md class_filter',
													'id' => 'sem_filter'
												);
												echo form_dropdown('Semester', $semoption, $this->data['Legend'][0]['Semester'], $attr);

											?>
											
										</li>
										<div style="overflow-y:auto; max-height:300px" id="class_filter_list">
											
										</div>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		</div>
		<!--//Class Feed-->
		<!-- end: page -->
	</section>
	<script>
		function base_url(){
			return '<?php echo base_url(); ?>';	
		}
	</script>
	<script src="<?php echo base_url(); ?>assets/javascripts/assessmentrespondents.js"></script>