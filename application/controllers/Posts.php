<?php

class Posts extends CI_Controller
{

    public function index()
    {


        $data['title'] = 'Latest Posts';

        $this->db->order_by('id', 'DESC');
        $data['posts'] = $this->post_model->get_posts();


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

        $data['posts'] = $this->post_model->get_posts();

        $data['emails'] = [];
        $data['titles'] = [];


        foreach ($data['posts'] as $post) {

            $data['emails'] = [...$data['emails'], $post['email']];
            $data['titles'] = [...$data['titles'], $post['title']];
        }

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


        $this->form_validation->set_rules('title', 'Title', 'required|htmlspecialchars|is_unique[posts.title]');  //first is name of input field  second is for error messages that are human readable last is the rule that we want 
        $this->form_validation->set_rules('name', 'Name', 'required|htmlspecialchars');
        $this->form_validation->set_rules('email', 'Email',  'required|valid_email|is_unique[posts.email]|htmlspecialchars');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|max_length[10]|min_length[10]|greater_than[0]|htmlspecialchars');
        $this->form_validation->set_rules('body', 'Body', 'required|htmlspecialchars');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('posts/create', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Post Created';

            $this->post_model->create_post($post_photo);
            $this->session->set_flashdata('post_created', 'Post Has been created');
            redirect('posts');
        }
    }

    public function delete($id)
    {

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

        $data['posts'] = $this->post_model->get_posts();

        $data['emails'] = [];
        $data['titles'] = [];


        foreach ($data['posts'] as $post) {

            $data['emails'] = [...$data['emails'], $post['email']];
            $data['titles'] = [...$data['titles'], $post['title']];
        }



        $new_name = '';
        $post_photo = $data['post']['post_photo'];
        if (!empty($_FILES['userfile']['name'])) {
            $new_name = time() . $_FILES['userfile']['name'];
            $config['file_name'] = $new_name;
            $config['upload_path'] = './assets/images/posts';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '2048';
            $config['max_height'] = '500';
            $config['max_width'] = '500';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $post_photo = 'noimage.jpg';
                var_dump($errors);
            } else {
                $data = array('data' => $this->upload->data());
                $post_photo = ($new_name === '') ? 'noimage.jpg' : $new_name;
            }
        }




        $is_unique_email = '';
        $is_unique_title =  '';


        if (!empty($data['post'])) {


            if ($this->input->post('email') != $data['post']['email']) {
                $is_unique_email =  '|is_unique[posts.email]';
            } else {
                $is_unique_email =  '';
            }
            if ($this->input->post('title') != $data['post']['title']) {
                $is_unique_title =  '|is_unique[posts.title]';
            } else {
                $is_unique_title =  '';
            }
        }


        // $is_unique_email =  '|is_unique[posts.email]';

        $this->form_validation->set_rules('title', 'Title', 'required|htmlspecialchars' . $is_unique_title);  //first is name of input field  second is for error messages that are human readable last is the rule that we want 
        $this->form_validation->set_rules('name', 'Name', 'required|htmlspecialchars');
        $this->form_validation->set_rules('email', 'Email',  'required|valid_email|htmlspecialchars' . $is_unique_email);
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|max_length[10]|min_length[10]|greater_than[0]|htmlspecialchars');
        $this->form_validation->set_rules('body', 'Body', 'required|htmlspecialchars');

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
