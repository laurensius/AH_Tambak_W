<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_log extends CI_Model {
    
    function insert($data){
        $this->db->insert("t_log",$data);
        return $this->db->affected_rows();
    }

    function select(){
        $this->db->select('*');
        $this->db->from('t_log');
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

}