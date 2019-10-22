<section role="main" class="content-body" data-base_url='<?php echo base_url(); ?>'>
		<header class="page-header">
			<h2>Assessments <i class="fa fa-home"></i></h2>
		
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

		<div class="row">
			<div class="col-md-12" style="background-color: rgba(255,255,255, 0.7); color: ccc;  font-weight: bold; z-index: 2; padding: 20px; padding-top: 10px; padding-bottom: 100px;">
				<div class="row">
					<div class="col-md-12">
						<?php if($this->data['Assessment_Data']): ?>
						
							<h1 class="pull-left"><?php echo $this->data['Assessment_Data'][0]['AssessmentName']; ?></h1>
						
						<?php endIf; ?>
					</div>
					<div class="col-md-12">
						<?php if($this->data['Assessment_Data']): ?>
							<p class="pull-left">CONSTRUCTED BY: <u><?php echo $this->data['Assessment_Data'][0]['Instructor_Name']; ?></u></p>
						<?php endIf; ?>
						<?php if($this->data['Assessment_Respondent']): ?>
							<p class="pull-right">TAKEN BY: <u><?php echo $this->data['Assessment_Respondent'][0]['RespondentName']; ?></u></p>
						<?php endIf; ?>
					</div>
					<div class="col-md-12">
						<?php if($this->data['Assessment_Data']): ?>
						
							<hr>
						
						<?php endIf; ?>
					</div>
					<div class="col-md-12">
						<?php if($this->session->flashdata('message')): ?>
							<div class="well warning">
								<h3><?php echo $this->session->flashdata('message'); ?></h3>
							</div>
						<?php endIf; ?>
					</div>
					<div class="col-md-4" style="text-align: center; padding-top:50px">
						<div class="circular-bar">
							<div class="circular-bar-chart" data-percent="<?php echo $this->data['AssessmentStats']['ScorePercentage']; ?>" data-plugin-options='{ "barColor": "#<?php echo $this->data['AssessmentStats']['ScoreColor']; ?>", "delay": 300 , "size": 300}'>
									<strong style="font-size:25px; color:green">SCORE</strong>
									<label style="font-size:50px"><span class="percent"><?php echo $this->data['AssessmentStats']['ScorePercentage']; ?></span>%</label>
							</div>
						</div>
					</div>
					<div class="col-md-4">

						<?php if($this->data['Assessment_Data']): ?>

							<section class="panel panel-featured-left panel-featured-secondary">
								<div class="panel-body">
									<div class="widget-summary">
										<div class="widget-summary-col widget-summary-col-icon">
											<div class="summary-icon" style="color:white; background:#<?php echo $this->data['AssessmentStats']['ScoreColor']; ?>">
												<i class="fa fa-check-circle"></i>
											</div>
										</div>
										<div class="widget-summary-col">
											<div class="summary">
												<h2 class="title" style="color:green">Total Points</h2>
												<div class="info" style="line-height: 5rem;">
													<strong class="amount" style="font-size: 4rem;"><?php echo $this->data['AssessmentStats']['Score']; ?> / <?php echo $this->data['AssessmentStats']['TotalPoints']; ?></strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="panel panel-featured-left panel-featured-secondary">
								<div class="panel-body">
									<div class="widget-summary">
										<div class="widget-summary-col widget-summary-col-icon">
											<div class="summary-icon bg-primary">
												<i class="fa fa-pencil"></i>
											</div>
										</div>
										<div class="widget-summary-col">
											<div class="summary">
												<h2 class="title" style="color:green">Questions Answered</h2>
												<div class="info" style="line-height: 5rem;">
													<strong class="amount" style="font-size: 4rem;"><?php echo $this->data['AssessmentStats']['AnswerCount']; ?> / <?php echo $this->data['AssessmentStats']['QuestionCount']; ?></strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="panel panel-featured-left panel-featured-secondary">
								<div class="panel-body">
									<div class="widget-summary">
										<div class="widget-summary-col widget-summary-col-icon">
											<div class="summary-icon bg-success">
												<i class="fa fa-clock-o"></i>
											</div>
										</div>
										<div class="widget-summary-col">
											<div class="summary">
												<h2 class="title" style="color:green">Time Elapsed</h2>
												<div class="info" style="line-height: 5rem;">
													<strong class="amount" style="font-size: 4rem;"><?php echo $this->data['AssessmentStats']['RemainingTime']; ?> mins</strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							
						<?php else: ?>

							<h1>Invalid Assessment Code</h1>

						<?php endIf; ?>

					</div>
					<div class="col-md-4">

						<section class="panel panel-featured-left panel-featured-secondary">
							<div class="panel-body">
								<div class="widget-summary">
									<div class="widget-summary-col widget-summary-col-icon">
										<div class="summary-icon bg-info">
											<i class="fa fa-check-circle-o"></i>
										</div>
									</div>
									<div class="widget-summary-col">
										<div class="summary">
											<h2 class="title" style="color:green">Date Finished</h2>
											<div class="info" style="line-height: 5rem;">
												<strong class="amount" style="font-size: 4rem;"><?php echo $this->data['AssessmentStats']['DateFinished']; ?></strong>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>

					</div>
					
					<div class="col-md-12">
						<?php if($this->data['Assessment_Data']): ?>

							<div class="row">
								<div class="col-md-12">
									<h1 class="pull-left">Student Outcomes</h1>
								</div>
								<div class="col-md-12">
										<hr>
								</div>
							</div>

							<div class="row">
								<?php foreach($this->data['AssessmentStats']['Outcome'] as $outcome => $outcomestats): ?>
									<div class="col-md-4">
										<section class="panel panel-featured-bottom panel-featured-primary">
											<div class="panel-body">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon bg-primary">
															<i class="fa fa-graduation-cap"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h2 class="title" style="color:green"><?php echo $outcomestats['Name']; ?></h2>
															<div class="info" style="line-height: 5rem;">
																<strong class="amount" style="font-size: 4rem;"><?php echo $outcomestats['Percentage']; ?>%</strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-muted text-uppercase">Questions: <?php echo $outcomestats['Count']; ?> <br> Correct Answers: <?php echo $outcomestats['Correct']; ?></a>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
								<?php endForeach; ?>

							</div>

						<?php endIf; ?>
						
					</div>
				</div>
			</div>
		</div>

		<!-- end: page -->
	</section>


</div>