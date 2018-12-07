<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function index() {

		$this->load->helper(array('form'));
	    $this->load->library('form_validation');
		$user_id = 2;
    	$query = $this->db->query('SELECT password FROM users WHERE id = '.$user_id);
		$row = $query->row();
		$error = '';
		if (count($row) == 0) {
		    redirect(base_url());
		}

		if (isset($_POST['check_post']) && $_POST['check_post'] == 1) {
			$this->form_validation->set_rules('oldpassword', 'Current password', 'required|min_length[5]');
			$this->form_validation->set_rules('npassword', 'New password', 'required|min_length[5]');
			$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[npassword]');
			if ($this->form_validation->run() == TRUE) {
				if (base64_encode($this->input->post('oldpassword')) == $row->password) {
					$data = [
						'password' => base64_encode($this->input->post('npassword'))
					];
					$this->db->where('id', $user_id)->update('users', $data);
					redirect(site_url('profile'));
			   } else {
			   		$error = 'Invalid current password';
			   }
			} 
		}
		
		$content = $this->load->view('profile', ['error' => $error], true);
	    $this->load->view('layout',['content' => $content]);
	}
}
