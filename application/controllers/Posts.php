<?php 

class Posts extends CI_Controller{

 public function index(){

 
    $data['title']='Latest Posts';

    $this->db->order_by('id','DESC');
    $data['posts']=$this->post_model->get_posts();

    // var_dump($data['posts']);

    $this->load->view('templates/header');
    $this->load->view('posts/index',$data);
    $this->load->view('templates/footer');

 }

 public function view($slug){

    $data['post']=$this->post_model->get_posts($slug);

    $data['title']=$data['post']['title'];

    $this->load->view('templates/header');
    $this->load->view('posts/view',$data);
    $this->load->view('templates/footer');

 }

 public function create(){

    $data['title']='Create Posts';


    $this->form_validation->set_rules('title','Title','required');  //first is name of input field  second is for error messages that are human readable last is the rule that we want 
    $this->form_validation->set_rules('body','Body','required');

    if($this->form_validation->run()==FALSE){
       $this->load->view('templates/header');
        $this->load->view('posts/create',$data);
        $this->load->view('templates/footer');
    }
    else{
    $data['title']='Post Created';

        $this->post_model->create_post();
       redirect('posts');
        }
 }

 public function delete($id){

    var_dump($id);
    echo " ytest";
    $this->post_model->delete_post($id);

    

    redirect('posts');

    // $this->load->view('templates/header');
    // $this->load->view('posts/view',$data);
    // $this->load->view('templates/footer');

 }

 public function edit($slug){

    $data['post']=$this->post_model->get_posts($slug);

    $data['title']='Edit Post';

    $this->form_validation->set_rules('title','Title','required');  //first is name of input field  second is for error messages that are human readable last is the rule that we want 
    $this->form_validation->set_rules('body','Body','required');

    if($this->form_validation->run()==FALSE){
       $this->load->view('templates/header');
        $this->load->view('posts/edit',$data);
        $this->load->view('templates/footer');
    }
    else{
        $this->post_model->edit_post();
       
        redirect('posts');
        }

 }
    
}



?>