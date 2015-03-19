<style type="text/css">
body{
	color:#333;}
</style>

    <script language="javascript" type="text/javascript">

        function highlight(section, active) {
            if (active == true)
                $(".matri" + section).css("background-color", "#c9c7c7");
            else
                $(".matri" + section).css("background-color", "");
        }
</script>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="<?php echo base_url(); ?>assets/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>


<body> <div style=" background-color:#FFF; margin:0px 10px 0 15px; font-size:11px; position:absolute;"  >All Stops <img src="<?php echo base_url();?>assets/images/price-arrow.png" /></div>
<div id="TabbedPanels1" class="TabbedPanels">

  <ul class="TabbedPanelsTabGroup">
 
    <li class="TabbedPanelsTab" tabindex="0">All Stops</li>
    <li class="TabbedPanelsTab" tabindex="0">Non Stop</li>
     <li class="TabbedPanelsTab" tabindex="0">1 Stop</li>
    <li class="TabbedPanelsTab" tabindex="0">Multi Stops</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent" >
    
    
  
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  >
  <tr>
    <td width="140" align="left" valign="top"><table width="140" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#e7f5fd" class="matrix_fixed_part_main">
      <tr>
        <td height="30" align="center"  class="text13">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle"  class="text13"><div style="color:#15538a;">Time Span <img src="<?php echo base_url();?>assets/images/down_arrow_tab.png" /></div></td>
      </tr>
      <tr>
        <td align="center"><div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Morning</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; font-size:11px; line-height:30px;">Afternoon</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; font-size:11px; line-height:30px;">Night</div>
          <div class="matri" onClick="selectFilterOneTime('chkMorning')" onMouseOver="highlight('mrn',true)" onMouseOut="highlight('mrn',false)"  >Mid Night</div></td>
      </tr>
    </table></td>
    <td align="left" valign="top">
    
  <div id="mcts1">
   <?php
   $matrix=array();	
   if(isset($flight_result)) 
   { 
        if($flight_result != '') 
        { 
            foreach($flight_result as $row) 
            {  
                if($row->stops==0)
                {
                        $matrix['cicode'][]=$row->cicode;
                        $matrix['name'][]=$row->name;
                }
                else
                {	
                        $stops=$row->stops;
                        $cicode=explode('<br>',$row->cicode);
                        $name=explode('<br>',$row->name);
                        $matrix['cicode'][]=$cicode[0];
                        $matrix['name'][]=$name[0];
                }
            }
         }
     }	
	
	$array=array_unique($matrix['cicode']);
	$array1=array_unique($matrix['name']);
	//echo '<pre />';print_r($array);echo '<pre />';print_r($array1);die;
	
	foreach($array as $key=>$val)
	{
		 $morning_rates = $this->Flights_Model->morning_rates($val,$session_id,$akbar_session);
                // print_r($morning_rates);echo '<<<>>>';die;
		 $afternoon_rates = $this->Flights_Model->afternoon_rates($val,$session_id,$akbar_session);
		 $night_rates = $this->Flights_Model->night_rates($val,$session_id,$akbar_session);
		 $midnight_rates = $this->Flights_Model->midnight_rates($val,$session_id,$akbar_session);
		 ?>
				<a href="#"><div class="matrix_tab airline_nm" name="airline_filter">
				
				<table width="100" border="0" align="left" cellpadding="0" cellspacing="0">
				  <tr>
					<td align="center" valign="top">
                      
                   
                   	 
                    <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
						<td height="32" align="center" bgcolor="#FFFFFF"><img src="<?php echo base_url();?>assets/airline_logo/<?php echo $val; ?>.gif" border="0" /></td>
					  </tr>
					  <tr>
						<td align="center" bgcolor="#C0E4F6" height="30px"><span class="text13" style="font-size:11px; color:#114879; line-height:15px; "><?php echo($array1[$key]=='Nacil Air India'?'Air India':$array1[$key]); ?></span></td>
					  </tr>
					  <tr>
						<td align="center" class="matri" onClick="filter_matrix('<?php echo $morning_rates->FareAmount; ?>');"><?php if(isset($morning_rates)) { if($morning_rates != '') { echo "&#36;".$morning_rates->FareAmount; } else { echo '-'; } }?></td>
					  </tr>
					  <tr>
						<td align="center"  class="matri" onClick="filter_matrix('<?php echo $afternoon_rates->FareAmount; ?>');"><?php if(isset($afternoon_rates)) { if($afternoon_rates != '') { echo "&#36;".$afternoon_rates->FareAmount; } else { echo '-'; } }?></td>
					  </tr>
					  <tr>
						<td align="center"  class="matri" onClick="filter_matrix('<?php echo $night_rates->FareAmount; ?>');"><?php if(isset($night_rates)) { if($night_rates != '') { echo "&#36;".$night_rates->FareAmount; } else { echo '-'; } } ?></td>
					  </tr>
					  <tr>
						<td align="center" class="matri" onClick="selectFilterOneTime('chkMorning'),filter_matrix('<?php echo $midnight_rates->FareAmount; ?>');" onMouseOver="highlight('mrn',true)" onMouseOut="highlight('mrn',false)" ><?php if(isset($midnight_rates)) { if($midnight_rates != '') { echo "&#36;".$midnight_rates->FareAmount; } else { echo '-'; } }?></td>
					  </tr>
					  </table>
                       
            
                      </td>
				  </tr>
				</table>
               
				</div></a>
  <?php  } ?>
 
      </div>
    </td>
  </tr>
</table>


    </div>
    <div class="TabbedPanelsContent">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="140" align="left" valign="top"><table width="140" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#e7f5fd" class="matrix_fixed_part_main">
      <tr>
        <td height="30" align="center"  class="text13">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle"   class="text13"><div style="color:#15538a;">Time Span <img src="<?php echo base_url();?>assets/images/down_arrow_tab.png" /></div></td>
      </tr>
      <tr>
        <td align="center"><div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Morning</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Afternoon</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Night</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Mid Night</div></td>
      </tr>
    </table></td>
    <td align="left" valign="top">
    
    
    
    <?php 
    $zeroStopQuery=$this->db->query($sql="select cicode,name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and stops='0' group by name order by Total_FareAmount asc");
    if($zeroStopQuery->num_rows() >0)
    {
        $zeroStopData=$zeroStopQuery->result();
    }
    else $zeroStopData='';
  
       if(isset($zeroStopData) && $zeroStopData != '') 
       { 
           
           //print_r($zeroStopData);echo 'dsfgdsfdsf';die;
           foreach($zeroStopData as $row) 
           {  
		 
		 $morning_rates = $this->Flights_Model->morning_rates_zerostop($row->cicode,$session_id,$akbar_session);
		 $afternoon_rates = $this->Flights_Model->afternoon_rates_zerostop($row->cicode,$session_id,$akbar_session);
		 $night_rates = $this->Flights_Model->night_rates_zerostop($row->cicode,$session_id,$akbar_session);
		 $midnight_rates = $this->Flights_Model->midnight_rates_zerostop($row->cicode,$session_id,$akbar_session);
		 ?>
    <div class="matrix_tab">
    
    <table width="100" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="top" bgcolor="#e8f6fd"><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" bgcolor="#FFFFFF" align="center" height="32"><img src="<?php echo base_url();?>assets/airline_logo/<?php echo $row->cicode; ?>.gif" border="0" /></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#C0E4F6"  height="30px"><span class="text13" style=" font-weight:normal; font-weight: bold; line-height:15px;  font-size:11px; color:#15538a;">
                <?php echo($row->name=='Nacil Air India'?'Air India':$row->name); ?>
                </span></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $morning_rates->FareAmount; ?>');"><?php if(isset($morning_rates)) { if($morning_rates != '') { echo "&#36;".$morning_rates->FareAmount; } else { echo '-'; } } ?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $afternoon_rates->FareAmount; ?>');"><?php if(isset($afternoon_rates)) { if($afternoon_rates != '') { echo "&#36;".$afternoon_rates->FareAmount; } else { echo '-'; } } ?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $night_rates->FareAmount; ?>');"><?php if(isset($night_rates)) { if($night_rates != '') { echo "&#36;".$night_rates->FareAmount; } else { echo '-'; } } ?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $midnight_rates->FareAmount; ?>');"><?php if(isset($midnight_rates)) { if($midnight_rates != '') { echo "&#36;".$midnight_rates->FareAmount; } else { echo '-'; } }?></td>
          </tr>
          </table></td>
      </tr>
    </table>
    </div>
    
    <?php  } 
            }
            else
            {
                //echo 'aaaaaaaa';die;
    ?>
        <div class="matrix_tab">
    
                <table width="100" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center" valign="top" bgcolor="#e8f6fd"><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center" bgcolor="#FFFFFF" align="center" height="32"><img src="<?php echo base_url();?>assets/airline_logo/<?php echo $row->cicode; ?>.gif" border="0" /></td>
                      </tr>
                      <tr>
                        <td align="center" bgcolor="#C0E4F6"  height="30px"><span class="text13" style=" font-weight:normal; font-weight: bold; line-height:15px;  font-size:11px; color:#15538a;">
                            <?php echo($row->name=='Nacil Air India'?'Air India':$row->name); ?>
                            </span></td>
                      </tr>
                      <tr>
                        <td align="center" bgcolor="#FFFFFF" class="matri" align="center" ><?php echo '-'; ?></td>
                      </tr>
                      <tr>
                        <td align="center" bgcolor="#FFFFFF" class="matri" align="center" ><?php echo '-'; ?></td>
                      </tr>
                      <tr>
                        <td align="center" bgcolor="#FFFFFF" class="matri" align="center" ><?php echo '-'; ?></td>
                      </tr>
                      <tr>
                        <td align="center" bgcolor="#FFFFFF" class="matri" align="center" ><?php echo '-'; ?></td>
                      </tr>
                      </table></td>
                  </tr>
                </table>
           </div>
    <?php
            }
    ?>
    
    
    
    </td>
  </tr>
