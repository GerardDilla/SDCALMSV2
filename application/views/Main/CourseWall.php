<section role="main" class="content-body" data-base_url='<?php echo base_url(); ?>'>
		<header class="page-header">
			
			<h2><?php echo $this->data['SchedData'][0]['Instructor_Name']; ?>'s Class <i class="fa fa-book"></i></h2>
		
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


						<hr class="dotted short">

						<h6 class="text-muted">About</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis vulputate quam. Interdum et malesuada</p>

						<hr class="dotted short">
						<h6 class="text-muted">Email</h6>
						<p style="color:green"></p>

						<hr class="dotted short">
						<h6 class="text-muted">Course</h6>
						<p style="color:green"></p>


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
							
							</ul>
						</div>
					</div>
				</section>
			</div>
			<div class="col-md-8 col-lg-6">
				<div class="timeline">
					<div class="tm-body">

						<!--Post space-->
						<ol class="tm-items">
							<li>
								<div class="tm-info">
									<section class="simple-compose-box mb-xlg">
										<form method="get" action="/">
											<textarea name="message-text" data-plugin-textarea-autosize="" placeholder="What's on your mind?" rows="5" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;"></textarea>
										</form>
										<div class="compose-box-footer">
											<ul class="compose-toolbar">
												<li>
													<a href="#"><i class="fa fa-camera"></i></a>
												</li>
												<li>
													<a href="#"><i class="fa fa-map-marker"></i></a>
												</li>
											</ul>
											<ul class="compose-btn">
												<li>
													<a class="btn btn-primary btn-md">Post</a>
												</li>
											</ul>
										</div>
									</section>
								</div>
							</li>
						</ol>
						<!--Post space-->

						<div class="tm-title">
							<h3 class="h5 text-uppercase">November 2013</h3>
						</div>
						<ol class="tm-items">
							<li>
								<div class="tm-info">
									<div class="tm-icon"><i class="fa fa-star"></i></div>
								</div>
								<div class="tm-box appear-animation" data-appear-animation="fadeInRight"data-appear-animation-delay="100">
									<p>
										It's awesome when we find a good solution for our projects, Porto Admin is <span class="text-primary">#awesome</span>
									</p>
									<div class="tm-meta">
										<span>
											<i class="fa fa-user"></i> By <a href="#">John Doe</a>
										</span>
										<span>
											<i class="fa fa-tag"></i> <a href="#">Porto</a>, <a href="#">Awesome</a>
										</span>
										<span>
											<i class="fa fa-comments"></i> <a href="#">5652 Comments</a>
										</span>
									</div>
								</div>
							</li>
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
						</ol>
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
										<a class="img-thumbnail" href="assets/images/projects/project-4.jpg">
											<img width="215" src="assets/images/projects/project-4.jpg">
											<span class="zoom">
												<i class="fa fa-search"></i>
											</span>
										</a>
										<a class="img-thumbnail" href="assets/images/projects/project-3.jpg">
											<img width="215" src="assets/images/projects/project-3.jpg">
											<span class="zoom">
												<i class="fa fa-search"></i>
											</span>
										</a>
										<a class="img-thumbnail" href="assets/images/projects/project-2.jpg">
											<img width="215" src="assets/images/projects/project-2.jpg">
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
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-3">
				<section class="panel">
					<div class="panel-body">


						<hr class="dotted short">

						<h6 class="text-muted">About</h6>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis vulputate quam. Interdum et malesuada</p>

						<hr class="dotted short">
						<h6 class="text-muted">Email</h6>
						<p style="color:green"></p>

						<hr class="dotted short">
						<h6 class="text-muted">Course</h6>
						<p style="color:green"></p>


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
							
							</ul>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- end: page -->
	</section>

