<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Support_model extends CI_Model
{
	/* var $column_order = array(null,'u.user_name','r.reportTitle','r.reportDescription','r.reportScreenShot',null); //set column field database for datatable orderable
    var $column_search = array('u.user_name','r.reportTitle','r.reportDescription','r.reportScreenShot'); //set column field database for datatable searchable 
    var $order = array('r.reportId' => 'DESC'); 

    function __construct()
    {
        parent::__construct();
    }
	
	private function _get_datatables_query($table,$condition='')
	{
        $this->db->select('r.*,u.user_name');
        $this->db->from($table); 
        // $this->db->join('user_details u','u.id=r.userId','left'); 
        //$this->db->join('reply re','re.from_id=r.reportId','left'); 
        //$this->db->group_by('re.from_id');
        //$this->db->order_by('re.id desc');
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

    public function GetData($table,$field='',$condition='',$group='',$order='',$limit='',$result='')
    {
        if($field != '')
            $this->db->select($field);
        if($condition != '')
            $this->db->where($condition);
        if($order != '')
            $this->db->order_by($order);
        if($limit != '')
            $this->db->limit($limit);
        if($group != '')
            $this->db->group_by($group);
        if($result != '')
        {
            $return =  $this->db->get($table)->row();
        }else{
            $return =  $this->db->get($table)->result();
        }
        return $return;
    }
    
    public function SaveData($table,$data='',$condition='')
    {
        $DataArray = array();
        if(!empty($data))
        { 
            if(!empty($condition))
            {
                $data['modified']=date("Y-m-d H:i:s");
            }
            else
            {
                $data['created']=date("Y-m-d H:i:s");
                $data['modified']=date("Y-m-d H:i:s");
            }
        }
        $table_fields = $this->db->list_fields($table);
        foreach($data as $field=>$value)
        {
            if(in_array($field,$table_fields))
            {
                $DataArray[$field]= $value;
            }
        }

        if($condition != '')
        {
            $this->db->where($condition);
            $this->db->update($table, $DataArray);

        }else{
            $this->db->insert($table, $DataArray);
        }
    }

    public function DeleteData($table,$condition='',$limit='')
    {
        if($condition != '')
            $this->db->where($condition);
        if($limit != '')
            $this->db->limit($limit);
        $this->db->delete($table);
    } 

    public function getUserName($condition=''){
        $this->db->select('s.*,u.user_name,u.profile_img,(select count(userId) from support_logs sl where sl.userId=s.userId and sl.type="User" and sl.isRead="No") userTotalMessage');
        $this->db->from('support_logs s');
        if($condition != '')
        $this->db->where($condition);
        $this->db->join('user_details u','u.user_id=s.userId');
        $this->db->group_by('s.userId');
        $this->db->order_by('s.supportLogId desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getChat($condition=''){
        $this->db->select('s.*,u.user_name,u.profile_img');
        $this->db->from('support_logs s');
        if($condition != '')
        $this->db->where($condition);
        $this->db->join('user_details u','u.user_id=s.userId');
        // $this->db->group_by('c.userId');
         $this->db->order_by('s.supportLogId ASC');
        $query = $this->db->get();
        return $query->result();
    }*/

     
  
 
}