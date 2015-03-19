<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Circular Content Carousel with jQuery</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Circular Content Carousel with jQuery" />
        <meta name="keywords" content="jquery, conent slider, content carousel, circular, expanding, sliding, css3" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/style_jaq.css" />
		<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Coustard:900' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Rochester' rel='stylesheet' type='text/css' />
    </head>
    <body>
		<div class="container" style="width:780px; height:150px;">
			
			
			<div id="ca-container" class="ca-container">
				<div class="ca-wrapper">
				  
                   <div class="ca-item ca-item-1"><div class="ca-item-main"><img src="images/down_img1.gif"/></div> </div>
                  
				  <div class="ca-item ca-item-2"> <div class="ca-item-main"><img src="images/down_img2.gif"/></div> </div>
                     
                      <div class="ca-item ca-item-6"> <div class="ca-item-main"><img src="images/down_img6.gif"/></div> </div>
                      
                      <div class="ca-item ca-item-6"> <div class="ca-item-main"><img src="images/down_img7.gif"/></div> </div>
                      
                      <div class="ca-item ca-item-6"> <div class="ca-item-main"><img src="images/down_img8.gif"/></div> </div>
                      
                      <div class="ca-item ca-item-6"> <div class="ca-item-main"><img src="images/down_img9.gif"/></div> </div>
                      
                      <div class="ca-item ca-item-4"> <div class="ca-item-main"><img src="images/down_img4.gif"/></div> </div>
                    
                     <div class="ca-item ca-item-5"> <div class="ca-item-main"><img src="images/down_img5.gif"/></div> </div>
                    
                    
				  
				  
				  
				  
					
					
				</div>
			</div>
			</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
		<script type="text/javascript">
			$('#ca-container').contentcarousel();
		</script>
    </body>
</html>