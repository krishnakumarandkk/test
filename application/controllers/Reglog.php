<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reglog extends CI_Controller {

	public function index()
	{

		$session = is_logged_in();
		if ( $session['status'] == 1 ) {
			redirect(base_url());
		}
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
        $content = $this->load->view('register',[],true);
		$this->load->view('layout',['content' => $content]);
	}

	public function validate()
	{
		$session = is_logged_in();
		if ( $session['status'] == 1 ) {
			redirect(base_url());
		}
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
		
		if ($this->form_validation->run() == FALSE)
		{
		    $content = $this->load->view('register', [], true);
		    $this->load->view('layout',['content' => $content]);
		}
		else
		{
			$data = [
				'email'=> $this->input->post('email'),
				'password'=> base64_encode(($this->input->post('password'))),
				'status' => 1,
				'email_verified' => 0,
				'created' => date('Y-m-d H:i:s')
			];
			$this->db->insert('users', $data);
			$user_id = $this->db->insert_id();
			$newdata = array(
		        'email' => $this->input->post('email'),
		        'id' => $user_id
			);
			$this->session->set_userdata($newdata);
		    redirect(site_url('registration-successful'));
		}
	}


	public function logout () {
		$array_items = array('id', 'email');
		$this->session->unset_userdata($array_items);
		redirect(site_url('register'));
	}

	public function success () {
		$session = is_logged_in();
		if ( $session['status'] == 0 ) {
			redirect(site_url('register'));
		}
		$content = $this->load->view('success', [], true);
	    $this->load->view('layout',['content' => $content]);
	}


	public function addbook() {
		$session = is_logged_in();
		if ( $session['status'] == 0 ) {
			redirect(site_url('register'));
		}

		$this->load->helper(array('form'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('author', 'Author', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('sale_price', 'Sale price', 'required|callback_decimal_numeric');
		$this->form_validation->set_rules('orginal_price', 'Orginal price', 'required|callback_decimal_numeric');
		$this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('exchange', 'Exchange', 'required');


		if (isset($_POST['check_post']) && $_POST['check_post'] == 1) {

			if ($this->form_validation->run() == FALSE)
			{
		} else {
				//add book here
				$data = [
					'name'=> $this->input->post('name'),
					'author'=> $this->input->post('author'),
					'category' => $this->input->post('category'),
					'sale_price'=> $this->input->post('sale_price'),
					'orginal_price'=> $this->input->post('orginal_price'),
					'country' => $this->input->post('country'),
					'state'=> $this->input->post('state'),
					'city'=> $this->input->post('city'),
					'exchange' => $this->input->post('exchange'),
					'description' => $this->input->post('description'),
					'status' => 1,
					'sold' => 0,
					'user_id' => $session['id'],
					'created' => date('Y-m-d H:i:s')
				];
				$this->db->insert('books', $data);
				$book_id = $this->db->insert_id();
				redirect(site_url('add-book-image/'.base64_encode($book_id)));	
			}
		}
		$content = $this->load->view('book', [], true);
	    $this->load->view('layout',['content' => $content]);
	}




	public function decimal_numeric($variable)
    {
        if (!is_numeric($variable)) //Use your logic to check here
        {
            //check for number 
            if (!preg_match ("/[^0-9]/", $variable)) {
            	return TRUE;
            } else {
            	$this->form_validation->set_message('decimal_numeric', 'Invalid %s ');
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }


    public function addimage ($id) {
    	$session = is_logged_in();
		if ( $session['status'] == 0 ) {
			redirect(site_url('register'));
		}
    	
    	$book_id = base64_decode($id);
    	//check if this book belongs to the user
    	$user_id = $session['id'];
    	$query = $this->db->query('SELECT id FROM books WHERE user_id = '.$user_id.' and id = '.$book_id);
		$row = $query->row();
		
		if (count($row) == 0) {
		    redirect(base_url());
		}
		
		if (isset($_POST['check_post']) && $_POST['check_post'] == 1) {
			$new_name = time().$_FILES["image"]['name'];
			$config['file_name'] = $new_name;
			$config['upload_path']  = SITE_ROOT.'/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                exit;
            } else {
            	//$this->resizeImage($new_name);
            	die('uploaded');
            }
		}

		$content = $this->load->view('bookimage', ['id' => $id], true);
	    $this->load->view('layout',['content' => $content]);

    }

    public function resizeImage($filename)
    {
      $source_path = SITE_ROOT . '/uploads/' . $filename;
      $target_path = SITE_ROOT . '/uploads/thumb/';
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => false,
          'create_thumb' => TRUE,
          'thumb_marker' => '_thumb',
          'width' => 150,
          'height' => 150
      );
      $this->load->library('image_lib', $config_manip);
      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }
      $this->image_lib->clear();
    }

}
