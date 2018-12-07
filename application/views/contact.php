<?php echo validation_errors(); ?>
<?php echo form_open('contact-us'); ?>
<input type="hidden" name="check_post" value="1" />
<h5>Email Address</h5>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="150" />
<h5>Message</h5>
<textarea name="message" >
	<?php echo set_value('message'); ?>
</textarea> 
<div><input type="submit" value="Submit" /></div>
</form>