<div id="leftBar">
<div id="leftBarInside">
	<h3>Categories</h3>
	<ul>
		<?php 
			foreach($categories as $category => $value){
				echo "<li>".$category." - ".$value."</li>";
			}
		?>
	</ul>
	<div class="split"></div>
	<h3>Schools</h3>
	<ul>
		<?php 
			foreach($schools as $school => $value){
				echo "<li>".$school." - ".$value."</li>";
			}
		?>
	</ul>
</div>
</div>
<div id="rightContent">
<h1>Searching for <?php echo $searchTerm; ?></h1><h3><?php echo $numResults; ?> items</h3>
<div class="split"></div>
<?php
	foreach($items as $item){
		if($item->seller_or_group==0){
			echo "<span class='shopItem'><a href='".base_url()."item/listing/".$item->id."'><span class='itemImage' style='background: url(\"".base_url()."images/item".$item->id."ASmall.jpg?id=".rand()."\"); background-size: 110% auto;''></span></a><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."shop/people/".$item->id_sg."'>".$item->name_user."</a><span class='itemPrice'>$".$item->price."</span></span></span>";
			}else{
				echo "<span class='shopItem'><a href='".base_url()."item/listing/".$item->id."'><span class='itemImage' style='background: url(\"".base_url()."images/item".$item->id."ASmall.jpg?id=".rand()."\"); background-size: 110% auto;''></span></a><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."group/page/".$item->id_sg."'>".$item->name_user."</a><span class='itemPrice'>$".$item->price."</span></span></span>";
			}
	}
?>
<div id="clear"></div>
<div class="custom-pagination">
<a class="btn-other" href="#">< previous</a>
<span class="pageNumSearch">Page 1 of 1</span>
<a class="btn-other" style="float:right;" href="#">next ></a>
</div>	
</div>
<div id="clear"></div>