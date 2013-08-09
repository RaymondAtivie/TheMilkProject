<?php

class Home extends MY_Controller
{

   public function index()
   {
       $this->load->model('product_model', '', TRUE);
       $lProducts = $this->product_model->getLatestProducts(4);
       //$cat = $this->product_model->getAllCategories();
       
       $data['lProducts'] = $lProducts;
       $data['categories'] = $this->categories;
       
       foreach($this->categories as $c){
           $categoryProducts[$c->id] = $this->product_model->getProductsByCategory($c->id, 8);
           $categoryProducts[$c->id]['obj'] = $c;
       }
       
       //print_r($categoryProducts);
       
       $data['categoryProducts'] = $categoryProducts;       
       
       $this->load->view('templates/default/include/header', $this->headdata);
       $this->load->view('templates/default/home', $data);
       $this->load->view('templates/default/include/footer');
   }

}
