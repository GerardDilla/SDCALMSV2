


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
			                <section class="panel panel text-dark">
								<header class="panel-heading heading-title">
									<h2 class="panel-title text-center text-danger text-bold" >Rubrics</h2>
								</header>
								<div class="panel-body">
									    <div class="pull-right">
										<a href="<?php echo base_url(); ?>index.php/Rubrics/Create_Rubrics">
											<button type="button" class="btn btn-success irow">Create Rubrics</button>	
										</a>			
										</div>
								
									<br><br>
									
									<table class="table table-bordered table-striped mb-none" id="RubricsTable">
                                         <thead>
										   <tr class="text-danger text-bold">
											 <th>Rubrics Name</th>
											 <th ></th> 
										  </tr>
										</thead>
                                       <tbody>
									   <?php foreach($this->data['GetRubrics'] as $row) {?>
										
									      <tr>
											<td width="70%"><?php echo $row['rubrics'];  ?></td>
										
											<td width="30%">                          
											 <form method="post" action="<?php echo base_url(); ?>index.php/Rubrics/ChooseButton">
													<input type="hidden" value="<?php echo $row['rubrics_id']; ?>" name="rubrics_id">
													<button type="submit" name="ViewButton" class="btn btn-success">View</button>								
													<button  type="submit " name="DeleteButton" class="btn btn-danger">Delete</button>
											</form>
											</td>
									
										  </tr>
										 
										  <?php  }?>
									   </tbody>
                                </table>

						
								</div>
								
						    </section>
				 </div>
            </div>

			<!-- end: page -->
			
</section>    


