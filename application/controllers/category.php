<?php

if (!defined('BASEPATH'))
    die();

class Category extends MY_Controller {

    public function index() {
        $this->load->view('templates/default/include/header', $this->headdata);
        $this->load->view('templates/default/category');
        $this->load->view('templates/default/include/footer');
    }
    
    public function openCategory($category_id){
        
        $this->load->model('product_model', '', TRUE);
        $products = $this->product_model->getProductsByCategory($category_id);
        
        //print_r($products);
        
        $data['products'] = $products;
        $data['category'] = $this->product_model->getCategory($category_id);
        
        $this->load->view('templates/default/include/header', $this->headdata);
        $this->load->view('templates/default/category', $data);
        $this->load->view('templates/default/include/footer');
    }

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
