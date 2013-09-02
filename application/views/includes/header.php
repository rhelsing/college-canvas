<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="keywords" content="CollegeCanvas, college canvas, college, canvas, art, artwork, original art, crafts, student crafts, craft, handmade, student, local art, Athens, UGA, University of Georgia, student art, creative campus, " /> 
<meta name="description" content="CollegeCanvas is an online marketplace for students to sell their art and other handmade items. We provide a venue to connect you with original and creative work by students at an affordable price." /> 
<meta name="revisit-after" content="30" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Slab' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/avgrund.css">
	       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
        <title>
        <?php
        if(isset($page_title)){
	        echo $page_title;
        }else{
	        echo "College Canvas";
        }
         ?>
         </title>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
       <div id="main_container"> 
       	<span style="float:right; position:relative; width:100px; height:100px;"><a href="<?php echo base_url(); ?>about/beta"><img src="<?php echo base_url(); ?>img/beta.jpg" /></a></span>
	       <div id="head">
	       <a href="<?php echo base_url(); ?>"><img id="logo" src="<?php echo base_url(); ?>img/logo.png" /></a>
	       <?php if(isset($signedin)){ ?>
		       <div id="right_head" style="margin-right:-100px;"><a href="<?php echo base_url(); ?>shop">my shop</a> <a href="<?php echo base_url(); ?>group">groups</a> <a href="<?php echo base_url(); ?>logout">log out</a> <a href="<?php echo base_url(); ?>cart">cart <img src="<?php echo base_url(); ?>img/cart.png" /></a></div>
	       <?php }else{ ?>
		       <div id="right_head" style="margin-right:-100px;"><a href="<?php echo base_url(); ?>signin">log in</a> <a href="<?php echo base_url(); ?>cart">cart <img src="<?php echo base_url(); ?>img/cart.png" /></a></div>
	      <?php } ?>
	       </div>
	       <div id="navi">
	       
	       <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">browse by university</a>
                                <ul class="dropdown-menu">
                                    <?php include('lists/schools.txt'); ?>
                                </ul>
                            </li>
                            |
                             <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">browse by category</a>
                                <ul class="dropdown-menu">
                                	<?php include('lists/categories.txt'); ?>
                                </ul>
                            </li>
	       <div id="navi_search">
	       <form name="searchForm" action="<?php echo base_url(); ?>search" method="post">
	       <input type="text" placeholder="search..." <?php if(isset($searchTerm)){ echo "value='".$searchTerm."'"; }?> name="search" /><input id="navi_button" type="submit" value="search" />
	       </form>
	       </div>
	       </div>
	       <div id="navi_below"></div>
	       <div id="main_content">
	       <?php if(isset($error)){echo "<div class='error'>".$error."</div>";} ?>
	       
        