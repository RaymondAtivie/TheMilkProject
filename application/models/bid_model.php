<?php

/**
 * Description of bid_model
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
class bid_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function submitBid($bid, $p_id, $u_id) {

        if ($this->checkIfBidable($bid, $p_id, $u_id)) {
            if ($this->insertBid($bid, $p_id, $u_id)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    private function insertBid($bid, $p_id, $u_id) {
        $insert = array(
            'amount' => $bid,
            'product_id' => $p_id,
            'user_id' => $u_id
        );

        $record = $this->db->insert(TB_BIDS, $insert);

        if ($record > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function checkIfBidable($bid, $p_id, $u_id) {
        $where = array('user_id' => $u_id,
            'id' => $p_id);
        $query = $this->db->select("id")->get_where(TB_PRODUCTS, $where);

        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $b = $this->getWinningBid($p_id);
            if ($b) {
                if ($bid > $b) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
    }

    function getBidHistory($p_id) {
        $where = array('product_id' => $p_id);
        $query = $this->db->order_by("amount DESC")->get_where(TB_BIDS, $where);

        $CI = & get_instance();
        $CI->load->library("custom/User_class");

        if ($query->num_rows > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $rows[$i] = $row;
                $rows[$i]->user = new User_class(array('id' => $row->user_id));

                $datetime = new DateTime($row->time);
                $rows[$i]->ISOdatetime = $datetime->format(DateTime::ISO8601);

                $i++;
            }
            return $rows;
        } else {
            return FALSE;
        }
    }

    function getWinningBid($p_id) {
        $where = array('product_id' => $p_id);
        $query = $this->db->select("MAX(amount) AS amount")->from(TB_BIDS)->where($where)->group_by("product_id")->get();

        if ($query->num_rows > 0) {
            $row = $query->result();

            return $row[0]->amount;
        } else {
            $where = array('id' => $p_id);
            $query = $this->db->select("price")->from(TB_PRODUCTS)->where($where)->get();
            $row = $query->result();

            if ($query->num_rows > 0) {
                return $row[0]->price;
            } else {
                return 0;
            }
        }
    }

}

?>
