


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
										<button type="button" id="addcol" class="btn btn-success">Add Column</button>
                                    </div>

									<br><br>
									
									<table class="table table-bordered mb-none">
										<thead id="scale_panel">
											<tr class="text-danger">
												<th>Category</th>
												
											</tr>
										</thead>
										<tbody id="criteria_panel">
										</tbody>
									</table>
								<br>
								<button type="button"  id="addrow" class="btn btn-success ">Add Row</button>
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
			$('#criteria_panel')
			 .append($('<tr>').attr('class','rubric_criteria')
			        .append($('<td>').attr('style','text-align:center;')
					      .append($('<input>').attr({'placeholder':'Criteria','class':'form-control','name':'criteria[]','required':'required'}))
						        .append($('<a>').attr('class','drow'))
								      .append($('<i>').attr('class','fa fa-times delete_criteria')))
			);
			construct_table();
		}

		function add_scale(){
			scalecount = $('.rubric_scale').length;
			$('#scale_panel tr')
				.append($('<th>').attr({'class':'','data-scale':scalecount,'style':'text-align:center;'})
					.append($('<input>').attr({'class':'form-control','name':'escale[]','placeholder':'rating','required':'required'}))
						.append($('<a>').attr('class','drow').append($('<i>').attr('class','fa fa-times rubric_scale')))
			);
			construct_table();
			//alert('added scale');
		}
		
		function delete_criteria(obj){
			
			$(obj).parent().parent().remove();

		}
		function delete_scale(obj){
			
			//alert($(obj).attr('data-scale'));
			$('#criteria_panel').find("td[data-scale-id='"+$(obj).attr('data-scale')+"']").remove();
			$(obj).parent().parent().parent().remove();
	
		}
		function construct_table(){
			
			$('.rubric_criteria').each(function(i, crit) {
				$('.rubric_scale').each(function(i2, scale) {
					if(!$(crit).children('.rubric-cell').eq(i2).attr('data-scale-id')){
						$(crit).append($('<td>').attr({'data-scale-id':i2,'class':'rubric-cell','style':'text-align:center;'})
						              .append($('<textarea>').attr({'class':'form-control','rows':'6','name':'description[]','placeholder':'Description'}))
									        
						       );
					}
				});
			});

		}

	</script>

