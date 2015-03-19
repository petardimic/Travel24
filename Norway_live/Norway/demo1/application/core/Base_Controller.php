<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * MyBookingSystem
 *  
 *
 * @package		MyBookingSystem
 * @author		Khadharvalli
 * @copyright	Copyright (c) 2013 - 2014, Provabtechnosoft Pvt. Ltd.
 * @license		http://www.mybookingsystem.com/support/license-agreement
 * @link		http://www.mybookingsystem.com
 * 
 */

class Base_Controller extends MX_Controller {

    public $ajax_controller = false;

    public function __construct()
    {
        parent::__construct();     

        $this->load->library('session');
        $this->load->helper('url');

        $this->load->database();
        $this->load->library('form_validation');       
       
        // Load default language settings
        if($this->session->userdata('default_language') == '')
        {			
			$this->session->set_userdata('default_language','english');
		}        
 
        $this->lang->load('fi',$this->session->userdata('default_language'));

        $this->load->helper('language');

    }

}

?>
