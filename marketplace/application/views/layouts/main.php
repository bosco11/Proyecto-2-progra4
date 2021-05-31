<!DOCTYPE HTML>
<html>
  <head>
  	<link rel="icon" href="<?php echo site_url('resources/img/favicon.png');?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo site_url('resources/css/style.css');?>">
    <script type="text/javascript" src="<?php echo site_url('resources/js/axios.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo site_url('resources/js/functions.js');?>"></script>
    <title>Chatwitter</title>
  </head>

  <body id="main_page">
  	<div id="main_box">
	    <?php                    
	    if(isset($_view) && $_view)
	        $this->load->view($_view);
	    ?> 
    </div> 
  </body>
</html>