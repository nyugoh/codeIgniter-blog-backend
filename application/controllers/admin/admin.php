<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('stories');
        $this->load->helper('date');
        date_default_timezone_set('Africa/Nairobi');
	}

	public function index()
	{	
		if(!$this->session->userdata('is_logged')){
			redirect('admin/login');
		}
		//loads all the stories
		$this->load->view('inc/admin-header.html');
		$this->load->view('admin/view');
		$this->load->view('inc/admin-footer.html');
		
	}

	public function login()
	{	
		if($this->session->userdata('is_logged')){
			redirect('admin/add');
		}
		if(isset($_POST['login'])){
			//get the data
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			//validate the format
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[20]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]');

			if ($this->form_validation->run()) {
				# code...
				if($this->users_model->user_exists($username) === false){
					$data['error'] = 'User doesn\' exist.';
					$this->load->view('admin/login',$data);
				}else{
					if($this->users_model->login($username, md5($password))){
						$data['error'] = 'Wrong password or username.';
						$this->load->view('admin/login',$data);
					}else{
						//set the session data
						$user = $this->users_model->get_profile($username);
						$data = array(
								'username'=>$user['username'],
								'level'=>$user['level'],
								'genre'=>$user['genre'],
								'photo'=>$user['photo'],
								//'hash'=>
								//'last_activity'=>
								'is_logged' => true
							);
						$this->session->set_userdata($data);
						redirect('admin/add');
					}
				}
				
			} else {
				# code...
				$data['error'] = validation_errors();
				$this->load->view('admin/login',$data);
			}
		}else{
			$this->load->view('admin/login');
		}
		
	}

	public function logout()
	{
		if($this->session->userdata('is_logged')){
			session_unset();
			session_destroy();
			redirect('admin/login');
		}else{
			redirect('admin/login');
		}
	}


	 //signup module
    public function signup(){
    	if($this->session->userdata('is_logged')){
    		session_unset();
    		session_destroy();
    	}

        if(isset($_POST['signup'])){
            $username= $this->input->post('username');
            $fname= $this->input->post('firstname');
            $lname= $this->input->post('lastname');
            $email= $this->input->post('email');
            $password= $this->input->post('password');
            $confirm_password= $this->input->post('confirm-password');
            $profession= $this->input->post('profession');
            $level= 1;
            $genre= 2;

            //validation rules
            $config = array(
                array(
                    'field'=> 'username',
                    'label'=>'username',
                    'rules'=>'is_unique[authors.username]|trim|required|max_length[20]|min_length[3]'
                ),
                array(
                    'field'=> 'firstname',
                    'label'=>'first name',
                    'rules'=>'trim|required|max_length[20]|min_length[3]'
                ),
                array(
                    'field'=> 'lastname',
                    'label'=>'Last name',
                    'rules'=>'trim|required|max_length[20]|min_length[3]'
                ),
                array(
                    'field'=> 'profession',
                    'label'=>'profession',
                    'rules'=>'trim|required|max_length[30]|min_length[3]'
                ),
                array(
                    'field'=> 'email',
                    'label'=>'email',
                    'rules'=>'trim|required|valid_email'
                ),
                array(
                    'field'=> 'password',
                    'label'=>'password',
                    'rules'=>'trim|required|max_length[40]|min_length[4]'
                ),
                array(
                    'field'=> 'confirm-password',
                    'label'=>'confirm password',
                    'rules'=>'matches[password]|trim|required|max_length[40]|min_length[4]'
                )
            );
            $this->form_validation->set_rules($config);
            
             //set the profile photo rules
             $config['upload_path'] = 'assets/images/admins';
             $config['allowed_types'] = 'jpg|gif|png';
             $config['max_size'] = 0;
             $config['max_width'] = 0;
             $config['max_height'] = 0;
             $config['file_name'] = $username;

             $this->load->library('upload');
             $this->upload->initialize($config);

            if($this->form_validation->run()){
                if($this->upload->do_upload('profile')){
                    $file_data = $this->upload->data();
                    $profile = $file_data['file_name'];

                    $data = array(
                        'username'=> $username,
                        'fname' =>$fname,
                        'lname'=> $lname,
                        'email'=>$email,
                        'level'=>$level,
                        'photo'=>$profile,
                        'password'=> md5($password),
                        'profession'=> $profession
                    );
                    if($this->users_model->add_admin($data)){
                    	$data['errors'] = "Account created successfully...Login below.";
                    	$this->load->view('admin/login',$data);
                    }else
                        $this->load->view('admin/signup');
                }else{
                    $data['errors'] = $this->upload->display_errors();
                $this->load->view('admin/signup', $data);
                }
            }else{
                $data['errors'] = validation_errors();
                $this->load->view('admin/signup', $data);
            }
        }else{
            //show the form
            $this->load->view('admin/signup');
        }
    }

	public function view($value = 'view', $data= ' ')
	{	
		if(!$this->session->userdata('is_logged')){
			redirect('admin/login');
		}
		//show the form to add a new story
		# code...
		if($value === 'index'){
			$view = 'view';
		}else{
			$view = 'admin/'.$value;
		}

		$this->load->view('inc/admin-header.html');
		$this->load->view($view,$data);
		$this->load->view('inc/admin-footer.html');	
	}


	//insert post
    public function add(){

    	if(!$this->session->userdata('is_logged')){
			redirect('admin/login');
		}

        if(isset($_POST['insert'])){
        	//set the validation rules
        	$title = $this->input->post('title');
        	$description = $this->input->post('description');
        	$article = $this->input->post('body');
        	$status = $this->input->post('status');
        	$tags = "";

        	//add the tags to string $tags
        	if(isset($_POST['tags'])){
        		for($i =0;$i < count($_POST['tags']);$i++){
        			if($i == (count($_POST['tags']) - 1)){
        				$tags = $tags. $_POST['tags'][$i];
        			}else{
                        $tags = $tags. $_POST['tags'][$i] . ', ';
                    }
        		}
        	}else{
        		$tags = '';
        	}


        	$config = array(
        	    array(
        	        'field'=>'title',
        	        'label' => 'Article title',
        	        'rules' => 'required|trim|is_unique[stories.title]'
        	    ),
        	    array(
        	        'field'=>'description',
        	        'label' => 'Article description',
        	        'rules' => 'required|trim'
        	    ),
        	    array(
        	        'field'=>'body',
        	        'label' => 'Article body',
        	        'rules' => 'required|trim'
        	    ),
        	    array(
        	        'field'=>'tags[]',
        	        'label' => 'tags',
        	        'rules' => 'required|trim'
        	    ),
        	    array(
        	        'field'=>'status',
        	        'label' => 'status',
        	        'rules' => 'required|trim'
        	    )
        	);

        	$this->form_validation->set_rules($config);

        	$config['upload_path'] = 'assets/images';
        	$config['allowed_types'] = 'jpg|gif|png';
        	$config['file_name'] = date('YmjHis');
        	$config['max_size'] = 0;
        	$config['max_width'] = 0;
        	$config['max_length'] = 0;

        	$this->load->library('upload');
        	$this->upload->initialize($config);

        	if($this->form_validation->run()){
        	    if($this->upload->do_upload('cover_photo')){
        	        $body = htmlentities($article);
        	        $this->load->helper('date');

        	        $date = mdate('%Y-%m-%j %h:%i:%s', time());
        	        $file_data = $this->upload->data();
        	        $cover_photo = $file_data['file_name'];
        	        $data = array(
        	            'title' => $title,
        	            'description'=> $description,
        	            'body' => $body,
        	            'status' => $status,
        	            'tags' => $tags,
        	            'date_created' => $date,
        	            'date_modified' => $date,
        	            'cover' => $cover_photo,
        	            'category' => 1,
        	            'author' => $_SESSION['username']
        	        );

        	        if($this->stories->insert($data)){
                        $this->users_model->total_post_by_author();
        	        	//$this->view('edit',$data);
                        redirect('admin/edit','refresh');
        	        }else{
        	        	$data['errors'] = 'Fatal error occured';
        	        	$this->view('add',$data);
        	        }
        	        
        	    }else{
        	        $data['errors']= $this->upload->display_errors();
        	        $this->view('add',$data);
        	    }
        	}else{
        		$data['errors'] = validation_errors();
        	    $this->view('add',$data);
        	}
        }else{
        	$this->view('add');
        }
    }//End of insert

        //insert post
    public function update($id, $page = 1){

        if(!$this->session->userdata('is_logged')){
            redirect('admin/login');
        }

        $data['row'] = $this->stories->select($id);

        if(isset($_POST['update'])){
            //set the validation rules
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $article = $this->input->post('body');
            $status = $this->input->post('status');
            $date_modified = $this->input->post('date_modified');
            $id = $this->input->post('id');
            $author = $this->input->post('author');
            $body = htmlentities($article);
            $date = mdate('%Y-%m-%j %h:%i:%s', time());
            $cover_photo = $this->input->post('photo');
            $covers = $this->input->post('covers');
            $tags = "";

            //add the tags to string $tags
            if(isset($_POST['tags'])){
                for($i =0;$i < count($_POST['tags']);$i++){
                    if($i == (count($_POST['tags']) - 1)){
                        $tags = $tags. $_POST['tags'][$i];
                    }else{
                        $tags = $tags. $_POST['tags'][$i] . ', ';
                    }
                }
            }else{
                $tags = '';
            }


            $config = array(
                array(
                    'field'=>'title',
                    'label' => 'Article title',
                    'rules' => 'required|trim'
                ),
                array(
                    'field'=>'description',
                    'label' => 'Article description',
                    'rules' => 'required|trim'
                ),
                array(
                    'field'=>'body',
                    'label' => 'Article body',
                    'rules' => 'required|trim'
                ),
                array(
                    'field'=>'tags[]',
                    'label' => 'tags',
                    'rules' => 'required|trim'
                ),
                array(
                    'field'=>'status',
                    'label' => 'status',
                    'rules' => 'required|trim'
                )
            );

            $this->form_validation->set_rules($config);



            

            if($this->form_validation->run()){
                if($covers == 2){
                    //do upload
                    $config['upload_path'] = 'assets/images';
                    $config['allowed_types'] = 'jpg|gif|png';
                    $config['file_name'] = date('YmjHis');
                    $config['max_size'] = 0;
                    $config['max_width'] = 0;
                    $config['max_length'] = 0;

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if($this->upload->do_upload('cover_photo')){
                        $file_data = $this->upload->data();
                        $cover_photo = $file_data['file_name'];
                        $data = array(
                            'title' => $title,
                            'description'=> $description,
                            'body' => $body,
                            'status' => $status,
                            'tags' => $tags,
                            'date_created' => $date_modified,
                            'date_modified' => $date,
                            'cover' => $cover_photo,
                            'category' => 1,
                            'author' => $author
                        );

                        if($this->stories->update($data, $id)){
                            $data['row'] = $this->stories->select($id); 
                            //$this->view('update',$data);
                            redirect('admin/edit/'.$page.'/#'.$id,'refresh');
                        }else{
                            $data['errors'] = 'Fatal error occured...';
                            $data['row'] = $this->stories->select($id); 
                            $this->view('update',$data);
                        }
                    }else{
                        $data['errors']= $this->upload->display_errors();
                        //$cover_photo = 'buffalo.jpg';
                        $this->view('update',$data);
                    }

                }else{
                    $data = array(
                        'title' => $title,
                        'description'=> $description,
                        'body' => $body,
                        'status' => $status,
                        'tags' => $tags,
                        'date_created' => $date_modified,
                        'date_modified' => $date,
                        'cover' => $cover_photo,
                        'category' => 1,
                        'author' => $author
                    );

                    if($this->stories->update($data, $id)){
                        $data['row'] = $this->stories->select($id); 
                        //$this->view('update',$data);
                        redirect('admin/edit#'.$id,'refresh');
                    }else{
                        $data['errors'] = 'Fatal error occured...';
                        $data['row'] = $this->stories->select($id); 
                        $this->view('update',$data);
                    }
                }
               
                
            }else{
                $data['errors'] = validation_errors();
                $data['row'] = $this->stories->select($id); 
                $this->view('update',$data);
            }
        }else{
            $data['row'] = $this->stories->select($id); 
            $this->view('update',$data);
        }
    }//End of insert

	public function edit($id = 1)
	{	
		//Edit the story
        $data['rows'] = $this->stories->select_all();
        $this->view('edit', $data);

	}

	public function monitor($value='')
	{	
		//Delete or pause a post
		# code...
		$this->view('monitor');
	}

    public function delete($id)
    {
        if($this->db->delete('stories', array('id'=>$id))){
            redirect('admin/edit','refresh');
        }
    }

    public function play($id, $page=1)
    {
        # code...
        if($this->stories->play($id)){
            redirect('admin/edit/'.$page.'#'.$id,'refresh');
        }
    }

    public function pause($id, $page=1)
    {
        # code...
        if($this->stories->pause($id)){
            redirect('admin/edit/'.$page.'#'.$id,'refresh');
        }
    }

    public function like($id)
    {
        # code...
        if($this->stories->like($id)){
            redirect('post/'.$id,'refresh');
        }
    }

    public function love($id)
    {
        # code...
        if($this->stories->love($id)){
            redirect('post/'.$id,'refresh');
        }
    }



}

/* End of file admin_c.php */
/* Location: ./application/controllers/admin_c.php */