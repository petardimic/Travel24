<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Flights</title>

    
<!-- CSS --><link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main_style.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/car.css" type="text/css"/>
<script type="text/javascript" src="<?php print base_url()?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
<body><?php $this->load->view('home/header'); ?>
    <div style="text-align:center; border: 5px solid brown; font-size: 20px; font-weight: bold; width: 1000px; margin: auto; padding: 20px 0px; margin-top: 30px;"><?php echo $msg; ?></div>
<?php $this->load->view('home/footer'); ?>