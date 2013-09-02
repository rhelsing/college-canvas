<span id="sideItem">
<h3 class="priceText">$<?php echo $price; ?></h3>
<?php
if($quantity > 0){ ?>
<a class="btn-other" href="<?php echo base_url(); ?>cart/add/<?php echo $id; ?>">Add to Cart</a><br>
<p class="caption"><?php echo $quantity; ?> available</p>
<?php	
}else{ ?>
	<h3>Out of stock</h3>
	<?php
}
 ?>
<br>
<div class="box">
<h3><?php echo $name_user; ?></h3>
	<div class="split"></div>
	<?php if($seller_or_group==0){ ?>
		<a href="<?php echo base_url(); ?>shop/people/<?php echo $id_sg; ?>"><img src="<?php echo base_url(); ?>images/thumb<?php echo $id_sg; ?>.jpg?id=<?php echo rand(); ?>"/></a><br><br>
		<a href="<?php echo base_url(); ?>shop/people/<?php echo $id_sg; ?>">Visit Shop</a>
		<div class="split"></div>
		<a href="<?php echo base_url(); ?>contact/seller/<?php echo $id_sg; ?>">Contact Seller</a>
	<?php }else{ ?>
		<a href="<?php echo base_url(); ?>group/page/<?php echo $id_sg; ?>"><img src="<?php echo base_url(); ?>images/groupMain<?php echo $id_sg; ?>.jpg?id=<?php echo rand(); ?>"/></a><br><br>
		<a href="<?php echo base_url(); ?>group/page/<?php echo $id_sg; ?>">Visit Group</a>
		<div class="split"></div>
		<a href="<?php echo base_url(); ?>contact/group/<?php echo $id_sg; ?>">Contact Group</a>
	<?php } ?>
</div>
<!-- AddThis Button BEGIN -->
<div class="addthis_default_style" style="margin-top:10px;">
<a style="margin-left:0px;" class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a style="margin-left:-8px;" class="addthis_button_tweet"></a>
<a style="margin-left:-20px;" class="addthis_button_pinterest_pinit"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51003a8769c05aab"></script>
<!-- AddThis Button END -->
</span>

<h3><?php echo $name; ?></h3>
<img id="A" class="itemImg" src="<?php echo base_url(); ?>images/item<?php echo $id; ?>A.jpg" />
<img id="B" class="itemImg" style="display:none;" src="<?php echo base_url(); ?>images/item<?php echo $id; ?>B.jpg" />
<img id="C" class="itemImg" style="display:none;" src="<?php echo base_url(); ?>images/item<?php echo $id; ?>C.jpg" />
<img id="D" class="itemImg" style="display:none;" src="<?php echo base_url(); ?>images/item<?php echo $id; ?>D.jpg" />
<img id="E" class="itemImg" style="display:none;" src="<?php echo base_url(); ?>images/item<?php echo $id; ?>E.jpg" />
<?php if(file_exists('images/item'.$id.'ASmall.jpg')){ ?>
<span id="thumbA" class="thumbItem" style="background:url('<?php echo base_url(); ?>images/item<?php echo $id; ?>ASmall.jpg'); background-size: auto 100%;"></span>
<?php } ?>
<?php if(file_exists('images/item'.$id.'BSmall.jpg')){ ?>
<span id="thumbB" class="thumbItem" style="background:url('<?php echo base_url(); ?>images/item<?php echo $id; ?>BSmall.jpg'); background-size: auto 100%;"></span>
<?php } ?>
<?php if(file_exists('images/item'.$id.'CSmall.jpg')){ ?>
<span id="thumbC" class="thumbItem" style="background:url('<?php echo base_url(); ?>images/item<?php echo $id; ?>CSmall.jpg'); background-size: auto 100%;"></span>
<?php } ?>
<?php if(file_exists('images/item'.$id.'DSmall.jpg')){ ?>
<span id="thumbD" class="thumbItem" style="background:url('<?php echo base_url(); ?>images/item<?php echo $id; ?>DSmall.jpg'); background-size: auto 100%;"></span>
<?php } ?>
<?php if(file_exists('images/item'.$id.'ESmall.jpg')){ ?>
<span id="thumbE" class="thumbItem" style="background:url('<?php echo base_url(); ?>images/item<?php echo $id; ?>ESmall.jpg'); background-size: auto 100%;"></span>
<?php } ?>
<div id="clear"></div>
<span id="itemLeft">
<h3>About this item</h3>
<p><?php echo $about; ?></p>
<h3>Payment Information</h3>
<div class="box">
	<p><img src="<?php echo base_url(); ?>img/paypal.gif" /></p>
	<p class="caption">Shipping cost: <?php echo $shipping_cost; ?></p>
</div>
<h3>Item Details</h3>
<div class="box">
	<p class="checkTitle">Sizes: <?php echo $size; ?></p>
	<div class="split"></div>
	<p class="checkTitle">Dimensions: <?php echo $dimensions; ?></p>
	<div class="split"></div>
	<p class="checkTitle">Material: <?php echo $material; ?></p>
	<div class="split"></div>
	<p class="checkTitle">How it's made: <?php echo $how_it_is_made; ?></p>
	
</div>
</span>

<script>
$("#thumbA").click(function() {
  $('#A').show();
  $('#B').hide();
  $('#C').hide();
  $('#D').hide();
  $('#E').hide();
});
$("#thumbB").click(function() {
  $('#A').hide();
  $('#B').show();
  $('#C').hide();
  $('#D').hide();
  $('#E').hide();
});
$("#thumbC").click(function() {
  $('#A').hide();
  $('#B').hide();
  $('#C').show();
  $('#D').hide();
  $('#E').hide();
});
$("#thumbD").click(function() {
  $('#A').hide();
  $('#B').hide();
  $('#C').hide();
  $('#D').show();
  $('#E').hide();
});
$("#thumbE").click(function() {
  $('#A').hide();
  $('#B').hide();
  $('#C').hide();
  $('#D').hide();
  $('#E').show();
});
</script>