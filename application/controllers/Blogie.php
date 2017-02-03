<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogie extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	public function index()
	{	
		//get all post
		$data['posts'] = $this->stories->select_all_home();
		$this->load->view('inc/header.html');
		$this->load->view('index', $data);
		$this->load->view('inc/footer.html');
	}

	public function view($id)
	{
		//load a specific post/article
		$this->load->helper('date');
		$data['row'] = $this->stories->select($id);
		$data['id'] = $id;

		//get the full name of the author
		$data['name'] = $this->stories->author_names($data['row']['author']);

		//get the link to the next article
		$data['next'] = $this->stories->next($id);
		$data['prev'] = $this->stories->prev($id);
		$data['latest'] = $this->stories->latest();
		$this->load->view('inc/header.html');
		$this->load->view('post',$data);
		$this->load->view('inc/footer.html');
	}

	public function sidebar()
	{	
		//load the sidebar data
		$this->load->view('inc/header.html');
		$this->load->view('sidebar');
		$this->load->view('inc/footer.html');
	}

}

/* End of file Blogie.php */
/* Location: ./application/controllers/Blogie.php */