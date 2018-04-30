<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_m extends CI_Model{

	private $lastQuery = '';

	public function getBlog($limit, $start){
		$this->db->order_by('created_at', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get('tbl_blogs');
		$this->lastQuery = $this->db->last_query();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function submit(){
		$field = array(
			'title'=>$this->input->post('txt_title'),
			'description'=>$this->input->post('txt_description'),
			'created_at'=>date('Y-m-d H:i:s')
			);
		$this->db->insert('tbl_blogs', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function getBlogById($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_blogs');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function update(){
		$id = $this->input->post('txt_hidden');
		$field = array(
			'title'=>$this->input->post('txt_title'),
			'description'=>$this->input->post('txt_description'),
			'updated_at'=>date('Y-m-d H:i:s')
			);
		$this->db->where('id', $id);
		$this->db->update('tbl_blogs', $field);
		echo $this->db->last_query();extit;
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_blogs');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function getTotalRow(){
		$sql = explode('LIMIT', $this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result = $query->result();
		return count($result);
	}

}