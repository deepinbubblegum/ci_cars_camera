<?php
class Usermanager_model extends CI_Model {

    public function register($data)
    {
        $this->db->insert('user_id', $data);
        return true;
    }
}
