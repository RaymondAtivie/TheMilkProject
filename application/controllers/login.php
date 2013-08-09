<?php

/**
 * Description of login
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
class Login extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

        if ($this->input->post() OR $this->input->get("redirect")) {
            $this->load->library('form_validation');

            if ($this->form_validation->run('login') == FALSE) {
                if ($this->input->get("redirect")) {
                    $this->session->set_flashdata('redirect', $this->input->get("redirect"));
                }elseif($this->session->flashdata('redirect')){
                    $this->session->keep_flashdata('redirect');
                }
            } else {
                //$this->load->library('session');
                $uid = $this->session->userdata('uid');

                $this->session->set_userdata('user_id', $uid);
                $this->session->set_userdata('loggedIn', "Yes");

                if ($this->input->get("redirect")) {
                    $this->session->set_flashdata("bid_status", "success");
                    $this->session->set_flashdata("bid_msg", "You have logged in");
                    
                    redirect(base_url($this->input->get("redirect")));
                } elseif ($this->session->flashdata('redirect')) {                    
                    $this->session->set_flashdata("bid_status", "success");
                    $this->session->set_flashdata("bid_msg", "You have logged in");
                    
                    redirect(base_url($this->session->flashdata('redirect')));
                } else {
                    redirect(base_url('user/dashboard'));
                }


                die();
            }
        }

        $this->load->view('templates/default/include/header', $this->headdata);
        $this->load->view('templates/default/user/login');
        $this->load->view('templates/default/include/footer');
    }

    function logout() {
        $this->session->sess_destroy();

        redirect(base_url());
    }

}

?>
