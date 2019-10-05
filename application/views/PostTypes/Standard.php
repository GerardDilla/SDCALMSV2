


<div class="tm-info">
	<div class="tm-icon">
		<?php if($Attachments['Status'] == 1): ?>
			<i class="fa fa-file-text-o"></i>
		<?php else: ?>
			<i class="fa fa-bullhorn"></i>
		<?php endIf; ?>
	</div>
	<time class="tm-datetime" datetime="2013-11-19 18:13">
		<div class="tm-datetime-date">
			<?php 
				if($ElapsedMonth != 0){
					echo $ElapsedMonth;
					echo $ElapsedMonth > 1 ? ' Months ' : ' Month ';
					echo 'ago';
				}
				else if($ElapsedWeek != 0){
					echo $ElapsedWeek;
					echo $ElapsedWeek > 1 ? ' Weeks ' : ' Week ';
					echo 'ago';
				}
				else if($ElapsedDay != 0){
					echo $ElapsedDay;
					echo $ElapsedDay > 1 ? ' Days ' : ' Day ';
					echo 'ago';
				}
				else if($ElapsedHour != 0){
					echo $ElapsedHour;
					echo $ElapsedHour > 1 ? ' Hours ' : ' Hour ';
					echo 'ago';
				}
				else if($ElapsedMinute != 0){
					echo $ElapsedMinute;
					echo $ElapsedMinute > 1 ? ' Minutes ' : ' Minute ';
					echo 'ago';
				}
				else if($ElapsedSecond != 0){
					echo $ElapsedSecond;
					echo $ElapsedSecond > 1 ? ' Seconds ' : ' Second ';
					echo 'ago';
				}
				else{
					echo 'Just now';
				}
			?>
		</div>
		<div class="tm-datetime-time">
			<?php echo $Time; ?>
		</div>
	</time>
</div>
<div class="tm-box appear-animation" data-appear-animation="fadeInRight"data-appear-animation-delay="100">
	<h4>
		<?php echo $Description; ?>
	</h4>
	<div class="row">
	<?php if($Attachments['Status'] == 1): ?>
		<?php foreach($Attachments['Assessment'] as $assessment): ?>
			<div class="col-md-3" style="text-align:center;">
				<hr>
				<a href="<?php echo base_url(); ?>index.php/Assessment/PreAssessment/<?php echo $assessment['AssessmentCode']; ?>" style="text-decoration: none; color:#000">
					<h2><i class="fa fa-file-text-o"></i></h2>
					<span><h4><?php echo $assessment['AssessmentName']; ?></h4></span>
					<p><?php echo $assessment['Instructor_Name']; ?></p>
				</a>
				<hr>
			</div>
		<?php endForeach; ?>
	<?php endIf; ?>	
	</div>
	<div class="tm-meta">
		<span>
			
			<?php if($Student_Number): ?>
				<i class="fa fa-user"></i> By <a target="_blank" style="text-transform: capitalize" href="<?php echo base_url(); ?>index.php/Portfolio/Info/<?php echo $Student_Number; ?>">
					<?php echo ucfirst(strtolower($First_Name)); ?> <?php echo ucfirst(strtolower($Last_Name)); ?>
				</a>
			<?php elseif($Instructor_ID): ?>
				<i class="fa fa-user"></i> By <a target="_blank" style="text-transform: capitalize">
					<?php echo ucfirst(strtolower($Instructor_Name)); ?> 
				</a>
			<?php endIf; ?>
			
			
			
		</span>
		<span>
			<i class="fa fa-tag"></i> 
			<?php if($Student_Number): ?>
				Student
			<?php elseif($Instructor_ID): ?>
				Teacher
			<?php endIf; ?>
			
		</span>
		<span>
			<i class="fa fa-comments"></i> <a href="#">No Comments</a>
		</span>
	</div>
</div>