</table>
    </div>
    <div class="TabbedPanelsContent">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="140" align="left" valign="top"><table width="140" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#e7f5fd" class="matrix_fixed_part_main">
      <tr>
        <td height="30" align="center"  class="text13">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle"   class="text13"><div style="color:#15538a;">Time Span <img src="<?php echo base_url();?>assets/images/down_arrow_tab.png" /></div></td>
      </tr>
      <tr>
        <td align="center"><div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Morning</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Afternoon</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Night</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Mid Night</div></td>
      </tr>
    </table></td>
    <td align="left" valign="top">
    
    
    
    <?php 
        //echo $sql="select cicode,name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and stops='1' group by name order by Total_FareAmount asc";die;
        $matrix1=array();
	$oneStopQuery=$this->db->query($sql="select cicode,name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and stops='1' group by name order by Total_FareAmount asc");
        if($oneStopQuery->num_rows() >0)
        {
            $oneStopData=$oneStopQuery->result();
        }
        else $oneStopData='';
       
        if($oneStopData!='')
        {
            foreach($oneStopData as $row) 
            {  
                $cicode=explode('<br>',$row->cicode);
                $name=explode('<br>',$row->name);
                $matrix1['cicode'][]=$cicode[0];
                $matrix1['name'][]=$name[0];
            }
        }
        
        $array2=array_unique($matrix1['cicode']);
	$array3=array_unique($matrix1['name']);
        //print_r($array2);print_r($array3);die;
        if(isset($array2)) 
        { 
            if($array2 != '') 
            { 
                foreach($array2 as $key=>$row) 
                {  
                    $morning_rates = $this->Flights_Model->morning_rates_onestop($row,$session_id,$akbar_session);
                    $afternoon_rates = $this->Flights_Model->afternoon_rates_onestop($row,$session_id,$akbar_session);
                    $night_rates = $this->Flights_Model->night_rates_onestop($row,$session_id,$akbar_session);
                    $midnight_rates = $this->Flights_Model->midnight_rates_onestop($row,$session_id,$akbar_session);
    ?>
    <div class="matrix_tab">
    
    <table width="100" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="top" bgcolor="#e8f6fd"><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" bgcolor="#FFFFFF" height="32"><img src="<?php echo base_url();?>assets/airline_logo/<?php echo $row; ?>.gif" border="0" /></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#C0E4F6" align="center"   height="30px" ><span   class="text13" style=" font-weight:normal; line-height:15px; font-weight: bold; font-size:11px; color:#15538a;"><?php echo($array3[$key]=='Nacil Air India'?'Air India':$array3[$key]); ?></span></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $morning_rates->FareAmount; ?>');"><?php if(isset($morning_rates)) { if($morning_rates != '') { echo "&#36;".$morning_rates->FareAmount; } else { echo '-'; } }?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $afternoon_rates->FareAmount; ?>');"><?php if(isset($afternoon_rates)) { if($afternoon_rates != '') { echo "&#36;".$afternoon_rates->FareAmount; } else { echo '-'; } }?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $night_rates->FareAmount; ?>');"><?php if(isset($night_rates)) { if($night_rates != '') { echo "&#36;".$night_rates->FareAmount; } else { echo '-'; } } ?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $midnight_rates->FareAmount; ?>');"><?php if(isset($midnight_rates)) { if($midnight_rates != '') { echo "&#36;".$midnight_rates->FareAmount; } else { echo '-'; } }?></td>
          </tr>
          </table></td>
      </tr>
    </table>
    </div>
    
    <?php  
            } 
         } 
    } 
    ?>
    
    
    
    </td>
  </tr>
