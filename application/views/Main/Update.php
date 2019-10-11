
<div style="padding: 20%">

<?php if($this->session->flashdata('success')): ?>
   <?php echo $this->session->flashdata('success'); ?>
 <?php elseif($this->session->flashdata('error')): ?>
   <?php echo $this->session->flashdata('error'); ?>     
<?php endif; ?>

<form action="<?php echo base_url(); ?>index.php/Update/index" method="post">
<input type="hidden" name="old_pass" value="20130336">

<?php echo validation_errors(); ?>

<br>
<label>Email: </label>
  <input type="text" name="email">
<label>Confirm Email: </label>
  <input type="text" name="cemail">
<br><br>
<label>Current Password: </label>
  <input type="text" name="opassword">
<label>New Password: </label>
  <input type="text" name="npassword">
<label>Retype New Password: </label>
  <input type="text" name="rtnpassword">
  <br><br>

<button type="submit">Update</button>
</form>
</div>