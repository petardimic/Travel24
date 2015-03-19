<?php 
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
    function alpha_dash_space($str)
    {
        //return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
        return ( ! preg_match("/^[a-z0-9:_\-|]+$/i", $str)) ? FALSE : TRUE;
    }
    
    function send_mail($toEmail,$fromName,$fromEmail,$ccEmail='',$msg,$subject)
    {
        $CI =& get_instance();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.provab.com';
        $config['smtp_port'] = 25;
        $config['smtp_user'] = 'christin@provab.com';
        $config['smtp_pass'] = 'provab123';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $CI->load->library('email',$config);
        $message=preg_replace('/\s[\s]+/', '',$msg);
        $toEmail = strip_tags($toEmail);
        
        $CI->email->set_newline("\r\n");
        $CI->email->from($fromEmail,$fromName);
        $CI->email->to($toEmail);
        if($ccEmail!='')
        {
            $CI->email->cc($ccEmail);
        }
        $CI->email->subject($subject);
        $CI->email->message($message);

	if($CI->email->send())
        {
            return true;
        }
        else
        {
            //echo $CI->email->print_debugger();
            return false;
        }
    }
?>