</table>
    </div>
    <div class="TabbedPanelsContent">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="140" align="left" valign="top"><table width="140" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#e7f5fd" class="matrix_fixed_part_main">
      <tr>
        <td height="30" align="center"  class="text13">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle"  class="text13"><div style="color:#15538a;">Time Span <img src="<?php echo base_url();?>assets/images/down_arrow_tab.png" /></div></td>
      </tr>
      <tr>
        <td align="center"><div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Morning</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Afternoon</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Night</div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;">Mid Night</div></td>
      </tr>
    </table></td>
    <td align="left" valign="top">
    
    
    
    <?php 
	$matrix2=array();
	$multiStopQuery=$this->db->query($sql="select cicode,name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and stops>'1' group by name order by Total_FareAmount asc");
        if($multiStopQuery->num_rows() >0)
        {
            $multiStopData=$multiStopQuery->result();
        }
        else $multiStopData='';
       
        if($multiStopData!='')
        {
            foreach($multiStopData as $row) 
            {  
                $cicode=explode('<br>',$row->cicode);
                $name=explode('<br>',$row->name);
                $matrix2['cicode'][]=$cicode[0];
                $matrix2['name'][]=$name[0];
            }
        }
        
        $array4=array_unique($matrix2['cicode']);
	$array5=array_unique($matrix2['name']);
        //print_r($array2);print_r($array3);die;
         if(isset($array4)) 
        { 
            if($array4 != '') 
            { 
                foreach($array4 as $key=>$row) 
                {  
                    $morning_rates = $this->Flights_Model->morning_rates_multistop($row,$session_id,$akbar_session);
                    $afternoon_rates = $this->Flights_Model->afternoon_rates_multistop($row,$session_id,$akbar_session);
                    $night_rates = $this->Flights_Model->night_rates_multistop($row,$session_id,$akbar_session);
                    $midnight_rates = $this->Flights_Model->midnight_rates_multistop($row,$session_id,$akbar_session);
    ?>
    <div class="matrix_tab">
    
    <table width="100" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="top" bgcolor="#e8f6fd"><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" bgcolor="#FFFFFF" height="32"><img src="<?php echo base_url();?>assets/airline_logo/<?php echo $row; ?>.gif" border="0" /></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#C0E4F6" align="center"><span class="text13" style="font-size:11px; color:#114879; "><?php echo $array5[$key]; ?></span></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $morning_rates->FareAmount; ?>');"><?php if(isset($morning_rates)) { if($morning_rates != '') { echo "&#36;".$morning_rates->FareAmount; } else { echo '-'; } }?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $afternoon_rates->FareAmount; ?>');"><?php if(isset($afternoon_rates)) { if($afternoon_rates != '') { echo "&#36;".$afternoon_rates->FareAmount; } else { echo '-'; } }?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $night_rates->FareAmount; ?>');"><?php if(isset($night_rates)) { if($night_rates != '') { echo "&#36;".$night_rates->FareAmount; } else { echo '-'; } } ?></td>
          </tr>
          <tr>
            <td align="center" bgcolor="#FFFFFF" class="matri" align="center" onclick="filter_matrix('<?php echo $midnight_rates->FareAmount; ?>');"><?php if(isset($midnight_rates)) { if($midnight_rates != '') { echo "&#36;".$midnight_rates->FareAmount; } else { echo '-'; } }?></td>
          </tr>
          </table></td>
      </tr>
    </table>
    </div>
    
    <?php  
            } 
         } 
    } 
    else
    {
  ?>
        <div class="matrix_tab">
    
    <table width="100" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" valign="top" bgcolor="#e8f6fd"><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" bgcolor="#FFFFFF">There Are No Multi Stops</td>
          </tr>
          </table></td>
      </tr>
    </table>
    </div>
  <?php
    }
    ?>
    
    
    
    </td>
  </tr>
</table>
    </div>
  </div>
</div>

  
 
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
