<div class="col-md-12 question-panel" data-question-type="multiplechoice">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="fa fa-times"></a>
			</div>
			<h2 class="panel-title question-number">Question #<span></span></h2><span style="color:green">MULTIPLE CHOICE</span>
			<br>
			<div class="form-group">
				<input type="text" name="Question[]" placeholder="Write your question here." class="form-control question-input" value="Question">
				<input type="hidden" name="Type[]" value="1">
			</div>
		</header>
		<div class="panel-body">
			
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label class="control-label">Choice A</label>
						<div class="input-group mb-md">
							<input type="text" class="form-control question-choice" placeholder="Write choice here" required value="Answer 1">
							<span class="input-group-addon btn-warning">
								<div class="radio-custom radio-warning  question-tick">
									<input type="radio" class="mult_choice">
									<label >Correct Answer</label>
								</div>
							</span>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label class="control-label">Choice B</label>
						<div class="input-group mb-md">
							<input type="text" class="form-control question-choice" placeholder="Write choice here" required value="Answer 2">
							<span class="input-group-addon btn-warning">
								<div class="radio-custom radio-warning question-tick">
									<input type="radio" class="mult_choice">
									<label>Correct Answer</label>
								</div>
							</span>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label class="control-label">Choice C</label>
						<div class="input-group mb-md">
							<input type="text" class="form-control question-choice" placeholder="Write choice here" required value="Answer 3">
							<span class="input-group-addon btn-warning">
								<div class="radio-custom radio-warning  question-tick">
									<input type="radio" class="mult_choice">
									<label>Correct Answer</label>
								</div>
							</span>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label class="control-label">Choice D</label>
						<div class="input-group mb-md" >
							<input type="text" class="form-control question-choice" placeholder="Write choice here" required value="Answer 4">
							<span class="input-group-addon btn-warning">
								<div class="radio-custom radio-warning  question-tick">
									<input type="radio" class="mult_choice">
									<label>Correct Answer</label>
								</div>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 row">
					<label class="col-md-1 control-label" for="inputDefault" style="color:green; line-height: 2.5;">POINTS</label>
					<div class="col-md-2">
						<input type="number" class="form-control question-point" placeholder="Points" name="Points[]" value="<?php echo $QuestionPoints ? $QuestionPoints : ''; ?>">
					</div>
					<div class="col-md-6">
						<button class="btn btn-default remove_question_button pull-right">Remove</button>
					</div>
				</div>
			</div>
		</footer>
	</section>
</div>