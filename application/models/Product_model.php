<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Product_model extends CI_Model
{
    public function getAll($db)
    {
        $this->db->from($db['table']);
        $this->db->order_by($db['column'], 'desc');
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function getSingleProduct($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row_array();
    }

    public function getProductByCategory($id)
    {
        $query = "SELECT `products`.* 
                    FROM `products` JOIN `product_categories`
                    ON `products`.`id` = `product_categories`.`product_id`
                    WHERE `product_categories`.`category_id` = $id
                    ORDER BY `products`.`created_at`";

        return $this->db->query($query)->result_array();
    }

    public function getProductCategory($id)
    {
        // Gunakan BackTick ``
        $query = "SELECT `categories`.`id`, `category_name`
                                FROM `categories` JOIN `product_categories`
                                ON `categories`.`id` = `product_categories`.`category_id`
                                WHERE `product_categories`.`product_id` = $id";

        return $this->db->query($query)->result_array();
    }

    // INSERT, DELETE, UPDATE
    public function addProductOrCategory($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function addProductCategories($data, $prodName)
    {
        $getProdId = $this->db->get_where('products', ['product_name' => $prodName])->row_array();

        $return = [];
        foreach ($data as $value) {
            $return[] = ['product_id' => $getProdId['id'], 'category_id' => $value];
        }

        $this->db->insert_batch('product_categories', $return);
    }

    public function updateProduct($data)
    {
        $this->db->replace('products', $data);
    }

    public function updateProductCategories($data, $prodId)
    {
        $this->db->where('product_id', $prodId);
        $this->db->delete('product_categories');

        $return = [];
        foreach ($data as $value) {
            $return[] = ['product_id' => $prodId, 'category_id' => $value];
        }

        $this->db->insert_batch('product_categories', $return);
    }

    public function deleteProduct($id)
    {
        $prodName = $this->getSingleProduct($id);

        $this->db->where('id', $id);
        $this->db->delete('products');

        return $prodName['product_name'];
    }

    public function deleteCategory($id)
    {
        $prodName = $this->db->get_where('categories', ['id' => $id])->row_array();

        $this->db->where('id', $id);
        $this->db->delete('categories');

        return $prodName['category_name'];
    }

    public function deleteProductCategories($id, $status)
    {
        if ($status == 'prodDelete') {
            $this->db->where('product_id', $id);
        } else {
            $this->db->where('category_id', $id);
        }

        $this->db->delete('product_categories');
    }

    // SEARCHING
    public function liveSearch($data)
    {
        $this->db->select("*");
        $this->db->from("products");
        if ($data != '') {
            $this->db->like('product_name', $data);
        }
        $this->db->order_by('product_name', 'ASC');
        return $this->db->get();
    }
}
