<style type="text/css">
body{
	color:#333;}
	
	
	#container {
    width: 618px;
    overflow: auto;
    height: 205px;
	overflow-y:hidden;
	overflow-x:scroll;
    white-space: nowrap;
}

.contents {
    width: 100px;
    height: 187px;
    display: inline-block;
}

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


<body> <div style="  margin:0px 10px 0 15px; font-size:11px; position:absolute;"  >All Stops <img src="<?php echo base_url();?>assets/images/price-arrow.png" /></div>
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
    <td width="140" align="left" valign="top"><table width="140" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#90cbf4" class="matrix_fixed_part_main">
      <tr>
        <td height="30" align="center"  class="text13">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="middle"  class="text13" ><div style="color:#fff; background-color:#1c699d;">Time Span <img src="<?php echo base_url();?>assets/images/down_arrow_tab.png" /></div></td>
      </tr>
      <tr>
        <td align="center">
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#1c699d; color:#fff; line-height:30px; font-size:11px;"><a onClick="filter_matrix_time('morning')" style="cursor:pointer">Morning</a></div>
          
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#1c699d; color:#fff; font-size:11px; line-height:30px;"><a onClick="filter_matrix_time('afternoon')" style="cursor:pointer">Afternoon</a></div>
          
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#1c699d; color:#fff; font-size:11px; line-height:30px;"><a onClick="filter_matrix_time('evening')" style="cursor:pointer">Evening</a></div>
          
          <div class="matri" onMouseOver="highlight('mrn',true)" onMouseOut="highlight('mrn',false)"  style="margin-bottom:1px; background-color:#1c699d; color:#fff; font-size:11px; line-height:30px;" ><a onClick="filter_matrix_time('night')" style="cursor:pointer">Night</a></div></td>
      </tr>
    </table></td>
    <td align="left" valign="top">
  <div id="container">
  <?php 
    $allStopQuery=$this->db->query($sql="select cicode,name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' group by name order by Total_FareAmount asc");
    if($allStopQuery->num_rows() >0)
    {
        $allStopData=$allStopQuery->result();
    }
    else $allStopData='';
  
    $matrix0=array();
    if($allStopData!='')
    {
        foreach($allStopData as $row) 
        {  
            if(strpos($row->cicode,'<br>'))
            {
                $cicode=explode('<br>',$row->cicode);
                $name=explode('<br>',$row->name);
                $matrix0['cicode'][]=$cicode[0];
                $matrix0['name'][]=$name[0];
            }
            else 
            {
                $matrix0['cicode'][]=$row->cicode;
                $matrix0['name'][]=$row->name;
            }
        }
    }
    
    $array0=array_unique($matrix0['cicode']);
    $arrayy=array_unique($matrix0['name']);
       if(isset($array0) && $array0 != '') 
       { 
           foreach($array0 as $key=>$row1) 
           {  
		 $morning_rates = $this->Flights_Model->morning_rates_allstop($row1,$session_id,$akbar_session,'OneWay');
		 $afternoon_rates = $this->Flights_Model->afternoon_rates_allstop($row1,$session_id,$akbar_session,'OneWay');
		 $night_rates = $this->Flights_Model->night_rates_allstop($row1,$session_id,$akbar_session,'OneWay');
		 $midnight_rates = $this->Flights_Model->midnight_rates_allstop($row1,$session_id,$akbar_session,'OneWay');
    ?>
                    <div class="contents">
    
      <a href="#">
   
        <table width="100" border="0" align="center" cellpadding="0" cellspacing="0" class="matrix_tab airline_nm" name="airline_filter">
                        <tr>
                            <td height="32" align="center" bgcolor="#FFFFFF"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $row1; ?>.gif" border="0" onClick="filter_matrix_airline('<?php echo $arrayy[$key]; ?>','All');"/></td>
                            </tr>
                        <tr>
                            <td height="30px" align="center" bgcolor="#90cbf4"><span class="text13" style="font-size:11px; color:#114879; line-height:15px; " onClick="filter_matrix_airline('<?php echo $arrayy[$key]; ?>','All');"><?php echo($arrayy[$key] == 'Nacil Air India' ? 'Air India' : $arrayy[$key]); ?></span></td>
                        </tr>
                        <tr>
                          <?php 
                                if($morning_rates!='')
                                {
                          ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $morning_rates->FareAmount; ?>','<?php echo $arrayy[$key]; ?>');">
                            <?php 
                                    if (isset($morning_rates)) {
                                        if ($morning_rates != '') {
                                            echo "&#36;" . $morning_rates->FareAmount;
                                        } else {
                                            echo '-';
                                        }
                                    } 
                                ?>                            
                          </td>
                          <?php 
                               }
                               else
                               {
                           ?>
                                    <td align="center" class="matri">---</td>
                           <?php
                               }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($afternoon_rates!='')
                                {
                          ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $afternoon_rates->FareAmount; ?>','<?php echo $arrayy[$key]; ?>');"> 
                              <?php 
                                  if (isset($afternoon_rates)) {
                                       if ($afternoon_rates != '') {
                                           echo "&#36;" . $afternoon_rates->FareAmount;
                                       } else {
                                           echo '-';
                                       }
                                   } 
                                ?>
                          </td>
                          <?php
                                }
                            else
                               {
                           ?>
                            <td align="center" class="matri">---</td>
                           <?php
                               }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($night_rates!='')
                                {
                           ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $night_rates->FareAmount; ?>','<?php echo $arrayy[$key]; ?>'); ">
                              <?php 
                                if (isset($night_rates)) {
                                    if ($night_rates != '') {
                                        echo "&#36;" . $night_rates->FareAmount;
                                    } else {
                                        echo '-';
                                    }
                                } 
                            ?>
                          </td>
                          <?php 
                            }
                            else
                            {
                           ?>
                           <td align="center" class="matri">---</td>
                           <?php
                            }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($midnight_rates!='')
                                {
                           ?>
                          <td align="center" class="matri" onClick="selectFilterOneTime('chkMorning'),filter_matrix('<?php if (isset($midnight_rates)) {
                                  if ($midnight_rates != '') {
                                      echo $midnight_rates->FareAmount;
                                  }
                              } ?>','<?php echo $arrayy[$key]; ?>');" onMouseOver="highlight('mrn',true)" onMouseOut="highlight('mrn',false)" >
                              <?php 
                                  if (isset($midnight_rates)) 
                                  {
                                      if ($midnight_rates != '') 
                                      {
                                         echo "&#36;" . $midnight_rates->FareAmount;
                                      } 
                                      else 
                                      {
                                          echo '-';
                                      }
                                  } 
                              ?>
                          </td>
                          <?php 
                                }
                                else
                                {
                           ?>
                           <td align="center" class="matri">---</td>
                           <?php
                                }
                           ?>
                        </tr>
                        </table> 
    
      </a>
 
      </div>
      <?php  
  
        } 
    }
  ?>
      </div>
    </td>
  </tr>
