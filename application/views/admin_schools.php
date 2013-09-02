<a href="<?php echo base_url(); ?>admin">Admin Home</a> | <a href="<?php echo base_url(); ?>admin/schools">Manage Schools</a> | <a href="<?php echo base_url(); ?>admin/categories">Manage Categories</a> | <a href="<?php echo base_url(); ?>admin/handpicked">Manage Handpicked Items</a>
<div class="split"></div>
<h3>Schools</h3>
<div class="split"></div>
<?php if(isset($records)) : foreach($records as $row) :?>
<h1><?php echo $row->name; ?> - <?php echo $row->ext; ?> - <a class="btn-other" href="<?php echo base_url(); ?>admin/edit_school/<?php echo $row->id; ?>">Edit</a></h1><p class="caption"><?php echo $row->about; ?></p>
<?php endforeach; ?>
<?php else: ?>
<h1>No records.</h1>
<?php endif;?>
<div class="split"></div>
<div class="box">
<h3>New School</h3>
<form method="post" name="save_changes" action="<?php echo base_url(); ?>admin/schools/insert">
	<label>Name</label>
	<input type="text" name="name" />
	<p class="caption">Name that will appear on site</p>
	<label>About</label>
	<textarea name="about" style="width:400px; height:100px;"></textarea>
	<p class="caption">Short blurb about the school</p>
	<label>Email Extension</label>
	<input type="text" name="ext" />
	<p class="caption">example: uga.edu (used to allow students at school to register)</p>
	<a class="btn-other" onclick="document.forms['save_changes'].submit(); return false;">save</a>
</form>
</div>