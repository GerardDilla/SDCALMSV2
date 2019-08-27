
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
		           <div class="col-md-12">
			            <section class="panel shadowed-box">
                            <header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
								</div>
								<h2 class="panel-title text-success bold">Professor</h2>
								<p class="panel-subtitle">
								</p>
                           </header>
							<div class="panel-body">
							 <div class="row">
								<div class="col-md-6">
									<label class="col-md-3 control-label">Professor:</label>
										<div class="col-md-8">
									    	<input type="text" class="form-control" id="Proffesor">
										</div>
								</div>
							<div class="col-md-6">
							<div class="form-group">
									<label class="col-md-3 control-label">Search by:</label>
									<div class="col-md-8">
										<select data-plugin-selectTwo class="form-control populate" id="ActiveDeactive">	
										    <option selected value="">Select Deactive or Active:</option>
											<option value="1">Active </option>
											<option value="2">Deactive</option>
										</select>
									</div>
							</div>
							
							</div>
                         </div>
                      
					  <div class="message_box">
                           
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <button type="button" class="btn btn-success" onclick="Get_Pagination()" >View Professors</button>
                        <button type="button" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                        <span class="searchloader">
                            <img src="http://10.0.0.65/SDCALMSv2/assets/images/loading.gif" height="42" width="42">
                        </span>
                    </footer>
                </section>
			  </div>
			
				   <div class="col-md-12">
				       <section class="panel shadowed-box">
						    <div class="panel-body">
							     <div class="pull-right" id="professor_edit_pagination">
				                 </div>
								<table class="table table-bordered table-striped mb-none">
									<thead> 
										<tr class="danger">
										   <th># </th>
											<th>Name </th>
											<th>Department</th>
											<th class="center"></th>
										</tr>
									</thead>
									<tbody id="Professor_Table">

									</tbody>
								</table>
								<br>
						</section>
			         </div>

				   </div>
		     </div>

			<!-- end: page -->
			

			
   

</section> 
<script src="<?php echo base_url(); ?>assets/javascripts/Faculty_Evaluation/Professor.js"></script>



									<!-- Examples -->

