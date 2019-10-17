<div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
	<div class="thumbnail">
		<div class="thumb-preview">
			<a class="thumb-image" href="assets/images/projects/project-1.jpg" style="max-width:136px">
				<img src="<?php echo base_url(); ?>/filestorage/default.png" style="width:100%" class="img-responsive" alt="Project">
			</a>
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
		<h5 class="mg-title text-semibold"><?php echo $FileName; ?><small><?php echo $FileExtension; ?></small></h5>
		<div class="mg-description">
			<small class="pull-left text-muted"><?php echo $FileName; ?></small>
			<small class="pull-right text-muted"><?php echo $Date; ?></small>
		</div>
	</div>
</div>