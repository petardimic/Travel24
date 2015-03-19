<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="bpp0ROCVS3LPbXjA1yFatlXcJXu8PHHlhKPqCAgvyAk" />
<title>Hotels in,Luxury hotels,Cheap hotels,star hotels,best hotels | Travellingmart</title>

<meta name="description" content="Travellingmart provides online resevation for cheap hotels in Dubai,Hotels in Bahrain,Luxury hotels in Saudi Arabia,Best hotels in Kuwait,حجوزات فنادق , فنادق فاخرة بأسعار رخيصة">

<meta name="keywords" content="best luxury hotels in oman,Hotels in Bahrain,best hotels in Dubai,discount hotel in iraq,Cheap hotels in Kuwait,the best cheapest hotel in iran,best 7 star hotels in saudi,Luxury hotels in London,Hotels in Singapore,Hotels in Paris,Hotels in Hongkong,Hotels in Bangalore">

<meta name="robots" content="index,follow">
<?php $land_marks = $this->Home_Model->get_landmarks();
	$count_loc = count($land_marks); ?>
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

 <script>
function show_filter(id)
{
	$("#filter"+id).toggle('slow');
	$(this).show();
	
}
 
</script>
<!--header--><style type="text/css">
           
            #container .pagination ul li.inactive,
            #container .pagination ul li.inactive:hover{
                background-color:#e32121;
                color:#fff;
                border:1px solid #e32121;
                cursor: default;
            }
            #container .data ul li{
                list-style: none;
                font-family: verdana;
                margin: 5px 0 5px 0;
                color: #000;
                font-size: 13px;
            }

            #container .pagination{
                width: 736px;
                height: 25px;
            }
            #container .pagination ul li{
                list-style: none;
                float: left;
                border: 1px solid #e32121;
                padding: 2px 6px 2px 6px;
                margin: 0 3px 0 3px;
                font-family: arial;
                font-size: 14px;
                color: #e32121;
                font-weight: bold;
                background-color: #f2f2f2;
            }
            #container .pagination ul li:hover{
                color: #fff;
                background-color: #e32121;
                cursor: pointer;
            }
			.go_button
			{
			background-color:#f2f2f2;border:1px solid #f2f2f2;color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;position:absolute;margin-top:-1px;
			}
			.total
			{
			float:right;font-family:arial;color:#333; font-size:12px;
			}

        </style>
<?php if($this->session->userdata('memid') != '')
		{
			$this->load->view('member/header'); 
		}
		else
		{
			$this->load->view('header'); 
		}?>
<script type="text/javascript">

