<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stories extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function insert($data)
	{

		return $this->db->insert('stories', $data);
	}

	public function update($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update('stories', $data);
	}

	public function select($id)
	{
		// $this->db->select('*');
  //       $this->db->from('stories');
  //      //$this->db->join('admins', "post.author = admins.id_num");
  //       $this->db->where(array('stories.id' =>$id));
        $q = $this->db->get_where('stories', array('id'=>$id,'status'=>2));
        return $q->row_array();
		if($q->num_rows() == 1){
			return $q->row_array();
		}else{
			return array('error'=>'No record with that id.'.$id);
		}
	}


	public function select_all_home()
	{	$this->load->library('pagination');

        $config['base_url'] = base_url().'blogie/index';
        $status = 2;
		$this->db->where('status', $status);
        $config['total_rows'] = $this->db->count_all('stories');
        $config['per_page'] = 5;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = true;

        $config['first_link'] = 'FIRST';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'LAST';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="disabled active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

       //$config['display_pages'] = false;
        $this->pagination->initialize($config);
		$this->db->order_by('id','desc');
		$status = 2;
		$this->db->where('status', $status);
		$q = $this->db->get('stories', $config['per_page'], $this->uri->segment(3));
		return $q->result_array();
	}
	public function select_all()
	{	$this->load->library('pagination');

        $config['base_url'] = base_url().'admin/edit';
        $config['uri_segment'] = 3;
        //$config['full_tag_open'] = '<li>';
        //$config['full_tag_close'] = '</li>';
        $config['total_rows'] = $this->db->count_all('stories');
        $config['per_page'] = 2;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = true;

        $config['first_link'] = 'FIRST';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'LAST';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="disabled active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

       //$config['display_pages'] = false;
        $this->pagination->initialize($config);
		$this->db->order_by('id','desc');
		$q = $this->db->get('stories', $config['per_page'], $this->uri->segment(3));
		return $q->result_array();
	}

	public function delete($id)
	{
		# code...
	}

	public function play($id)
	{
		# code...
		$data = array(
			'status'=> 2
			);
		$this->db->where('id',$id);
		return $this->db->update('stories',$data);
	}

	public function pause($id)
	{
		# code...
		$data = array(
			'status'=> 0
			);
		$this->db->where('id',$id);
		return $this->db->update('stories',$data);
	}

	public function author_names($author)
	{
		# code...
		$r = $this->db->get_where('authors', array('username'=>$author));
		return $r->row_array();
	}

	public function latest()
	{
		$this->db->order_by('id','desc');
		$this->db->where('status', 2);
		$q = $this->db->get('stories', 5);
		return $q->result_array();	
	}

	public function next($id)
	{
		# code...
		$this->db->where('status', 2);
		$this->db->where('id >', $id);
		$r = $this->db->get('stories',1);
		if($r->num_rows() == 1){
			return $r->row_array();
		}else{
			return array('id'=>'#','title'=>'No more articles');
		}
	}

	public function prev($id)
	{
		# code...
		if($id < 10){
			$offset = 10;
		}else{
			$offset =$id-10;
		}
		$this->db->where('status', 2);
		$this->db->where('id <', $id);
		$this->db->limit(1, $offset);
		$r = $this->db->get('stories');
		if($r->num_rows() == 1){
			return $r->row_array();
		}else{
			return array('id'=>'#','title'=>'No more articles');
		}
	}


    public function like($id)
    {
        # code...
        $this->db->select('likes');
        $this->db->where('id', $id);
        $r = $this->db->get('stories');
        $row = $r->row_array();
        $likes = $row['likes'];
        $new_likes = $likes + 1;
        $data = array(
            'likes'=> $new_likes
            );

        $this->db->where('id', $id) ;
       return $this->db->update('stories', $data);
    }

    public function love($id)
    {
        # code...
        $this->db->select('shares');
        $this->db->where('id', $id);
        $r = $this->db->get('stories');
        $row = $r->row_array();
        $shares = $row['shares'];
        $new_shares = $shares + 1;
        $data = array(
            'shares'=> $new_shares
            );

        $this->db->where('id', $id) ;
        return $this->db->update('stories', $data);
    }

}

/* End of file Stories.php */
/* Location: ./application/models/Stories.php */