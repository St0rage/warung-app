<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function getAllCategories()
    {
        $this->db->from('categories');
        $this->db->order_by('category_name', 'asc');
        $query = $this->db->get()->result_array();

        return $query;
    }
}