$(document).ready(function(){
 
	
	$('#loc_a').val('');
	$('#bord_type_a').val('');
	$("#hotelname").val('');
	 function loadData(page){

//           loading_show();                   
			var anand = $('#anand').val();
			var changed_cur1 = $('#changed_cur1').val(); 
			var sort_asc_data = $('#sort_asc_data').val();
			var sort_asc_type = $('#sort_asc_type').val();
			//alert(anand);
			//alert(changed_cur1);
			  var strs = $('#star_val').html();	
			  var count_loc = $('#count_loc').val();
			  var loc_a = $('#loc_a').val();
            $.ajax
            ({
                  type: "POST",
                   url: "<?php echo WEB_URL?>home/results",
				    data: "page="+page+"&star="+strs+"&loc_a="+loc_a+"&anand="+anand+"&changed_cur="+changed_cur1+"&sort_asc_data="+sort_asc_data+"&sort_asc_type="+sort_asc_type,
				   success: function(msg)
                   {
					 var msg = JSON.parse(msg);
				   $('#search_result_ajax_all').html(msg.hotel_search_result);
				    $('.pagination').html(msg.msg);
					$('#count').html(msg.count);
					$("#star").html(msg.hotel_search_star);
				   
				   }
             });
          }
		 
                loadData(1);  
				  $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);
                    
                });           
                $('#go_btn').live('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
				
				
				
});
 function loadData_sort(page)
 { $('#search_result_ajax_all').html('<div id="loading_show" style="text-align:center;"><img src="<?php echo WEB_DIR?>images/loading1.gif"/></div>');
			 $('.pagination').html('');
	 
	var anand = $('#anand').val();
	var changed_cur1 = $('#changed_cur1').val(); 
	var strs = $('#star_val').html();	
	var count_loc = $('#count_loc').val();
	var loc_a = $('#loc_a').val();
	var bord_type_a = $('#bord_type_a').val();
	var hotel = $("#hotelname").val();
	var sort_asc_data = $('#sort_asc_data').val();
	var sort_asc_type = $('#sort_asc_type').val();
	
    $.ajax
     ({
           type: "POST",
            url: "<?php echo WEB_URL?>home/results",
		    data: "page="+page+"&star="+strs+"&loc_a="+loc_a+"&anand="+anand+"&changed_cur="+changed_cur1+"&bord_type_a="+bord_type_a+"&hotel="+hotel+"&sort_asc_data="+sort_asc_data+"&sort_asc_type="+sort_asc_type,
		   success: function(msg)
            {
			 	var msg = JSON.parse(msg);
			   $('#search_result_ajax_all').html(msg.hotel_search_result);
				$('.pagination').html(msg.msg);
				$('#count').html(msg.count);
				$("#star").html(msg.hotel_search_star);
			   
		   	}
	 });
  }
  	function sort_asc(data,type)
	{
		$('#search_result_ajax_all').html('<div id="loading_show" style="text-align:center;"><img src="<?php echo WEB_DIR?>images/loading1.gif"/></div>');
		 $('.pagination').html('');
		$('#sort_asc_data').val(data);
		$('#sort_asc_type').val(type);
		loadData_sort(1);
	}
		function star_filter(strs)
		  {
			  $('#search_result_ajax_all').html('<div id="loading_show" style="text-align:center;"><img src="<?php echo WEB_DIR?>images/loading1.gif"/></div>');
			  var str = '';
			   $('.pagination').html('');
			  for(var k=0;k<=5;k++)
			  {
				  var tf=$('#star'+k).is(":checked");
				  if(tf)
				  {
					  str += k+','
				  }
			  }
			   $("#star_val").html(str);
			  loadData_sort(1);
		  }
		  function submit_board(board,i)
		  {
			  $('#search_result_ajax_all').html('<div id="loading_show" style="text-align:center;"><img src="<?php echo WEB_DIR?>images/loading1.gif"/></div>');
			   $('.pagination').html('');
			  var tf = $('#bord_type'+i).is(":checked");
			  if(tf)
			  {
				 	var bord_type1 = $('#bord_type_a').val();
					bord_type1 = bord_type1.replace(board," ");
					$('#bord_type_a').val(bord_type1);
			  }
			  else
			  {
				  var bord_type1 = $('#bord_type_a').val();
					if(bord_type1 != '')
					{
						 bord_type1 = bord_type1+board;
						$('#bord_type_a').val(bord_type1);
					}
					else
					{
						$('#bord_type_a').val(board);
					}
			 }

			 loadData_sort(1);
	  	  }
		  function get_location_results(loc,i,page)
		  {
			//  alert(i);
			$('#search_result_ajax_all').html('<div id="loading_show" style="text-align:center;"><img src="<?php echo WEB_DIR?>images/loading1.gif"/></div>');
			 $('.pagination').html('');
			  var tf=$('#loca'+i).is(":checked");
			  if(tf)
			  {
				  	var loc1 = $('#loc_a').val();
					loc1 = loc1.replace(loc," ");
					$('#loc_a').val(loc1);
			  }
			  else
			  {
				   var loc1 = $('#loc_a').val();
					if(loc1 != '')
					{
						 loc1 = loc1+loc;
						$('#loc_a').val(loc1);
					}
					else
					{
						$('#loc_a').val(loc);
					}
			  }
				  //alert('adsfasfd');
			  loadData_sort(1);
			 
		  }
		  /*function result_sort(page)
		  {
			 // alert(page);
			//alert("hiihi"); return false;
			  var strs = $('#star_val').html();	
			  var count_loc = $('#count_loc').val();
			  var loc_a = $('#loc_a').val();	
			 $.ajax
				({
					
					  type: "POST",
					   url: "<?php echo WEB_URL?>home/results_sort",
					   data: "page="+page+"&star="+strs+"&loc_a="+loc_a,
					   success: function(msg)
					   {
						 var msg = JSON.parse(msg);
					   $('#search_result_ajax_all').html(msg.hotel_search_result);
						$('.pagination').html(msg.msg);
						$('#count').html(msg.count);
						$("#star").html(msg.hotel_search_star);
					   
					   }
				 });
				 page = Number(page)+1;
				// alert(page);
				 result_sort(page);
		  
		  }*/
		  function get_byhotelname(page)
		  {
			 
			  var hotel = $("#hotelname").val();			   
		  }
		  /*function get_landmarks(location)
			{
					var count_loc = $("#count_loc").val();
					//alert(location);
				   $.ajax
						({
							  type: "POST",
							   url: "<?php echo WEB_URL?>home/hotel_location_results",
							   data: "page="+page+"count_loc="+count_loc+"loca="+lcoation,
							   success: function(msg)
							   {
								  
								 var msg = JSON.parse(msg);
							   $('#search_result_ajax_all').html(msg.hotel_search_result);
								$('.pagination').html(msg.msg);
								$('#count').html(msg.count);
								$("#star").html(msg.hotel_search_star);
							   
							   }
						 });
					  
			}*/
