<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_model extends CI_Model
{
	function get($table_name,$select = array(),$where = '',$order = '',$limit = 0,$offset = 0, $where_not='')
	{
		$this->load->database();
		if ($select) {
			$this->db->select($select);
		}
		if ($where) {
			$this->db->where($where);
		}
		if($where_not){
			$this->db->where_not_in('id', $where_not);
		}
		if ($order) {
			$this->db->order_by($order);
		}
		if ($limit) {
			$this->db->limit($limit);
		}
		if ($offset) {
			$this->db->offset($offset);
		}
		return $this->db->get($table_name);
	}
	function count($table_name,$where = '')
	{
		$this->load->database();
		if ($where) {
			$this->db->where($where);
		}
		return $this->db->count_all_results($table_name);
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
	function add_batch($table,$data){
		try{

			$this->load->database();
			return $this->db->insert_batch($table, $data);;

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
	function delete($table,$id)
	{
		$this->load->database();
		$this->db->where('id',$id);
		$this->db->delete($table);
	}
	function delete_from_field($table,$field,$id)
	{
		$this->load->database();
		$this->db->where($field,$id);
		$this->db->delete($table);
	}
	function delete_where($table, $where){
		$this->load->database();
		$this->db->where($where);
		return $this->db->delete($table);
	}
	function add_no_return($table,$data)
	{
		try{

			$this->load->database();
			$this->db->insert($table,$data);
			return;

		}catch (Exception $e) {
            return $this->db->error();
        }
	}
	function get_news($limit, $offset, $search = ''){
		$this->load->database();
		$this->db->select('A.*, B.name as category_name');
		$this->db->from('artikel A');
		$this->db->join('category B', 'A.id_category = B.id');
		if ($search) {
			$this->db->where('title ILIKE', '%'.$search.'%');
			$this->db->or_where('name ILIKE', '%'.$search.'%');
		}
		$this->db->where([
			'A.status' 				=> 1, 
			'A.published_date <'	=> date('Y-m-d H:i:s')
		]);
		$this->db->order_by('A.created_date DESC');
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get()->result();
	}
	function edit_from_field($table,$field,$id,$data)
	{
		$this->load->database();
		$this->db->where($field,$id);
		if($this->db->update($table,$data)){
			return true;
		}else{
			return false;
		}
	}
	function login($username, $password){
		$this->load->database();
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		if($this->db->count_all_results('users') > 0){
			return true;
		}
		else{
			return false;
		}
	}

	function change_password($username, $new_password){
		$this->load->database();
		$this->db->where('username', $username);
		$this->db->set('password', $new_password);
		if($this->db->update('users')){
			return true;
		}else{
			return false;
		}
	}

	function get_module($id){
		$this->load->database();
		$this->db->select('id_module');
		$this->db->from('member A');
		$this->db->join('privilege_module B', 'A.id_privilege = B.id_privilege');
		$this->db->where('A.id', $id);
		return $this->db->get()->result_array();
	}

	function get_participant_all($where='', $limit = '',$offset = '', $count=false)
    {
        try{
        	$limit  = ($limit)?'limit '.$limit:'';
        	$offset = ($offset)?'offset '.$offset:'';
        	
	        $this->load->database();
	       	$query =  $this->db->query("select * from (select r.id_participant, min(p.firstname) as firstname, min(p.lastname) as lastname, min(p.username) as username, min(p.email) as email, min(p.phone) as phone, min(p.date_registered) as date_registered, sum(r.score) as score, sum(r.playtime) as playtime from result as r left join participant as p on p.id = r.id_participant ".$where." group by r.id_participant) as b order by b.score desc, b.playtime asc ".$offset. " " .$limit);
	        
	        if($count){
	        	return $query->num_rows();
	        }
	        return $query;

    	}catch (Exception $e) {
            return $this->db->error();
        }
    }

    function edit_where($table,$where,$data)
	{
		$this->load->database();
		$this->db->where($where);
		if($this->db->update($table,$data)){
			return true;
		}else{
			return false;
		}
	}
}
