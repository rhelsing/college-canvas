<div id="leftBar">
<div id="leftBarInside">
Groups are a great way to ... more info about groups
</div>
</div>
<div id="rightContent">
<a class="btn-other" style="float:right;" href="<?php echo base_url(); ?>group/create">new group</a><h3>My Groups</h3>
<div class="split"></div>
<?php
	foreach($groups as $group){
		if($user_id == $group->admin_id){
		
			echo "<div class='box'><h3>".$group->name." (admin)</h3> <div class='split'></div><a class='btn-other' href='".base_url()."group/page/".$group->id."'>view</a> <a class='btn-other' href='".base_url()."group/edit/".$group->id."'>edit</a> <a class='btn-other' href='".base_url()."group/manageMembers/".$group->id."'>manage members</a></div><br>";
		
		}else{
		
			echo "<div class='box'><h3>".$group->name."</h3> <div class='split'></div><a class='btn-other' href='".base_url()."group/page/".$group->id."'>view</a></div><br>";
			
		}
	}
	
	
?>
</div>
<div id="clear"></div>