<?php

class Posts extends CI_Controller
{

    public function index()
    {


        $data['title'] = 'Latest Posts';

        $this->db->order_by('id', 'DESC');
        $data['posts'] = $this->post_model->get_posts();

        // var_dump($data['posts']);

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug)
    {

        $data['post'] = $this->post_model->get_posts($slug);

        $data['title'] = $data['post']['title'];

        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {

        $data['title'] = 'Create Posts';

        $config['upload_path'] = './assets/images/posts';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '2048';
        $config['max_height'] = '500';
        $config['max_width'] = '500';

        $new_name = '';
        if (!empty($_FILES['userfile']['name'])) {
            $new_name = time() . $_FILES['userfile']['name'];
            $config['file_name'] = $new_name;
        }




        $this->load->library('upload', $config);

        // $errors = '';
        if (!$this->upload->do_upload()) {
            $errors = array('error' => $this->upload->display_errors());
            $post_photo = 'noimage.jpg';
        } else {
            $data = array('data' => $this->upload->data());
            $post_photo = ($new_name === '') ? 'noimage.jpg' : $new_name;
        }






        $this->form_validation->set_rules('title', 'Title', 'required');  //first is name of input field  second is for error messages that are human readable last is the rule that we want 
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('posts/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Post Created';

            $this->post_model->create_post($post_photo);
            redirect('posts');
        }
    }

    public function delete($id)
    {

        var_dump($id);
        echo " ytest";
        $this->post_model->delete_post($id);



        redirect('posts');

        // $this->load->view('templates/header');
        // $this->load->view('posts/view',$data);
        // $this->load->view('templates/footer');

    }

    public function edit($slug)
    {

        $data['post'] = $this->post_model->get_posts($slug);

        $data['title'] = 'Edit Post';

        $config['upload_path'] = './assets/images/posts';
        $config['allowed_types'] = 'gif | jpg | jpeg | png ';
        $config['max_size'] = '10';
        $config['max_height'] = '500';
        $config['max_width'] = '500';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $errors = array('error' => $this->upload->display_errors());
            $post_photo = 'noimage.jpg';
        } else {
            $data = array('data' => $this->upload->data());
            $post_photo = $_FILES['userfile']['name'];
        }


        $this->form_validation->set_rules('title', 'Title', 'required');  //first is name of input field  second is for error messages that are human readable last is the rule that we want 
        $this->form_validation->set_rules('body', 'Body', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('posts/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->post_model->edit_post($post_photo);

            redirect('posts');
        }
    }
}
