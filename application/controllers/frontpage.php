<?php

if (!defined('BASEPATH'))
    die();

class Frontpage extends MY_Controller {

    public function index() {
        $this->load->view('templates/default/include/header', $this->headdata);
        $this->load->view('templates/default/frontpage');
        $this->load->view('templates/default/include/footer');
    }

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
