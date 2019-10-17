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

								<div class="row">
									<div class="col-md-12">
									<h2>My Files</h2>
									</div>
								</div>
								<hr>
								<div class="sidebar-widget m-none">
									<div class="widget-header clearfix">
										<h6 class="title pull-left mt-xs">Folders</h6>
										<div class="pull-right">
											<!--<a href="#" class="btn btn-dark btn-sm btn-widget-act">Add Folder</a>-->
										</div>
									</div>
									<div class="widget-content">
										<ul class="mg-folders">

											<li id="parent-folder" data-folder-id="0" data-folder-name="All Files">
												<a href="#" class="menu-item"><i class="fa fa-folder"></i> All Files</a>
												<div class="item-options">
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
										<h6 class="title">Allowed Files</h6>
										<span class="widget-toggle">+</span>
									</div>
									<div class="widget-content">
										<ul class="mg-tags">
											<li><a href="#">PDF</a></li>
											<li><a href="#">DOCX</a></li>
											<li><a href="#">XLS</a></li>
											<li><a href="#">JPG</a></li>
											<li><a href="#">PNG</a></li>
											<li><a href="#">MP4</a></li>
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
								<a disabled href="#" id="mgSelectAll"><i class="fa fa-check-square"></i> <span data-all-text="Select All" data-none-text="Select None">Select All</span></a>
							</li>
							<li>
								<a disabled href="#"><i class="fa fa-pencil"></i> Edit</a>
							</li>
							<li>
								<a disabled href="#"><i class="fa fa-trash-o"></i> Delete</a>
							</li>
						</ul>
					</div>
					<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">

						<div class="col-md-2">
							<h2 class="folder-directory"></h2> 
						</div>
						<div class="col-md-2">
							<a class="btn btn-block btn-primary btn-md pt-sm pb-sm text-md uploadbutton" style="margin-top: 15px;">
								<i class="fa fa-upload mr-xs"></i>
								Upload File
							</a>
						</div>
						<div class="col-md-12">
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


	<!-- Upload File Modal -->
	<div id="UploadFileModal" class="modal fade" role="dialog">
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
						<label class="col-md-3 control-label" for="profileFirstName">Upload File(JPG/PNG)</label>
						<div class="col-md-8">
							<?php 
								$attributes = array(
									'id' => 'upload_form',
									'method' => 'post',
								); 
							?>
							<?php echo form_open_multipart(base_url().'index.php/API/FileManagerAPI',$attributes); ?>

								<input type="hidden" name="Command" value="file_upload" />
								<input type="hidden" class="instructor_id_token" name="InstructorID" value="" />
								<input type="hidden" class="folder_id_upload" name="FolderID" value="0" />

								<input type="text" name="FileName" class="form-control assessment_required_input" placeholder="Enter File Name">

								<input class="btn btn-info form-control"  type="file" id="UploadFile" name="CertFile" size="20" onchange="display_image(this)" />
								<hr>
								<button type="submit" class="btn btn-sm btn-success">Upload</button>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- /Upload File Modal -->

	<script>
		//Initially hides sidebar
		$(document).ready(function(){
			$('.custom-scroll').addClass('sidebar-left-collapsed');
			$('.instructor_id_token').val(user_token());
		});
		function FileAPI_URL(){
			return '<?php echo base_url(); ?>index.php/API/FileManagerAPI';
		}
		function user_token(){

			return '<?php echo $this->data['InstructorID']; ?>';
			
		}
	</script>
	<script src="<?php echo base_url(); ?>assets/api_handler/filemanager_handler.js"></script>