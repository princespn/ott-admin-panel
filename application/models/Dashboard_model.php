<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model  extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
   
    function coinsDeductHistory($condition='')
    {
        $this->db->select("if(sum(cdh.coins),sum(cdh.coins),'0') sum");
        $this->db->from('coins_deduct_history cdh');
        $this->db->join('user_details u','u.id=cdh.userId','left');
        if(!empty($condition))
            $this->db->where($condition);
        $query = $this->db->get();
        return $query->row();
    }   

}