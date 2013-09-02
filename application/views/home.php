<?php echo validation_errors(); ?>
<div id="homeHeader">
	<h3>College Canvas encourages creativity and entrepreneurship among college students by providing an online handmade market for college students to sell handmade items. <a style="color: #0d7cb3;" href="<?php echo base_url(); ?>about">Learn more</a>.</h3>
</div>
<div id="homeCont">
	<span id="homeA" style="background:url('<?php echo base_url(); ?>images/handpicked1.jpg?id=<?php include('lists/1.txt') ?>'); background-size: auto 100%;"></span>
	<span id="homeB" style="background:url('<?php echo base_url(); ?>images/handpicked2.jpg?id=<?php include('lists/2.txt') ?>'); background-size: 110% auto;"></span>
	<span id="homeC" style="background:url('<?php echo base_url(); ?>images/handpicked3.jpg?id=<?php include('lists/3.txt') ?>'); background-size: 100% auto;"></span>
	<span id="homeD" style="background:url('<?php echo base_url(); ?>images/handpicked4.jpg?id=<?php include('lists/4.txt') ?>'); background-size: auto 100%;"></span>
	<span id="homeE" style="background:url('<?php echo base_url(); ?>images/handpicked5.jpg?id=<?php include('lists/5.txt') ?>'); background-size: 100% auto;"></span>
	<span id="homeF" style="background:url('<?php echo base_url(); ?>images/handpicked6.jpg?id=<?php include('lists/6.txt') ?>'); background-size: 100% auto;"></span>
	<span id="homeG" style="background:url('<?php echo base_url(); ?>images/handpicked7.jpg?id=<?php include('lists/7.txt') ?>'); background-size: auto 100%;"></span>
	<span id="homeH" style="background:url('<?php echo base_url(); ?>images/handpicked8.jpg?id=<?php include('lists/8.txt') ?>'); background-size: 100% auto;"></span>
	<span id="homeI" style="background:url('<?php echo base_url(); ?>images/handpicked9.jpg?id=<?php include('lists/9.txt') ?>'); background-size: 100% 100%;"></span>
</div>
<div class="center"><a class="btn-other" href="<?php echo base_url(); ?>signin">request invite to sell</a></div>
<script>
$("#homeA").click(function() {
  window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/1.txt') ?>";
});
$("#homeB").click(function() {
  window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/2.txt') ?>";
});
$("#homeC").click(function() {
 	window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/3.txt') ?>";
});
$("#homeD").click(function() {
  window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/4.txt') ?>";
});
$("#homeE").click(function() {
  window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/5.txt') ?>";
});
$("#homeF").click(function() {
  window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/6.txt') ?>";
});
$("#homeG").click(function() {
  window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/7.txt') ?>";
});
$("#homeH").click(function() {
  window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/8.txt') ?>";
});
$("#homeI").click(function() {
 	window.location.href = "<?php echo base_url(); ?>item/listing/<?php include('lists/9.txt') ?>";
});
</script>
