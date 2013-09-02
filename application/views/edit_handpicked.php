<div class="box">
<h3>Choose Handpicked Item</h3>
<form method="post" action="<?php echo base_url(); ?>admin/save_handpicked/<?php echo $current_id; ?>">
	<label>Item ID</label>
	<input type="text" name="item" />
	<p class="caption">Number in url when on product page</p>
	<label>Picture</label>
	<input type="text" name="picture" />
	<p class="caption">A: first picture, B: second picture, etc.</p>
	<br><input type="submit" value="Save" />
</form>
</div>