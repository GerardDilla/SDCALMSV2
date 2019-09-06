<section role="main" class="content-body" data-base_url='<?php echo base_url(); ?>'>
		<header class="page-header">
			<h2><?php echo $this->data['StudentInfo'][0]['First_Name'].' '.$this->data['StudentInfo'][0]['Last_Name']; ?>'s Portfolio <i class="fa fa-book"></i></h2>
		
			<div class="right-wrapper pull-right" style="padding-right:20px">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Pages</span></li>
					<li><span>User Profile</span>
					<button id="sticky-primary" class="mt-sm mb-sm btn btn-primary">Primary</button>
					</li>
				</ol>
			</div>
		</header>
		<div id="particles-js"></div>
		<!-- start: page -->

		<div class="row">
			<div class="col-md-4 col-lg-3">

				<section class="panel">
					<div class="panel-body">
						<div class="thumb-info mb-md">
							<img src="<?php echo base_url(); ?>personaldata/Profilepicture/default.png" class="rounded img-responsive" alt="John Doe">
							<div class="thumb-info-title">
								<span class="thumb-info-inner"><?php echo $this->data['StudentInfo'][0]['First_Name'].' '.$this->data['StudentInfo'][0]['Last_Name']; ?></span>
								<span class="thumb-info-type"><?php echo $this->data['StudentInfo'][0]['Student_Number']; ?></span>
							</div>
						</div>

						<hr class="dotted short">

						<h6 class="text-muted">About</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis vulputate quam. Interdum et malesuada</p>

						<hr class="dotted short">
						<h6 class="text-muted">Email</h6>
						<p style="color:green"><?php echo $this->data['StudentInfo'][0]['AccountEmail'] ?></p>

						<hr class="dotted short">
						<h6 class="text-muted">Course</h6>
						<p style="color:green"><?php echo $this->data['StudentInfo'][0]['Course'] ?></p>


					</div>
				</section>

				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
						</div>

						<h2 class="panel-title">Achievements</h2>
					</header>
					<div class="panel-body">
						<ul class="simple-post-list" id="AchievementSummary">
						<?php if($this->data['CertificateList']): ?>
							<?php foreach($this->data['CertificateList'] as $row): ?>
								<li>
									<div class="post-image">
										<div class="img-thumbnail cert_thumbnail">
											<a class="lightbox" href="<?php echo base_url(); ?>personaldata/Certificates/<?php echo $row['Certificate'].''.$row['Extension'] ?>" data-plugin-options='{ "type":"image" }'>
												<img class="cert_img" src="<?php echo base_url(); ?>personaldata/Certificates/<?php echo $row['Certificate'].''.$row['Extension'] ?>" alt="">
											</a>
										</div>
									</div>
									<div class="post-info">
										<a class="lightbox cert_link" href="<?php echo base_url(); ?>personaldata/Certificates/<?php echo $row['Certificate'].''.$row['Extension'] ?>" data-plugin-options='{ "type":"image" }'><?php echo $row['Title']; ?></a>
										<div class="post-meta">
											<?php echo $row['Date']; ?>
										</div>
									</div>
								</li>
							<?php endForeach; ?>
						<?php else: ?>
							<?php echo 'No Achievement posted'; ?>
						<?php endIf; ?>
						</ul>
					</div>
				</section>

				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
						</div>

						<h2 class="panel-title">
							<span class="va-middle">Organizational Groups</span>
						</h2>
					</header>
					<div class="panel-body">
						<div class="content">
							<ul class="simple-user-list">
							<?php if($this->data['OrganizationList']): ?>
								<?php foreach($this->data['OrganizationList'] as $org): ?>
									<li>
										<span class="title"><?php echo $org['Organization']; ?></span>
										<span class="message truncate"><?php echo $org['Description']; ?></span>
									</li>
								<?php endForeach; ?>
							<?php else: ?>
								<?php echo 'No Affiliated Organization'; ?>
							<?php endIf; ?>
							</ul>
						</div>
					</div>
				</section>

			

			</div>
			<div class="col-md-8 col-lg-6">

				<div class="tabs">
					<ul class="nav nav-tabs tabs-primary">
						<li class="active">
							<a href="#overview" data-toggle="tab">Activity Logs</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="overview" class="tab-pane active">

							<h4 class="mb-xlg">Activities</h4>

							<div class="timeline timeline-simple mt-xlg mb-md">
								<div class="tm-body">
									<?php echo $this->data['ActivityFeedView']; ?>
								</div>
							</div>

							

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-3">

				<h4 class="mb-md">Enrolled Courses</h4>
				<ul class="simple-bullet-list mb-xlg">
					<li class="red">
						<span class="title">Programming 101</span>
						<span class="description truncate">Gerard Dilla</span>
					</li>
					<li class="green">
						<span class="title">Calculus Basics</span>
						<span class="description truncate">Oneal Vallecera</span>
					</li>
					<li class="blue">
						<span class="title">Database Management fundamentals</span>
						<span class="description truncate">Ayben Feudo</span>
					</li>
					<li class="orange">
						<span class="title">Data Mining</span>
						<span class="description truncate">Shaira Relos</span>
					</li>
				</ul>
				<hr class="dotted short">

				<br>

				<h4 class="mb-md">Recently Taken Assessments</h4>
				<ul class="simple-user-list mb-xlg">
				<?php if($this->data['AssessmentList']): ?>
					<?php foreach($this->data['AssessmentList'] as $assessment): ?>
					<li>
						<span class="title"><?php echo $assessment['AssessmentName']; ?></span>
						<span class="message"><?php echo $assessment['Instructor_Name']; ?></span>
					</li>
					<?php endForeach; ?>
				<?php endIf; ?>
				</ul>

				<hr class="dotted short">

				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
							<a href="#" class="fa fa-times"></a>
						</div>

						<h2 class="panel-title">
							<span class="va-middle">Volunteer Experience</span>
						</h2>
					</header>
					<div class="panel-body">
						<div class="content">
							<ul class="simple-user-list">
								<?php if($this->data['ExperienceList']): ?>
								<?php foreach($this->data['ExperienceList'] as $exp): ?>
									<li>
										<span class="title"><?php echo $exp['Experience']; ?></span>
										<span class="message truncate"><?php echo $exp['Description']; ?></span>
									</li>
								<?php endForeach; ?>
								<?php else: ?>
									<?php echo 'No Experiences Recorded'; ?>
								<?php endIf; ?>
							</ul>
						</div>
					</div>
				</section>
				
			</div>

		</div>
		<!-- end: page -->
	</section>

	<div id="Certmanage" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">

                Manage Achievements / Certificates
                <span class="searchloader">
                    <img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="20" width="auto">
				</span>
				

            </h2>

        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text row">

					<div class="form-group">
						<label class="col-md-3 control-label">Search</label>
						<div class="col-md-7">
							<input type="text"  class="form-control" id="cert_manager_search" autofocus placeholder="Search with Title..">
						</div>
						<button style="height:34px" class="col-md-1 btn btn-sm btn-default" onclick="search_cert()"><i class="fa fa-search"></i></button>
					</div>

					<div class="table-responsive col-md-12" style="max-height:600px; min-height:600px; overflow:auto">
						<table class="table mb-none">
							<tbody id="cert_manager">




							</tbody>
						</table>
					</div>

                </div>
            </div>
        </div>
        <footer class="panel-footer">
			<div class="row">
                <div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss pull-right">Close</button>
                </div>
            </div>
        </footer>
    </section>
</div>

