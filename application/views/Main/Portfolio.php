<section role="main" class="content-body">
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

						<div class="widget-toggle-expand mb-md">
							<div class="widget-header">
								<h6>Profile Completion</h6>
								<div class="widget-toggle">+</div>
							</div>
							<div class="widget-content-collapsed">
								<div class="progress progress-xs light">
									<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
										60%
									</div>
								</div>
							</div>
							<div class="widget-content-expanded">
								<ul class="simple-todo-list">
									<li class="completed">Update Personal Information</li>
									<li class="completed">Update Joined Organizations</li>
									<li>Update Volunteer Experiences</li>
									<li>Upload Certificates</li>
								</ul>
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
							<a href="#" class="fa fa-times"></a>
						</div>

						<h2 class="panel-title">Achievements</h2>
					</header>
					<div class="panel-body">
						<ul class="simple-post-list">
							<li>
								<div class="post-image">
									<div class="img-thumbnail">
										<a class="lightbox" href="<?php echo base_url(); ?>assets/images/projects/post-thumb-1.jpg" data-plugin-options='{ "type":"image" }'>
											<img src="<?php echo base_url(); ?>assets/images/post-thumb-1.jpg" alt="">
										</a>
									</div>
								</div>
								<div class="post-info">
									<a href="#">Best in Thesis</a>
									<div class="post-meta">
										 Jan 10, 2013
									</div>
								</div>
							</li>
							<li>
								<div class="post-image">
									<div class="img-thumbnail">
										<a class="lightbox" href="<?php echo base_url(); ?>assets/images/projects/post-thumb-1.jpg" data-plugin-options='{ "type":"image" }'>
											<img src="<?php echo base_url(); ?>assets/images/post-thumb-1.jpg" alt="">
										</a>
									</div>
								</div>
								<div class="post-info">
									<a href="#">OJT Certificate</a>
									<div class="post-meta">
										 Jan 10, 2013
									</div>
								</div>
							</li>
							<li>
								<div class="post-image">
									<div class="img-thumbnail">
										<a class="lightbox" href="<?php echo base_url(); ?>assets/images/projects/post-thumb-1.jpg" data-plugin-options='{ "type":"image" }'>
											<img src="<?php echo base_url(); ?>assets/images/post-thumb-1.jpg" alt="">
										</a>
									</div>
								</div>
								<div class="post-info">
									<a href="#">Research Congress</a>
									<div class="post-meta">
										 Jan 10, 2013
									</div>
								</div>
							</li>
						</ul>
						<hr class="dotted short">
						<div class="text-right">
							<a class="text-uppercase text-muted" href="#">(View All)</a>
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
							<ul class="simple-user-list">
								<li>
									<span class="title">ACTS</span>
									<span class="message truncate">Association of Computer Technology Specialists</span>
								</li>
								<li>
									<span class="title">Dominican Soccer Team</span>
								</li>
								<li>
									<span class="title">Tagingtinig</span>
									<span class="message truncate">Dominican Choir</span>
								</li>
								<li>
									<span class="title">Kumbancheros</span>
									<span class="message truncate">Dominican Band</span>
								</li>
							</ul>
							<hr class="dotted short">
							<div class="text-right">
								<a class="text-uppercase text-muted" href="#">(View All)</a>
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
								<div class="tm-body">
									<div class="tm-title">
										<h3 class="h5 text-uppercase">August 2019</h3>
									</div>
									<a class="mb-xlg pull-right" href="<?php echo base_url(); ?>">View All Activities</a>
									<ol class="tm-items">
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Took <u>Programming 101 Long test</u> Assessment.
												</p>
											</div>
										</li>
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Joined Professor Gerard's Programming 101 Online Course
												</p>
											</div>
										</li>
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Uploaded a new Certificate!
												</p>
												<div class="thumbnail-gallery">
													<a class="img-thumbnail lightbox" href="<?php echo base_url(); ?>assets/images/projects/project-4.jpg" data-plugin-options='{ "type":"image" }'>
														<img class="img-responsive" width="215" src="<?php echo base_url(); ?>assets/images/projects/project-4.jpg">
														<span class="zoom">
															<i class="fa fa-search"></i>
														</span>
													</a>
												</div>
											</div>
										</li>
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Took <u>Programming 101 Long test</u> Assessment.
												</p>
											</div>
										</li>
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Joined Professor Gerard's Programming 101 Online Course
												</p>
											</div>
										</li>
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Took <u>Programming 101 Long test</u> Assessment.
												</p>
											</div>
										</li>
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Joined Professor Gerard's Programming 101 Online Course
												</p>
											</div>
										</li>
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Took <u>Programming 101 Long test</u> Assessment.
												</p>
											</div>
										</li>
										<li>
											<div class="tm-box">
												<p class="text-muted mb-none">1 months ago.</p>
												<p>
													Joined Professor Gerard's Programming 101 Online Course
												</p>
											</div>
										</li>

									</ol>
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
											<br />
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

				<h4 class="mb-md">Enrolled Online Courses</h4>
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
					<li>
						<span class="title">Programming 101 Long test</span>
						<span class="message">Gerard Dilla</span>
					</li>
					<li>
						<span class="title">Programming 101 POP QUIZ</span>
						<span class="message">Gerard Dilla</span>
					</li>
					<li>
						<span class="title">Programming 101 Quiz</span>
						<span class="message">Gerard Dilla</span>
					</li>
					<li>
						<span class="title">Programming 101 Seatwork</span>
						<span class="message">Gerard Dilla</span>
					</li>
				</ul>
				<hr class="dotted short">
					<div class="text-right">
						<a class="text-uppercase text-muted" href="#">(View All)</a>
					</div>
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
								<li>
									<span class="title">ACTS</span>
									<span class="message truncate">Association of Computer Technology Specialists</span>
								</li>
								<li>
									<span class="title">Dominican Soccer Team</span>
								</li>
								<li>
									<span class="title">Tagingtinig</span>
									<span class="message truncate">Dominican Choir</span>
								</li>
								<li>
									<span class="title">Kumbancheros</span>
									<span class="message truncate">Dominican Band</span>
								</li>
							</ul>
							<hr class="dotted short">
							<div class="text-right">
								<a class="text-uppercase text-muted" href="#">(View All)</a>
							</div>
						</div>
					</div>
				</section>
				
			</div>

		</div>
		<!-- end: page -->
	</section>
	<script>

	function display_image(file){
		imagelink = (window.URL ? URL : webkitURL).createObjectURL(file.files[0]);
		$('#cert_thumbnail')[0].src = imagelink;
		$('#cert_lightbox').attr("href", imagelink);
	}
	$(document).ready(function(){
			$('#cert_form').submit(function(e){
				e.preventDefault(); 
					$.ajax({
						url: $(this).attr('action'),
						type: $(this).attr('method'),
						data:new FormData(this),
						processData:false,
						contentType:false,
						cache:false,
						async:false,
						success: function(data){

							result = JSON.parse(data);
							if(result['Status'] == 1){

								$('#CertFile').val('');
								$('#CertName').val('');
								$('#cert_thumbnail')[0].src = '<?php echo base_url(); ?>assets/images/cert_icon.png';
								$('#cert_lightbox').attr("href", '<?php echo base_url(); ?>assets/images/cert_icon.png');

								config = {
									'message':result['Message'],
									'type':'success',
									'object':'#certificate_message',
								}
								portfolio_message_handler(config);

							}else{

								config = {
									'message':result['Message'],
									'type':'info',
									'object':'#certificate_message',
								}
								portfolio_message_handler(config);
								
							}
							console.log(data);
							
						}
					});
				});
		});

	function portfolio_message_handler(settings){

		console.log(settings);
		if(length.settings == 0 || settings == undefined){
			settings = {
				'type':'warning',
				'message':'',
				'object':'.message_box',
			};
		}else{
			if(settings.type == ''){
				settings['type'] = 'info';
			}
			if(settings.message == ''){
				settings['message'] = '';
				console.log('No Message provided for message_handler');
			}
			if(settings.object == ''){
				settings['object'] = '.message_box';
			}
		}

		var box = '';
		box += '<div class="alert alert-'+settings.type+'">';
		box += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
		box += settings.message;
		box += '</div>';
		$(settings.object).html(box);

	}

	</script>
