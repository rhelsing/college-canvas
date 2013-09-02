<div id="leftBar">
<div id="leftBarInside">
Groups are a great way to ... more info about groups
</div>
</div>
<div id="rightContent">
<h3>Members of <?php echo $name; ?></h3>
<div class="split"></div>
<form method="post" name="add" action="<?php echo base_url(); ?>group/addMemberSave">
	<input type="hidden" name="g_id" value="<?php echo $g_id; ?>" />
	<input type="text" name="email" placeholder="email address of user..." /> <a class="btn" style="margin-top:-10px;" onclick="document.forms['add'].submit(); return false;">add member</a>
</form>
<?php
	foreach($members as $member){
		//remove or make admin
		if($member->id != $id){
			echo $member->email."- <a href='".base_url()."group/removeMember/".$member->id."/".$g_id."'>remove from group</a> / <a href='".base_url()."group/transferAdmin/".$member->id."/".$g_id."'>transfer admin</a>";
			echo "<br>";
		}
	}
	if(count($members)==1){
		echo "<h3>Add a member by entering thier email address above.</h3>";
	}
?>
</div>
<div id="clear"></div>