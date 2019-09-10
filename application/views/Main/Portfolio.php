<section role="main" class="content-body" data-base_url='<?php echo base_url(); ?>'>
		<header class="page-header">
			<h2>My Portfolio <i class="fa fa-home"></i></h2>
		
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
								<span class="thumb-info-inner"><?php echo $this->student_data['Full_Name']; ?></span>
								<span class="thumb-info-type"><?php echo $this->student_data['Student_Number']; ?></span>
							</div>
						</div>


						<hr class="dotted short">

						<h6 class="text-muted">About</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis vulputate quam. Interdum et malesuada</p>
						<div class="clearfix">
							<a class="text-uppercase text-muted pull-right" href="#">(View All)</a>
						</div>


						<hr class="dotted short">
						<h6 class="text-muted">Email</h6>
						<p style="color:green"><?php echo $this->student_data['Email']; ?></p>

						<hr class="dotted short">
						<h6 class="text-muted">Course</h6>
						<p style="color:green">BSIT</p>


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
						<hr class="dotted short">
						<div class="text-right">

						</div>
					</div>
				</section>

				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
							<a href="#" class="fa fa-times"></a>
						</div>

						<h2 class="panel-title">
							<span class="va-middle">Organizational Groups</span>
						</h2>
					</header>
					<div class="panel-body">
						<div class="content">
							<ul class="simple-user-list" id="OrgSummary">
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
							<hr class="dotted short">
							<div class="text-right">
								
							</div>
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
						<li>
							<a href="#edit" data-toggle="tab">Edit</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="overview" class="tab-pane active">

							<h4 class="mb-xlg">Activities</h4>

							<div class="timeline timeline-simple mt-xlg mb-md">
								<div class="tm-body" id="ActivityFeed">
									<?php echo $this->data['ActivityFeedView']; ?>
								</div>
							</div>

							

						</div>
						<div id="edit" class="tab-pane">

								<h4 class="mb-xlg">About Yourself</h4>
								<fieldset>
									<div class="form-group">
										<label class="col-md-3 control-label" for="profileBio">Personal Info</label>
										<div class="col-md-8">
											<textarea class="form-control" rows="3" id="profileBio"></textarea>
										</div>
									</div>
								</fieldset>

								<hr class="dotted tall">
								<h4 class="mb-xlg">Change Email</h4>
								<fieldset>
									<div class="form-group">
										<label class="col-md-3 control-label" for="profileFirstName">Current Email</label>
										<div class="col-md-8">
											<input type="readonly" disabled class="form-control" value="<?php echo $this->student_data['Email']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="profileFirstName">New Email</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="profileFirstName">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="profileLastName">Password</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="profileLastName">
										</div>
									</div>
								</fieldset>

								<hr class="dotted tall">
								<h4 class="mb-xlg">
								
									Portfolio Info 
									<span class="searchloader">
										<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
									</span>

								</h4>

								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
										</div>
										<h5>Upload an Achievement</h5>
									</header>
									<div class="panel-body">

										<div id="certificate_message">
							
										</div>
										<?php 
											$attributes = array(
												'id' => 'cert_form',
												'method' => 'post',
											); 
										?>
										<?php echo form_open_multipart(base_url().'index.php/Portfolio/certificate_upload',$attributes); ?>
										
											<div class="form-group">
												<label class="col-md-3 control-label" for="profileFirstName">Certificate / Achievement Name</label>
												<div class="col-md-8">
													<input type="text"  class="form-control" id="CertName" name="CertName" placeholder="Ex: Best in Thesis Certificate">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="profileFirstName">Certificate Image (JPG/PNG)</label>
												<div class="col-md-8">
													<input class="btn btn-info form-control"  type="file" id="CertFile" name="CertFile" size="20" onchange="display_image(this)" />
												</div>
											</div>
											<hr>
											<div style="text-align:center">
												<a class="img-thumbnail lightbox" id="cert_lightbox" href="<?php echo base_url(); ?>assets/images/cert_icon.png" data-plugin-options='{ "type":"image" }'>
													<img class="img-responsive" id="cert_thumbnail" width="200" src="<?php echo base_url(); ?>assets/images/cert_icon.png">
													<span class="zoom">
														<i class="fa fa-search"></i>
													</span>
												</a>
											</div>
											<br/>
			
											<button class="btn btn-default" href="#" onclick="cert_viewall()">Manage Certificates</button>
											<input class="btn btn-success pull-right" type="submit" value="Submit" />

										</form>
									</div>
								</section>

								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
										</div>
										<h5>Organizations</h5>
									</header>
									<div class="panel-body">

										<div id="organization_message"></div>
										<?php 
											$attributes = array(
												'id' => 'org_form',
												'method' => 'post',
											); 
										?>
										<?php echo form_open(base_url().'index.php/Portfolio/Ajax_org_save',$attributes); ?>
										<div class="form-group">
											<label class="col-md-3 control-label" for="profileFirstName">Organization Name</label>
											<div class="col-md-8">
												<input type="text" id="OrgName" name="OrgName" class="form-control" placeholder="Ex: Student Council">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-3 control-label" for="profileFirstName">Short Description</label>
											<div class="col-md-8">
												<input type="text" id="OrgDescription" name="OrgDescription" class="form-control" placeholder="">
											</div>
										</div>
										<br />
										<button class="btn btn-default" href="#" onclick="org_viewall()">Manage Organizations</button>
										<input class="btn btn-success pull-right" type="submit" value="Submit" />
										</form>
									</div>
								</section>

								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
										</div>
										<h5>Volunteer Experience</h5>
									</header>
									<div class="panel-body">
										<div class="form-group">
											<label class="col-md-3 control-label" for="profileFirstName">Organization Name</label>
											<div class="col-md-8">
												<input type="text"  class="form-control" placeholder="Ex: Student Council">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-3 control-label" for="profileFirstName">Short Description</label>
											<div class="col-md-8">
												<input type="text"  class="form-control" placeholder="">
											</div>
										</div>
										<br />
										<input class="btn btn-success pull-right" type="submit" value="Submit" />
									</div>
								</section>
								
								<hr class="dotted tall">

								<h4 class="mb-xlg">Change Password</h4>
								<fieldset class="mb-xl">
									<div class="form-group">
										<label class="col-md-3 control-label" for="profileNewPassword">New Password</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="profileNewPassword">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repeat New Password</label>
										<div class="col-md-8">
											<input type="text" class="form-control" id="profileNewPasswordRepeat">
										</div>
									</div>
								</fieldset>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-9 col-md-offset-3">
											<button type="submit" class="btn btn-primary">Submit</button>
											<button type="reset" class="btn btn-default">Reset</button>
										</div>
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
					<div class="text-right">
						<a class="text-uppercase text-muted" href="#">(View All)</a>
					</div>
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
					<div class="text-right">
						<a class="text-uppercase text-muted" href="<?php echo base_url(); ?>index.php/Assessment">(View All)</a>
					</div>
				<hr class="dotted short">

				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
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



	<!-- Certificate Modal -->
	<div id="Certmanage" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Manage Achievements / Certificates</h4>
					<span class="searchloader">
						<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="20" width="auto">
					</span>
				</div>
				<div class="modal-body row">
					
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
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<!-- /Certificate Modal -->
	

<!-- JS for portfolio page -->
<script>
function PortfolioUrl(){
    //Gets base url
    return $('.content-body').attr('data-base_url');
}
function RefreshActivity(){

	$('#ActivityFeed').fadeOut('fast');
	$.ajax({
		url: PortfolioUrl()+'index.php/Portfolio/Ajax_ActivityFeed_Output',
		success: function(output){
			$('#ActivityFeed').html(output).fadeIn('fast');;
		}
	});

}
function RemoveActivity(ID){
	if(confirm('Are you sure you want to remove this activity?')) {

		$.ajax({
			url: PortfolioUrl()+'index.php/Portfolio/Ajax_Remove_ActivityLog',
			type:'POST',
			data:{'ActivityID':ID},
			success: function(output){
				if(output == 1){

					RefreshActivity();
					
				}else{
					
					alert('An Error occured while trying to remove activity');

				}
			}
		});

	}else{

		return;

	}

}
</script>
<script src="<?php echo base_url(); ?>assets/javascripts/cert_portfolio.js"></script>

<script src="<?php echo base_url(); ?>assets/javascripts/org_portfolio.js"></script>
