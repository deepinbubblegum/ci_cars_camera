<?php
class Usermanager_model extends CI_Model {

    public function register($data)
    {
        $this->db->insert('user_id', $data);
        return true;
    }

    public function getUserModel()
    {
        $this->db->select('u_id, username');
        $this->db->from('user_id');
        $this->db->where('username != ', 'admin');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_user_model($id)
    {
        $this->db->delete('user_id', array('u_id' => $id));
        return true;
    }
}
