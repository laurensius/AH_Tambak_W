<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_monitoring extends CI_Model {
    
    function update($data){
        $this->db->where('id', 1);
        $this->db->update('t_monitoring', $data); 
        return $this->db->affected_rows();
    }

    function select(){
        $this->db->select('*');
        $this->db->from('t_monitoring');
        $query = $this->db->get();
        return $query->result();
    }

}