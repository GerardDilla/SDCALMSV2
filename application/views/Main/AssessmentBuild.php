
<section role="main" class="content-body">
    <header class="page-header">
        <h2><i class="fa fa-table"></i> CREATE ASSESSMENT</h2>
    
        <div class="right-wrapper pull-right" style="padding-right:20px">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Create Assessment</span></li>
            </ol>
            <a class="sidebar-right-toggle"></a>
        </div>
    </header>
    <div id="particles-js"></div>
    <div class="row">


		<form action="<?php echo base_url(); ?>index.php/AssessmentBuilder/SaveAssessment" method="post" id="AssessmentForm" class="col-md-8 row QuestionsPanel">
			<section class="col-md-12 panel shadowed-box">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
					</div>

					<h2 class="panel-title">Create Assessment</h2>
					<p class="panel-subtitle">
						Start by adding questions to your assessment
					</p>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Assessment Name*</label>
						<div class="col-md-8">
							<input type="text" name="AssessmentName" class="form-control assessment_required_input" id="inputDefault">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Description*</label>
						<div class="col-md-8">
						<textarea class="form-control assessment_required_input" rows="3" name="AssessmentDescription"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Rubrics</label>
						<div class="col-md-8">
							<select name="Rubrics" data-plugin-selectTwo class="form-control populate"  id="Sched_sem">
								<option selected value="0">No Rubrics Selected</option>
								
							</select>
						</div>
					</div>
					<div class="message_box">
						
					</div>
				</div>
			</section> 
        </form>
        <div class="col-md-4">

			<section class="panel shadowed-box question_adder">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
					</div>

					<h2 class="panel-title">Add Questions</h2>
					<p class="panel-subtitle">
						Start by adding questions to your assessment
					</p>
				</header>
				<div class="panel-body">
					<div id="question_manager_message">

					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Question Type</label>
						<div class="col-md-8">
							<select data-plugin-selectTwo class="form-control populate" id="QuestionType">

								<option selected value="1">Multiple Choice</option>
								<option selected value="2">True or False</option>
								<option selected value="3">Identification</option>

							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Points</label>
						<div class="col-md-3">
							<input type="number" class="form-control" id="inputDefault" value="1">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Semester</label>
						<div class="col-md-8">
							<select data-plugin-selectTwo class="form-control populate"  id="Sched_sem">
								<option selected value="">Select Semester</option>
								
							</select>
						</div>
					</div>

					<div class="message_box">
						
					</div>
				</div>
				<footer class="panel-footer">
					<button type="button" class="btn btn-default add_question_button">Add Question</button>
					<span class="searchloader">
						<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
					</span>
				</footer>
			</section>

			<section class="panel shadowed-box question_adder">
				<div class="panel-body" style="text-align:center">
					<button class="btn btn-success assessment-submit">Submit Assessment</button>
				</div>
			</section>

        </div>

    </div>
  
</section>
<script>
function base_url(){

	return '<?php echo base_url(); ?>';

}
</script>
<script src="<?php echo base_url(); ?>assets/javascripts/assessmentbuilder.js"></script>




 
