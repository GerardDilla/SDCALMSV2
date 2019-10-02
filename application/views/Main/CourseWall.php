<section role="main" class="content-body" id="CourseWall" data-base_url='<?php echo base_url(); ?>' data-usertype="<?php echo $this->data['Usertype']; ?>" data-usertoken="<?php echo $this->data['Usertoken']; ?>">
		<header class="page-header">
			
			<h2><i class="fa fa-book"></i> <?php echo $this->data['SchedData'][0]['Course_Code']; ?> : <?php echo $this->data['SchedData'][0]['Sched_Code']; ?></h2>
		
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

		<!--General Class info-->
		<div class="row">

		</div>
		<!--//General Class info-->

		<!--Class Feed-->
		<div class="row flex-column-reverse flex-md-row">
			<div class="col-sm-8 col-lg-8 order-2">
					<h1>Welcome to your Class!</h1>
					<hr>
					<div class="tm-info">
							<section class="simple-compose-box mb-xlg">
								<form method="post" action="">
									<textarea name="Post" data-plugin-textarea-autosize="" placeholder="What's on your mind?" rows="5" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;"></textarea>
									<div class="compose-box-footer " style="padding:10px 25px 10px 25px">
										<div class="row" id="Attachment_Queue">

										</div>
									</div>
									<div class="compose-box-footer">
										<ul class="compose-toolbar">
											<li>
												<a href="#" id="AssessmentAttach"><i class="fa fa-file-text-o"></i></a>
											</li>
											<li>
												<a disabled href="#"><i class="fa fa-camera"></i></a>
											</li>
											<li>
												<a disabled href="#"><i class="fa fa-map-marker"></i></a>
											</li>
										</ul>
										<ul class="compose-btn">
											<li>
												<button type="submit" class="btn btn-primary btn-md">Post</button>
											</li>
										</ul>
									</div>
								</form>
							</section>
						</div>
					<div class="timeline">
					<div class="tm-body">

						<?php if(!$this->data['CourseFeed']['Months']): ?>

							<div class="tm-title">
								<h3 class="h5 text-uppercase">No posts yet</h3>
							</div>
						
						<?php else: ?>

							<?php foreach($this->data['CourseFeed']['Months'] as $month): ?>
								<div class="tm-title">
									<h3 class="h5 text-uppercase"><?php echo $month; ?></h3>
								</div>
								<ol class="tm-items">
									<?php foreach($this->data['CourseFeed']['Posts'][$month] as $post): ?>
										<li>
											<?php echo $post; ?>
										</li>
									<?php endForeach; ?>
								</ol>
							<?php endForeach; ?>

						<?php endIf; ?>

						<!--
							<li>
								<div class="tm-info">
									<div class="tm-icon"><i class="fa fa-thumbs-up"></i></div>
									<time class="tm-datetime" datetime="2013-11-19 18:13">
										<div class="tm-datetime-date">7 months ago.</div>
										<div class="tm-datetime-time">06:13 PM</div>
									</time>
								</div>
								<div class="tm-box appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="250">
									<p>
										What is your biggest developer pain point?
									</p>
								</div>
							</li>
							<li>
								<div class="tm-info">
									<div class="tm-icon"><i class="fa fa-map-marker"></i></div>
									<time class="tm-datetime" datetime="2013-11-14 17:25">
										<div class="tm-datetime-date">7 months ago.</div>
										<div class="tm-datetime-time">05:25 PM</div>
									</time>
								</div>
								<div class="tm-box appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="400">
									<p>
										<a href="#">John Doe</a> is reading a book at <span class="text-primary">New York Public Library</span>
									</p>
									<blockquote class="primary">
										<p>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning.</p>
										<small>A. Einstein,
											<cite title="Brainyquote">Brainyquote</cite>
										</small>
									</blockquote>
									<div id="gmap-checkin-example" class="mb-sm" style="height: 250px; width: 100%;"></div>
									<div class="tm-meta">
										<span>
											<i class="fa fa-user"></i> By <a href="#">John Doe</a>
										</span>
										<span>
											<i class="fa fa-comments"></i> <a href="#">9 Comments</a>
										</span>
									</div>
								</div>
							</li>
						-->
						<!--
							<div class="tm-title">
								<h3 class="h5 text-uppercase">September 2013</h3>
							</div>
							<ol class="tm-items">
								<li>
									<div class="tm-info">
										<div class="tm-icon"><i class="fa fa-heart"></i></div>
										<time class="tm-datetime" datetime="2013-09-08 16:13">
											<div class="tm-datetime-date">9 months ago.</div>
											<div class="tm-datetime-time">04:13 PM</div>
										</time>
									</div>
									<div class="tm-box appear-animation" data-appear-animation="fadeInRight">
										<p>
											Checkout! How cool is that!
										</p>
										<div class="thumbnail-gallery">
											<a class="img-thumbnail" href="<?php echo base_url(); ?>personaldata/Profilepicture/default.png">
												<img width="215" src="<?php echo base_url(); ?>personaldata/Profilepicture/default.png">
												<span class="zoom">
													<i class="fa fa-search"></i>
												</span>
											</a>
											<a class="img-thumbnail" href="<?php echo base_url(); ?>personaldata/Profilepicture/default.png">
												<img width="215" src="<?php echo base_url(); ?>personaldata/Profilepicture/default.png">
												<span class="zoom">
													<i class="fa fa-search"></i>
												</span>
											</a>
											<a class="img-thumbnail" href="<?php echo base_url(); ?>personaldata/Profilepicture/default.pngg">
												<img width="215" src="<?php echo base_url(); ?>personaldata/Profilepicture/default.png">
												<span class="zoom">
													<i class="fa fa-search"></i>
												</span>
											</a>
										</div>
										<div class="tm-meta">
											<span>
												<i class="fa fa-user"></i> By <a href="#">John Doe</a>
											</span>
											<span>
												<i class="fa fa-tag"></i> <a href="#">Duis</a>, <a href="#">News</a>
											</span>
											<span>
												<i class="fa fa-comments"></i> <a href="#">12 Comments</a>
											</span>
										</div>
									</div>
								</li>
								<li>
									<div class="tm-info">
										<div class="tm-icon"><i class="fa fa-video-camera"></i></div>
										<time class="tm-datetime" datetime="2013-09-08 11:26">
											<div class="tm-datetime-date">9 months ago.</div>
											<div class="tm-datetime-time">11:26 AM</div>
										</time>
									</div>
									<div class="tm-box appear-animation" data-appear-animation="fadeInRight">
										<p>
											Google Fonts gives you access to over 600 web fonts!
										</p>
										<div class="embed-responsive embed-responsive-16by9">
											<iframe class="embed-responsive-item" src="//player.vimeo.com/video/67957799"></iframe>
										</div>
										<div class="tm-meta">
											<span>
												<i class="fa fa-user"></i> By <a href="#">John Doe</a>
											</span>
											<span>
												<i class="fa fa-thumbs-up"></i> 122 Likes
											</span>
											<span>
												<i class="fa fa-comments"></i> <a href="#">3 Comments</a>
											</span>
										</div>
									</div>
								</li>
							</ol>
						-->
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-lg-4 col-sm-12" >
				<section class="panel panel-group">
					<header class="panel-heading bg-primary">

						<div class="widget-profile-info">
							<div class="profile-picture">
								<img src="<?php echo base_url(); ?>personaldata/Profilepicture/default.png">
							</div>
							<div class="profile-info">
								<h4 class="name text-semibold"><?php echo $this->data['SchedData'][0]['Course_Title']; ?></h4>
								<h5 class="role"><?php echo $this->data['SchedData'][0]['Instructor_Name']; ?></h5>
								<div class="profile-footer">
								</div>
							</div>
						</div>

					</header>
					<div id="accordion">
						<div class="panel panel-accordion panel-accordion-first">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse1One" aria-expanded="false">
										<i class="fa fa-check"></i> Assessments
									</a>
								</h4>
							</div>
							<div id="collapse1One" class="accordion-body collapse" aria-expanded="false" style="height: 0px;">
								<div class="panel-body">
									<ul class="widget-todo-list ui-sortable">
										<li>
											<div class="checkbox-custom checkbox-default">
												<input type="checkbox" checked="" id="todoListItem1" class="todo-check">
												<label class="todo-label line-through" for="todoListItem1"><span>Lorem ipsum dolor sit amet</span></label>
											</div>
											<div class="todo-actions">
												<a class="todo-remove" href="#">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</li>
										<li>
											<div class="checkbox-custom checkbox-default">
												<input type="checkbox" id="todoListItem2" class="todo-check">
												<label class="todo-label" for="todoListItem2"><span>Lorem ipsum dolor sit amet</span></label>
											</div>
											<div class="todo-actions">
												<a class="todo-remove" href="#">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</li>
										<li>
											<div class="checkbox-custom checkbox-default">
												<input type="checkbox" id="todoListItem3" class="todo-check">
												<label class="todo-label" for="todoListItem3"><span>Lorem ipsum dolor sit amet</span></label>
											</div>
											<div class="todo-actions">
												<a class="todo-remove" href="#">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="panel panel-accordion panel-accordion-first">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#assignmentcollapse" aria-expanded="false">
										<i class="fa fa-check"></i> Assignments
									</a>
								</h4>
							</div>
							<div id="assignmentcollapse" class="accordion-body collapse" aria-expanded="false" style="height: 0px;">
								<div class="panel-body">
									<ul class="widget-todo-list ui-sortable">
										<li>
											<div class="checkbox-custom checkbox-default">
												<input type="checkbox" checked="" id="todoListItem1" class="todo-check">
												<label class="todo-label line-through" for="todoListItem1"><span>Lorem ipsum dolor sit amet</span></label>
											</div>
											<div class="todo-actions">
												<a class="todo-remove" href="#">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</li>
										<li>
											<div class="checkbox-custom checkbox-default">
												<input type="checkbox" id="todoListItem2" class="todo-check">
												<label class="todo-label" for="todoListItem2"><span>Lorem ipsum dolor sit amet</span></label>
											</div>
											<div class="todo-actions">
												<a class="todo-remove" href="#">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</li>
										<li>
											<div class="checkbox-custom checkbox-default">
												<input type="checkbox" id="todoListItem3" class="todo-check">
												<label class="todo-label" for="todoListItem3"><span>Lorem ipsum dolor sit amet</span></label>
											</div>
											<div class="todo-actions">
												<a class="todo-remove" href="#">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!--//Class Feed-->
		<!-- end: page -->
	</section>


	<!-- Assessment Attachment Modal -->
	<div id="AssessmentAttachmentModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Attach an Assessment
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
					<div class="col-md-12">
						<div class="message_box"></div>
						<br>
						<div class="table-responsive col-md-12">
							<table class="table mb-none">
							    <thead>
									<tr>
										<th>Date</th>
										<th>Assessment Name</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="assessment_attachment_picker">
									<tr>
										<th></th>
										<th></th>
									</tr>
								</tbody>
							</table>
						</div>
					</div>		
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /Assessment Attachment Modal -->

	<script>
	function base_url(){
		return '<?php echo base_url(); ?>';
	}
	</script>
	<script src="<?php echo base_url(); ?>assets/javascripts/courseware.js"></script>