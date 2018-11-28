<?php echo validation_errors(); ?>
<?php echo form_open('validate'); ?>
<h5>Email Address</h5>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="150" />
<h5>Password</h5>
<input type="password" name="password" value="<?php echo set_value('password'); ?>" size="150" />
<h5>Password Confirm</h5>
<input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" size="150" />
<div><input type="submit" value="Submit" /></div>
</form>