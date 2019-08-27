<div class="col-md-12">
	<section class="panel shadowed-box">
		<div class="panel-body">

				<h3 class="mt-lg">Question #<?php echo $Number; ?>: <span class="pull-right" style="color:green">MULTIPLE CHOICE</span></h3>
				<br>
				<h4>
					<?php echo $Data['Question']; ?>
				</h4>
				<hr>
				<label class="rbcontainer">

					<?php echo $Data['Choice_A']; ?>
					<input class="question" type="radio" name="<?php echo $Data['QuestionID']; ?>" value="<?php echo $Data['Choice_A']; ?>">
					<span class="checkmark"></span>

				</label>
				<hr>
				<label class="rbcontainer">

					<?php echo $Data['Choice_B']; ?>
					<input class="question" type="radio" name="<?php echo $Data['QuestionID']; ?>" value="<?php echo $Data['Choice_B']; ?>">
					<span class="checkmark"></span>

				</label>
				<hr>
				<label class="rbcontainer">

					<?php echo $Data['Choice_D']; ?>
					<input class="question" type="radio" name="<?php echo $Data['QuestionID']; ?>" value="<?php echo $Data['Choice_C']; ?>">
					<span class="checkmark"></span>

				</label>
				<hr>
				<label class="rbcontainer">

					<?php echo $Data['Choice_C']; ?>
					<input class="question" type="radio" name="<?php echo $Data['QuestionID']; ?>" value="<?php echo $Data['Choice_D']; ?>">
					<span class="checkmark"></span>
				</label>

		</div>
	</section> 
</div>