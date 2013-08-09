<?php

/**
 * Description of notification_model
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
class notification_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function sendNotification($u_id, $description) {
        $insert = array(
            "user_id" => $u_id,
            "description" => $description);
        $query = $this->db->insert(TB_NOTIFICATION, $insert);

        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function readNotification($n_id) {
        $set = array("unread" => time());
        $where = array("id" => $n_id);
        $this->update(TB_NOTIFICATION, $set, $where);
    }

    function getAllUserNotification($u_id) {
        $where = array("user_id" => $u_id);
        $query = $this->db->get_where(TB_NOTIFICATION, $where);

        foreach ($query->result() as $rows) {
            $rows[] = $row;
        }

        return $rows;
    }

    function getUnreadNotification($u_id, $num = NULL) {
        $where = array(
            "user_id" => $u_id,
            "unread" => 0);
        $query = $this->db->get_where(TB_NOTIFICATION, $where);

        if ($query->num_rows() > 0) {
            if ($num) {
                return $query->num_rows();
            } else {
                foreach ($query->result() as $row) {
                    $rows[] = $row;
                }
                return $rows;
            }
        } else {
            return 0;
        }
    }

    function getNotification($n_id) {
        $where = array("id" => $n_id);
        $query = $this->db->get_where(TB_NOTIFICATION, $where);

        $row = $query->result();

        return $row[0];
    }

}

?>
