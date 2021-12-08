<?php

namespace App\Controllers;

use App\Models\categoryModel;

class Category extends BaseController {
    protected $categoryModel;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
    }

    public function create() {
      
      $this->categoryModel->insert([
        'name' => $this->request->getVar('category')
      ]);

      session()->setFlashData('tx_success_message', 'Kategori "'. $this->request->getVar('category') .'" berhasil ditambahkan');
      return redirect()->to('/category');
    }

    public function update($id) {

      $category = $this->categoryModel->find($id);
  
      if (empty($category)) {
        session()->setFlashData('tx_error_message', 'Data tidak ditemukan');
        return redirect()->to('/category');
      }
      
      $this->categoryModel->update($id, [
        'name' => $this->request->getVar('category')
      ]);

      session()->setFlashData('tx_success_message', 'Kategori "'. $category['name'] .'" berhasil diubah');
      return redirect()->to('/category');
    }

    public function delete($id) {

      $category = $this->categoryModel->find($id);
  
      if (empty($category)) {
        session()->setFlashData('tx_error_message', 'Data tidak ditemukan');
        return redirect()->to('/category');
      }
      
      $this->categoryModel->delete($id);

      session()->setFlashData('tx_success_message', 'Kategori "'. $category['name'] .'" berhasil dihapus');
      return redirect()->to('/category');
    }
}