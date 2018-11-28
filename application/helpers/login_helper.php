<?php
function is_logged_in() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('id');
    $email = $CI->session->userdata('email');
    if (!isset($user) || !isset($email) ) { 
    	return array('status' => 0); 
    } else { 
    	return array('status' => 1,'id' => $user, 'email' => $email); 
    }
}
