
<section role="main" class="content-body">
	<header class="page-header">
		<h2></h2>
					
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
						   <i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Faculty Evaluation</span></li>
				</ol>
				<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
			</div>
	</header>
	<div id="particles-js"></div>
		<!-- start: page -->

		   <div class="row">

			    <div class="col-md-12">  
				    <section class="panel shadowed-box">
						<div class="panel-body">
						   <section class="panel panel-secondary" id="panel-2" data-portlet-item="">
								<header class="panel-heading portlet-handler">
									<h2 class="panel-title">
									<div class="row">
								       <div class="col-md-6">
											Details
									   </div>
									   <div class="col-md-6">
											Statistics
									   </div>
									</div>
									</h2>
								</header>
								<div class="panel-body">
								   <div class="row">
								       <div class="col-md-6">
									       <div class="row">
												<label class="col-md-4 control-label text-bold">Name of Professor:</label> 
												<label class="col-md-8 control-label text-bold text-success">
												<?php echo $this->data['prof_id']; ?></label> 
												<label class="col-md-4 control-label text-bold">Semester:</label> 
												<label class="col-md-8 control-label text-bold text-success">
												<?php echo $this->data['sem']; ?></label> 
												<label class="col-md-4 control-label text-bold">School Year:</label> 
												<label class="col-md-8 control-label text-bold text-success">
												<?php echo $this->data['sy']; ?></label> 
											</div>
										</div>
										<div class="col-md-6">
										    <div class="row">
												<label class="col-md-3 control-label text-bold">No of Evaluators:</label> 
												<label class="col-md-9 control-label text-bold text-success">51</label> 
												<label class="col-md-3 control-label text-bold">Total Average:</label> 
												<label class="col-md-9 control-label text-bold text-success">4.99</label> 
												<label class="col-md-3 control-label text-bold">Total Percentage:</label> 
												<label class="col-md-9 control-label text-bold text-success">99%</label> 
											</div>
										</div>
									</div>
								</div>
                             </section>		

							<table class="table table-striped table-bordered table-hover text-dark" style="font-size: 16px; ">
								<thead >
									<tr class="danger">
										<th class="heading-title" >Ratings</th>
										<th class="heading-title">Criteria</th>
									</tr>  
								</thead>
									 <tbody>
									 <?php foreach($this->data['getscriteria'] as $row): ?>
										<tr>
											<td><?php echo $row['ratings']; ?></td>
											<td><?php echo $row['criteria']; ?></td>
										</tr>
									<?php endforeach; ?>
									</tbody>      
							</table>
							

						<?php $area = ''; ?>
							<?php foreach($this->data['getdescription'] as $row): ?>
					               <?php if($area != $row['category_name']): ?>
										<table class="table table-striped table-bordered table-hover text-dark" style="font-size: 16px; ">
										   <thead class=" text-center">
												<tr>
												<?php $ideval = $row['eval_type']; ?>
												<?php if($ideval=='Rating'): ?>
											    	<th class="text-danger heading-title" ><?php echo $row['orderr']; ?>.<?php echo $row['category_name']; ?></th>
												<?php foreach($this->data['getscriteria'] as $row1): ?>
												     <th class="text-danger heading-title"><?php echo $row1['ratings']; ?></th>
												<?php endforeach; ?>	
													<th class="text-danger heading-title">Average</th>
													<th class="text-danger heading-title">Percentage</th>
											    <?php endif; ?>
												</tr>  
											</thead>
										
											<?php $area = $row['category_name']; ?>
									<?php endif; ?>
								          	<?php $ideval = $row['eval_type']; ?>
											  <?php if($ideval=='Rating'): ?>
											    <tbody>
													<tr>
														<td width="100%"><?php echo $row['question_name']; ?></td>
													<?php foreach($this->data['getscriteria'] as $row2): ?>
														<td class="center score text-success"></td>
													<?php endforeach; ?>
														<td class="center score"></td>
														<td class="center score"></td>
													 </tr>
												</tbody>
											<?php endif; ?>  
		
							<?php endforeach; ?>
																	
						                     	<tr>
													<td  class="text-danger text-bold" width="83.5%">Total:</td>
													<td class="center score text-success"></td>
													<td class="center score"></td>
											 </tr>	
							                       
										</table>
										
						</div>
					</section>
			    </div>

			</div>        
		<!-- end: page -->
			

			
</section>    



<script src="<?php echo base_url(); ?>assets/javascripts/Faculty_Evaluation/Results.js"></script>


