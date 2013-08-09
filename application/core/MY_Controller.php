<?php

class MY_Controller extends CI_Controller {

    var $user_id;
    var $user_OBJ;
    var $categories;
    var $session;

    function __construct() {
        parent::__construct();

        $this->load->library("session");

        if ($this->session->userdata('loggedIn') == "Yes") {
            $user_id = $this->session->userdata('user_id');

            $this->load->model('user_model', '', TRUE);
            $user = $this->user_model->loadUser($user_id);

            $this->headdata['user_header'] = "yes";
            $this->headdata['user'] = $user;

            $this->user_id = $user_id;
            $this->user_OBJ = $user;
        } else {
            $this->headdata['user_header'] = "no";
        }

        $this->load->model('product_model', '', TRUE);
        $cat = $this->product_model->getAllCategories();

        $this->categories = $cat;
        $this->headdata['categories'] = $this->categories;
    }

    function is_default_select($str) {
            if ($str == 'SELECT') {
                $this->form_validation->set_message('is_default_select', 'Please select a <b>%s</b>');
                return FALSE;
            }
        return TRUE;
    }
    
    function check_login($pass) {
        $username = $this->input->post('username');

        $this->load->model('login_model');
        $uid = $this->login_model->login($username, $pass);

        if (!$uid) {
            $this->form_validation->set_message('check_login', 'Incorrect Username/Email or password');

            return FALSE;
        } else {
            $this->load->library('session');
            $this->session->set_userdata('uid', $uid);

            return TRUE;
        }
    }

}
