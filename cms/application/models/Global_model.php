<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function filter($params)
    {
        if(!empty($params['select'])){
            $this->db->select($params['select']);
        }
        if(!empty($params['offset'])){
            $this->db->offset($params['offset']);
        }
        if(!empty($params['limit'])){
            $this->db->limit($params['limit']);
        }
        if(isset($params['id'])){
            $this->db->where('id', $params['id']);
        }
        if(!empty($params['order'])){
            foreach ($params['order'] as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        if(!empty($params['join'])){
            foreach ($params['join'] as $row) {
                if(!empty($row[2])){
                    $this->db->join($row[0], $row[1], $row[2]);
                }else{
                    $this->db->join($row[0], $row[1]);
                }
            }
        }
        if(!empty($params['search'])){
            $i = 1;
            $this->db->group_start();
            foreach ($params['search'] as $key => $value) {
                if($i==1){
                    $this->db->like($key, $value);
                }else{
                    $this->db->or_like($key, $value);
                }
                $i++;
            }
            $this->db->group_end();
        }
        if(!empty($params['where'])){
            foreach ($params['where'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }
    }
    function get($params = [])
    {
        $this->filter($params);
        return $this->db->get($params['table']);
    }
    function count($params = [])
    {
        $this->filter($params);
        $this->db->from($params['table']);
        return $this->db->count_all_results();
    }
    function insert($params = [])
    {
        $this->db->insert($params['table'], $params['data']);
        return $this->db->insert_id();
    }
    function update($params = [])
    {
        return $this->db->update($params['table'], $params['data'], ['id'=>$params['id']]);
    }
    function delete($params = [])
    {   
        $this->filter($params);
        return $this->db->delete($params['table']);
    }
    function query($query)
    {   
        return $this->db->query($query);
    }
	function trans_start()
	{
		$this->db->trans_start();
	}
	function trans_complete()
	{
		$this->db->trans_complete();
	}
}
