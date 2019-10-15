<section role="main" class="content-body" id="CourseWall" data-base_url='<?php echo base_url(); ?>' data-usertype="<?php //echo $this->data['Usertype']; ?>" data-usertoken="<?php //echo $this->data['Usertoken']; ?>">
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
					<li><span>File Manager</span>
					 
					</li>
				</ol>
			</div>
		</header>
		<div id="particles-js"></div>

		<!-- start: page -->
		<section class="content-with-menu content-with-menu-has-toolbar media-gallery">
			<div class="content-with-menu-container">
				<div class="inner-menu-toggle">
					<a href="#" class="inner-menu-expand" data-open="inner-menu">
						Show Bar <i class="fa fa-chevron-right"></i>
					</a>
				</div>
				
				<menu id="content-menu" class="inner-menu" role="menu">
					<div class="nano">
						<div class="nano-content">
				
							<div class="inner-menu-toggle-inside">
								<a href="#" class="inner-menu-collapse">
									<i class="fa fa-chevron-up visible-xs-inline"></i><i class="fa fa-chevron-left hidden-xs-inline"></i> Hide Bar
								</a>
								<a href="#" class="inner-menu-expand" data-open="inner-menu">
									Show Bar <i class="fa fa-chevron-down"></i>
								</a>
							</div>
				
							<div class="inner-menu-content">
				
								<a class="btn btn-block btn-primary btn-md pt-sm pb-sm text-md">
									<i class="fa fa-upload mr-xs"></i>
									Upload Files
								</a>
				
								<hr class="separator" />
				
								<div class="sidebar-widget m-none">
									<div class="widget-header clearfix">
										<h6 class="title pull-left mt-xs">Folders</h6>
										<div class="pull-right">
											<a href="#" class="btn btn-dark btn-sm btn-widget-act">Add Folder</a>
										</div>
									</div>
									<div class="widget-content">
										<ul class="mg-folders">
											<li>
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> My Documents</a>
												<div class="item-options">
													<a href="#">
														<i class="fa fa-edit"></i>
													</a>
													<a href="#" class="text-danger">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</li>
											<li>
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> Templates</a>
												<div class="item-options">
													<a href="#">
														<i class="fa fa-edit"></i>
													</a>
													<a href="#" class="text-danger">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</li>
											<li>
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> Design</a>
												<div class="item-options">
													<a href="#">
														<i class="fa fa-edit"></i>
													</a>
													<a href="#" class="text-danger">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</li>
											<li>
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> PSDs</a>
												<div class="item-options">
													<a href="#">
														<i class="fa fa-edit"></i>
													</a>
													<a href="#" class="text-danger">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</li>
											<li>
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> Downloads</a>
												<div class="item-options">
													<a href="#">
														<i class="fa fa-edit"></i>
													</a>
													<a href="#" class="text-danger">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</li>
											<li>
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> Photos</a>
												<div class="item-options">
													<a href="#">
														<i class="fa fa-edit"></i>
													</a>
													<a href="#" class="text-danger">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</li>
											<li>
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> Projects</a>
												<div class="item-options">
													<a href="#">
														<i class="fa fa-edit"></i>
													</a>
													<a href="#" class="text-danger">
														<i class="fa fa-times"></i>
													</a>
												</div>
											</li>
										</ul>
									</div>
								</div>
				
								<hr class="separator" />
				
								<div class="sidebar-widget m-none">
									<div class="widget-header">
										<h6 class="title">Labels</h6>
										<span class="widget-toggle">+</span>
									</div>
									<div class="widget-content">
										<ul class="mg-tags">
											<li><a href="#">Design</a></li>
											<li><a href="#">Projects</a></li>
											<li><a href="#">Photos</a></li>
											<li><a href="#">Websites</a></li>
											<li><a href="#">Documentation</a></li>
											<li><a href="#">Download</a></li>
											<li><a href="#">Images</a></li>
											<li><a href="#">Vacation</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</menu>
				<div class="inner-body mg-main">
				
					<div class="inner-toolbar clearfix">
						<ul>
							<li>
								<a href="#" id="mgSelectAll"><i class="fa fa-check-square"></i> <span data-all-text="Select All" data-none-text="Select None">Select All</span></a>
							</li>
							<li>
								<a href="#"><i class="fa fa-pencil"></i> Edit</a>
							</li>
							<li>
								<a href="#"><i class="fa fa-trash-o"></i> Delete</a>
							</li>
							<li class="right" data-sort-source data-sort-id="media-gallery">
								<ul class="nav nav-pills nav-pills-primary">
									<li>
										<label>Filter:</label>
									</li>
									<li class="active">
										<a data-option-value="*" href="#all">All</a>
									</li>
									<li>
										<a data-option-value=".document" href="#document">Documents</a>
									</li>
									<li>
										<a data-option-value=".image" href="#image">Images</a>
									</li>
									<li>
										<a data-option-value=".video" href="#video">Videos</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">

						<div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
							<div class="thumbnail">
								<div class="thumb-preview">
									<header class="panel-heading bg-white">
										<div class="panel-heading-icon bg-primary mt-sm">
											<i class="fa fa-rocket"></i>
										</div>
									</header>
									<div class="mg-thumb-options">
										<div class="mg-zoom"><i class="fa fa-search"></i></div>
										<div class="mg-toolbar">
											<div class="mg-option checkbox-custom checkbox-inline">
												<input type="checkbox" id="file_1" value="1">
												<label for="file_1">SELECT</label>
											</div>
											<div class="mg-group pull-right">
												<a href="#">EDIT</a>
												<button class="dropdown-toggle mg-toggle" type="button" data-toggle="dropdown">
													<i class="fa fa-caret-up"></i>
												</button>
												<ul class="dropdown-menu mg-menu" role="menu">
													<li><a href="#"><i class="fa fa-download"></i> Download</a></li>
													<li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<h5 class="mg-title text-semibold">SEO<small>.png</small></h5>
								<div class="mg-description">
									<small class="pull-left text-muted">Design, Websites</small>
									<small class="pull-right text-muted">07/10/2014</small>
								</div>
							</div>
						</div>
						<div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
							<div class="thumbnail">
								<div class="thumb-preview">
									<header class="panel-heading bg-white">
										<div class="panel-heading-icon bg-primary mt-sm">
											<i class="fa fa-rocket"></i>
										</div>
									</header>
									<div class="mg-thumb-options">
										<div class="mg-zoom"><i class="fa fa-search"></i></div>
										<div class="mg-toolbar">
											<div class="mg-option checkbox-custom checkbox-inline">
												<input type="checkbox" id="file_1" value="1">
												<label for="file_1">SELECT</label>
											</div>
											<div class="mg-group pull-right">
												<a href="#">EDIT</a>
												<button class="dropdown-toggle mg-toggle" type="button" data-toggle="dropdown">
													<i class="fa fa-caret-up"></i>
												</button>
												<ul class="dropdown-menu mg-menu" role="menu">
													<li><a href="#"><i class="fa fa-download"></i> Download</a></li>
													<li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<h5 class="mg-title text-semibold">SEO<small>.png</small></h5>
								<div class="mg-description">
									<small class="pull-left text-muted">Design, Websites</small>
									<small class="pull-right text-muted">07/10/2014</small>
								</div>
							</div>
						</div>
						<div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
							<div class="thumbnail">
								<div class="thumb-preview">
									<header class="panel-heading bg-white">
										<div class="panel-heading-icon bg-primary mt-sm">
											<i class="fa fa-rocket"></i>
										</div>
									</header>
									<div class="mg-thumb-options">
										<div class="mg-zoom"><i class="fa fa-search"></i></div>
										<div class="mg-toolbar">
											<div class="mg-option checkbox-custom checkbox-inline">
												<input type="checkbox" id="file_1" value="1">
												<label for="file_1">SELECT</label>
											</div>
											<div class="mg-group pull-right">
												<a href="#">EDIT</a>
												<button class="dropdown-toggle mg-toggle" type="button" data-toggle="dropdown">
													<i class="fa fa-caret-up"></i>
												</button>
												<ul class="dropdown-menu mg-menu" role="menu">
													<li><a href="#"><i class="fa fa-download"></i> Download</a></li>
													<li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<h5 class="mg-title text-semibold">SEO<small>.png</small></h5>
								<div class="mg-description">
									<small class="pull-left text-muted">Design, Websites</small>
									<small class="pull-right text-muted">07/10/2014</small>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</section>
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
		$(document).ready(function(){
			$('.custom-scroll').addClass('sidebar-left-collapsed');
		});
	</script>
	<script src="<?php echo base_url(); ?>assets/javascripts/courseware.js"></script>