<div class="box">
<h3>Edit Category</h3>
<form method="post" name="save_changes" action="<?php echo base_url(); ?>admin/update_category/<?php echo $row->id; ?>">
	<label>Name</label>
	<input type="text" name="name" value="<?php echo $row->name; ?>" />
	<p class="caption">Name that will appear on site</p>
	<label>About</label>
	<textarea name="about" style="width:400px; height:100px;"><?php echo $row->about; ?></textarea>
	<p class="caption">Short blurb about the category</p>
	<a class="btn-other" onclick="document.forms['save_changes'].submit(); return false;">save</a>
</form>
</div>