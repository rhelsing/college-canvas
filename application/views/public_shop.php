<div id="leftBar">
<div id="leftBarInside">
<?php
if($picture!=""){
	echo '<img src="'.base_url().'images/'.$picture.'?id='.rand().'" class="proPic"/>';
}else{
	echo '<div id="sampleProPic" class="proPic"></div>';
}
 ?>
<br><br>
<?php if($name != ""){ $useName = $name; }else{ $useName = $username; } ?>
<a href="<?php echo base_url(); ?>shop/people/<?php echo $username ?>" class="sideH1" style="color: #0d7cb3;"><?php echo $useName; ?></a><br>
<p class="sideH2"><?php echo $hometown ?></p>
<p class="sideH3">About</p>
<p class="sideH4">
<?php echo $about ?>
</p>  
<p class="sideH3">School</p>
<p class="sideH4">
<?php echo $school ?>, <?php echo $major ?>
</p> 
</div>
<div id="leftBarInside">
<a style="color: #0d7cb3;" href="<?php echo base_url(); ?>contact/seller/<?php echo $id; ?>">Contact Seller</a>             	
</div>
</div>
<div id="rightContent">
<h3><?php echo $useName; ?>'s Profile</h3>
<?php
if($shop_banner!=""){
	echo '<img src="'.base_url().'images/'.$shop_banner.'" style="margin-top:10px;"/>';
}
 ?>
<div class="topBar"></div>	
<?php
if(isset($items)){
	foreach($items as $item){
	echo "<span class='shopItem'><a href='".base_url()."item/listing/".$item->id."'><span class='itemImage' style='background: url(\"".base_url()."images/item".$item->id."ASmall.jpg?id=".rand()."\"); background-size: 110% auto;''></span></a><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."shop/people/".$id_sg."'>".$useName."</a><span class='itemPrice'>$".$item->price."</span></span></span>";
	
	//<a href='".base_url()."item/edit/".$item->id."'>edit</a>
	
	
	//echo "<span class='shopItem'><img src='".base_url()."images/item".$item->id."ASmall.jpg' />";
	//echo $item->name." - Edit</span>";
}
?><br /><br />
<div id="clear"></div>
<?php
}else{
?>
	<h3>This user doesn't have any items yet.</h3>
<?php }
 ?>
</div>
<div id="clear"></div>