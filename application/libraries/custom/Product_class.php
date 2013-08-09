<?php

/**
 * Description of Product_class
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_class {

    var $id;
    var $name;
    var $description;
    var $image;
    var $price;
    var $highest_bid;
    var $category_id;
    var $category;
    var $uploaded;
    var $ending;
    var $min_increment;
    var $user_id;
    var $bidHistory;

    function __construct($id = "") {
        if (is_array($id)) {
            $id = array('id' => $id['id']);

            $CI = & get_instance();

            $query = $CI->db->get_where(TB_PRODUCTS, $id);

            $row = $query->result_array();
            $obj = $row[0];

            foreach ($obj as $k => $v) {
                $this->$k = $v;
            }

            $CI->load->model('product_model', '', TRUE);
            $cat = $CI->product_model->getAllCategories();

            //echo $this->category_id;

            $this->category = $cat[$this->category_id]->name;

            $CI->load->model('bid_model', '', TRUE);
            $this->highest_bid = $CI->bid_model->getWinningBid($this->id);
        }
    }

    function getBidHistory() {

        $CI = & get_instance();

        $CI->load->model('bid_model', '', TRUE);
        $this->bidHistory = $CI->bid_model->getBidHistory($this->id);

        return $this->bidHistory;
    }

}