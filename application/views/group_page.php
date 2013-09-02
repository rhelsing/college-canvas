<div id="leftBar">
<div id="leftBarInside">
<?php if(file_exists('images/groupMain'.$id.'.jpg')){ ?>
	<img src="<?php echo base_url(); ?>images/groupMain<?php echo $id; ?>.jpg?id=<?php echo rand(); ?>" class="proPic"/><br><br>
	<?php echo $name?><br><br>
<? } ?>
<p class="sideH3">About</p>
<p class="sideH4">
<?php echo $about ?>
</p>  
</div>
<div id="leftBarInside">
<a style="color: #0d7cb3;" href="<?php echo base_url(); ?>contact/group/<?php echo $id; ?>">Contact Group</a>      	
</div>
<div id="leftBarInside">
<h3>Members</h3>
<?php 
	foreach($members as $member){
		$nameu = $member['username'];
		if($member['name']!=""){
			$nameu = $member['name'];
		}
		echo "<a href='".base_url()."shop/people/".$member['username']."'><p style='margin-bottom:24px;'><span style='background: url(\"".base_url()."images/profile".$member['id'].".jpg?id=".rand()."\"); background-size: auto 110%;display: block; float:left; margin-top:-3px; margin-right:10px;height:30px; width:30px; border:1px solid #fff;'></span>".$nameu."</p></a>";
	}
?> 
</div>
</div>
<div id="rightContent">
<?php if($belongs){ ?>
<a class="btn-other" style="float:right;" href="<?php echo base_url(); ?>group/addItem/<?php echo $id; ?>">new item</a>
<? } ?>
<h3><?php echo $name ?></h3>
<?php if(file_exists('images/groupBannerSmall'.$id.'.jpg')){ ?>
	<img src="<?php echo base_url(); ?>images/groupBanner<?php echo $id; ?>.jpg?id=<?php echo rand(); ?>" style="margin-top:10px;" /><br>
<? } ?>
<div class="topBar"></div>	
<?php
if(isset($items)){
	foreach($items as $item){
		if($belongs){
			if($item->username == $username){
				echo "<span class='shopItem'><span class='itemImage' style='background: url(\"".base_url()."images/item".$item->id."ASmall.jpg?id=".rand()."\"); background-size: 110% auto;'><a class='btn' style='margin:5px; float:right;' href='".base_url()."group/editItem/".$id."/".$item->id."'>edit</a></span><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."group/page/".$id."'>".$name."</a><span class='itemPrice'>$".$item->price."</span></span></span>";
			}else{
				echo "<span class='shopItem'><a href='".base_url()."item/listing/".$item->id."'><span class='itemImage' style='background: url(\"".base_url()."images/item".$item->id."ASmall.jpg?id=".rand()."\"); background-size: 110% auto;'></span></a><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."group/page/".$id."'>".$name."</a><span class='itemPrice'>$".$item->price."</span></span></span>";
			}
		}else{
	echo "<span class='shopItem'><a href='".base_url()."item/listing/".$item->id."'><span class='itemImage' style='background: url(\"".base_url()."images/item".$item->id."ASmall.jpg?id=".rand()."\"); background-size: 110% auto;'></span></a><span class='itemTitle'><a href='".base_url()."item/listing/".$item->id."'>".$item->name."</a></span><span class='itemSub'><a href='".base_url()."group/page/".$id."'>".$name."</a><span class='itemPrice'>$".$item->price."</span></span></span>";
		}
}
?><br /><br />
<div id="clear"></div>
<?php
}else{
	echo "<div class='center'><h3>This group doesn't have any items yet!</h3></div>";
}
 ?>
</div>
<div id="clear"></div>