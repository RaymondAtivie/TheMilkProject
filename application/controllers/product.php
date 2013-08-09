<?php

class Product extends MY_Controller {

    public function index() {
        show_404();
        $id = $this->input->get('id');
        $params = array('id' => $id);

        $this->load->model('Product_model', '', TRUE);
        $product = $this->Product_model->getProduct(4);

        $data['product'] = $product;
        $data['product']->price = price_tag($data['product']->price);

        $this->load->view('templates/default/include/header', $this->headdata);
        $this->load->view('templates/default/product', $data);
        $this->load->view('templates/default/include/footer');
    }

    public function getProduct($id) {

        $this->load->model('Product_model', '', TRUE);
        $product = $this->Product_model->getProduct($id);

        $data['biddable'] = ($this->user_id == $product->user_id);
        $data['PBH'] = $product->getBidHistory();
        $data['product'] = $product;
        $data['product']->price = price_tag($data['product']->price);

        if ($this->session->flashdata('bid_status')) {
            $data['bid_status'] = $this->session->flashdata('bid_status');
            $data['bid_msg'] = $this->session->flashdata('bid_msg');
        }

        $this->load->view('templates/default/include/header', $this->headdata);
        $this->load->view('templates/default/product', $data);
        $this->load->view('templates/default/include/footer');
    }

}
