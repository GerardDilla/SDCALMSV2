
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
					<span id="assessment_message">
						<?php if($this->session->flashdata('message')): ?>
						<div class="message_box"><div class="alert alert-warning">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->flashdata('message'); ?>
							</div>
						</div>
						<?php endIf; ?>
					</span>

					<div class="form-group">
						<label class="col-md-3 control-label">Assessment Name*</label>
						<div class="col-md-8">
							<input type="text" name="AssessmentName" class="form-control assessment_required_input" id="inputDefault">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Handled Subjects</label>
						<div class="col-md-8">
							<select name="handled_schedcode" data-plugin-selectTwo class="form-control populate" >
								<option selected value="0">Choose where to post this Assessment</option>
								<?php if($this->data['HandledSubjects']): ?>
									<?php foreach($this->data['HandledSubjects'] as $subjects): ?>
									<option value="<?php echo $subjects['Sched_Code']; ?>"><?php echo $subjects['Course_Title']; ?> : <?php echo $subjects['Course_Code']; ?></option>
									<?php endForeach; ?>
								<?php else: ?>
									<option selected value="0">No Handled Subjects</option>
								<?php endIf; ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Outcomes-Based*
						<button type="button" class="pull-right btn btn-success add-outcome">+</button>
						</label>
						<div class="col-md-8">
							<div class="row outcome-list form-group" style="padding:0px 10px 0px 15px">

								<div class="input-group mb-md">
									<input type="text" class="form-control outcome-input" placeholder="Place Outcome here..." name="outcome[]" data-index="0" value=''>
									<span class="input-group-btn">
										<button class="btn btn-danger remove-outcome" type="button">Remove</button>
									</span>
								</div>

							</div>
						<!--<textarea class="form-control assessment_required_input" rows="3" name="AssessmentDescription"></textarea>-->
							
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Start Time*</label>
						<div class="col-md-8">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<input type="text" data-plugin-datepicker="" name="start_date" class="form-control">
								
								<span class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</span>
								<input type="text" data-plugin-timepicker="" name="start_time" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">End Time*</label>
						<div class="col-md-8">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
								<input type="text" data-plugin-datepicker="" name="end_date" class="form-control">
								
								<span class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</span>
								<input type="text" data-plugin-timepicker="" name="end_time" class="form-control">
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label">Time Limit (Minutes)</label>
						<div class="col-md-2">
							<input type="number" name="timelimit" placeholder="0.00" value="60" class="form-control assessment_required_input" id="inputDefault">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Rubrics</label>
						<div class="col-md-8">
							<select name="Rubrics" data-plugin-selectTwo class="form-control populate"  id="rubrics_choice">
								<option selected value="0">No Rubrics Selected</option>
								<?php if($this->data['RubricsList']): ?>
									<?php foreach($this->data['RubricsList'] as $rubric): ?>
									<option value="<?php echo $rubric['rubrics_id']; ?>"><?php echo $rubric['rubrics']; ?></option>
									<?php endForeach; ?>
								<?php endIf; ?>
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
							<input type="number" class="form-control" id="pointset" value="1">
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




 
