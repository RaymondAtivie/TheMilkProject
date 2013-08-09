<?php

/**
 * Description of user_model
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
class user_model extends CI_Model{
    
    var $user_id;
    var $user_OBJ;
    
    function __construct(){
        parent::__construct();  
    }
    
    function loadUser($user_id){        
        $this->user_id = $user_id;
        
        $this->load->library('custom/User_class');
        $this->user_OBJ = new User_class(array("id"=>$this->user_id));
        
        return $this->user_OBJ;
    }
    
    function getUserProducts(){
        $where = array('user_id'=>$this->user_id);
        $query = $this->db->select("id")->get_where(TB_PRODUCTS, $where);
        
        $this->load->library('custom/Product_class');
        foreach($query->result() as $row){
            $objs[] = new Product_class(array("id"=>$row->id));
        }
        
        if(isset($objs)){
            return $objs;
        }else{
            return FALSE;
        }        
    }
    
    function addProduct($name, $category, $ending, $price, $description, $min_increment, $image){
        $this->load->model('product_model');
        return $this->product_model->addProduct($name, $category, $ending, $price, $description, $min_increment, $image, $this->user_OBJ->id);
    }
    
    function deleteProduct(){
        
    }
    
    function editProduct(){
        
    }
    
}

?>
