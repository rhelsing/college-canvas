<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>College Canvas</title>
	<link href='http://fonts.googleapis.com/css?family=Headland+One|Open+Sans:400,300,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/avgrund.css">
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }
	
	.custom {
		color: #555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}

	.custom p {
		padding: 10px 20px;
		margin: 30px 0 0;
		font-size: 14px;
		font-weight: 300;
		text-align: justify;
	}
	
	.avgrund-close {
		display: block;
		text-transform: uppercase;
		color: #555;
		text-decoration: none;
		position: absolute;
		top: 6px;
		right: 10px;
		font-size: 13px;
	}

	body {
		background-color: #fff;
		margin: -12px;
		font: 13px/20px normal 'Headland One', Arial, sans-serif;
		color: #8b8b8b;
		width: 850px;
		margin-left: auto;
		margin-right: auto;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #8b8b8b;
		background-color: transparent;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 0 0;
		padding: 14px 15px 10px 15px;
	}
	
	h2 {
		color: #fff;
		background-color: #8bae6e;
		border-bottom: 10px solid #037ab4;
		font-size: 12px;
		font-weight: normal;
		margin: 0 0 0 0;
		padding: 5px 5px 5px 15px;
	}

	code {
		font: 13px/20px normal 'Open Sans', Arial, sans-serif;
		font-size: 15px;
		border-top: 1px solid #d0d0d0;
		border-bottom: 1px solid #d0d0d0;
		color: #8b8b8b;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 60px 12px 60px;
		text-align: center;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 10px solid #037ab4;
		line-height: 32px;
		padding: 10px 10px 30px 10px;
		margin: 20px 0 0 0;
		background-color: #8bae6e;
		color: #FFF;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	.btn {
		font: 13px/20px normal 'Open Sans', Arial, sans-serif;
	  display: inline-block;
	  *display: inline;
	  padding: 4px 14px;
	  margin-bottom: 0;
	  *margin-left: .3em;
	  font-size: 14px;
	  line-height: 20px;
	  *line-height: 20px;
	  color: #333333;
	  text-align: center;
	  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
	  vertical-align: middle;
	  cursor: pointer;
	  background-color: #f5f5f5;
	  *background-color: #e6e6e6;
	  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
	  background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
	  background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
	  background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
	  background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
	  background-repeat: repeat-x;
	  border: 1px solid #bbbbbb;
	  *border: 0;
	  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	  border-color: #e6e6e6 #e6e6e6 #bfbfbf;
	  border-bottom-color: #a2a2a2;
	  -webkit-border-radius: 4px;
	     -moz-border-radius: 4px;
	          border-radius: 4px;
	  filter: progid:dximagetransform.microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
	  filter: progid:dximagetransform.microsoft.gradient(enabled=false);
	  *zoom: 1;
	  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	     -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
	text-decoration:none;
	}
	.btn:hover,
	.btn:active,
	.btn.active,
	.btn.disabled,
	.btn[disabled] {
	  color: #333333;
	  background-color: #e6e6e6;
	  *background-color: #d9d9d9;
	}

	.btn:active,
	.btn.active {
	  background-color: #cccccc \9;
	}

	.btn:first-child {
	  *margin-left: 0;
	}

	.btn:hover {
	  color: #333333;
	  text-decoration: none;
	  background-color: #e6e6e6;
	  *background-color: #d9d9d9;
	  /* Buttons in IE7 don't get borders, so darken on hover */

	  background-position: 0 -15px;
	  -webkit-transition: background-position 0.1s linear;
	     -moz-transition: background-position 0.1s linear;
	       -o-transition: background-position 0.1s linear;
	          transition: background-position 0.1s linear;
	}

	.btn:focus {
	  outline: thin dotted #333;
	  outline: 5px auto -webkit-focus-ring-color;
	  outline-offset: -2px;
	}

	.btn.active,
	.btn:active {
	  background-color: #e6e6e6;
	  background-color: #d9d9d9 \9;
	  background-image: none;
	  outline: 0;
	  -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	     -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	          box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
	}

	.btn.disabled,
	.btn[disabled] {
	  cursor: default;
	  background-color: #e6e6e6;
	  background-image: none;
	  opacity: 0.65;
	  filter: alpha(opacity=65);
	  -webkit-box-shadow: none;
	     -moz-box-shadow: none;
	          box-shadow: none;
	}
	#handpicked_items{
		-moz-column-count: 3;
		-moz-column-gap: 10px;
		-moz-column-fill: auto;
		-webkit-column-count: 3;
		-webkit-column-gap: 10px;
		-webkit-column-fill: auto;
		column-count: 3;
		column-gap: 10px;
		column-fill: auto;
		margin-bottom:20px;
	}
	#item{
		-moz-column-break-inside: avoid;
		-webkit-column-break-inside: avoid;
		column-break-inside: avoid;
		display: inline-block;
		width: 300px;
	}
	</style>
</head>
<body>
<div id="container" class="container">
	<h1><img src="application/images/logo.jpg" /></h1>
	<h2>about us | browse by university | browse by category</h2>

	<div id="body">
		<code><b>Collegecanvas.org</b> specializes in the sales of locally made goods by <b>college students</b>. We encourage student <b>entrepreneurship, creativity, and education</b> by providing a platform for students to sell <b>handmade items</b>.</code>
		<div id="handpicked_items">
			<div id="item"><img src="http://placehold.it/264x185"></div>
			<div id="item"><img src="http://placehold.it/264x150"></div>
			<div id="item"><img src="http://placehold.it/264x110"></div>
			<div id="item"><img src="http://placehold.it/264x120"></div>
			<div id="item"><img src="http://placehold.it/264x100"></div>
			<div id="item"><img src="http://placehold.it/264x150"></div>
			<div id="item"><img src="http://placehold.it/264x185"></div>
			</div>
<p style="margin-left:305px;"><a class="btn" href="#" id="show">request invite to sell &raquo;</a></p>
	</div>

	<p class="footer">sponsors</p>
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