<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function index() {


		/*-------------------------------------*/
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.live.com',
			'smtp_port' => 465,
			'smtp_user' => 'buymybook.in@hotmail.com',
			'smtp_pass' => 'lakshmi1@',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from('buymybook.in@hotmail.com', 'myname');
        $this->email->to('mekrishnakumarkk@gmail.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  


		$this->email->send(FALSE);

		echo "<pre>";
		print_r($this->email->print_debugger());
		exit;

		/*------------------------------------*/
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'required');

		if (isset($_POST['check_post']) && $_POST['check_post'] == 1) {
			if ($this->form_validation->run() == TRUE)
			{
				$data = [
					'email'=> $this->input->post('email'),
					'message'=> $this->input->post('message'),
					'created_at' => date('Y-m-d H:i:s')
					];
				$this->db->insert('contact', $data);
				redirect(site_url('contact-us'));
				
			}
		}

		$content = $this->load->view('contact', [], true);
	    $this->load->view('layout',['content' => $content]);
	}
}
