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

			<!-- Primary info--->
			<div class="col-md-4 col-lg-3">

				<section class="panel">
					<div class="panel-body">
						<div class="thumb-info mb-md">
							<img src="<?php echo base_url(); ?>personaldata/Profilepicture/default.png" class="rounded img-responsive" alt="John Doe">
							<div class="thumb-info-title">
								<span class="thumb-info-inner"><?php echo $this->user_data['Full_Name']; ?></span>
								<span class="thumb-info-type"><?php echo $this->user_data['Student_Number']; ?></span>
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
						<p style="color:green"><?php echo $this->user_data['Email']; ?></p>

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
											<a class="lightbox" href="#">
												<img class="cert_img preview-image" src="<?php echo base_url(); ?>personaldata/Certificates/<?php echo $row['Certificate'].''.$row['Extension'] ?>" alt="">
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
			<!-- //Primary info--->

			<!-- Edit Panel / Activity panel --->
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
						<div id="edit" class="tab-pane panel-group">

								<div class="panel panel-accordion panel-accordion-primary">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Two" aria-expanded="true">
												<i class="fa fa-cogs"></i> Personal Information
											</a>
										</h4>
									</div>
									<div id="collapse2Two" class="accordion-body collapse in" aria-expanded="true" style="">
										<div class="panel-body">

											<h4 class="mb-xlg">About Yourself</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileBio">Personal Info</label>
													<div class="col-md-8">
														<textarea class="form-control" rows="3" id="profileBio"></textarea>
													</div>
												</div>
											</fieldset>
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-default pull-right">Submit</button>
													</div>
												</div>
											</div>

											<hr class="dotted tall">
											<h4 class="mb-xlg">Change Email</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">Current Email</label>
													<div class="col-md-8">
														<input type="readonly" disabled class="form-control" value="<?php echo $this->user_data['Email']; ?>">
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
											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary pull-right">Confirm</button>
													</div>
												</div>
											</div>

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
														<button type="submit" class="btn btn-primary pull-right">Confirm</button>
													</div>
												</div>
											</div>

											<br>
										</div>
									</div>
								</div>

								<hr class="dotted tall">

								<div class="panel panel-accordion panel-accordion-primary">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#portfolio_collapse" aria-expanded="true">
												<i class="fa fa-cogs"></i> Portfolio Management
												<span class="searchloader">
													<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
												</span>
											</a>
										</h4>
									</div>
									<div id="portfolio_collapse" class="accordion-body collapse in" aria-expanded="true" style="">
										<div class="panel-body">

											<!-- Acheivement Panel -->
											<section class="panel">
												<h4>Upload an Achievement</h4>
												<div class="panel-body">
													<div id="certificate_message"></div>
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
															<a class="img-thumbnail" id="cert_lightbox">
																<img class="img-responsive preview-image" id="cert_thumbnail" width="200" src="<?php echo base_url(); ?>assets/images/cert_icon.png">
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
											<!-- //Acheivement Panel -->

											<!-- Organization Panel -->
											<section class="panel">
												<h4>Organizations</h4>
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
														<button type="button" class="btn btn-default" href="#" id="OrgManagerShow">Manage Organizations</button>
														<input class="btn btn-success pull-right" type="submit" value="Submit" />
													</form>
												</div>
											</section>
											<!-- //Organization Panel -->

											<!-- Experience Panel -->
											<section class="panel">
												<h4>Volunteer Experience</h4>
												<div class="panel-body">

													<div id="Experience_message"></div>
													<?php 
														$attributes = array(
															'id' => 'exp_form',
															'method' => 'post',
														); 
													?>
													<?php echo form_open(base_url().'index.php/Portfolio/Ajax_exp_save',$attributes); ?>
														<div class="form-group">
															<label class="col-md-3 control-label" for="profileFirstName">Volunteer Experience</label>
															<div class="col-md-8">
																<input type="text" name="ExpName" id="ExpName" class="form-control" placeholder="Ex: Mangrove Planting">
															</div>
														</div>
														
														<div class="form-group">
															<label class="col-md-3 control-label" for="profileFirstName">Short Description</label>
															<div class="col-md-8">
																<input type="text" name="ExpDesc" id="ExpDesc" class="form-control" placeholder="">
															</div>
														</div>
														<br />
														<button type="button" class="btn btn-default" href="#" id="ExpManagerShow">Manage Experiences</button>
														<input class="btn btn-success pull-right" type="submit" value="Submit" />
													</form>
												</div>
											</section>
											<!-- //Experience Panel -->

										</div>
									</div>
								</div>

								
						</div>
					</div>
				</div>
			</div>
			<!-- //Edit Panel / Activity panel --->

			<!-- Additional info-->
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
							<ul class="simple-user-list" id="ExpSummary">
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
			<!-- //Additional info-->

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

	<!-- Organization Modal -->
	<div id="Orgmanage" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:1000px">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Manage Organizations
						<span class="searchloader">
							<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="20" width="auto">
						</span>
					</h4>
				</div>
				<div class="modal-body row">
					
					<div class="form-group">
						<div class="col-md-7">
							<input type="text"  class="form-control" id="org_manager_search" autofocus placeholder="Search with Title..">
						</div>
						<button style="height:34px" class="col-md-1 btn btn-sm btn-default" id="Orgsearch"><i class="fa fa-search"></i></button>
					</div>
					<div class="col-md-8" style="border-right: solid #cc0000 thick">
						<div class="message_box"></div>
						<br>
						<div class="table-responsive col-md-12">
							<table class="table mb-none">
							    <thead>
									<tr>
										<th>Date</th>
										<th>Organization</th>
										<th>Short Description</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="org_manager">
								</tbody>
							</table>
						</div>
					</div>										
					<form class="col-md-4 pull-left" action="<?php echo base_url(); ?>index.php/Portfolio/Ajax_org_update" method="post" id="Org_Editpanel">
					
						<h3>Edit Organization</h3>
						<br>
						<input type="hidden" name="OrgId" id="OrgId" value="">
						<input type="text" class="form-control" id="OrganizationNameEdit" name="OrganizationNameEdit" placeholder="Organization Name">
						<br>
						<input type="text" class="form-control" id="OrganizationDescEdit" name="OrganizationDescEdit" placeholder="Organization Short Description">
						<hr>
						<button type="button" class="org-remove-button btn btn-danger" value="">Remove</button>
						<button type="submit" class="btn btn-primary pull-right">Update</button>

					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<!-- /Certificate Modal -->

	<!-- Experience Modal -->
	<div id="Expmanage" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:1000px">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Manage Experiences
						<span class="searchloader">
							<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="20" width="auto">
						</span>
					</h4>
				</div>
				<div class="modal-body row">
					
					<div class="form-group">
						<div class="col-md-7">
							<input type="text"  class="form-control" id="exp_manager_search" autofocus placeholder="Search with Title..">
						</div>
						<button style="height:34px" class="col-md-1 btn btn-sm btn-default" id="Expsearch"><i class="fa fa-search"></i></button>
					</div>
					<div class="col-md-8" style="border-right: solid #cc0000 thick">
						<div class="message_box"></div>
						<br>
						<div class="table-responsive col-md-12">
							<table class="table mb-none">
							    <thead>
									<tr>
										<th>Date</th>
										<th>Exprience</th>
										<th>Short Description</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="exp_manager">
								</tbody>
							</table>
						</div>
					</div>										
					<form class="col-md-4 pull-left" action="<?php echo base_url(); ?>index.php/Portfolio/Ajax_exp_update" method="post" id="Exp_Editpanel">
					
						<h3>Edit Experience</h3>
						<br>
						<input type="hidden" name="ExpId" id="ExpId" value="">
						<input type="text" class="form-control" id="ExpNameEdit" name="ExpNameEdit" placeholder="Experience Name">
						<br>
						<input type="text" class="form-control" id="ExpDescEdit" name="ExpDescEdit" placeholder="Short Description">
						<hr>
						<button type="button" class="exp-remove-button btn btn-danger" value="">Remove</button>
						<button type="submit" class="btn btn-primary pull-right">Update</button>

					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Experience Modal -->

	<!-- Photopreview Modal -->
	<div id="PhotoPreview" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width:1000px">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body row" style="padding:0px">
					<img id="Photopanel" src="" height="auto" width="100%">
				</div>
			</div>
		</div>
	</div>
	<!-- /Photopreview Modal -->
	

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
	$(document).ready(function(){

		//Dynamic images
		$('#AchievementSummary').on('click', '.preview-image', function() {
			image = $(this).attr('src');
			$('#PhotoPreview').modal('show');
			$('#Photopanel').attr('src',image);
		});

		//Non dynamic images
		$('.preview-image').click(function() {

			image = $(this).attr('src');
			$('#PhotoPreview').modal('show');
			$('#Photopanel').attr('src',image);

		});

		//Cert uploader
		$('#cert_lightbox').on('click', '.preview-image', function() {

			image = $(this).attr('src');
			$('#PhotoPreview').modal('show');
			$('#Photopanel').attr('src',image);

		});
		

	});
</script>


<script src="<?php echo base_url(); ?>assets/javascripts/cert_portfolio.js"></script>

<script src="<?php echo base_url(); ?>assets/javascripts/org_portfolio.js"></script>

<script src="<?php echo base_url(); ?>assets/javascripts/exp_portfolio.js"></script>
