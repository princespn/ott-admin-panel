<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UsersGamePlay_model  extends CI_Model
{
    var $column_order = array(null,'ua.roomId','ua.gameType','ua.betValue','ua.isWin','ua.coins','ua.adminCommition','ua.adminAmount',null); //set column field database for datatable orderable
    var $column_search = array('ua.roomId','ua.gameType','ua.betValue','ua.isWin','ua.coins','ua.adminCommition','ua.adminAmount'); //set column field database for datatable searchable 
    var $order = array('ua.coinsDeductHistoryId' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
    
    private function _get_datatables_query($table,$condition='')
    {
        $this->db->select('ua.*');
        $this->db->from($table);      
        $this->db->group_by('ua.roomId');      

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
        $this->db->select('ua.*,u.user_name,u.email_id,u.mobile,u.playerType');
        $this->db->from("user_account ua");      
        $this->db->join('user_details u','u.id=ua.userId','left');      
        $this->db->where($cond); 
        $query = $this->db->get();
        return $query->result();     
    }

    public function getExportData($table,$condition=''){
        $this->db->select('ua.*');
        $this->db->from($table);      
        $this->db->group_by('ua.roomId');
        if(!empty($condition)){
            $this->db->where($condition);
        }
        $query = $this->db->get();
        return $query->result();   
    }

}