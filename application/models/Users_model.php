<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function user_exists($username)
	{
		$query = $this->db->get_where('authors', array('username'=>$username));
		if($query->num_rows() == 1 ){
			return true;
		}else{
			return false;
		}
	}

	public function login($username, $password)
	{
		$query = $this->db->get_where('authors', array('username'=>$username,'password'=>$password ) );
		if($query->num_rows() >0 ){
			return false;
		}else{
			return true;
		}
	}

     //add data to admins table
    public function add_admin($data){
        if($this->db->insert('authors', $data))
            return true;
        else
            return false;

    }

    //return all information about a certain user
    public function get_profile($username)
    {
    	# code...
    	$result = $this->db->get_where('authors', array('username'=>$username));
    	return $result->row_array();
    }

    //add the post 
    public function total_post_by_author()
    {
    	# code...
    	$this->db->select('articles');
    	$this->db->where('username', $this->session->userdata('username'));
    	$r = $this->db->get('authors');
    	$row = $r->row_array();
    	$articles = $row['articles'];
    	$new_articles = $articles + 1;
    	$data = array(
    		'articles'=> $new_articles
    		);

    	$this->db->where('username', $this->session->userdata('username')) ;
    	$this->db->update('authors', $data);

    }

}

/* End of file Users.php */
/* Location: ./application/models/Users.php */