<a href="<?php echo base_url(); ?>admin">Admin Home</a> | <a href="<?php echo base_url(); ?>admin/schools">Manage Schools</a> | <a href="<?php echo base_url(); ?>admin/categories">Manage Categories</a> | <a href="<?php echo base_url(); ?>admin/handpicked">Manage Handpicked Items</a>
<div class="split"></div>
<h3>Sellers waiting approval</h3>
<div class="split"></div>
<?php if(isset($records)) : foreach($records as $row) :?>
<h1><?php echo $row->email; ?> - <a class="btn-other" href="<?php echo base_url(); ?>admin/approve/<?php echo $row->id; ?>">Approve</a>  <a class="btn-other" href="<?php echo base_url(); ?>admin/deny/<?php echo $row->id; ?>">Deny</a></h1>
		
<?php endforeach; ?>
<?php else: ?>
<h1>No records.</h1>
<?php endif;?>