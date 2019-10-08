


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
	<form method="post" action="<?php echo base_url(); ?>index.php/Rubrics/Insert_Rubrics">

			<div class="row">
				<div class="col-md-12">
			                <section class="panel panel text-dark">
								<header class="panel-heading heading-title">
									<h2 class="panel-title text-center text-danger text-bold" >Create Rubrics</h2>
								</header>
								<div class="panel-body">
								    <div class="form-group">
										<label class="col-md-1 control-label" for="inputDefault">Title:</label>
											<div class="col-md-6">
												<input type="text" class="form-control" name="RubricsTitle" id="inputDefault" required>
											</div>
									</div>
									<div class="form-group">
										<label class="col-md-1 control-label" for="textareaAutosize">Description:</label>
											<div class="col-md-6">
											    <textarea class="form-control" name="RubricsDescription" rows="3" id="textareaDefault" required></textarea>
											</div>
									</div>
								     <div class="pull-right">
										<button type="button" class="btn btn-success icol">Add Column</button>
                                    </div>

									<br><br>
									
									<table class="table table-bordered table-striped mb-none" id="RubricsTable">
									<thead id="scale_panel">
										   <tr class="text-danger text-bold">
										     <th>Category</th>
											 <th><input type="text" placeholder="rating:" name="escale[]" class="form-control" id="inputDefault" required>	<div style="text-align:center"> (<a class="rubric-editor-delete-icon" data-ng-show="editRubric.rows.length > 1" href="" data-ng-click="deleteRow(row)" title="Delete Row"><i class="fa fa-times"></i></a>) </div></th>
											 <th><input type="text" placeholder="rating:" name="escale[]" class="form-control" id="inputDefault" required>	<div style="text-align:center"> (<a class="rubric-editor-delete-icon" data-ng-show="editRubric.rows.length > 1" href="" data-ng-click="deleteRow(row)" title="Delete Row"><i class="fa fa-times"></i></a>) </div></th>
										  </tr>
										</thead>
										<tbody id="criteria_panel">
									      <tr>
											<td>
											    <input type="text" placeholder="Value" name="criteria[]"  class="form-control" id="inputDefault" required>
												<div style="text-align:center">
													(
													<a class="drow"  title="Delete Row">
														<i class="fa fa-times drow"></i>
													</a>
													)
                                                </div>
										    </td>
											<td>
											<textarea class="form-control" rows="3" name="description[]" placeholder="Description:" id="textareaAutosize" data-plugin-textarea-autosize required></textarea> <div style="text-align:center">
												<div style="text-align:center">
													(
													<a class=""  title="Delete Row">
														<i class="fa fa-plus drow"></i>
													</a>
													)
                                                </div>
										    </td>
											<td>
											<textarea class="form-control" rows="3" name="description[]" placeholder="Description:" id="textareaAutosize" data-plugin-textarea-autosize required></textarea> <div style="text-align:center">
												<div style="text-align:center">
													(
													<a class=""  title="Delete Row">
														<i class="fa fa-plus drow"></i>
													</a>
													)
                                                </div>
										    </td>
										  </tr>
										  <tr>
											<td>
											    <input type="text" placeholder="Value" name="criteria[]"  class="form-control" id="inputDefault" required>
												<div style="text-align:center">
													(
													<a class="rubric-editor-delete-icon drow"  title="Delete Row">
														<i class="fa fa-times drow"></i>
													</a>
													)
                                                </div>
										    </td>
											<td>
											<textarea class="form-control" rows="3" name="description[]" placeholder="Description:" id="textareaAutosize" data-plugin-textarea-autosize required></textarea> <div style="text-align:center">
												<div style="text-align:center">
													(
														<a class=""  title="Delete Row">
														<i class="fa fa-plus drow"></i>
													</a>
													)
                                                </div>
										    </td>
											<td>
											<textarea class="form-control" rows="3" name="description[]" placeholder="Description:" id="textareaAutosize" data-plugin-textarea-autosize required></textarea> <div style="text-align:center">
												<div style="text-align:center">
													(
													<a class=""  title="Delete Row">
														<i class="fa fa-plus drow"></i>
													</a>
													)
                                                </div>
										    </td>
										  </tr>
										  <tr class="criteria-count">
											<td>
											    <input type="text" placeholder="Value" name="criteria[]"  class="form-control" id="inputDefault" required>
												<div style="text-align:center">
													(
													<a class="rubric-editor-delete-icon drow"  title="Delete Row">
														<i class="fa fa-times drow"></i>
													</a>
													)
                                                </div>
										    </td>
											<td>
											<textarea class="form-control" rows="3" name="description[]" placeholder="Description:" id="textareaAutosize" data-plugin-textarea-autosize required></textarea> <div style="text-align:center">
												<div style="text-align:center">
													(
														<a class=""  title="Delete Row">
														<i class="fa fa-plus drow"></i>
													</a>
													)
                                                </div>
										    </td>
											<td>
											<textarea class="form-control" rows="3" name="description[]" placeholder="Description:" id="textareaAutosize" data-plugin-textarea-autosize required></textarea> <div style="text-align:center">
												<div style="text-align:center">
													(
													<a class=""  title="Delete Row">
														<i class="fa fa-plus drow"></i>
													</a>
													)
                                                </div>
										    </td>
										  </tr>
										  
									   </tbody>
                                </table>
								<br>
								<button type="button"  class="btn btn-success irow">Add Row</button>
								<br>
								   <div class="text-center">
										<button type="submit" class="btn btn-success">Save Rubrics</button>
                                    </div>
			
								</div>
								
						    </section>
				 </div>
            </div>
	</form>
			<!-- end: page -->
			
</section>    

<script>
		
		$(document).ready(function(){

			$('#addrow').click(function(){
				add_criteria();
			});

			$('#addcol').click(function(){
				add_scale();
			});

			$('#criteria_panel').on('click','.delete_criteria',function(){
				delete_criteria(this);
			});

			$('#scale_panel').on('click','.rubric_scale',function(){
				delete_scale(this);
			});

		})
		function add_criteria(){

			$('#criteria_panel').append($('<tr>').attr('class','rubric_criteria').append($('<td>').append($('<input>').attr('placeholder','Criteria')).append($('<button>').attr('class','delete_criteria').text('Delete'))));

			construct_table();
		}
		function add_scale(){

			scalecount = $('.rubric_scale').length;
			$('#scale_panel tr').append($('<th>').attr({'class':'rubric_scale','data-scale':scalecount}).text('test'+scalecount).append($('<button>').text('Delete')));
			
			construct_table();
			//alert('added scale');

		}
		function delete_criteria(obj){
			
			$(obj).parent().parent().remove();

		}
		function delete_scale(obj){
			
			//alert($(obj).attr('data-scale'));
			$('#criteria_panel').find("td[data-scale-id='"+$(obj).attr('data-scale')+"']").remove();
			$(obj).remove();
	
		}
		function construct_table(){
			
			$('.rubric_criteria').each(function(i, crit) {
				$('.rubric_scale').each(function(i2, scale) {
					if(!$(crit).children('.rubric-cell').eq(i2).attr('data-scale-id')){
						$(crit).append($('<td>').attr({'data-scale-id':i2,'class':'rubric-cell'}).text('text cell : '+i2));
					}
				});
			});

		}

	</script>