</script>
<!--header-->



<!--main-->
<div class="wrapper">
<input type="hidden" id="anand" value="<?php echo $anand?>"/>
<input type="hidden" id="loc_a" />
<input type="hidden" id="bord_type_a"/>
<input type="hidden" id="sort_asc_data"/>
<input type="hidden" id="sort_asc_type"/>
<input type="hidden" id="changed_cur1" value="<?php echo $changed_cur?>"/>
<div style="margin:auto; width:1000px; height:auto;">

<div class="main">
 
 <span  id="star_val" style="display:none;"></span>

<!--leftside-->
<div class="rollover" style="margin:25px 0px 5px 50px; font-size:13px; color:#e62424;"><a href="<?php echo WEB_URL ?>home/index">Home</a>&nbsp; > &nbsp;<a href="<?php echo WEB_URL ?>home/hotel_search">Hotel Search</a> &nbsp;>&nbsp; Hotels in <?php echo $this->session->userdata('disp_city'); ?></div>

<div class="leftsearch" >
  <div style="float:left; margin-left:2px;">
    <div style="float:left; height:10px;"></div>
      <div style="clear:both;"></div>
      
      
      
       
      
    </div>
      
      
      <div class="filterbg">Filter search</div>
      <div class="filtercenterbg">
        <div style="float:left; margin-left:10px;">
          <?php /*?><div style="float:left; margin:10px 0px 10px 0px;"><img src="<?php echo WEB_DIR ?>images/minus.png" /><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin-left:10px; "><strong>Price Range: </strong>:</span></div><?php */?>
      <div style="clear:both;"></div>
      <div style="border:1px #e0e0e0 solid; width:188px;">
        <form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0" cellspacing="0" cellpadding="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;">
            <tr>
              <td colspan="2" align="center" valign="middle"><?php /*?><img src="<?php echo WEB_DIR ?>images/scroll.png" width="177" height="44" /><?php */?></td>
            </tr>
            </table>
        </form>
      </div>
      
    </div>
      <div style="float:left; margin-left:10px;">
      <div style="float:left; margin:10px 0px 10px 0px;"><img src="<?php echo WEB_DIR ?>images/minus.png" /><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin-left:10px; "><strong>Seacrh by Hotel Name</strong>:</span></div>
      <div style="clear:both;"></div>
      <div style="border:1px #e0e0e0 solid; width:188px;">
              <table width="100%" border="0" cellspacing="2" cellpadding="4" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000;">
            <tr>
              <td width="15" align="left">
                <input type="text" name="hotelname" id="hotelname"  style="border:1px #CCC solid; width:137px; padding:2px; margin-left:5px;"/></td>
              <td><span style="float:left; margin:10px 0px 10px 0px; cursor:pointer;"><img src="<?php echo WEB_DIR ?>images/go.png" id="hotel_go" onclick="loadData_sort(1);" /></span></td>
            
            </tr>
          </table>
      </div>
      
      
      
      
      
      </div>
      
      <script type="text/javascript">
	
		 $(document).ready(function(){
		  $("#hotel_star").find("input").click(function()
            {
				var star_sel = $('#star_sel').val();
                var val=this.value;
                var tf=$(this).is(":checked");
				if(tf == true)
				{
					if(star_sel)
					{
                		val = star_sel+','+val;
					}
					else
					{
						val =val;
					}
					$('#star_sel').val(val);
				}
				else
				{
					var star_sel = $('#star_sel').val();
					if(star_sel.indexOf(val) != -1)
					{
						val1 = ','+val;
						if(star_sel.indexOf(val1) != -1)
						{
							var n =star_sel.replace(val1,'');
						}
						else
						{
							var n =star_sel.replace(val,'');
						}
					}
					$('#star_sel').val(n);
				}
				
				var star_sel = $('#star_sel').val();
				//alert(star_sel);
				$.ajax({
					type:"POST",
					url:"<?php echo WEB_URL?>home/hotel_search_filter",
					async:false,
					data:"star=" + star_sel,
					cache:false,
					success:function(response){
					//alert(response);return false;
						//var res = response.split('@');
						//$('#sort_avail').html(res[0]);
						$('#search_result_ajax_all').html(response);
							}
				});
            });
			$("#hotel_go").click(function(){
				var hotel_name = $('#hotel_name').val();
				$.ajax({
					type:"POST",
					url:"<?php echo WEB_URL?>home/hotel_search_filter",
					async:false,
					data:"hotel_name=" + hotel_name,
					cache:false,
					success:function(response){
					//alert(response);return false;
						//var res = response.split('@');
						//$('#sort_avail').html(res[0]);
						$('#search_result_ajax_all').html(response);
							}
				});
			});
			
			});
		 });
	  </script>
       <input type="hidden" name="star_sel" id="star_sel" value="0,1,2,3,4,5" />
      <div style="float:left; margin-left:10px;">
      <div style="float:left; margin:10px 0px 10px 0px;"><img src="<?php echo WEB_DIR ?>images/minus.png" /><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin-left:10px; "><strong>Star rating</strong>:</span></div>
      <div style="clear:both;"></div>
      <div style="border:1px #e0e0e0 solid; width:188px;" id="star">
        
          
      </div>
      
      
      
      
      
      </div>
      
      
      
      

      
      
      
      
      
      <?php /*?><div style="float:left; margin-left:10px;">
      <div style="float:left; margin:10px 0px 10px 0px;"><img src="<?php echo WEB_DIR ?>images/minus.png" /><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin-left:10px; "><strong>Hotel Facilities</strong>:</span></div>
      <div style="clear:both;"></div>
      <div style="border:1px #e0e0e0 solid; width:188px;">
        <form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0" cellspacing="2" cellpadding="4" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000;">
            <tr>
              <td width="15" align="left"><input name="aimatlabel6" value="ai" id="aimatlabel8" checked="checked" onclick="airlinefilter(this.value,this.checked,'airline')" type="checkbox" /></td>
              <td>Bayswater - Paddington</td>
            </tr>
            <tr>
              <td align="left"><input name="aimatlabel6" value="ai" id="aimatlabel8" checked="checked" onclick="airlinefilter(this.value,this.checked,'airline')" type="checkbox" /></td>
              <td>Kensington - Earl's Court</td>
            </tr>
            <tr>
              <td align="left"><input name="aimatlabel2" value="ai" id="aimatlabel2" checked="checked" onclick="airlinefilter(this.value,this.checked,'airline')" type="checkbox" /></td>
              <td>Bloomsbury - Soho</td>
            </tr>
            <tr>
              <td align="left"><input name="aimatlabel3" value="ai" id="aimatlabel3" checked="checked" onclick="airlinefilter(this.value,this.checked,'airline')" type="checkbox" /></td>
              <td>Victoria - Westminster</td>
            </tr>
            <tr>
              <td align="left"><input name="aimatlabel4" value="ai" id="aimatlabel4" checked="checked" onclick="airlinefilter(this.value,this.checked,'airline')" type="checkbox" /></td>
              <td>Mayfair - Marylebone</td>
            </tr>
          </table>
        </form>
      </div>
      
      
      
      
      
      </div><?php */?>
      
      <div style="float:left; margin-left:10px;">
      <div style="float:left; margin:10px 0px 10px 0px;"><img src="<?php echo WEB_DIR ?>images/minus.png" /><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin-left:10px; "><strong>Accommodation type</strong>:</span></div>
      <div style="clear:both;"></div>
      <div style="border:1px #e0e0e0 solid; width:188px;">
      
       <?php /*?> <form id="form1" name="board" method="post" action="<?php echo WEB_URL ?>home/hotel_board_results"><?php */?>
          <table width="100%" border="0" cellspacing="2" cellpadding="2" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000;">
          <?php $board_types = $this->Home_Model->get_board_types(); ?>
          <input type="hidden" name="board_count" value="<?php echo count($board_types); ?>"  />
          <?php $i = 1; if(isset($board_types)) { if($board_types != '') { foreach($board_types as $bd) { ?>
            <tr>
              <td width="15" align="left"><input name="bord_type<?php echo $i; ?>" value="<?php echo $bd->plan_type.","; ?>" id="bord_type<?php echo $i; ?>" onclick="return submit_board(this.value,'<?php echo $i?>');" type="checkbox" /></td>
              <td><?php if($bd->plan_type == 'BB' || $bd->plan_type == 'Bed & Breakfast') 
			  		{
						echo "Bed And Breakfast";
					}
					elseif($bd->plan_type == 'RO' || $bd->plan_type== 'Room Only')
					{
						echo "Room Only";	
					}
					elseif($bd->plan_type == 'CB')
					{
						echo "Continental Breakfast";	
					}
					elseif($bd->plan_type == 'AI')
					{
						echo "All Inclusive";	
					}
					elseif($bd->plan_type == 'FB')
					{
						echo "Full Board";	
					}
					elseif($bd->plan_type == 'HB')
					{
						echo "Half Board";	
					}
					elseif($bd->plan_type == 'BD')
					{
						echo "Bed And Dinner";	
					}
					elseif($bd->plan_type == 'Bed & Continental Breakfast')
					{
						echo "Bed & Continental Breakfast";	
					}
					elseif($bd->plan_type == 'Room and Breakfast (English Buffet Breakfast)')
					{
						echo "Room and Breakfast (English Buffet Breakfast)";
					}?></td>
            </tr>
            <?php $i++; } } } ?>
           <!-- <tr>
              <td align="left"><input name="aimatlabel6" value="ai" id="aimatlabel8" checked="checked" onclick="airlinefilter(this.value,this.checked,'airline')" type="checkbox" /></td>
              <td>Hotel</td>
            </tr>
            <tr>
              <td align="left"><input name="aimatlabel2" value="ai" id="aimatlabel2" checked="checked" onclick="airlinefilter(this.value,this.checked,'airline')" type="checkbox" /></td>
              <td>Resort</td>
            </tr>
            <tr>
              <td align="left"><input name="aimatlabel3" value="ai" id="aimatlabel3" checked="checked" onclick="airlinefilter(this.value,this.checked,'airline')" type="checkbox" /></td>
              <td>Vacation home / Condo</td>
            </tr>-->
          </table>
       <?php /*?> </form><?php */?>
      </div>
      
      
      
      
      
      </div>
      
      <div style="float:left; margin-left:10px;">
      <div style="float:left; margin:10px 0px 10px 0px; border-bottom:1px #999 dashed; width:187px; cursor:pointer; padding-bottom:5px;" id="click" onclick="show_filter(1);"><img src="<?php echo WEB_DIR ?>images/minus.png" /><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin-left:10px; "><strong>Location</strong>:</span></div>
      <div style="clear:both;"></div>
      <div style="border:1px #e0e0e0 solid; width:188px; display:none;" id="filter1" >
      <script type="text/javascript">
	/*/  function get_location_results()
	  {
		  document.location_form.submit();
	  }*/
	  </script>
        <?php /*?><form id="form1" name="location_form" method="post" action="<?php echo WEB_URL ?>home/hotel_location_results"><?php */?>
        <span id="location"></span>
          <table width="100%" border="0" cellspacing="2" cellpadding="4" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000;">
          
          <input type="hidden" value="<?php echo count($land_marks); ?>" name="count_loc" id="count_loc"  />
          <?php $i = 1; if(isset($land_marks)) { if($land_marks != '') { foreach($land_marks as $lnd) { ?>
            <tr>
              <td width="15" align="left" valign="top"><input name="loca<?php echo $i; ?>" value="<?php echo $lnd->location."@"; ?>" id="loca<?php echo $i; ?>" onclick="return get_location_results(this.value,<?php echo $i?>,1);" type="checkbox" /></td>
              <td><?php echo $lnd->location; ?></td>
            </tr>
            <?php $i++;
			} } } ?>
          </table>
        <?php /*?></form><?php */?>
      </div>
      
      
      
      
      
      </div>
      
      
      
      
      
      
      
      
      <div style="float:left; margin-left:10px;">
      <div style="float:left; margin:10px 0px 10px 0px;"><img src="<?php echo WEB_DIR ?>images/minus.png" /><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; margin-left:10px; "><strong>My last viewed hotels</strong>:</span></div>
      <div style="clear:both;"></div>
      <div style="border:1px #e0e0e0 solid; width:188px;">
        <form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0" cellspacing="12" cellpadding="4"  style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000;">
          <?php $hotels = $this->Home_Model->last_view_hotel(); ?>
          <?php if(isset($hotels)) { if($hotels != '') { foreach($hotels as $las) { ?>
            <tr>
              <td colspan="2"><?php /*?><a href="<?php echo WEB_URL ?>home/prop_detail/<?php echo $las->hotelid; ?>/<?php echo $las->Name; ?>/goglobal"><?php */?> <?php echo $las->Name; ?> <?php $star_rate = $las->stars; 
			if($star_rate == '1')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active1.png" /> 
                <?php
			}
			elseif($star_rate == '2')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active2.png" /> 
                <?php
			}
			elseif($star_rate == '3')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active3.png" /> 
                <?php
			}
			elseif($star_rate == '4')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active4.png" /> 
                <?php
			}
			elseif($star_rate == '5')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active5.png" /> 
                <?php
			}
			else
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active0.png" /> 
                <?php
			}?></a>
        </td>
            </tr>
            <?php } } } ?>
           <!-- <tr>
              <td colspan="2">Siam Square</td>
            </tr>
            <tr>
              <td colspan="2">Pratunam Market</td>
            </tr>
            <tr>
              <td colspan="2">Bangkok Don Mueang Intl. Airport</td>
            </tr>
            <tr>
              <td colspan="2">Mayfair - Marylebone</td>
            </tr>-->
          </table>
        </form>
      </div>
      
      
      
      
      
      </div>
      
      
      
      
      
      </div>
      <div class="filterbottombg"></div>
      
     
  </div>
