<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model 
{
	function get($table_name, $select = array(), $where = '', $order = '', $limit = 0, $join_table='', $join='')
	{
		$this->load->database();
		if ($select) {
			$this->db->select($select);
		}
		if ($where) {
			$this->db->where($where);
		}
		if ($order) {
			$this->db->order_by($order);
		}
		if ($limit) {
			$this->db->limit($limit);
		}
		if ($join) {
			$this->db->join($join_table, $join);
		}
		return $this->db->get($table_name);	
	}

	function add($table,$data)
	{
		try{
			$this->load->database();
			$this->db->insert($table,$data);
			return $this->db->insert_id();

		}catch (Exception $e) {
            return $this->db->error();
        }
	}

	function edit($table,$id,$data)
	{
		$this->load->database();
		$this->db->where('id',$id);
		if($this->db->update($table,$data)){
			return true;
		}else{
			return false;
		}
	}

}