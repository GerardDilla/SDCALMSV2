<section role="main" class="content-body" id="CourseWall" data-base_url='<?php //echo base_url(); ?>' data-usertype="<?php //echo $this->data['Usertype']; ?>" data-usertoken="<?php //echo $this->data['Usertoken']; ?>">
		<header class="page-header">
			
			<h2><i class="fa fa-book"></i> <?php //echo $this->data['SchedData'][0]['Course_Code']; ?> : <?php echo $this->data['AssessmentData'][0]['AssessmentCode']; ?></h2>
		
			<div class="right-wrapper pull-right" style="padding-right:20px">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Assessment</span></li>
					<li><span>Respondent</span>
					 
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
				</h3>
				<div class="tabs">
					<ul class="nav nav-tabs nav-justified">
						<li class="active">
							<a href="#popular10" data-toggle="tab" class="text-center"><i class="fa fa-star"></i> Assessment Report</a>
						</li>
						<li>
							<a href="#recent10" data-toggle="tab" class="text-center assessment-summary"> Summary</a>
						</li>
					</ul>
					<div class="tab-content" style="height:100%;">
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
								<div class="col-md-6">
									<div class="input-group btn-group" style="width:100%" >
										<span class="input-group-addon">
											<i class="fa fa-th-list"></i>
										</span>
										<select class="form-control" multiple="multiple" data-plugin-multiselect="" id="remark_filters" style="display: none;">
											<option value="Passed">Passed</option>
											<option value="Failed">Failed</option>
										</select>
										<span class="searchloader" style="margin-left:10px">
											<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="34.60" width="42">
										</span>
									</div>
								</div>
								<div class="col-md-12">
									<hr>
								</div>
								<div class="col-md-12">
									<div class="table-responsive" style="overflow:auto; max-width:700vw; min-height:200px">
										<table id="respondent_table" class="table table-hover mb-none">
											<p>Click on the Outcomes to view results</p>
											<thead>
												<tr>
													<th>Student Number</th>
													<th>Name</th>
													<th>Section</th>
													<th>Score</th>
													<th>Remarks</th>
													<?php if($this->data['AssessmentOutcomes']): ?>
														<?php $addedoutcome = 5; ?>
														<?php foreach($this->data['AssessmentOutcomes'] as $outcomes): ?>
														<?php $addedoutcome++; ?>
															<th class="added-outcome" data-outcome-no="<?php echo $addedoutcome; ?>">
																<button class="btn btn-default btn-sm td-outcome" data-outcome-name="<?php echo $outcomes['Outcome']; ?>">
																	<span><?php echo $outcomes['Outcome']; ?> (<?php echo $this->data['OutcomeTotal'][$outcomes['Outcome']]; ?>)</span>
																</button>
															</th>
														<?php endForeach; ?>
													<?php endIf; ?>
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
							<div class="row" id="summary-report">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<h2 id="active-filter-panel">Assessment Summary</h2>
									<hr>
								</div>
								<div class="col-md-12" style="text-align: center; padding-top:50px">
									<div class="circular-bar">
										<div class="circular-bar-chart passing-chart" data-percent="0" data-plugin-options='{ "barColor": "#cc0000", "size": 250}'>
												<strong style="font-size:25px; color:green">Passed</strong>
												<label style="font-size:50px"><span class="percent">0</span>%</label>
										</div>
									</div>
								</div>
								<!--
									<div class="col-md-12 col-lg-6 col-xl-6">
										<section class="panel panel-featured-left panel-featured-tertiary">
											<div class="panel-body">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon bg-tertiary">
															<i class="fa fa-check-circle"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Total Points:</h4>
															<br>
															<div class="info">
																<strong class="amount" style="padding-top:10px; font-size:5rem;"><?php echo $this->data['TotalPoints']; ?></strong>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
									<div class="col-md-12 col-lg-6 col-xl-6">
										<section class="panel panel-featured-left panel-featured-primary">
											<div class="panel-body">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon bg-primary">
															<i class="fa fa-check-circle"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Number of Takers:</h4>
															<br>
															<div class="info">
																<strong class="amount" style="padding-top:10px; font-size:5rem;" id="respondent_count"></strong>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
									<div class="col-md-12 col-lg-6 col-xl-6">
										<section class="panel panel-featured-left panel-featured-success">
											<div class="panel-body">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon bg-success">
															<i class="fa fa-check-circle"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Number of Passers:</h4>
															<br>
															<div class="info">
																<strong class="amount" style="padding-top:10px; font-size:5rem;" id="passers_count"></strong>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
								-->
								<div class="col-md-12 col-lg-12 col-xl-12">
									<hr>
										<h1>Skill-Based Results</h1>
										<h4>Legends:</h4>
										<span class="highlight" style="background-color:rgba(255, 0, 0, 1)">70% below</span> 
										<span class="highlight" style="background-color:rgba(255, 165, 0, 1)">70% Above</span> 
										<span class="highlight" style="background-color:rgba(124,252,0, 1); color:#000">100%</span>
									<hr>
									<section class="panel row">
										<div class="col-md-1 h-100" style="margin-top:20%">
											<h3 style="transform: rotate(-90deg); width:120px">Student %</h3>
										</div>
										<div class="col-md-11">
											<canvas id="outcome_report" width="300" height="150"></canvas>
											<hr>
										</div>
										<div class="col-md-12 row outcome-breakdown">


										</div>
										
									</section>
								</div>
								

							</div>
							<div class="row">
								<hr>
								<div class="col-md-12" style="text-align:center">
									<button class="btn btn-info print-summary pull-right">Print Summary</button>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-2 col-lg-3 order-2">
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
											<li>
												<div class="checkbox-custom checkbox-default">
													<input type="checkbox" id="201810071" class="class_filter_check" onclick="ToggleFilter(&quot;IT314&quot;,&quot;201810071&quot;)">
													
												</div>
											</li>
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

	<!-- Outcome result modal -->
	<div id="Outcome_indiv_result" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:50%">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style="text-transform:uppercase">Results for: <strong><span class="outcome-title">test</strong></u>
						<span class="searchloader">
							<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="20" width="auto">
						</span>
					</h4>
				</div>
				<div class="modal-body row">
					<!-- Morris: Area -->
					<canvas id="outcome_indiv_report" width="300" height="150"></canvas>
					<h3 style="text-align:center">Grade Percentage %</h3>

				</div>
			</div>

		</div>
	</div>
	<!-- Outcome result modal -->



	<script>
		function base_url(){
			return '<?php echo base_url(); ?>';	
		}
	</script>
	<script src="<?php echo base_url(); ?>assets/javascripts/assessmentrespondents.js"></script>