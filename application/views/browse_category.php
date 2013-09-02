<h3><?php echo $cat_name; ?></h3>
<div class="split"></div>
<?php
if($pgs != 0){
	echo "<div id='columns'>";
	foreach($items as $item){
		if($item->seller_or_group==0){
			echo "<div class='pin'><a href='".base_url()."item/listing/".$item->id."'><img src='".base_url()."images/item".$item->id."APin.jpg' /></a><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."shop/people/".$item->id_sg."'>".$item->name_user."</a><span class='itemPrice'>$".$item->price."</span></span></div>";
		}else{
			echo "<div class='pin'><a href='".base_url()."item/listing/".$item->id."'><img src='".base_url()."images/item".$item->id."APin.jpg' /></a><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."group/page/".$item->id_sg."'>".$item->name_user."</a><span class='itemPrice'>$".$item->price."</span></span></div>";
		}
	}
	echo "</div>";
}else{
	echo "<h3>No items.</h3>";
}
?>
<br>
<?php
if($pgs != 0){ ?>
<div class="custom-pagination">
<a <?php echo $hideprev; ?> class="btn-other" href="<?php echo base_url()."browse/category/".$id."/".$prev; ?>">< previous</a>
<span class="pageNum">Page <?php echo $current; ?> of <?php echo $pgs; ?></span>
<a <?php echo $hidenext; ?> class="btn-other" style="float:right;" href="<?php echo base_url()."browse/category/".$id."/".$next; ?>">next ></a>
</div>
<?php } ?>	
<div id="clear"></div>