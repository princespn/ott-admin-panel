<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class MatchHistory_model  extends CI_Model
{
	 var $column_order = array(null,'rud.roomId','rud.gameStatus','rud.isTournament',null); //set column field database for datatable orderable
	var $column_search = array('rud.tableId','rud.gameStatus','rud.isTournament'); //set column field database for datatable searchable 
	 var $order = array('rud.created' => 'DESC'); 

	function __construct()
	{
		parent::__construct();
	}
	
	private function _get_datatables_query($table,$condition='')
	{
		$this->db->select('rud.*,u.user_name,u.email_id,u.mobile,u.playerType');
        $this->db->from("rooms rud");      
        $this->db->join('user_details u','u.user_id=rud.userId','left');        
        $this->db->group_by('rud.roomId');

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
		$this->_get_datatables_query($table,$condition);
		return $this->db->count_all_results();
	}


	public function count_filtered($table,$condition='')
	{
		$this->_get_datatables_query($table,$condition);
		$query = $this->db->get();
		return $query->num_rows();
	}    

	public function matchesData($cond){
		$this->db->select('rud.*,u.user_name,u.email_id,u.mobile,u.playerType');
		$this->db->from("rooms rud");      
		$this->db->join('user_details u','u.user_id=rud.userId','left');      
		$this->db->where($cond); 
		$query = $this->db->get();
		return $query->result();     
	}

	public function getExportData($table,$condition=''){
		$this->db->select('rud.*,u.id,u.user_id,u.user_name,u.email_id,u.mobile,u.playerType');
		$this->db->from($table);      
		$this->db->join('user_details u','u.user_id=rud.userId','left');
		if(!empty($condition))
			$this->db->where($condition);
		$this->db->group_by('rud.roomId');
		$this->db->order_by('rud.created DESC');
		$query = $this->db->get();
		return $query->result();
	}

}