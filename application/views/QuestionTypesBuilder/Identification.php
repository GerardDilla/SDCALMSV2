<div class="col-md-12 question-panel" data-question-type="identification">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="fa fa-times remove_question_button"></a>
			</div>
			<h2 class="panel-title question-number">Question #<span></span></h2><span style="color:green">IDENTIFICATION</span>
			<br>
			<div class="form-group">
				<input type="text" name="Question[]" placeholder="Write your question here." class="form-control question-input" required value="Question">
				<input type="hidden" name="Type[]" value="3">
			</div>
		</header>
		<div class="panel-body">
			
			<textarea class="form-control identificationquestion" rows="3" placeholder="Write your answer here" name="Answer[]" required>Answer</textarea>

		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 row">
				
					<label class="col-md-1 control-label" for="inputDefault" style="color:green; line-height: 2.5;">POINTS</label>
					<div class="col-md-2">
						<input type="number" class="form-control" id="inputDefault" placeholder="Points" name="Points[]" value="<?php echo $QuestionPoints ? $QuestionPoints : ''; ?>">
					</div>
					<div class="col-md-3">
						<select name="Criteria[]" data-plugin-selectTwo class="form-control populate rubrics_criteria_option">
								<option selected value="0">No Rubrics Selected</option>
								
						</select>
					</div>
					<div class="col-md-6">
						<button class="btn btn-default remove_question_button pull-right">Remove</button>
					</div>
				</div>
			</div>
		</footer>
	</section>
</div>