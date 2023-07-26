<?php 



class Post_model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }
    public function get_posts($slug=FALSE){
        if($slug===FALSE){
            $query=$this->db->get('posts');
            return $query->result_array();
        }

        $query=$this->db->get_where('posts',array('slug'=>$slug));
        return $query->row_array();
    }   

    public function create_post(){

        $title=$this->input->post('title');
        $body=$this->input->post('body');
        $slug=url_title($title);

        $data=[
         'title' =>  $title,
         'body' =>  $body, 
         'slug' =>  $slug, 

        ];


       return $this->db->insert('posts',$data);

    } 

    public function delete_post($id){

     $this->db->where('id',$id);
     $this->db->delete('posts');
   
     var_dump($id);
     return $this->db->affected_rows()>0;


    } 

    public function edit_post(){

        $title=$this->input->post('title');
        $body=$this->input->post('body');
        $id=$this->input->post('id');
        

        $slug=url_title($title);

        $data=[
         'title' =>  $title,
         'body' =>  $body, 
         'slug' =>  $slug, 
        ];

        $this->db->where('id',$id);
       return $this->db->update('posts',$data);
    } 
}




?>