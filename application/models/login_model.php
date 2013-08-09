<?php

/**
 * Description of login_model
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
class login_model extends CI_Model{
    
    var $user_id;
    var $user_OBJ;
    
    function __construct(){
        parent::__construct();  
    }
    
    function login($username, $password){  
        
        $p = array('password'=>$password);                
        $where = "(`username` = '$username' OR `email`='$username')";
        
        $query = $this->db->select('id')->from(TB_USERS)->where($where)->where($p)->get();  
        
        if($query->num_rows > 0){
            $row = $query->result();
            
            return $row[0]->id;
        }else{
            return false;
        }
    }
    
}

?>
