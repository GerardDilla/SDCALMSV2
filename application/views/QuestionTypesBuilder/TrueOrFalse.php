<div class="col-md-12 question-panel" data-question-type="trueorfalse">
	<section class="panel">
		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="fa fa-times remove_question_button"></a>
			</div>
			<h2 class="panel-title question-number">Question #<span></span></h2><span style="color:green">TRUE OR FALSE</span>
			<br>
			<div class="form-group">
				<input type="text" name="Question[]" placeholder="Write your question here." class="form-control question-input">
				<input type="hidden" name="Type[]" value="2">
			</div>
		</header>
		<div class="panel-body">
			
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label">Choice A</label>
						<div class="input-group mb-md">
							<span class="input-group-addon btn-default">
								<div class="radio-custom radio-success  question-tick">
									<input type="radio" name="Answer[]" value="TRUE">
									<label>True</label>
								</div>
							</span>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label">Choice B</label>
						<div class="input-group mb-md">
							<span class="input-group-addon btn-default">
								<div class="radio-custom radio-success question-tick">
									<input type="radio" name="Answer[]" value="FALSE">
									<label>False</label>
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
						<input type="number" class="form-control" id="inputDefault" placeholder="Points" name="Points[]" value="<?php echo $QuestionPoints ? $QuestionPoints : ''; ?>">
					</div>
					<div class="col-md-9">
						<button class="btn btn-default remove_question_button pull-right">Remove</button>
					</div>
				</div>
			</div>
		</footer>
	</section>
</div>