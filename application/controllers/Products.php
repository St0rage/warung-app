<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $db['products'] = [
            'table' => 'products',
            'column' => 'created_at'
        ];
        $db['categories'] = [
            'table' => 'categories',
            'column' => 'category_name'
        ];
        $data['products'] = $this->product->getAll($db['products']);
        $data['categories'] = $this->product->getAll($db['categories']);
        $data['id'] = null;

        $this->load->view('templates/header');
        $this->load->view('products/products', $data);
        $this->load->view('templates/footer');
    }

    public function category($id)
    {
        $db['categories'] = [
            'table' => 'categories',
            'column' => 'category_name'
        ];
        $data['categories'] = $this->product->getAll($db['categories']);
        $data['products'] = $this->product->getProductByCategory($id);
        $data['id'] = $id;

        $this->load->view('templates/header');
        $this->load->view('products/products', $data);
        $this->load->view('templates/footer');
    }

    public function addProduct()
    {
        $db['categories'] = [
            'table' => 'categories',
            'column' => 'category_name'
        ];
        $data['categories'] = $this->product->getAll($db['categories']);

        $this->form_validation->set_rules('product_name', 'Name', 'trim|required|min_length[4]|is_unique[products.product_name]', [
            'min_length' => 'Masukan nama barang yang sesuai!',
            'required' => 'Nama barang tidak boleh kosong',
            'is_unique' => 'Nama barang yang dimasukan sudah ada'
        ]);
        $this->form_validation->set_rules('price', 'Price', 'numeric|trim|required|callback_price_check', [
            'required' => 'Harga barang tidak boleh kosong',
            'numeric' => 'Harga barang harus berbentuk angka'
        ]);
        $this->form_validation->set_rules('category_id[]', 'Category', 'required', [
            'required' => 'Pilih minimal satu kategori'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('products/add-product', $data);
            $this->load->view('templates/footer');
        } else {

            $this->load->library('upload');

            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] =  '10240';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $data['insertProduct'] = [
                    'product_name' => htmlspecialchars($this->input->post('product_name', true)),
                    'price' => htmlspecialchars($this->input->post('price', true)),
                ];
            } else {
                $data['insertProduct'] = [
                    'product_name' => htmlspecialchars($this->input->post('product_name', true)),
                    'price' => htmlspecialchars($this->input->post('price', true)),
                    'image' => $this->upload->data('file_name')
                ];
            }

            $productName = htmlspecialchars($this->input->post('product_name', true));
            $data['insertProductCategories'] = $this->input->post('category_id');

            // INSERT
            $this->product->addProductOrCategory($data['insertProduct'], 'products');
            $this->product->addProductCategories($data['insertProductCategories'], $productName);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Barang ' . $productName . ' Berhasil di Tambahkan</div>');
            redirect('products');
        }
    }

    public function addCategory()
    {
        $this->form_validation->set_rules('category_name', 'cat_name', 'trim|required|min_length[3]|is_unique[categories.category_name]', [
            'min_length' => 'Masukan nama kategori yang sesuai!',
            'required' => 'Nama kategori tidak boleh kosong',
            'is_unique' => 'Nama kategori yang dimasukan sudah ada'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('products/add-category');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'category_name' => htmlspecialchars($this->input->post('category_name', true))
            ];

            $this->product->addProductOrCategory($data, 'categories');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori ' . $data['category_name'] . ' Berhasil di Tambahkan</div>');
            redirect('products');
        }
    }

    public function updateProduct($id = '')
    {
        if ($id == '') {
            redirect('products');
        }

        $db['categories'] = [
            'table' => 'categories',
            'column' => 'category_name'
        ];

        $data['product'] = $this->product->getSingleProduct($id);
        $data['categories'] = $this->product->getAll($db['categories']);
        $cates = $this->product->getProductCategory($id);
        $data['productCategories'] = [];

        foreach ($cates as $cate) {
            array_push($data['productCategories'], $cate['id']);
        }

        $this->form_validation->set_rules('product_name', 'Name', 'trim|required|min_length[4]', [
            'min_length' => 'Masukan nama barang yang sesuai!',
            'required' => 'Nama barang tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('price', 'Price', 'numeric|trim|required|callback_price_check', [
            'required' => 'Harga barang tidak boleh kosong',
            'numeric' => 'Harga barang harus berbentuk angka'
        ]);
        $this->form_validation->set_rules('category_id[]', 'Category', 'required', [
            'required' => 'Pilih minimal satu kategori'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('products/update-product', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->library('upload');


            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] =  '10240';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $data['insertProduct'] = [
                    'id' => $this->input->post('id', true),
                    'product_name' => htmlspecialchars($this->input->post('product_name', true)),
                    'price' => htmlspecialchars($this->input->post('price', true)),
                    'image' => $data['product']['image']
                ];
            } else {
                $data['insertProduct'] = [
                    'id' => $this->input->post('id', true),
                    'product_name' => htmlspecialchars($this->input->post('product_name', true)),
                    'price' => htmlspecialchars($this->input->post('price', true)),
                    'image' => $this->upload->data('file_name')
                ];
            }

            $prodName = htmlspecialchars($this->input->post('product_name', true));
            $prodId = $this->input->post('id', true);
            $data['insertProductCategories'] = $this->input->post('category_id');

            // UPDATE
            $this->product->updateProduct($data['insertProduct']);
            $this->product->updateProductCategories($data['insertProductCategories'], $prodId);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Barang ' . $prodName . ' Berhasil di Rubah</div>');
            redirect('products');
        }
    }

    public function deleteProduct($id = '')
    {
        if ($id == '') {
            redirect('products');
        }

        $productName = $this->product->deleteProduct($id);
        $this->product->deleteProductCategories($id, 'prodDelete');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Barang ' . $productName . ' Berhasil di Hapus</div>');
        redirect('products');
    }

    public function deleteCategory()
    {
        $db['categories'] = [
            'table' => 'categories',
            'column' => 'category_name'
        ];

        $data['categories'] = $this->product->getAll($db['categories']);

        $this->form_validation->set_rules('category_id[]', 'Category', 'required', [
            'required' => 'Silahkan pilih minimal satu kategori'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('products/delete-category', $data);
            $this->load->view('templates/footer');
        } else {
            $category_id = htmlspecialchars($this->input->post('category_id'));

            $prodName = $this->product->deleteCategory($category_id);
            $this->product->deleteProductCategories($category_id, 'cateDelete');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kategori ' . $prodName . ' Berhasil di Hapus</div>');
            redirect('products');
        }
    }

    public function searchProduct()
    {
        $keyword = '';
        $output = '';

        if ($this->input->get('cari-barang')) {
            $keyword = $this->input->get('cari-barang');
        }

        $products = $this->product->liveSearch($keyword);

        $output .= '
            <table class="table table-striped table-sm">
            <thead>
                <tr class="d-flex">
                    <th scope="col">#</th>
                    <th scope="col" class="col-4">Nama Barang</th>
                    <th scope="col" class="col-3">Harga</th>
                    <th scope="col" class="col-3">Kategori</th>
                    <th scope="col" class="col-2">Gambar</th>
                </tr>
            </thead>
        ';
        if ($products->num_rows() > 0) {
            $i = 1;
            foreach ($products->result_array() as $product) {

                $productCategories = $this->product->getProductCategory($product['id']);

                $output .= '
                    <tr class="d-flex">
                        <th scope="row">' . $i++ . '</th>
                        <td class="col-4">
                            <span>' . $product['product_name'] . '</span>
                            <div class="product-action">
                            <a href="' . base_url('products/updateproduct/' . $product['id']) . '" class="badge bg-primary text-decoration-none">Ubah</a>
                                <a onclick="return confirm()" href="' . base_url('products/deleteproduct/' . $product['id']) . '" class="badge bg-danger text-decoration-none">Hapus</a>
                            </div>
                        </td>
                        <td class="col-3">Rp ' . $product['price'] . '</td>
                        <td class="col-3">
                ';

                foreach ($productCategories as $productCategory) {
                    $output .= '<a href="" class="badge bg-success text-decoration-none mx-2">' . $productCategory['category_name'] . '</a>';
                }

                $output .= '
                            </td>
                            <td class="col-2"><img src="' . base_url('assets/img/' . $product['image']) . '" class="img-fluid"></td>
                        </tr>
                    </tbody>
                ';
            }
        } else {
            $output .= '
                    <tr>
                        <td colspan="5">Produk Tidak Ditemukan</td>
                    </tr>
                </tbody>
            ';
        }
        $output .= '</table>';
        echo $output;
    }


    // VALIDATION COSTUM
    public function price_check($str)
    {
        if ($str < 500) {
            $this->form_validation->set_message('price_check', 'Masukan harga barang yang sesuai');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function is_exist($str)
    {
        $result = $this->product->isExist($str);
    }
}
