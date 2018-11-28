<br /><br />

<div id="body">
<form method="get" action="<?php echo site_url('used-books'); ?>">
name
<input type="text" name="name" value="<?php echo $name; ?>">
author
<input type="text" name="author" value="<?php echo $author; ?>"><br />
<input type="submit" value="search"> 
</from>
<br />
<br />
<?php
if($results ) {
      foreach($results as $data) {
            echo $data->name . " - " . $data->author . "<br>";
      }
}
?>
 
<p><?php echo $links; ?></p>
 
</div>
