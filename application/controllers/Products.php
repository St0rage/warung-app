<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product');
    }

    public function index()
    {
        $data['categories'] = $this->product->getAllCategories();

        $this->load->view('templates/header');
        $this->load->view('products/products', $data);
        $this->load->view('templates/footer');
    }

    public function category($id)
    {
        $data['categories'] = $this->product->getAllCategories();
        $data['id'] = $id;

        $this->load->view('templates/header');
        $this->load->view('products/products-by-category', $data);
        $this->load->view('templates/footer');
    }

    public function addProduct()
    {
        $this->load->view('templates/header');
        $this->load->view('products/add-product');
        $this->load->view('templates/footer');
    }

    public function addCategory()
    {
        $this->load->view('templates/header');
        $this->load->view('products/add-category');
        $this->load->view('templates/footer');
    }

    public function updateProduct()
    {
        $this->load->view('templates/header');
        $this->load->view('products/update-product');
        $this->load->view('templates/footer');
    }
}