</table>


    </div>
      
     
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
        <td align="center">
            <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;"><a onClick="filter_matrix_time('morning')" style="cursor:pointer">Morning</a></div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; font-size:11px; line-height:30px;"><a onClick="filter_matrix_time('afternoon')" style="cursor:pointer">Afternoon</a></div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; font-size:11px; line-height:30px;"><a onClick="filter_matrix_time('evening')" style="cursor:pointer">Evening</a></div>
          <div class="matri" onMouseOver="highlight('mrn',true)" onMouseOut="highlight('mrn',false)"  ><a onClick="filter_matrix_time('night')" style="cursor:pointer">Night</a></div></td>
      </tr>
    </table></td>
    <td align="left" valign="top">
  <div id="container">
  <?php 
    $zeroStopQuery=$this->db->query($sql="select cicode,name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and stops='0' group by name order by Total_FareAmount asc");
    if($zeroStopQuery->num_rows() >0)
    {
        $zeroStopData=$zeroStopQuery->result();
    }
    else $zeroStopData='';
   //echo '<pre />';print_r($zeroStopData);die;
       if(isset($zeroStopData) && $zeroStopData != '') 
       { 
           
           //print_r($zeroStopData);echo 'dsfgdsfdsf';die;
           foreach($zeroStopData as $row) 
           {  
		 
		 $morning_rates = $this->Flights_Model->morning_rates_zerostop($row->cicode,$session_id,$akbar_session,'OneWay');
		 $afternoon_rates = $this->Flights_Model->afternoon_rates_zerostop($row->cicode,$session_id,$akbar_session,'OneWay');
		 $night_rates = $this->Flights_Model->night_rates_zerostop($row->cicode,$session_id,$akbar_session,'OneWay');
		 $midnight_rates = $this->Flights_Model->midnight_rates_zerostop($row->cicode,$session_id,$akbar_session,'OneWay');
    ?>
                    <div class="contents">
    
      <a href="#">
   
        <table width="100" border="0" align="center" cellpadding="0" cellspacing="0" class="matrix_tab airline_nm" name="airline_filter">
                        <tr>
                            <td height="32" align="center" bgcolor="#FFFFFF"><img src="<?php echo base_url();?>assets/airline_logo/<?php echo $row->cicode; ?>.gif" border="0" onClick="filter_matrix_airline('<?php echo $row->name; ?>','0');"/></td>
                            </tr>
                        <tr>
                            <td height="30px" align="center" bgcolor="#C0E4F6"><span class="text13" style="font-size:11px; color:#114879; line-height:15px; " onClick="filter_matrix_airline('<?php echo $row->name; ?>','0');"><?php echo($row->name=='Nacil Air India'?'Air India':$row->name); ?></span></td>
                        </tr>
                        <tr>
                          <?php 
                                if($morning_rates!='')
                                {
                          ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $morning_rates->FareAmount; ?>','<?php echo $row->name; ?>');">
                            <?php if(isset($morning_rates)) { if($morning_rates != '') { echo "&#36;".$morning_rates->FareAmount; } else { echo '-'; } } ?>                        
                          </td>
                          <?php 
                               }
                               else
                               {
                           ?>
                                    <td align="center" class="matri">---</td>
                           <?php
                               }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($afternoon_rates!='')
                                {
                          ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $afternoon_rates->FareAmount; ?>','<?php echo $row->name; ?>');"> 
                              <?php if(isset($afternoon_rates)) { if($afternoon_rates != '') { echo "&#36;".$afternoon_rates->FareAmount; } else { echo '-'; } } ?>
                          </td>
                          <?php
                                }
                            else
                               {
                           ?>
                            <td align="center" class="matri">---</td>
                           <?php
                               }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($night_rates!='')
                                {
                           ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $night_rates->FareAmount; ?>','<?php echo $row->name; ?>');">
                              <?php if(isset($night_rates)) { if($night_rates != '') { echo "&#36;".$night_rates->FareAmount; } else { echo '-'; } } ?>
                          </td>
                          <?php 
                            }
                            else
                            {
                           ?>
                           <td align="center" class="matri">---</td>
                           <?php
                            }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($midnight_rates!='')
                                {
                           ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $midnight_rates->FareAmount; ?>','<?php echo $row->name; ?>');" >
                              <?php if(isset($midnight_rates)) { if($midnight_rates != '') { echo "&#36;".$midnight_rates->FareAmount; } else { echo '-'; } }?>
                          </td>
                          <?php 
                                }
                                else
                                {
                           ?>
                           <td align="center" class="matri">---</td>
                           <?php
                                }
                           ?>
                        </tr>
                        </table> 
    
      </a>
 
      </div>
     <?php  
         } 
     }    
    ?>
      </div>
    </td>
  </tr>