<!--leftside-->



<!--rigtside-->
 
 
<script type="text/javascript">
function modify()
{
	$("#modify").toggle('slow');
}
</script>
 
    
     
    
     <div class="right_search_result1">
    <div>
   <div class="left_part_fiiglt1" style="width:733px;">We found <span id="count" style="color:#e62424;"></span> hotels with availability in <span style="color:#e62424;"><?php echo $this->session->userdata('disp_city').", ".$this->session->userdata('disp_country'); ?></span><a href="#"><span style="float:right; border-radius:5px; padding:5px; font-size:12px; color:#e62424; border:1px solid #e66363;"><span style="font-size:14px;" >+</span>&nbsp;&nbsp;<span onclick="modify();">Modify Search</span></span></a></div>
   
   <!--left_part_fiiglt-->
   
   <div id="modify" style="float:left; color:#e62424; border:1px solid #e98585; border-radius:5px; background-color:#f8f8f8; font-size:11px; width:739px; margin:10px 0px 0px 16px; display:none;">
   <table width="100%" border="0" cellspacing="15" cellpadding="0" style="float:left;">
  <tr>
    <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td>City</td>
        <td>Check-in Date</td>
        <td>Check-out Date</td>
        <td>Rooms</td>
        <td>Adult(s)</td>
        <td>Children(s)</td>
      </tr>
      <tr>
        <td><input name="hotel_city" type="text" class="field" id="city"  style="width:150px;" /></td>
        <td><span class="sub_input_bg2">
          <input name="sd_hotel" type="text"  value=""  class="datefield"   id="sd_hotel"/>
        </span></td>
        <td><span class="sub_input_bg2">
          <input name="sd_hotel2" type="text"  value=""  class="datefield"   id="sd_hotel2"/>
        </span></td>
        <td><select name="room_count" id="room_count" style="width:60px;"  class="field" onchange="display_rooms(this.value);" >
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select></td>
        <td><select name="adult[]" id="adult" style="width:60px; " class="field" >
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select></td>
        <td><select name="child[]" id="child" style="width:60px;"  class="field" >
          <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2" align="right"><span style="padding-top:7px; float:right;"><a href="#"><img src="<?php echo WEB_DIR ?>images/modify_search.png" border="0" /></a></span></td>
        </tr>
    </table></td>
  </tr>
