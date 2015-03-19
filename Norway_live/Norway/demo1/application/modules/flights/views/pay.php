<?php 

?>
<html>
    <head>
        <title>DSS Travels</title>
        <style>	
            .load_box{
                width:600px;
                height:260px;
                background:#FFF;
                border:1px solid #AAA;
                margin:116px auto;	
                box-shadow:1px 0px 9px #333333
            }
            .middle_box{
                width:484px;
                height:412px;
                margin: 0 auto;
                background:#FF;

            }
            .normall{
                font-family:Arial, Helvetica, sans-serif;
                font-size:14px;
                color:#212121;
                font-weight:bold;
                color: gray;
                margin-top:10px;
                text-align:center;
            }
        </style>
        <script type="text/javascript">
            function submitform()
            {
               //alert('hi');
                document.payment.submit();
            }
        </script>
    </head>

    <body onLoad="submitform()">
	<form name="payment" method="post" action="<?php echo site_url(); ?>/flights/send_perform_request">
		<table border="1" align="center"  width="300">

		<tr>
			<td><input type="hidden" name="MTrackid" size="25" value="<?php echo $mtrackid; ?>" ></td>
		</tr>
		
	<td colspan="100" align="center"><input type="submit" value="  Submit  "></td>
	</tr>
	<tr>
	<th colspan="50" bgcolor="brown" height="15"></th>
	</tr>
</table>

			
            
        </form>

        <div class="load_box">
            <div class="middle_box">
                <div align="center" style="width:100%; float:left;"><img src="images/logo.jpg" style="margin-top:12px;"/></div>
                <div class="normall" align="center" style="width:100%; float:left; margin-top:20px;">You are currently redirecting to the payment gateway page.</div>
                <div align="center" style="width:100%; float:left;"><img src="images/loading.gif" style="margin-top:12px;"/></div>            
            </div></div>
    </body>
</html>
