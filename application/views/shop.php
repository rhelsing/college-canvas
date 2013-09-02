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
<a href="<?php echo base_url(); ?>shop/people/<?php echo $username ?>" class="sideH1" style="color: #0d7cb3;"><?php echo $useName ?></a> <br>
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
<?php if($trans_num > 0){
	echo '<div id="leftBarInside">Total Sales: '.$trans_num.'<br>Revenue: $'.$revinue.'</div>';
} ?>
</div>
<div id="rightContent">
<a class="btn-other" style="float:right;" href="<?php echo base_url(); ?>item/add">new item</a>
<h3><?php echo $useName ?>'s Profile - <a style="color: #0d7cb3; font: 16px 'Open Sans', Helvetica, Arial, sans-serif;" href="<?php echo base_url(); ?>shop/edit">Edit Profile</a></h3>
<?php
if($shop_banner!=""){
	echo '<img src="'.base_url().'images/'.$shop_banner.'" style="margin-top:10px;"/>';
}
 ?>
<div class="topBar"></div>	
<?php
if(isset($items)){
	foreach($items as $item){
	echo "<span class='shopItem'><span class='itemImage' style='background: url(\"".base_url()."images/item".$item->id."ASmall.jpg?id=".rand()."\"); background-size: 110% auto;'><a class='btn' style='margin:5px; float:right;' href='".base_url()."item/edit/".$item->id."'>edit</a></span><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."shop/people/".$id_sg."'>".$useName."</a><span class='itemPrice'>$".$item->price."</span></span></span>";
	
	//<a href='".base_url()."item/edit/".$item->id."'>edit</a>
	
	
	//echo "<span class='shopItem'><img src='".base_url()."images/item".$item->id."ASmall.jpg' />";
	//echo $item->name." - Edit</span>";
}
?><br /><br />
<div id="clear"></div>
<?php
}else{
	echo "<div class='center'><h3>You don't have any items yet!</h3></div>";
 }
 ?>
</div>
<div id="clear"></div>