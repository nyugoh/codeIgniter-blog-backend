<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {

	protected $admin_level;


	public function __construct()
	{
		parent::__construct();
		$this->admin_level = $this->session->userdata('level');
	}


	public function check_level()
	{
		
	}

	public function display_all()
	{
		$data['row'] = $this->stories->select_all();
		$Admin->view('edit', $data);

	}

}

/* End of file Articles.php */
/* Location: ./application/controllers/Articles.php */