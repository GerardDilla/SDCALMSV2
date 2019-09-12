



<?php if($ActivityData): ?>
	<?php $monthsave = ''; ?>
	<?php foreach($ActivityData as $activity): ?>

		<?php if($monthsave != $activity['ActivityMonth']): ?>
			<div class="tm-title">
				<h3 class="h5 text-uppercase"><?php echo $activity['ActivityMonth']; ?>, <?php echo $activity['ActivityYear']; ?></h3>
			</div>
			<ol class="tm-items">
		<?php endIf; ?>

		<?php $monthsave = $activity['ActivityMonth'] ?>

			<li>
				<div class="tm-box">
					<p class="text-muted mb-none">
						<?php 
							if($activity['ElapsedMonth'] != 0){
								echo $activity['ElapsedMonth'];
								echo $activity['ElapsedMonth'] > 1 ? ' Months ' : ' Month ';
								echo 'ago';
							}
							else if($activity['ElapsedWeek'] != 0){
								echo $activity['ElapsedWeek'];
								echo $activity['ElapsedWeek'] > 1 ? ' Weeks ' : ' Week ';
								echo 'ago';
							}
							else if($activity['ElapsedDay'] != 0){
								echo $activity['ElapsedDay'];
								echo $activity['ElapsedDay'] > 1 ? ' Days ' : ' Day ';
								echo 'ago';
							}
							else if($activity['ElapsedHour'] != 0){
								echo $activity['ElapsedHour'];
								echo $activity['ElapsedHour'] > 1 ? ' Hours ' : ' Hour ';
								echo 'ago';
							}
							else if($activity['ElapsedMinute'] != 0){
								echo $activity['ElapsedMinute'];
								echo $activity['ElapsedMinute'] > 1 ? ' Minutes ' : ' Minute ';
								echo 'ago';
							}
							else if($activity['ElapsedSecond'] != 0){
								echo $activity['ElapsedSecond'];
								echo $activity['ElapsedSecond'] > 1 ? ' Seconds ' : ' Second ';
								echo 'ago';
							}
							else{
								echo 'Just now';
							}
						?>
					</p>
					<p style="text-transform:uppercase;">
						<?php if($activity['Type'] == 'certificate'): ?>

							Uploaded an Achievement! <u><?php echo $activity['Activity'] ?></u>

						<?php endIf; ?>
						<?php if($activity['Type'] == 'organization'): ?>

							Added an Organization! <u><?php echo $activity['Activity'] ?></u>

						<?php endIf; ?>
						<?php if($activity['Type'] == 'experience'): ?>

							Added an Experience! <u><?php echo $activity['Activity'] ?></u>

						<?php endIf; ?>
						<?php if($activity['Type'] == 'assessment'): ?>

							Took an Assessment! <u><?php echo $activity['Activity'] ?></u>

						<?php endIf; ?>
					</p>
					<!--<button onclick="RemoveActivity(this.value)" value="<?php echo $activity['ID']; ?>" class="btn btn-default">Remove</button>-->
				</div>
			</li>
	
		<?php if($monthsave != $activity['ActivityMonth']): ?>
			</ol>
		<?php endIf; ?>
	<?php endForeach; ?>
<?php else: ?>

	<div class="tm-title">
		<h3 class="h5 text-uppercase">No Activities yet.</h3>
	</div>

<?php endIf; ?>