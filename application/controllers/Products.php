<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('products/products');
        $this->load->view('templates/footer');
    }

    public function addProduct()
    {
        $this->load->view('templates/header');
        $this->load->view('products/add-product');
        $this->load->view('templates/footer');
    }
}
