<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Slab' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/avgrund.css">

        <script src="<?php echo base_url(); ?>js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
        <div class="container">
         <div id="splash_container">          
       <div id="splash_main">
	       <div id="splash_left"><img src="<?php echo base_url(); ?>img/logo.png" /></div>
	       <div id="splash_right">
		       <h1>It's time to redefine the handmade market.</h1>
		       <h2>Want to be the first to check out our groundbreaking platform? Coming January 2013.</h2>
		       <h3>Sign up now for our newsletter.</h3>
		       <form name="splashForm" action="<?php echo base_url(); ?>splash/add" method="post">
		       <p><input style="margin-top:9px; width:250px;" type="text" placeholder="Enter your email address..." name="email" /><span style="margin-left:5px;"><a class="btn" href="#" onclick="document.forms['splashForm'].submit(); return false;">Sign up</a></span></p></form>
	       </div>
       </div>
       <div id="splash_footer">collegecanvas.org, all rights reserved.<span style="float:right; margin-top:-15px;">
       <a target="_blank" href="https://www.facebook.com/pages/College-Canvas/385724421505417?ref=hl"><span class="link1"></span></a>
       <a target="_blank" href="https://twitter.com/College_Canvas"><span class="link2"></span></a>
       <a target="_blank" href="http://instagram.com/college_canvas/"><span class="link3"></span></a>
       <a target="_blank" href="http://pinterest.com/collegecanvas/"><span class="link4"></span></a>
       <img src="<?php echo base_url(); ?>img/social_media.png" /></span></div>
       </div>

        </div> <!-- /container -->
        
        <p style="visibility:hidden;"><a class="btn2" href="#" id="show">Show It &raquo;</a></p>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

        <script src="<?php echo base_url(); ?>js/vendor/bootstrap.min.js"></script>

        <script src="<?php echo base_url(); ?>js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
<script src="<?php echo base_url(); ?>js/jquery.avgrund.js"></script>
<script>

<?php if(isset($popup)){ ?>

$(function() {
	$('#show').avgrund({
		height: 120,
		holderClass: 'custom',
		showClose: false,
		showCloseText: 'Close',
		enableStackAnimation: true,
		onBlurContainer: '.container',
		template: '<?php echo $popup; ?>'
	});
});

$(document).ready(function() {
  $('.btn2').click();
});	


<?php } ?>
</script>
    </body>
</html>
