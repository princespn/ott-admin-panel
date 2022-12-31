<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PaymentTransaction_model extends CI_Model
{
	var $column_order = array(null,'ual.orderId','ud.user_name','ual.amount','ud.winWallet','ud.mainWallet',null,'ual.type','ual.paymentType','ual.status'); //set column field database for datatable orderable
    var $column_search = array('ual.orderId','ud.user_name','ual.amount','ud.winWallet','ud.mainWallet','ual.type','ual.paymentType','ual.status'); //set column field database for datatable searchable 
    var $order = array('ual.id' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query($table,$condition='')
	{
        $this->db->select('ual.*,ud.user_name,ud.mobile');
        $this->db->from($table);        
        $this->db->join("user_details ud","ud.id=ual.user_detail_id","left");        
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
        $this->db->select('ual.*,ud.user_name');
        $this->db->from($table);        
        $this->db->join("user_details ud","ud.id=ual.user_detail_id","left");       
        return $this->db->count_all_results();
    }


    function count_filtered($table,$condition='')
    {
        $this->_get_datatables_query($table,$condition);
        $query = $this->db->get();
        return $query->num_rows();
    }    


    function getUsers($table,$condition='')
    {
        $this->db->select('ud.*,b.bank_name,b.bank_city,b.bank_branch,b.accno,b.ifsc,b.is_bankVerified');
        $this->db->from($table);
        $this->db->join('bank_details b','b.user_detail_id=ud.id','left');
      //  $this->db->join('user_account ','kyc.user_detail_id=b.user_detail_id','left');
        if(!empty($condition))
            $this->db->where($condition);
        $query = $this->db->get();
        return $query->row();
    }   
}