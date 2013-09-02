<div class="box">
<h3>Edit School</h3>
<form method="post" name="save_changes" action="<?php echo base_url(); ?>admin/update_school/<?php echo $row->id; ?>">
	<label>Name</label>
	<input type="text" name="name" value="<?php echo $row->name; ?>" />
	<p class="caption">Name that will appear on site</p>
	<label>About</label>
	<textarea name="about" style="width:400px; height:100px;"><?php echo $row->about; ?></textarea>
	<p class="caption">Short blurb about the school</p>
	<label>Email Extension</label>
	<input type="text" name="ext" value="<?php echo $row->ext; ?>" />
	<p class="caption">example: uga.edu (used to allow students at school to register)</p>
	<a class="btn-other" onclick="document.forms['save_changes'].submit(); return false;">save</a>
</form>
</div>