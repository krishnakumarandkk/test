<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends CI_Controller {

	public function index() {
		parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $url);

		$url_seg = '';

		if (isset($url['name']) && $url['name'] !="" ) {
			$this->db->like('name', $url['name'], 'both');
			$url_seg .= '&name='.$url['name'];
		}
		if (isset($url['author']) && $url['author'] !="" ) {
			$this->db->like('author', $url['author'], 'both');
			$url_seg .= '&author='.$url['author'];
		}
		$url_seg = trim($url_seg, '&');

		$this->db->select('id');
		$query = $this->db->get("books");
		$this->load->library('pagination');
		$config["base_url"] = site_url('used-books');
		$config["total_rows"] = $query->num_rows();
		$config["per_page"] = 1;
		$config["uri_segment"] = 2;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$data["results"] = $this->fetch_books($config["per_page"], $page, $url);
		$data["links"] = $this->pagination->create_links('?'.$url_seg);
		//data for search
		$data['name'] = isset($url['name']) ? $url['name'] : '';
		$data['author'] = isset($url['author']) ? $url['author'] : '';

        $content = $this->load->view('listing', $data, true);
		$this->load->view('layout',['content' => $content]);
	}

	private function fetch_books($limit, $start, $url) {
		$this->db->limit($limit, $start);
		if (isset($url['name']) && $url['name'] !="" ) {
			$this->db->like('name', $url['name'], 'both');
		}
		if (isset($url['author']) && $url['author'] !="" ) {
			$this->db->like('author', $url['author'], 'both');
		}
        $query = $this->db->get("books");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
		}
		return false;
	}
}
