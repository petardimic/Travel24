
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Norway</title>
        <meta name="description" content="Full view calendar component for twitter bootstrap with year, month, week, day views.">
        <meta name="keywords" content="jQuery,Bootstrap,Calendar,HTML,CSS,JavaScript,responsive,month,week,year,day">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="css/1200.css" rel="stylesheet"> 
        <link href="css/980.css" rel="stylesheet"> 
        <link href="css/979.css" rel="stylesheet"> 
        <link href="css/979-768.css" rel="stylesheet"> 
        <link href="css/767.css" rel="stylesheet"> 
        <link href="css/480.css" rel="stylesheet"> 
        <link href="css/bootstrap.css" rel="stylesheet"> 
        <!--<link href="css/bootstrap.min.css" rel="stylesheet">--> 
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet"> 
        <link href="css/date/kendo.common.min.css" rel="stylesheet" />
        <link href="css/date/kendo.default.min.css" rel="stylesheet" />
        <link href="css/responsive-calendar.css" rel="stylesheet">
        <link href="css/less/responsive-calendar.less" rel="stylesheet">
        <link href="css/calendar.css" rel="stylesheet">
        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.png">
    </head>
   
    <body>

        <div class="header">
            <div class="container">
                <div class="row-fluid top-bottom15">
                    <div class="span4">
                        <img src="img/logo.png">
                    </div>
                    <div class="span8">
                        <div class="navbar top25">
                            <!--<div class="navbar-inner">-->
                            <div class="container">
                                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <!--<a class="brand" href="#">Project name</a>-->
                                <div class="nav-collapse collapse">
                                    <ul class="nav">
                                        <li class="active"><a href="#">FLYBILLETTER</a></li>
                                        <li><a href="#about">HOTELL</a></li>
                                        <li><a href="#contact">STOREBYFERIE</a></li>
                                        <li><a href="#contact">SOL OG BAD</a></li>
                                        <li><a href="#contact">TOPPLISTER</a></li>
                                    </ul>
                                </div><!--/.nav-collapse -->
                            </div>
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container top40">
            <div class="row">
                <div class="span6">
                    <h4>SØK FLYBILLETTER / SAS - STAR ALLIANCE</h4>
                    <p>Forsiden/ <span style="color: #999;">Billige Flybilletter</span></p>
                </div>
                <div class="span6 align-right">
                   <div id="flip" class="detail-cross-btn top20">Skjul/vis sokeboksen X</div>
                </div>
            </div>

            <div id="panel" class="search-box">
                <div class="row-fluid">
                    <div class="span5 top10">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked><strong>Tur/ retur</strong>
                                        </label>
                                    </div>
                                    <div class="span6">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"><strong>Enkel</strong>
                                        </label>                                
                                    </div>
                                </div>
                                
                                <div class="row-fluid">
                                    <div class="span12">
                                        <label style="margin: 0px;"><strong>Reis Fra</strong></label>
                                        <input type="text" class="search-input" placeholder="Oslo">
                                        <label style="margin: 0px;"><strong>Reis Til</strong></label>
                                        <input type="text" class="search-input" placeholder="Bang" style="margin-bottom: 0px;">
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12 top20">
                                        <button class="btn" type="button" style="margin-right: 15px;">Nullstill s0k</button>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <strong>Reisende</strong>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <label style="margin: 0px;"><strong>Voksen</strong></label>
                                        <select class="sele-width">
                                            <option>4</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <label style="margin: 0px;"><strong>Barn (2-11 ar)</strong></label>
                                        <select class="sele-width">
                                            <option>3</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <label style="margin: 0px;"><strong>Spedbarn (0-23 mnd)</strong></label>
                                        <select class="sele-width" style="margin-bottom: 0px;">
                                            <option>4</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span5">
                        <div class="row-fluid">
                            <div class="span6">
                                <label><strong>Check In</strong></label>
                                <div class="responsive-calendar cal-bg">
                                    <div class="controls">
                                        <a class="pull-left" data-go="prev"><div class="btn-arrow"> < </div></a>
                                        <strong><span data-head-year></span> <span data-head-month></span></strong>
                                        <a class="pull-right" data-go="next"><div class="btn-arrow"> > </div></a>
                                    </div><hr style="margin: 2px;">
                                    <div class="day-headers">
                                        <div class="day header">Mon</div>
                                        <div class="day header">Tue</div>
                                        <div class="day header">Wed</div>
                                        <div class="day header">Thu</div>
                                        <div class="day header">Fri</div>
                                        <div class="day header">Sat</div>
                                        <div class="day header">Sun</div>
                                    </div>
                                    <div class="days" data-group="days">

                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <label><strong>Check Out</strong></label>
                                <div class="responsive-calendar cal-bg">
                                    <div class="controls">
                                        <a class="pull-left" data-go="prev"><div class="btn-arrow"> < </div></a>
                                        <strong><span data-head-year></span> <span data-head-month></span></strong>
                                        <a class="pull-right" data-go="next"><div class="btn-arrow"> > </div></a>
                                    </div><hr style="margin: 2px;">
                                    <div class="day-headers">
                                        <div class="day header">Mon</div>
                                        <div class="day header">Tue</div>
                                        <div class="day header">Wed</div>
                                        <div class="day header">Thu</div>
                                        <div class="day header">Fri</div>
                                        <div class="day header">Sat</div>
                                        <div class="day header">Sun</div>
                                    </div>
                                    <div class="days" data-group="days">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span2">
                        <a href="search-result.php"><img src="img/search-botton.png" class="top95-rep"></a>
                    </div>
                </div>
            </div>     

            <div class="flight-search-box top20">
                <div class="row-fluid">
                    <div class="span4">
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="img/sas.png">
                            </a>
                            <div class="media-body top10">
                                <h4 class="media-heading">Scandinavian Airlines</h4>    
                            </div>
                        </div>
                        <h5>FLYAVGANGER MED SAS /STARALLIANCE</h5>
                        <div class="row-fluid">
                            <div class="span12">
                                <h4 style="margin: 0px;">OSL - BKK | 12/02 &nbsp; &nbsp; &nbsp; 1 voksen</h4>
                                <h4 style="margin: 0px;">BKK - OLS | 28/02 </h4>
                            </div>
                        </div>
                        <div class="row-fluid top10">
                            <div class="span12">
                                <h5><a href="#" id="show" style="text-decoration: underline;">Mer info om denne reisen</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="span8">
                        <div class="flight-home">
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <label>Utreise</label>
                                                    <input type="text" class="span12 place-color" placeholder="OSL 20:50" style="background-color: #276baa;border: 1px solid #276baa;">
                                                </div>
                                                <div class="span2 top300">
                                                    <img src="img/flight-left-icon.png">
                                                </div>
                                                <div class="span5">
                                                    <!--<label>&nbsp;</label>-->
                                                    <input type="text" class="span12 top25-rep place-color" placeholder="BKK 00:25" style="background-color: #276baa;border: 1px solid #276baa;">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <label>Hjemreise</label>
                                                    <input type="text" class="span12 place-color" placeholder="BKK 00:25" style="background-color: #958c29;border: 1px solid #958c29;">
                                                </div>
                                                <div class="span2 top300">
                                                    <img src="img/flight-right-icon.png">
                                                </div>
                                                <div class="span5">
                                                    <!--<label>&nbsp;</label>-->
                                                    <input type="text" class="span12 top25-rep place-color" placeholder="OSL 20:50" style="background-color: #958c29;border: 1px solid #958c29;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                    12t 15m
                                                </div>
                                                <div class="span6">
                                                    1 stopp (CPH)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    12t 15m
                                                </div>
                                                <div class="span6">
                                                    1 stopp (CPH)
                                                </div>
                                            </div>
                                            <div class="row-fluid align-right">
                                                <div class="span12">
                                                    <h5><a href="#" style="text-decoration: underline; color: #fff;">+9 ledige plasser</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="span4 align-right">
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <span>Kr <b style="font-size: 50px;">7.470</b></span>
                                        </div>
                                    </div>
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <img src="img/price-btn.png">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row-fluid">
                <div class="span9">
                    
                    <div id="panel2"  class="row-fluid" style="display: none;">
                     <div class="row-fluid top20">
                <div class="span6">
                    <div class="reisedetaljer-head">
                        <strong>Lavpriskalender</strong>
                    </div>
                </div>
                         <div class="span6 align-right">
                             <div id="hide" class="detail-cross-btn">Skjul Detaljer X</div>
                </div>
            </div>
                     <div class="flight-calander">
                        <div class="row-fluid">
                            <div class="span12">
                                <p>Reisedetaljer</p>
                                <strong>OSLO - BANGKOK TORSDAG 13. MARS 2014</strong> 
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4>OSLO - KØBENHAVN</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="error1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="error1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">
                                                        <h4>KØBENHAVN - BANGKOK</h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td>22:15 - 15:20</td>
                                                                <td>10:20</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="resize-content">
                                                        (Terminal 3) (SK973)<br/>
                                                        Flyselskap: Scandinavian Airlines<br/>
                                                        Flytype: Airbus Industrie A340-300
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid top20">
                            <div class="span12">
                                <p>Reisedetaljer</p>
                                <strong>BANGKOK - OSLO TORSDAG 20. MARS 2014</strong> 
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">
                                                        <h4>KØBENHAVN - BANGKOK</h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td>22:15 - 15:20</td>
                                                                <td>10:20</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="resize-content">
                                                        (Terminal 3) (SK973)<br/>
                                                        Flyselskap: Scandinavian Airlines<br/>
                                                        Flytype: Airbus Industrie A340-300
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="span6">
                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4>OSLO - KØBENHAVN</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="error1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="error1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row-fluid top20 align-center">
                            <div class="span12">
                                <button class="btn btn-primary" type="button">TILBAKE TIL KALENDER</button>
                            </div>
                        </div>
                    </div>
                        </div>
                    
                    <div class="row-fluid top20">
                <div class="span12">
                    <div class="flight-box-head">
                        <strong>Lavpriskalender</strong>
                    </div>
                </div>
            </div>
                    <div class="flight-calander">
                        <table class="table cal-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Retur <br/>Mandag <br/>17-mar-2014</th>
                                    <th>Retur <br/>Mandag <br/>17-mar-2014</th>
                                    <th>Retur <br/>Mandag <br/>17-mar-2014</th>
                                    <th>Retur <br/>Mandag <br/>17-mar-2014</th>
                                    <th>Retur <br/>Mandag <br/>17-mar-2014</th>
                                    <th>Retur <br/>Mandag <br/>17-mar-2014</th>
                                    <th>Retur <br/>Mandag <br/>17-mar-2014</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="null-bg">
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,-  <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,-<div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr class="null-bg1">
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                            </tbody>
                        </table>
                        <!--                       <div class="page-header">
                        
                                        <div class="pull-right form-inline">
                                                <div class="btn-group">
                                                        <button class="btn btn-primary" data-calendar-nav="prev">&lt;&lt; Prev</button>
                                                        <button class="btn" data-calendar-nav="today">Today</button>
                                                        <button class="btn btn-primary" data-calendar-nav="next">Next &gt;&gt;</button>
                                                </div>
                                                <div class="btn-group">
                                                        <button class="btn btn-warning" data-calendar-view="year">Year</button>
                                                        <button class="btn btn-warning active" data-calendar-view="month">Month</button>
                                                        <button class="btn btn-warning" data-calendar-view="week">Week</button>
                                                        <button class="btn btn-warning" data-calendar-view="day">Day</button>
                                                </div>
                                        </div>
                        
                                        <h3>March 2013</h3>
                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                       <div id="calendar"></div>
                                                    </div>
                                                </div>-->
                    </div>
                   
                </div>
                <div class="span3">
                    <div class="well top20" style="padding: 5px;">
                        <div class="row-fluid">
                            <div class="span12">                                
                            <img src="img/add1.png">
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">                                
                            <img src="img/add2.png">
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">                                
                            <img src="img/add3.png">
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">                                
                            <img src="img/add4.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap-transition.js"></script>
        <script src="js/bootstrap-collapse.js"></script>
        <script src="js/bootstrap-dropdown.js"></script>

        <!--<script src="js/bootstrap.min.js"></script>-->
        <script src="js/responsive-calendar.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".responsive-calendar").responsiveCalendar({
                    time: '2013-05',
                    events: {
                        "2013-04-30": {"number": 5, "url": "#"},
                        "2013-04-26": {"number": 1, "url": "#"},
                        "2013-05-03": {"number": 1},
                        "2013-06-12": {}}
                });
            });
        </script>

<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
        <script type="text/javascript" src="js/underscore-min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/calendar.js"></script>
        <script type="text/javascript" src="js/app.js"></script>

        <script type="text/javascript">
            var disqus_shortname = 'bootstrapcalendar'; // required: replace example with your forum shortname
            (function() {
                var dsq = document.createElement('script');
                dsq.type = 'text/javascript';
                dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        
        <script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle("slow");
  });
});
$("a").click(function(event){
  event.preventDefault();
});
</script>

<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $("#panel2").hide();
  });
  $("#show").click(function(){
    $("#panel2").show();
  });
});
$("a").click(function(event){
  event.preventDefault();
});
</script>

    </body>
</html>
