<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BotPlayer_model extends CI_Model
{
	var $column_order = array(null,'u.user_name','u.country_name','u.balance',null,'u.status',null); //set column field database for datatable orderable
    var $column_search = array('u.user_name','u.country_name','u.balance','u.status'); //set column field database for datatable searchable 
    var $order = array('u.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query($table,$condition='')
	{
        $this->db->select('u.*');
        $this->db->from($table);           
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
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->count_all_results();
    }


    function count_filtered($table,$condition='')
    {
        $this->_get_datatables_query($table,$condition);
        $query = $this->db->get();
        return $query->num_rows();
    }      

}