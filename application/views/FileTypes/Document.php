<div class="col-md-12">
	<section class="panel shadowed-box">
		<div class="panel-body">

				<h3 class="mt-lg">Question #<?php echo $Number; ?>: <span class="pull-right" style="color:green">TRUE OR FALSE</span></h3>
				<br>
				<h4>
					<?php echo $Data['Question']; ?>
				</h4>
				<hr>
				<label class="rbcontainer">
					TRUE
					<input class="tofquestion" type="radio"  name="<?php echo $Data['QuestionID']; ?>" value="TRUE">
					<span class="checkmark"></span>
				</label>
				<hr>
				<label class="rbcontainer">
					FALSE
					<input class="tofquestion" type="radio"  name="<?php echo $Data['QuestionID']; ?>"  value="FALSE">
					<span class="checkmark"></span>
				</label>

		</div>
	</section> 
</div>