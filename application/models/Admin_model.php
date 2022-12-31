<?php
	class Admin_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
			
		}

/* FOR INSERT AND UPDATE 
|
|  INSERT INTO table_name SET column1 = value1, column2 = value2....columnN = valueN;
|  UPDATE table_name SET column1 = value1, column2 = value2....columnN=valueN WHERE {CONDITION};
*/
		
		public function save($table,$data,$con='') 
		{
			if($con!='')
			{
				$this->db->where($con);
				$this->db->update($table,$data);
			}
			else
			{
				$this->db->insert($table,$data);
				return $this->db->insert_id();
			}
		}

		
/* FOR DELETE FUNCTION 
|
| DELETE FROM table_name WHERE {CONDITON};
*/
		public function delete($table,$con)
		{
			$this->db->where($con);
			$this->db->delete($table);
		}
		
		
/* FOR FETCHING SINGLE RECORD 
|
| SELECT * FROM table_name  WHERE {CONDITION} ;
*/
		public function get_single_record($table,$con)
		{
			$this->db->where($con);
			return $this->db->get($table)->row();
		}

		
/* FOR FETCHING MULTIPLE RECORDS 
|
|  SELECT * fields_name FROM table_name WHERE {ORDER BY, GROUP BY, LIMIT 0,10};
*/
		
		public function get_multiple_record($table,$fields='', $con='',$order='',$group='',$limit='')
		{
			if($fields!='')
			$this->db->select($fields);
			if($con!='')
			$this->db->where($con);
			if($order!='')
			$this->db->order_by($order);
			if($group!='')
			$this->db->group_by($group);
			if($limit!='')
			$this->db->limit($limit);

			return $this->db->get($table)->result();
		}
		
	//created and modified 	
		// public function SaveData($table,$data,$con='')
			// {
				// $DataArray = array();
				// if(!empty($data))
				// {
					// $data['modified']=date("Y-m-d H:i:s");
				// }
				// if(empty($con))
				// {
					// $data['created']=date("Y-m-d H:i:s");
				// }
				// $table_fields = $this->db->list_fields($table);
				// foreach($data as $field=>$value)
				// {
					// if(in_array($field,$table_fields))
					// {
						// $DataArray[$field]= $value;
					// }
				// }
				// if($con != '')
				// {
					// $this->db->where($con);
					// $this->db->update($table, $DataArray);
				// }
				// else
				// {
					// $this->db->insert($table, $DataArray);
				// }
			// }

		 

		// public function fetch_categoryBrandsMapping()
		// {
			// $this->db->select('categories.id, categories.category, category_subcategory_brands_mapping.id as csbmid, category_subcategory_brands_mapping.category_id as cid,
			// subcategories.id, subcategories.sub_category, category_subcategory_brands_mapping.subcategory_id as sid,
			// brands.id, brands.brand_name, category_subcategory_brands_mapping.brand_id as bid, REPLACE(group_concat(distinct concat(brand_name,"<br/>") order by brand_name,"<br/>"),trim(","),"") bname');
			// $this->db->from('category_subcategory_brands_mapping');
			// $this->db->join('categories','category_subcategory_brands_mapping.category_id = categories.id','Left');
			// $this->db->join('subcategories','category_subcategory_brands_mapping.subcategory_id = subcategories.id','Left');
			// $this->db->join('brands','category_subcategory_brands_mapping.brand_id = brands.id','Left');
			// $this->db->order_by('category_subcategory_brands_mapping.id', 'DESC');
			// $this->db->group_by('categories.id,subcategories.id');
			// $query=$this->db->get();
			// $getMappingsData = $query->result_array();
			// return $query->result();
		// }
		
		// public function fetch_industryBrandsMappings()
		// {
			// $this->db->select('map.id,i.industry,replace(group_concat(distinct concat(b.brand_name,"<br/>")),trim(","),"") as brand_name');
			// $this->db->from('industry_brands_mappings map');
			// $this->db->join('industries i','map.industry_id = i.id','Left');
			// $this->db->join('brands b','map.brand_id = b.id','Left');
			// $this->db->order_by('map.id', 'DESC');
			// $this->db->group_by('i.id');
			// $query=$this->db->get();
			// $getMappingsData = $query->result_array();
			// return $query->result();
		// }
		
		// public function fetch_categories()
		// {
			// $this->db->order_by("category", "ASC");
			// $query = $this->db->get("categories");
			// return $query->result();
		// }
		
		// public function fetch_industries()
		// {
			// $this->db->order_by("industry", "ASC");
			// $query = $this->db->get("industries");
			// return $query->result();
		// }
		
		// public function fetch_brand()
		// {
			// $this->db->order_by("brand_name", "ASC");
			// $query = $this->db->get("brands");
			// return $query->result();
		// }
		
		// public function fetch_subcategories($category_id)
         // {
              // $this->db->where('category_id', $category_id);
              // $this->db->order_by('sub_category', 'ASC');
              // $query = $this->db->get('subcategories');
              // $output = '<option value="">Select Subcategory</option>';
              // foreach($query->result() as $row)
              // {
               // $output .= '<option value="'.$row->id.'">'.$row->sub_category.'</option>';
              // }
              // return $output;
         // }
		
		// public function fetch_brands($subcategory_id)
        // {
			// $this->db->select('brands.id, brands.brand_name, category_subcategory_brands_mapping.id as cbmid, category_subcategory_brands_mapping.brand_id as cbmbrand');
			// $this->db->from('category_subcategory_brands_mapping');
			// $this->db->join('brands',' brands.id =category_subcategory_brands_mapping.brand_id','Left');
            // $this->db->where('subcategory_id', $subcategory_id);
            // $this->db->order_by('brand_id', 'ASC');
			// $query=$this->db->get();
            // $output = '<option value="">--Select Brand--</option>';
			// $join = $query->result_array();
			
			// foreach($join as $j1=>$row)
			// { 
				// $brand_name = $row['brand_name'];
				// $output .= '<option value="'.$row['id'].'">'.$brand_name.'</option>';
			// }
		    // return $output;			
        // }
		 
		// public function fetch_industryBrands($industry_id)
        // {
			// $this->db->select('brands.id, brands.brand_name, industry_brands_mappings.id as ibmid,industry_brands_mappings.brand_id as ibmbrand');
			// $this->db->from('industry_brands_mappings');
			// $this->db->join('brands',' brands.id =industry_brands_mappings.brand_id','Left');
            // $this->db->where('industry_id', $industry_id);
            // $this->db->order_by('brand_id', 'ASC');
			// $query=$this->db->get();
            // $output = '<option value="">--Select Brand--</option>';
			// $join = $query->result_array();
			
			// foreach($join as $j1=>$row)
			// { 
				// $brand_name = $row['brand_name'];
				// $output .= '<option value="'.$row['id'].'">'.$brand_name.'</option>';
			// }
		    // return $output;
        // }
         
		// public function fetch_state($country_id)
		// {
		// $this->db->where('country_id', $country_id);
		// $this->db->order_by('state_name', 'ASC');
		// $query = $this->db->get('states');
		// $output = '<option value="">--Select State--</option>';
		// foreach($query->result() as $row)
		// {
		// $output .= '<option value="'.$row->id.'">'.$row->state_name.'</option>';
		// }
		// return $output;
		// }

		// function fetch_city($state_id)
		// {
		// $this->db->where('state_id', $state_id);
		// $this->db->order_by('city_name', 'ASC');
		// $query = $this->db->get('cities');
		// $output = '<option value="">--Select City--</option>';
		// foreach($query->result() as $row)
		// {
		// $output .= '<option value="'.$row->id.'">'.$row->city_name.'</option>';
		// }
		// return $output;
		// }
			

	// public function multijoin($table,$field='',$condition='',$group='',$order='',$limit='',$tables='',$joincon='',$jointype='',$result='')  
    // {
        // if($field != '')
        // $this->db->select($field);
        // if($condition != '')
        // $this->db->where($condition);
        // if($order != '')
        // $this->db->order_by($order);
        // if($limit != '')
        // $this->db->limit($limit);
        // if($group != '')
        // $this->db->group_by($group);
        // for ($i=0; $i <count($tables); $i++)
        // {
            // $this->db->join($tables[$i], $joincon[$i],$jointype[$i]);
        // }
        // if($result != '')
        // {
            // $return =  $this->db->get($table)->row();
        // }else{
            // $return =  $this->db->get($table)->result();
        // }
        // return $return; 
    // } 
    
    // public function del_city_by_state($country_id)
    // {
    	// $this->db->where("state_id = Any (select id from states where country_id='".$country_id."') ");
    	// $this->db->delete('cities');

    // }


	// public function categorySubBrands()
	// {
		// $this->db->select('br.id,c.category,sc.sub_category');
		// $this->db->from('brands br');
		// $this->db->join('categories c','c.id=br.category_id','left');
		// $this->db->join('subcategories sc','sc.id=br.subcategory_id','left');
		// return $this->db->get()->result();
	// }
		
}
?>