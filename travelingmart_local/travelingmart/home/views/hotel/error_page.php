<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="bpp0ROCVS3LPbXjA1yFatlXcJXu8PHHlhKPqCAgvyAk" />
<title>travellingmart ! Luxury hotels and resorts,cheap hotel rooms,book hotels online</title>

<meta name="description" content="Travellingmart for Best hotels & resorts in dubai,cheap accommodation in oman,Top hotels in qatar,best resorts in oman & bahrain,best luxury hotels in iraq,Spa luxury hotels in qatar">

<meta name="keywords" content="budget hotels in iran,the best cheapest hotel in dubai,the best 7 star hotels in saudi arabia,the best luxury hotels in oman,Nice hotels in iraq, special rate hotels in bahrain,5 star hotels in oman,best small hotels in saudi">

<meta name="robots" content="index,follow">
<script src="<?php print WEB_DIR ?>SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="<?php print WEB_DIR ?>SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />


<body class="body-visible">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44964359-1']);
  _gaq.push(['_setDomainName', 'travellingmart.com']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
 <?php /*?><ul id="exampleMenu">
            <li ><a href="<?php echo WEB_URL ?>home/index">Home</a></li>
            
        </ul><?php */?>
<!--header-->

<?php if($this->session->userdata('memid') != '')
		{
			$this->load->view('member/header'); 
		}
		else
		{
			$this->load->view('header'); 
		}?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44759003-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!--header-->



<!--main-->
<div class="wrapper">

<div style="float:left; width:1335px; height:auto;">
<div class="main">

<div class="banner_shadow"><img src="<?php print WEB_DIR ?>images/banner_shadow.png" border="0"></div>

<!--leftside-->

<!--leftside-->



<!--rigtside-->
<div class="right_side">


 
    
     <span style="color:#B70000; font-size:18px; font-weight:bold; padding-top:100px;"><?php echo $errordesc; ?>
      <a href="<?php echo WEB_URL ?>home/index" style="text-decoration:none;"><img src="<?php echo WEB_DIR ?>images/back.png" border="0"  /></a></span>
    
        
    
    
 





<!--rigtside-->


</div>



  <div style="clear:both;"></div>

                      
</div>




<!--main-->


<div style="float:left; margin-top:20px;  "><?php $this->load->view('right_banner'); ?></div>
</div>

</div>




 <!--footer-->
    
	<?php $this->load->view('footer'); ?>
	
    
    <!--footer-->

<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
    </script>
</body>
</html>
