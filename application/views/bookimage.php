<form enctype="multipart/form-data" method="post" onsubmit="return validate();" action="<?php echo site_url('add-book-image/'.$id); ?>">   
<input type="hidden" name="check_post" value="1">
<h5>image</h5>
<input type="file" id="bimage" name="image"/>
<div><input type="submit" value="upload" /></div>
</form>
<script type="text/javascript">
function validate () {
	if (document.getElementById('bimage').value ==''){
		alert('upload image');
		return false;

	} else {
		return true;
	}
}
</script>