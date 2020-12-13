<?php namespace App\Controllers;

use App\Models\Category_model;

use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{

    protected $format       = 'json';
    protected $modelName    = 'App\Models\Category_model';

	public function __construct()
	{
        $this->category = new Category_model();
    }

    public function index()
    {
        $categories = $this->category->getCategory();

        foreach($categories as $row){

            $category_all[] = [
                'id_barang' => intval($row['id_barang']),
                'nama_barang' => $row['nama_barang'],
                'qty' => $row['qty'],
                'harga_beli' => $row['harga_beli'],
                'harga_jual' => $row['harga_jual'],
            ];
        }

		return $this->respond($category_all, 200);
    }
    
    public function create()
    {
        $nama_barang = $this->request->getPost('nama_barang');
        $qty = $this->request->getPost('qty');
        $harga_beli = $this->request->getPost('harga_beli');
        $harga_jual = $this->request->getPost('harga_jual');

        $data = [
            'nama_barang' => $nama_barang,
            'qty' => $qty,
            'harga_beli' => $harga_beli,
            'harga_jual' => $harga_jual
        ];

        $simpan = $this->category->insertCategory($data);

        if($simpan == true){
            $output = [
                'status' => 200,
                'message' => 'Berhasil Menyimpan Data',
                'data' => ''
            ];
            return $this->respond($output, 200);
        }else{
            $output = [
                'status' => 400,
                'message' => 'Gagal Menyimpan Data',
                'data' => '' 
            ];
            return $this->respond($output, 400); 
        }
    }

    public function show($id = null)
    {
        $category = $this->category->getCategory($id);

        if(!empty($category)){

            $output = [
                'id_barang' => intval($category['id']),
                'nama_barang' => $category['nama_barang'],
                'qty' => $category['qty'],
                'harga_beli' => $category['harga_beli'],
                'harga_jual' => $category['harga_jual'], 
            ];

            return $this->respond($output, 200);

        }else{

            $output = [
                'status' => 400,
                'message' => 'Gagal Menemukan Data',
                'data' => '' 
            ];
        }
            return $this->respond($output, 400); 
    }

    public function edit($id = null)
    {
        $category = $this->category->getCategory($id);

        if(!empty($category)){

            $output = [
                'id_barang' => intval($category['id_barang']),
                'nama_barang' => $category['nama_barang'],
                'qty' => $category['qty'],
                'harga_beli' => $category['harga_beli'],
                'harga_jual' => $category['harga_jual'],
            ];

            return $this->respond($output, 200);

        }else{

            $output = [
                'status' => 400,
                'message' => 'Gagal Menemukan Data',
                'data' => '' 
            ];

            return $this->respond($output, 400);
        }
    }

    public function update($id = null)
    {
        // menangkap data dari method PUT, DELETE, PATCH
        $data = $this->request->getRawInput();
        // cek data categories berdasarkan id
        $categories = $this->category->getCategory($id);
        // cek categories
        if(!empty($categories)){

        // update
        $updateCategory = $this->category->updateCategory($data, $id);

        $output = [
            'status' => true,
            'data' =>'',
            'message' => 'Update successfully'
        ];

        return $this->respond($output, 200);

    }else{

        $output = [
            'status' => false,
            'data' =>'',
            'message' => 'Update failed'
        ];

        return $this->respond($output, 400);
        }
    }

    public function delete($id = null)
    {
        // menangkap data dari method PUT, DELETE, PATCH
        $data = $this->request->getRawInput();
        // cek data categories berdasarkan id
        $categories = $this->category->getCategory($id);
        // cek categories
        if(!empty($categories)){

        // delete
        $deleteCategory = $this->category->deleteCategory($id);

        $output = [
            'status' => true,
            'data' =>'',
            'message' => 'Deleted successfully'
        ];

        return $this->respond($output, 200);

    }else{

        $output = [
            'status' => false,
            'data' =>'',
            'message' => 'Deleted failed'
        ];

        return $this->respond($output, 400);
        }
    }
}


