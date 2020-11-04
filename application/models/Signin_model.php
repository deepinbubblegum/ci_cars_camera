<?php
class Signin_model extends CI_Model {

    public function user_sign_in($user_id = null)
    {
        if ($user_id != null) {
            $this->db->select('password');
            $this->db->from('user_id');
            $this->db->where('username', $user_id);
            $query = $this->db->get();
            return $query->result();
        }else{
            return false;
        }


    }

}
