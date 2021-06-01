<!DOCTYPE HTML>
<html>
  <head>
  	<link rel="icon" href="<?php echo site_url('resources/img/favicon.png');?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo site_url('resources/css/style.css');?>">
    
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