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

	function get_event($params)
	{
		try{
			$this->load->database();
			$this->db->select('e.title, e.image, e.url');
			$this->db->where(['e.category_id'=>$params['category_id'], 'e.status'=>1, 'c.status'=>1]);
			$this->db->order_by('date_created desc');
			$this->db->limit(6);
			$this->db->join('category as c', 'c.id = e.category_id');

			return $this->db->get('event as e');

		}catch (Exception $e) {
            return $this->db->error();
        }
	}
}