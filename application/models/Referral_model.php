<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Referral_model extends CI_Model
{
	var $column_order = array(null,'u.user_name','ru.referalAmount',null); //set column field database for datatable orderable
	var $column_search = array('u.user_name','ru.referalAmount'); //set column field database for datatable searchable 
	var $order = array('ru.referLogId' => 'DESC'); 

	function __construct()
	{
		parent::__construct();
	}
	
	private function _get_datatables_query($table,$condition='')
	{
		$this->db->select('ru.referLogId,count(ru.toUserId) as totalRef,ru.fromUserId,sum(ru.referalAmount) as Amt,ru.toUserName,ru.referalAmountBy,ud.user_name,u.user_name as referralUser');
		$this->db->from($table);        
		$this->db->join("user_details ud","ud.id=ru.toUserId","left");        
		$this->db->join("user_details u","u.id=ru.fromUserId","left");        
		$this->db->group_by("ru.fromUserId");        
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
		if(!empty($condition))
			$this->db->where($condition);
		$this->db->select('ru.referLogId,count(ru.toUserId) as totalRef,ru.fromUserId,sum(ru.referalAmount) as Amt,ru.toUserName,ru.referalAmountBy,ud.user_name,u.user_name as referralUser');
		$this->db->from($table);        
		$this->db->join("user_details ud","ud.id=ru.toUserId","left");        
		$this->db->join("user_details u","u.id=ru.fromUserId","left");        
		$this->db->group_by("ru.fromUserId");    
		return $this->db->count_all_results();
	}


	function count_filtered($table,$condition='')
	{
		$this->_get_datatables_query($table,$condition);
		$query = $this->db->get();
		return $query->num_rows();
	}    


	public  function getReferralRecord($condition='')
	{
		$this->db->select('ru.referLogId, ru.toUserId, ru.fromUserId, sum(ru.referalAmount) as referalAmount, ru.referalAmountBy, ud.user_name, u.user_name as referralUser,ru.toUserName');
		$this->db->from('referal_user_logs ru');        
		$this->db->join("user_details ud","ud.id=ru.toUserId","left");        
		$this->db->join("user_details u","u.id=ru.fromUserId","left");   
		if(!empty($condition))
			$this->db->where($condition);
		$this->db->group_by("toUserId");
		$query = $this->db->get();
		return $query->result();
	}  
}