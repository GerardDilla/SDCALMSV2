


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
		   <input type="hidden" value="<?php echo base_url(); ?>"  id="base_urlSS">
		   <input type="hidden" value="<?php echo $this->data['get_sem'][0]['semester']; ?>"  id="semester">
		   <input type="hidden" value="<?php echo $this->data['get_sy'][0]['schoolyear']; ?>"  id="schoolyear">
		      <div class="col-md-12">
			  <section class="panel shadowed-box">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>
                        <h2 class="panel-title text-success bold">Results</h2>
                        <p class="panel-subtitle">
                        </p>
                    </header>
                    <div class="panel-body">
					   <div class="row">
								<div class="col-md-6">
									<label class="col-md-2 control-label">Professor:</label>
										<div class="col-md-8">
									    	<input type="text" class="form-control" id="Proffesor">
										</div>
										<button class="col-md-2 btn btn-danger" onclick="Get_Proffs()">Search </button>
								</div>				
                         </div>

					</div>
			    </div>
	

			    <div class="col-md-12">  
				    <section class="panel shadowed-box">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<h5 class="text-bold"> Semester:<span class="text-success text-bold" id="semester"> <?php echo $this->data['get_sem'][0]['semester']; ?> </span></h5>
								</div>
								<div class="col-md-6">
									<h5 class="text-bold"> School Year:<span class="text-success text-bold"  id="schoolyear"> <?php echo $this->data['get_sy'][0]['schoolyear']; ?> </span></h5>
								</div>
							</div>
							<div class="pull-right" id="professor_edit_pagination">
				            </div>
							<table class="table table-bordered table-striped mb-none">
								<thead>
									<tr class="danger">
										<th>Faculty Name</th>
										<th>Number of Evaluators</th>
										<th>Rating</th>
										<th>Remark</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="Professor_Table">

								</tbody>
							</table>
								<br>
					</section>
			    </div>

			          
			<!-- end: page -->
			
			
</section>    



<script src="<?php echo base_url(); ?>assets/javascripts/Faculty_Evaluation/Results.js"></script>


