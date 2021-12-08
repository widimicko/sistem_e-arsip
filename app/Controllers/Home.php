<?php

namespace App\Controllers;

use App\Models\ArchiveModel;
use App\Models\CategoryModel;

class Home extends BaseController {
    protected $archiveModel;
    protected $categoryModel;

    public function __construct() {
        $this->archiveModel = new ArchiveModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index() {
        $data = [
            'title' => "Beranda",
            'archives' => $this->archiveModel->select('archive.id as id, title, created_at, updated_at, document, category.name as category')->join('category', 'category.id = archive.id_category')->orderBy('created_at', 'DESC')->findAll()
        ];
        
        return view('archive/index', $data);
    }

    public function category() {
        $data = [
            'title' => "Kategori",
            'categories' => $this->categoryModel->findAll()
        ];
        
        return view('category/index', $data);
    }
}
