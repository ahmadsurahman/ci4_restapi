<?php

namespace App\Models;

use CodeIgniter\Model;

class Category_model extends Model{

    protected $table = "categories";

    public function getCategory($id = false)
    {
        if($id == false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id_barang'=> $id])->getRowArray();
        }
    }

    public function insertCategory($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        if($query){
            return true;
        } else{
            return false;
        }
    }

    public function updateCategory($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_barang' => $id]);
    }

    public function deleteCategory($id)
    {
        return $this->db->table($this->table)->delete(['id_barang' => $id]);
    }
}