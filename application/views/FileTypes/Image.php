<div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
	<div class="thumbnail">
		<div class="thumb-preview">
			<a class="thumb-image">
				<img src="<?php echo base_url(); ?>filestorage/<?php echo $FileName; ?><?php echo $FileExtension; ?>" class="img-responsive" alt="Project">
				<!--
				<div class="img-responsive panel-heading-icon">
					<i class="fa fa-globe"></i>
				</div>
				-->
			</a>
			<div class="mg-thumb-options">
				<a href="<?php echo base_url(); ?>filestorage/<?php echo $FileName; ?><?php echo $FileExtension; ?>" target="_blank" class="mg-zoom">
					<i class="fa fa-search">
					</i>
				</a>
				<div class="mg-toolbar">
					<div class="mg-toolbar">
						<div class="mg-group pull-right">
						<a href="#" class="delete_file" data-file-id="<?php echo $File_ID; ?>">Delete File</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<h5 class="mg-title text-semibold"><?php echo $Name; ?><small><?php echo $FileExtension; ?></small></h5>
		<div class="mg-description">
			<small class="pull-left text-muted"><?php echo $FolderName != null ? $FolderName : 'Uncategorized'; ?></small>
			<small class="pull-right text-muted"><?php echo $Date; ?></small>
		</div>
	</div>
</div>