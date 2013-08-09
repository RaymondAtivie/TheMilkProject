<?php

/**
 * Description of product_model
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
class product_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getProduct($id) {

        $where = array('id' => $id);
        $query = $this->db->select('id')->get_where(TB_PRODUCTS, $where);
        $row = $query->result_array();

        $CI = & get_instance();
        $CI->load->library('custom/Product_class');

        $obj = new Product_class(array('id' => $row[0]['id']));

        return $obj;
    }

    function addProduct($name, $category, $ending, $price, $description, $min_increment, $image, $user_id) {
        $inserts = array('name' => $name,
            'category_id' => $category,
            'ending' => $ending,
            'price' => $price,
            'description' => $description,
            'min_increment' => $min_increment,
            'image' => $image,
            'user_id' => $user_id);

        $this->db->insert(TB_PRODUCTS, $inserts);

        return $this->db->insert_id();
    }

    function deleteProduct() {
        
    }

    function editProduct() {
        
    }

    function getLatestProducts($num = "ALL") {
        if ($num != "ALL") {
            $limit = $num;
        } else {
            $limit = NULL;
        }

        $query = $this->db->select('id')->order_by("id DESC")->get(TB_PRODUCTS, $limit);

        $CI = & get_instance();
        $CI->load->library('custom/Product_class');

        foreach ($query->result() as $row) {
            $obj[] = new Product_class(array('id' => $row->id));
        }

        return $obj;
    }

    function getProductsByCategory($category_id, $num = "ALL") {
        if ($num != "ALL") {
            $limit = $num;            
        } else {
            $limit = NULL;
        }

        $where = array('category_id' => $category_id);
        $query = $this->db->order_by("id ASC")->get_where(TB_PRODUCTS, $where, $limit);
        
        //echo $this->db->last_query();

        $CI = & get_instance();
        $CI->load->library('custom/Product_class');

        $obj = FALSE;
        if($query->num_rows() > 0) {            
            foreach ($query->result() as $row) {
                $obj[] = new Product_class(array('id' => $row->id));
            }
        }
        return $obj;
    }

    function getFeaturedProducts($num = "ALL") {
        
    }

    function getAllCategories() {
        $query = $this->db->get(TB_CATEGORY);
        foreach ($query->result() as $row) {
            $cat[$row->id] = $row;
        }

        return $cat;
    }
    
    function getCategory($id){
        
        $query = $this->db->get_where(TB_CATEGORY, array('id'=>$id));
        $row = $query->result();
        //print_r($row);
               
        return $row[0];
    }

}

?>
