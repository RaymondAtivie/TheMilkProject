<?php

/**
 * Description of credit_model
 *
 * @author Raymond Ativie <RaymondAtivie@gmail.com>
 */
class credit_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function loadCredit($u_id, $code) {
        if ($this->validateVoucher($code)) {

            $voucher = $this->getVoucher($code);
            $description = "Loaded Account with voucher (Voucher Code: " . $code . ")";

            $this->db->trans_start();
            $this->creditUser($u_id, $description, $voucher->amount);

            $this->useVoucher($code);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                log_message();
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    function transferCredit($u_id, $t_id, $amount) {
        $CI = & get_instance();
        $CI->load->model("user_model", "", TRUE);
        $user = $CI->user_model->loadUser($u_id);
        $tUser = $CI->user_model->loadUser($t_id);

        $description = "Credits transfer to " . $tUser->username . "(" . $tUser->first_name . " " . $tUser->last_name . ")";
        if ($this->useCredit($u_id, $description, $amount)) {

            $description = "Credits transfer from " . $user->username . "(" . $user->first_name . " " . $user->last_name . ")";
            if ($this->creditUser($t_id, $description, $amount)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function validateVoucher($code) {
        $query = $this->db->select("id")->get_where(TB_CREDIT_VOUCHERS, array("code" => $code, "used" => 0));
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function payabble($u_id, $amount) {
        $CI = & get_instance();
        $CI->load->model("user_model", "", TRUE);
        $user = $CI->user_model->loadUser($u_id);

        if ($user->credit < $amount) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function addHistory($u_id, $description, $amount, $credit_debit) {
        $insert = array(
            'user_id' => $u_id,
            'description' => $description,
            'amount' => $amount,
            'credit_debit' => $credit_debit
        );
        $r = $this->db->insert(TB_CREDIT_HISTORY, $insert);

        if ($r) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function debitUser($u_id, $description, $amount) {
        $CI = & get_instance();
        $CI->load->model("user_model", "", TRUE);
        $user = $CI->user_model->loadUser($u_id);

        if ($this->payabble($u_id, $amount)) {
            $newAmt = $user->credit - $amount;

            $where = array('id' => $u_id);
            $set = array('credit' => $newAmt);

            $this->db->trans_start();
            $this->db->update(TB_USERS, $set, $where);
            $this->addHistory($u_id, $description, $amount, "debit");
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                log_message();
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return FALSE;
        }
    }

    function creditUser($u_id, $description, $amount) {
        $CI = & get_instance();
        $CI->load->model("user_model", "", TRUE);
        $user = $CI->user_model->loadUser($u_id);

        $newAmt = $user->credit + $amount;

        $where = array('id' => $u_id);
        $set = array('credit' => $newAmt);

        $this->db->trans_start();
        $this->db->update(TB_USERS, $set, $where);
        $this->addHistory($u_id, $description, $amount, "credit");
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message();
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function useCredit($u_id, $description, $amount) {
        $b = $this->debitUser($u_id, $description, $amount);
        if ($b) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function useVoucher($code) {
        $where = array('code' => $code);
        $set = array('used' => time());

        $this->db->update(TB_CREDIT_VOUCHERS, $set, $where);
    }

    function insertVoucher($code, $amount) {
        if ($this->validateVoucher($code)) {
            return FALSE;
        } else {
            $insert = array(
                "code" => $code,
                "amount" => $amount);
            $q = $this->db->insert(TB_CREDIT_VOUCHERS, $insert);

            if ($q) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function getVoucher($code) {
        $query = $this->db->get_where(TB_CREDIT_VOUCHERS, array("code" => $code));
        $row = $query->result();

        return $row[0];
    }

    function getCreditHistory($u_id) {
        $where = array("user_id" => $u_id);
        $query = $this->db->from(TB_CREDIT_HISTORY)->where($where)->order_by("datetime DESC")->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $rows[] = $row;
            }
            return $rows;
        }else{
            return FALSE;
        }

    }

}

?>