</table>


    </div>
      
      
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
        <td align="center"><div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;"><a onClick="filter_matrix_time('morning')" style="cursor:pointer">Morning</a></div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; font-size:11px; line-height:30px;"><a onClick="filter_matrix_time('afternoon')" style="cursor:pointer">Afternoon</a></div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; font-size:11px; line-height:30px;"><a onClick="filter_matrix_time('evening')" style="cursor:pointer">Evening</a></div>
          <div class="matri" onMouseOver="highlight('mrn',true)" onMouseOut="highlight('mrn',false)"  ><a onClick="filter_matrix_time('night')" style="cursor:pointer">Night</a></div></td>
      </tr>
    </table></td>
    <td align="left" valign="top">
  <div id="container">
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
            
            $array2=array_unique($matrix1['cicode']);
            $array3=array_unique($matrix1['name']);
        }
        else
        {
            $array2=$array3='';
        }
        //print_r($array2);print_r($array3);die;
       
        if($array2 != '') 
        { 
            foreach($array2 as $key=>$row) 
            {  
                $morning_rates = $this->Flights_Model->morning_rates_onestop($row,$session_id,$akbar_session,'OneWay');
                $afternoon_rates = $this->Flights_Model->afternoon_rates_onestop($row,$session_id,$akbar_session,'OneWay');
                $night_rates = $this->Flights_Model->night_rates_onestop($row,$session_id,$akbar_session,'OneWay');
                $midnight_rates = $this->Flights_Model->midnight_rates_onestop($row,$session_id,$akbar_session,'OneWay');
    ?>
                    <div class="contents">
    
      <a href="#">
   
        <table width="100" border="0" align="center" cellpadding="0" cellspacing="0" class="matrix_tab airline_nm" name="airline_filter">
                        <tr>
                            <td height="32" align="center" bgcolor="#FFFFFF"><img src="<?php echo base_url();?>assets/airline_logo/<?php echo $row; ?>.gif" border="0" onClick="filter_matrix_airline('<?php echo $array3[$key]; ?>','1');"/></td>
                            </tr>
                        <tr>
                            <td height="30px" align="center" bgcolor="#C0E4F6"><span class="text13" style="font-size:11px; color:#114879; line-height:15px; " onClick="filter_matrix_airline('<?php echo $array3[$key]; ?>','1');"><?php echo($array3[$key]=='Nacil Air India'?'Air India':$array3[$key]); ?></span></td>
                        </tr>
                        <tr>
                          <?php 
                                if($morning_rates!='')
                                {
                          ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $morning_rates->FareAmount; ?>','<?php echo $array3[$key]; ?>');">
                            <?php if(isset($morning_rates)) { if($morning_rates != '') { echo "&#36;".$morning_rates->FareAmount; } else { echo '-'; } }?>                       
                          </td>
                          <?php 
                               }
                               else
                               {
                           ?>
                                    <td align="center" class="matri">---</td>
                           <?php
                               }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($afternoon_rates!='')
                                {
                          ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $afternoon_rates->FareAmount; ?>','<?php echo $array3[$key]; ?>');"> 
                              <?php if(isset($afternoon_rates)) { if($afternoon_rates != '') { echo "&#36;".$afternoon_rates->FareAmount; } else { echo '-'; } }?>
                          </td>
                          <?php
                                }
                            else
                               {
                           ?>
                            <td align="center" class="matri">---</td>
                           <?php
                               }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($night_rates!='')
                                {
                           ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $night_rates->FareAmount; ?>','<?php echo $array3[$key]; ?>');">
                              <?php if(isset($night_rates)) { if($night_rates != '') { echo "&#36;".$night_rates->FareAmount; } else { echo '-'; } } ?>
                          </td>
                          <?php 
                            }
                            else
                            {
                           ?>
                           <td align="center" class="matri">---</td>
                           <?php
                            }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($midnight_rates!='')
                                {
                           ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $midnight_rates->FareAmount; ?>','<?php echo $array3[$key]; ?>');" >
                              <?php if(isset($midnight_rates)) { if($midnight_rates != '') { echo "&#36;".$midnight_rates->FareAmount; } else { echo '-'; } }?>
                          </td>
                          <?php 
                                }
                                else
                                {
                           ?>
                           <td align="center" class="matri">---</td>
                           <?php
                                }
                           ?>
                        </tr>
                        </table> 
    
      </a>
 
      </div>
      <?php  
         } 
     }
   ?>
      </div>
    </td>
  </tr>
