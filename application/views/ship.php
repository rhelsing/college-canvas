<div id="leftBar">
<div id="leftBarInside">
Info on shipping
</div>
</div>
<div id="rightContent">
<h3>Items waiting to be shipped</h3>
<div class="split"></div>
<?php 
	foreach($transactions as $t){
		?>
		<div class="box">
		<h3><?php echo $t->item_name; ?> / Quantity: <?php echo $t->quantity; ?></h3>
		<br><img class="proPic" src="<?php echo base_url(); ?>images/item<?php echo $t->item_number; ?>APin.jpg" /><br><br>
		<div class="split"></div>
		<h3>Ship To:</h3>
		<p class="checkTitle"><?php echo $t->address_name; ?></p>
		<p class="checkTitle"><?php echo $t->address_street; ?></p>
		<p class="checkTitle"><?php echo $t->address_city; ?>, <?php echo $t->address_state; ?> <?php echo $t->address_zip; ?></p>
		<p class="checkTitle"><?php echo $t->address_country; ?></p>
		<div class="split"></div>
		<h3>Transaction Info:</h3>
		<p class="checkTitle">Buyer: <?php echo $t->payer_email; ?></p>
		<p class="checkTitle">Revenue: <?php echo $t->mc_gross; ?></p>
		<div class="split"></div>
		<h3>Complete Transaction:</h3>
		<form id="form<?php echo $t->id; ?>" method="post" name="done<?php echo $t->id; ?>" action="<?php echo base_url(); ?>shop/shipped">
			<input type="hidden" value="<?php echo $t->id; ?>" name="itemid" />
			<input type="checkbox" id="chkSelect<?php echo $t->id; ?>"><span class="checkTitle">By checking this, I verify this item has been shipped.</span><br /><br />
			<a class="btn-other" onclick="myFunction('<?php echo $t->id; ?>'); return false;">Complete</a>
		</form>
		</div>
		<?php
	}
	
?>
</div>
<div id="clear"></div>
		<script>
			function myFunction(id) {
				if($('#chkSelect'+id).is(':checked')){
					$('#form'+id).submit();
				}else{
					alert("You must check the field that verifies you have shipped your item.");
				}
			}
		</script>