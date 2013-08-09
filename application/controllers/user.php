<?php

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();

        auth_login($this->session);
    }

    public function index() {

        $this->load->view('templates/default/include/header', $this->headdata);
        //$this->load->view('templates/default/user/dashboard');
        $this->load->view('templates/default/include/footer');
    }

    public function dashboard() {
        $this->load->library('form_validation');

        $this->load->model('product_model', '', TRUE);
        $this->load->model('user_model', '', TRUE);
        $this->load->model('credit_model', 'c', TRUE);

        $lProducts = $this->product_model->getLatestProducts(3);
        $data['lProducts'] = $lProducts;

        $data['categories'] = $this->categories;
        $data['userProducts'] = $this->user_model->getUserProducts();
        $data['creditHistory'] = $this->c->getCreditHistory($this->user_id);
        $data['userOBJ'] = $this->user_OBJ;

        $this->load->view('templates/default/include/header', $this->headdata);
        $this->load->view('templates/default/user/dashboard', $data);
        $this->load->view('templates/default/include/footer');
    }

    public function addProduct() {
        $this->load->library('form_validation');

        if ($this->form_validation->run('sell') == FALSE) {
            $this->session->set_userdata("temp_show_box", "#sellCollapse");
            $this->dashboard();
        } else {
            foreach ($this->input->post() as $k => $v) {
                $$k = $v;
            }

            $ending = date("Y-m-d H:i:s", ($duration * 24 * 60 * 60) + time());
            $image = "unknown.jpg";

            $this->load->model('user_model');
            $this->user_model->loadUser($this->user_id);

            $pid = $this->user_model->addProduct($name, $category, $ending, $price, $description, $min_increment, $image);

            $this->session->set_flashdata("bid_status", "success");
            $this->session->set_flashdata("bid_msg", "<b>Yipee!!!</b> Your item is now up for auction");
            redirect(base_url("product/" . $pid));
        }
    }

    public function loadVoucher() {
        //$this->load->library('form_validation');
        if (!$this->input->post("credit1") OR !$this->input->post("credit1") OR !$this->input->post("credit1")) {
            $this->session->set_userdata("load_error", "<div class='alert alert-warning alert-block'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your voucher number is not complete</div>");
        } else {
            $code = $this->input->post("credit1") . $this->input->post("credit2") . $this->input->post("credit3");
            $this->load->model("credit_model", "c", TRUE);

            if (!$this->c->loadCredit($this->user_id, $code)) {
                $this->session->set_userdata("load_error", "<div class='alert alert-error alert-block'><button type='button' class='close' data-dismiss='alert'>&times;</button>Your Voucher is not correct. Please confirm you put the right numbers</div>");
            } else {
                $v = $this->c->getVoucher($code);
                $this->session->set_userdata("load_error", "<div class='alert alert-success alert-block'><button type='button' class='close' data-dismiss='alert'>&times;</button>" . $v->amount . " Credits have been added to your account</div>");
            }
        }
        $this->session->set_userdata("temp_show_box", "#addvoucherCollapse");
        $this->dashboard();
    }

    public function bid($p_id) {
        $bid = $this->input->post("bid");

        $this->load->model("bid_model", '', TRUE);
        $b = $this->bid_model->submitBid($bid, $p_id, $this->user_id);
        if (!$b) {
            $this->session->set_flashdata("bid_status", "error");
            $this->session->set_flashdata("bid_msg", "Your Bid must be greater than the highest bidder");
        } else {
            $this->session->set_flashdata("bid_status", "success");
            $this->session->set_flashdata("bid_msg", "You have successfully bidded for this product");
        }

        redirect('product/' . $p_id);
    }

    public function test() {
        $this->load->model("credit_model", "c", TRUE);
        if ($this->c->transferCredit($this->user_id, 3, 22)) {
            $this->load->model("notification_model", "n", TRUE);
            
            $description = $this->user_id." sent you 50 credits";
            echo $this->n->sendNotification(3, $description);
            
        }
    }

}
