<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>College Canvas</title>
	
	
	
	<link rel="stylesheet" href="css/avgrund.css">
	
	
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
     <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div id="container" class="container">



	<p><a class="btn" href="#" id="show">Show It &raquo;</a></p>
	
	
	
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="js/jquery.avgrund.js"></script>
<script>
$(function() {
	$('#show').avgrund({
		height: 200,
		holderClass: 'custom',
		showClose: false,
		showCloseText: 'Close',
		enableStackAnimation: true,
		onBlurContainer: '.container',
		template: '<p>Collegecanvas.org specializes in the sales of locally made goods by college students. We encourage student entrepreneurship, creativity, and education by providing a platform for students to sell handmade items.</p>'
	});
});
</script>



</body>
</html>