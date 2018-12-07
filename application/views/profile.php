<h5>Email Address</h5>
<input type="text" name="email" value="" size="150" />

<?php echo validation_errors(); ?>
<?php echo $error; ?>

<?php echo form_open('profile'); ?>
<input type="hidden" name="check_post" value="1" />
<h5>Old password</h5>
<input type="text" name="oldpassword" value="<?php  echo set_value('oldpassword');  ?>" />
<h5>n password</h5>
<input type="text" name="npassword" value="<?php  echo set_value('npassword');  ?>" />
<h5>c password</h5>
<input type="text" name="cpassword" value="<?php echo set_value('cpassword');  ?>" />
<div>
	<input type="submit" value="Submit" />
</div>
</form>