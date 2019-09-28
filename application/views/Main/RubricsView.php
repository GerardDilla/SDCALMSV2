


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
	<form method="post" action="<?php echo base_url(); ?>index.php/Rubrics/Update_Rubrics">
        <input type="hidden"  name="Rubrics_ID" value="<?php echo $this->data['GetRubrics'][0]['rubrics_id']; ?>" >
		
			<div class="row">
				<div class="col-md-12">
			                <section class="panel panel text-dark">
								<header class="panel-heading heading-title">
									<h2 class="panel-title text-center text-danger text-bold" >Rubrics</h2>
								</header>
								<div class="panel-body">
								    <div class="form-group">
										<label class="col-md-1 control-label" for="inputDefault">Title:</label>
											<div class="col-md-6">
												<input type="text" class="form-control Enabled" name="RubricsTitle" id="inputDefault" value="<?php echo $this->data['GetRubrics'][0]['rubrics']; ?>" >
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-1 control-label" for="textareaAutosize">Description:</label>
											<div class="col-md-6">
											<textarea class="form-control Enabled" name="RubricsDescription" rows="3" id="textareaDefault"><?php echo $this->data['GetRubrics'][0]['description']; ?></textarea>
											</div>
									</div>
								   <div class="pull-right EditButton">
										<button type="button" class="btn btn-success EditButtons">Edit</button>
                                    </div>
									<div class="pull-right AddDelleteRowColumnButton" style="display: none;">
										<button type="button" class="btn btn-success icol">Add Column</button>
                                    </div>

									<br><br>
									
									<table class="table table-bordered table-striped mb-none" id="RubricsTable">
                                         <thead>
										   <tr class="text-danger text-bold">
										     <td>Category</td>
											 <?php foreach($this->data['RubricsEscale'] as $row): ?>
											   <td data-id="<?php echo $row['escale_id'] ?>"> 
											   <input type="hidden"  name="Escale_ID[]" value=" <?php echo $row['escale_id'] ?>" >
													<input type="text" placeholder="Value" name="escale[]" value=" <?php echo $row['escale'] ?>" class="form-control Enabled" id="inputDefault">
											   </td>
                                             <?php endforeach; ?>
										  </tr>
										</thead>
                                       <tbody>
									        <?php foreach($this->data['RubricsCriteria'] as $row): ?>
												<tr>
													<td>
													    <input type="hidden"  name="Criteria_ID[]" value=" <?php echo $row['criteria_id'] ?>" >
														<input type="text" placeholder="Value" name="criteria[]" value="<?php echo $row['criteria'] ?>" class="form-control Enabled" id="inputDefault">
														
													</td>
													<?php foreach($this->data['RubricsDescription'] as $row1): ?>
														<?php if($row1['criteria_id'] == $row['criteria_id']): ?>
															<td id="<?php echo $row1['escale_id'] ?>">
															<input type="hidden"  name="DESCRIPTION_ID[]" value="<?php echo $row1['description_id'] ?>" >
															   <textarea class="form-control Enabled" rows="10" name="description[]" placeholder="Description:" id="textareaAutosize" data-plugin-textarea-autosize>
															   <?php echo $row1['description'];?>
															   </textarea>
														
																<br>
															
																</div>
																
															</td>
														<?php endIf; ?>
													<?php endforeach; ?>
												</tr>
											 <?php endforeach; ?>
									   </tbody>
                                </table>
								<br>
							
								<div  class="text-center AddDelleteRowColumnButton" style="display: none;">
										<button type="submit" class="btn btn-success">Update</button>

                                    </div>
								
			
								</div>
								
						    </section>
				 </div>
            </div>
	</form>
			<!-- end: page -->
			
</section>    

<script type="text/javascript">

$( ".Enabled" ).prop( "disabled", true);
$( ".AddDelleteRowColumnButton" ).hide();

$('.EditButtons').click(function(){
	 $( ".EditButton" ).hide();
	 $( ".AddDelleteRowColumnButton" ).show();
	 $( ".Enabled" ).prop( "disabled", false);
});


</script>



