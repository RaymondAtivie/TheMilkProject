<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_class
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
class User_class {

    var $id;
    var $first_name;
    var $last_name;
    var $email;
    var $location;
    var $matric_number;
    var $credit;

    function __construct($id = "") {
        if (is_array($id)) {
            $id = array('id' => $id['id']);

            $CI = & get_instance();
            $CI->load->database();

            $query = $CI->db->get_where(TB_USERS, $id);

            $row = $query->result_array();
            $obj = $row[0];

            foreach ($obj as $k => $v) {
                $this->$k = $v;
            }
        }
    }

    function getUnreadNotification() {
        $CI = & get_instance();
        $CI->load->model("notification_model", "n", TRUE);
        
        return $CI->n->getUnreadNotification($this->id, "num");        
        
    }

}

?>
