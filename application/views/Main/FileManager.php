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

											<li data-folder-id="all" data-folder-name="My Files">
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> My Files</a>
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
										<ul class="mg-folders side-folders">

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

						<div class="col-md-12">
							<h2 class="folder-directory"></h2> 
							<hr>
						</div>

						<div class="storage-files">

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
					<h4 class="modal-title">Add new Folder
						<span class="searchloader">
							<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="20" width="auto">
						</span>
					</h4>
				</div>
				<div class="modal-body row">
					<div class="form-group">
						<div class="message_box"></div>
						<div class="col-md-8">
							<input type="text"  class="form-control" id="add_folder_input" autofocus placeholder="Folder Name">
						</div>
						<button style="height:34px" class="col-md-3 btn btn-sm btn-default" id="add_folder_button">Add Folder</button>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- /Assessment Attachment Modal -->

	<script>
		//Initially hides sidebar
		$(document).ready(function(){
			$('.custom-scroll').addClass('sidebar-left-collapsed');
		});
		function FileAPI_URL(){
			return '<?php echo base_url(); ?>index.php/API/FileManagerAPI';
		}
		function user_token(){

			return '<?php echo $this->data['InstructorID']; ?>';
			
		}
	</script>
	<script src="<?php echo base_url(); ?>assets/api_handler/filemanager_handler.js"></script>