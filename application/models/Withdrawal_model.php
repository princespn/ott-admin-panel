<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Withdrawal_model extends CI_Model
{
	var $column_order = array(null,'u.user_name','u.email_id','d.mobileNo','d.amount',null,null,'u.balance','d.created','d.status',null); //set column field database for datatable orderable
	var $column_search = array('u.user_name','u.email_id','d.mobileNo','d.amount','u.balance','d.created','d.status'); //set column field database for datatable searchable 
	var $order = array('d.id' => 'DESC'); 

	function __construct()
	{
		parent::__construct();
	}
	
	private function _get_datatables_query($table,$condition='')
	{
		$this->db->select('d.*,u.user_id,u.user_name,u.email_id');
		$this->db->from($table); 
		$this->db->join("user_details u","u.id=d.user_detail_id","left");       
	   // $this->db->group_by("d.user_detail_id");       
		 $i = 0;

		 if(!empty($condition))
			$this->db->where($condition);

	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables($table,$condition='')
	{
		$this->_get_datatables_query($table,$condition);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_all($table,$condition='')
	{    
		$this->db->select('d.*,u.user_id,u.user_name,u.balance,u.email_id');
		$this->db->from($table); 
		$this->db->join("user_details u","u.id=d.user_detail_id","left"); 
		 if(!empty($condition))
		$this->db->where($condition);
		return $this->db->count_all_results();
	}

	function count_filtered($table,$condition='')
	{
		$this->_get_datatables_query($table,$condition);
		$query = $this->db->get();
		return $query->num_rows();
	}    

	function getWithdrawalData($table,$condition='')
	{
		$this->db->select('d.*,u.user_id,u.user_name,u.email_id,u.balance');
		$this->db->from($table); 
		$this->db->join("user_details u","u.id=d.user_detail_id","left");
		$this->db->order_by('d.id DESC');  
		if(!empty($condition))
			$this->db->where($condition);
		$query = $this->db->get();
		return $query->row();
	}   

	function getExportData($table,$condition=''){
		$this->db->select('d.*,u.user_name,u.user_id,u.user_name,u.email_id,u.balance,u.mobile,bd.acc_holderName,bd.accno,bd.ifsc');
		$this->db->from($table); 
		$this->db->join("user_details u","u.id=d.user_detail_id","left");
		$this->db->join("bank_details bd","bd.user_detail_id=d.user_detail_id","left");
		$this->db->order_by('d.id DESC');  
		if(!empty($condition))
			$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	} 


	function getAllRedeemUser($table,$condition=''){
		$this->db->select('d.*,u.user_name,u.user_id,u.email_id');
		$this->db->from($table); 
		$this->db->join("user_details u","u.id=d.user_detail_id","left");
		$this->db->order_by('d.id DESC');  
		if(!empty($condition))
			$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	} 
}