</table>

</div>
</div>
   <div style="clear:both;"></div><!--prv_next-->
<div id="container" style="width:736px;">
            <div class="data"></div>
            <div class="pagination" style="margin:15px 10px 15px 15px; width:736px;"></div>
        </div>
        <div style="clear:both;"></div>
    <div class="sort">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="70" height="33" align="center" valign="middle" style=" color:#FFF; font-size:14px;">Sort by:</td>
          <td width="70" align="center" valign="middle" class="sortlinks" style="cursor:pointer;"><span id="star_sort" ><img src="<?php echo WEB_DIR?>images/up.png" style="padding-right:2px; cursor:pointer;" onclick="return sort_asc('star_rate','ASC');" title="Ascending Order of Stars"/>Stars<img src="<?php echo WEB_DIR?>images/down.png" style="padding-left:2px; cursor:pointer;" onclick="return sort_asc('star_rate','DESC');" title="Descending Order of Stars"/></span></td>
          <td width="1" align="center" valign="middle" bgcolor="#a0e0fb"></td>
          <td width="70" align="center" valign="middle" class="sortlinks"><img src="<?php echo WEB_DIR?>images/up.png" style="padding-right:2px; cursor:pointer;" onclick="return sort_asc('cost_value','ASC');" title="Ascending Order of Price"/>Price<img src="<?php echo WEB_DIR?>images/down.png" style="padding-left:2px; cursor:pointer;" onclick="return sort_asc('cost_value','DESC');" title="Descending Order of Price"/></td>
          <td width="1" align="center" valign="middle" bgcolor="#a0e0fb"></td>
          <td width="130" align="center" valign="middle" class="sortlinks"><img src="<?php echo WEB_DIR?>images/up.png" style="padding-right:2px; cursor:pointer;" onclick="return sort_asc('Rating','ASC');" title="Ascending Order of Review"/>Review Score<img src="<?php echo WEB_DIR?>images/down.png" style="padding-left:2px; cursor:pointer;" onclick="return sort_asc('Rating','DESC');" title="Descending Order of Review"/></td>
          <td width="1" align="center" valign="middle" bgcolor="#a0e0fb"></td>
          <td width="100" align="center" valign="middle" class="sortlinks"><img src="<?php echo WEB_DIR?>images/up.png" style="padding-right:2px; cursor:pointer"/ onclick="return sort_asc('location','ASC');" title="Ascending Order of Location">Location<img src="<?php echo WEB_DIR?>images/down.png" style="padding-left:2px; cursor:pointer;" onclick="return sort_asc('location','DESC');" title="Descending Order of Location" /></td>
          <td width="1" align="center" valign="middle" bgcolor="#a0e0fb"></td>
          <td align="center" valign="middle">&nbsp;</td>
          </tr>
      </table>
    </div>
    
    <div class="search_result1"><!--six_tab-->
   
    <div class="flight_resutl_full contents" id="search_result_ajax_all"  >
    <div id="loading_show" style="text-align:center;"><img src="<?php echo WEB_DIR?>images/loading1.gif"/></div>
   <!--flight_result-->
    
    <?php /*if(isset($results)) { if($results != '') { foreach($results as $row) { 
	
	$address = $this->Home_Model->get_address($row->hotel_id); ?>
    <span style="display:none;"><?php echo $row->star_rate; ?></span>
   <div class="hotel_result1 " >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <?php $image = $row->image_url;
	  		if($image != '')
			{
				$image = $image;
			}
			else
			{ 
				$image = WEB_DIR.'images/noImageAvailable.jpg';
			} ?>
      <td width="150" align="left" valign="top" ><img src="<?php echo $image; ?>" style="border-radius:5px;"  width="132" height="88"  /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;"><?php echo $row->hotel_name; ?></td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;">
       	<?php $star_rate = $row->star_rate; 
			if($star_rate == '1')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active1.png" /> 
                <?php
			}
			elseif($star_rate == '2')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active2.png" /> 
                <?php
			}
			elseif($star_rate == '3')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active3.png" /> 
                <?php
			}
			elseif($star_rate == '4')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active4.png" /> 
                <?php
			}
			elseif($star_rate == '5')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active5.png" /> 
                <?php
			}
			else
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active0.png" /> 
                <?php
			}?>
        
        </span></td>
      </tr>
      <tr>
        <td height="18" style="color:#202020; font-size:12px;"><?php echo $row->location; ?>, <?php echo $row->description; ?></td>
      </tr>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><?php if($row->Rating != '') { ?><a href="#"><?php echo $row->Rating; ?>/5 Excellent&nbsp;</a><?php } ?> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="105" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b>&#163; <?php echo $row->nightperroom + ($row->nightperroom *10)/100 ; ?></b> <br /> </span> 
     <span style="color:#e62424; font-size:20px; font-family:Arial, Helvetica, sans-serif;"><b>&#163; <?php echo $row->nightperroom; ?></b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per Night)</span><br />
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/<?php echo $row->hotel_id; ?>/<?php echo $row->hotel_name; ?>"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span></td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div> 
    
    <?php } } } */?>
    
   
   
   
   
   
  <?php /*?> <div class="hotel_result1"  >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <td width="150" align="left" valign="top" ><img src="<?php echo WEB_DIR ?>images/destination1.png" style="border-radius:5px;"   /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;">The strand Place</td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;"><img src="<?php echo WEB_DIR ?>images/hotels/star.jpg" /></span></td>
      </tr>
      <tr>
        <td height="18" style="color:#202020; font-size:12px;">Silom - Sathorn, 1800 103 3336 (India Toll Free)</td>
      </tr>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><a href="#">4.2/5 Excellent&nbsp;(1,005 reviews)</a> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="105" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b>Rs.3,078</b> <br /> </span> 
     <span style="color:#e62424; font-size:20px; font-family:Arial, Helvetica, sans-serif;"><b>Rs.5,078</b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per Night)</span><br />
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/1/holiday"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span></td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div>
    <div class="hotel_result1"  >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <td width="150" align="left" valign="top" ><img src="<?php echo WEB_DIR ?>images/destination1.png" style="border-radius:5px;"   /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;">The strand Place</td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;"><img src="<?php echo WEB_DIR ?>images/hotels/star.jpg" /></span></td>
      </tr>
      <tr>
        <td height="18" style="color:#202020; font-size:12px;">Silom - Sathorn, 1800 103 3336 (India Toll Free)</td>
      </tr>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><a href="#">4.2/5 Excellent&nbsp;(1,005 reviews)</a> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="105" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b>Rs.3,078</b> <br /> </span> 
     <span style="color:#e62424; font-size:20px; font-family:Arial, Helvetica, sans-serif;"><b>Rs.5,078</b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per Night)</span><br />
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/1/holiday"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span></td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div>
    <div class="hotel_result1"  >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <td width="150" align="left" valign="top" ><img src="<?php echo WEB_DIR ?>images/destination1.png" style="border-radius:5px;"   /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;">The strand Place</td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;"><img src="<?php echo WEB_DIR ?>images/hotels/star.jpg" /></span></td>
      </tr>
      <tr>
        <td height="18" style="color:#202020; font-size:12px;">Silom - Sathorn, 1800 103 3336 (India Toll Free)</td>
      </tr>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><a href="#">4.2/5 Excellent&nbsp;(1,005 reviews)</a> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="105" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b>Rs.3,078</b> <br /> </span> 
     <span style="color:#e62424; font-size:20px; font-family:Arial, Helvetica, sans-serif;"><b>Rs.5,078</b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per Night)</span><br />
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/1/holiday"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span></td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div>
    <div class="hotel_result1"  >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <td width="150" align="left" valign="top" ><img src="<?php echo WEB_DIR ?>images/destination1.png" style="border-radius:5px;"   /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;">The strand Place</td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;"><img src="<?php echo WEB_DIR ?>images/hotels/star.jpg" /></span></td>
      </tr>
      <tr>
        <td height="18" style="color:#202020; font-size:12px;">Silom - Sathorn, 1800 103 3336 (India Toll Free)</td>
      </tr>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><a href="#">4.2/5 Excellent&nbsp;(1,005 reviews)</a> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="105" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b>Rs.3,078</b> <br /> </span> 
     <span style="color:#e62424; font-size:20px; font-family:Arial, Helvetica, sans-serif;"><b>Rs.5,078</b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per Night)</span><br />
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/1/holiday"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span></td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div>
    <div class="hotel_result1"  >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <td width="150" align="left" valign="top" ><img src="<?php echo WEB_DIR ?>images/destination1.png" style="border-radius:5px;"   /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;">The strand Place</td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;"><img src="<?php echo WEB_DIR ?>images/hotels/star.jpg" /></span></td>
      </tr>
      <tr>
        <td height="18" style="color:#202020; font-size:12px;">Silom - Sathorn, 1800 103 3336 (India Toll Free)</td>
      </tr>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><a href="#">4.2/5 Excellent&nbsp;(1,005 reviews)</a> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="105" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b>Rs.3,078</b> <br /> </span> 
     <span style="color:#e62424; font-size:20px; font-family:Arial, Helvetica, sans-serif;"><b>Rs.5,078</b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per Night)</span><br />
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/1/holiday"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span></td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div>
    <div class="hotel_result1"  >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <td width="150" align="left" valign="top" ><img src="<?php echo WEB_DIR ?>images/destination1.png" style="border-radius:5px;"   /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;">The strand Place</td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;"><img src="<?php echo WEB_DIR ?>images/hotels/star.jpg" /></span></td>
      </tr>
      <tr>
        <td height="18" style="color:#202020; font-size:12px;">Silom - Sathorn, 1800 103 3336 (India Toll Free)</td>
      </tr>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><a href="#">4.2/5 Excellent&nbsp;(1,005 reviews)</a> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="105" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b>Rs.3,078</b> <br /> </span> 
     <span style="color:#e62424; font-size:20px; font-family:Arial, Helvetica, sans-serif;"><b>Rs.5,078</b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per Night)</span><br />
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/1/holiday"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span></td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div><?php */?>
  </div> 
  
  

           
 
 


 
  
  
   
  
   
  
   

</div><!--search_result-->

 
</div>   

 
 




<!--rigtside-->

 
</div>

</div>


<!--main-->


<?php /*?><div style="float:left; margin-top:20px;  "><?php $this->load->view('right_banner'); ?></div><?php */?>


</div>




 <!--footer-->
    
	<?php $this->load->view('footer'); ?>
	
    
    <!--footer-->

</body>
</html>