</table>


    </div>
      
       
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
        <td align="center"><div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; line-height:30px; font-size:11px;"><a onClick="filter_matrix_time('morning')" style="cursor:pointer">Morning</a></div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; font-size:11px; line-height:30px;"><a onClick="filter_matrix_time('afternoon')" style="cursor:pointer">Afternoon</a></div>
          <div class="text13 search_result_border_bottom_part" style="margin-bottom:1px; background-color:#c0e4f6; color:#15538a; font-size:11px; line-height:30px;"><a onClick="filter_matrix_time('evening')" style="cursor:pointer">Evening</a></div>
          <div class="matri" onMouseOver="highlight('mrn',true)" onMouseOut="highlight('mrn',false)"  ><a onClick="filter_matrix_time('night')" style="cursor:pointer">Night</a></div></td>
      </tr>
    </table></td>
    <td align="left" valign="top">
  <div id="container">
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
            
            $array4=array_unique($matrix2['cicode']);
            $array5=array_unique($matrix2['name']);
        }
        else
        {
            $array4=$array5='';
        }
       
        //print_r($array2);print_r($array3);die;
        
        if($array4 != '') 
        { 
            foreach($array4 as $key=>$row) 
            {  
                $morning_rates = $this->Flights_Model->morning_rates_multistop($row,$session_id,$akbar_session,'OneWay');
                $afternoon_rates = $this->Flights_Model->afternoon_rates_multistop($row,$session_id,$akbar_session,'OneWay');
                $night_rates = $this->Flights_Model->night_rates_multistop($row,$session_id,$akbar_session,'OneWay');
                $midnight_rates = $this->Flights_Model->midnight_rates_multistop($row,$session_id,$akbar_session,'OneWay');
    ?>
                    <div class="contents">
    
      <a href="#">
   
        <table width="100" border="0" align="center" cellpadding="0" cellspacing="0" class="matrix_tab airline_nm" name="airline_filter">
                        <tr>
                            <td height="32" align="center" bgcolor="#FFFFFF"><img src="<?php echo base_url();?>assets/airline_logo/<?php echo $row; ?>.gif" border="0" onClick="filter_matrix_airline('<?php echo $array5[$key]; ?>','2');"/></td>
                            </tr>
                        <tr>
                            <td height="30px" align="center" bgcolor="#C0E4F6"><span class="text13" style="font-size:11px; color:#114879; line-height:15px; " onClick="filter_matrix_airline('<?php echo $array5[$key]; ?>','2');"><?php echo $array5[$key]; ?></span></td>
                        </tr>
                        <tr>
                          <?php 
                                if($morning_rates!='')
                                {
                          ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $morning_rates->FareAmount; ?>','<?php echo $array5[$key]; ?>');">
                            <?php if(isset($morning_rates)) { if($morning_rates != '') { echo "&#36;".$morning_rates->FareAmount; } else { echo '-'; } }?>                       
                          </td>
                          <?php 
                               }
                               else
                               {
                           ?>
                                    <td align="center" class="matri">---</td>
                           <?php
                               }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($afternoon_rates!='')
                                {
                          ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $afternoon_rates->FareAmount; ?>','<?php echo $array5[$key]; ?>');"> 
                              <?php if(isset($afternoon_rates)) { if($afternoon_rates != '') { echo "&#36;".$afternoon_rates->FareAmount; } else { echo '-'; } }?>
                          </td>
                          <?php
                                }
                            else
                               {
                           ?>
                            <td align="center" class="matri">---</td>
                           <?php
                               }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($night_rates!='')
                                {
                           ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $night_rates->FareAmount; ?>','<?php echo $array5[$key]; ?>');">
                              <?php if(isset($night_rates)) { if($night_rates != '') { echo "&#36;".$night_rates->FareAmount; } else { echo '-'; } } ?>
                          </td>
                          <?php 
                            }
                            else
                            {
                           ?>
                           <td align="center" class="matri">---</td>
                           <?php
                            }
                           ?>
                        </tr>
                        <tr>
                          <?php 
                                if($midnight_rates!='')
                                {
                           ?>
                          <td align="center" class="matri" onClick="filter_matrix('<?php echo $midnight_rates->FareAmount; ?>','<?php echo $array5[$key]; ?>');">
                              <?php if(isset($midnight_rates)) { if($midnight_rates != '') { echo "&#36;".$midnight_rates->FareAmount; } else { echo '-'; } }?>
                          </td>
                          <?php 
                                }
                                else
                                {
                           ?>
                           <td align="center" class="matri">---</td>
                           <?php
                                }
                           ?>
                        </tr>
                        </table> 
    
      </a>
 
      </div>
      <?php  
  
        } 
    }
  ?>
      </div>
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
