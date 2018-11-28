<?php echo validation_errors(); ?>
<?php echo form_open('add-book'); ?>
<input type="hidden" name="check_post" value="1">
<h5>Book name</h5>
<input type="text" name="name" value="<?php echo set_value('name'); ?>" size="150" />
<br />
<h5>Author</h5>
<input type="text" name="author" value="<?php echo set_value('author'); ?>" size="150" />
<br />
<h5>category</h5>
<input type="text" name="category" value="<?php echo set_value('category'); ?>" size="150" />


<h5>sale price</h5>
<input type="text" name="sale_price" value="<?php echo set_value('sale_price'); ?>" size="150" />


<h5>orginal price</h5>
<input type="text" name="orginal_price" value="<?php echo set_value('orginal_price'); ?>" size="150" />


<h5>country</h5>
<input type="text" name="country" value="<?php echo set_value('country'); ?>" size="150" />


<h5>state</h5>
<input type="text" name="state" value="<?php echo set_value('state'); ?>" size="150" />


<h5>city</h5>
<input type="text" name="city" value="<?php echo set_value('city'); ?>" size="150" />


<h5>description</h5>
<textarea name="description"><?php echo set_value('description'); ?></textarea>

<h5>exchange</h5>
<?php
$options = array(
  '1' => 'Yes',
  '0' => 'No',
);
echo form_dropdown('exchange', $options, set_value('exchange', 0));
?>

<div><input type="submit" value="Submit" /></div>
</form>