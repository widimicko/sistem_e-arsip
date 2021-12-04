<?php

namespace App\Controllers;

use App\Models\ArchiveModel;

class Home extends BaseController {
    protected $archiveModel;

    public function __construct() {
        $this->archiveModel = new ArchiveModel();
    }

    public function index() {
        $data = [
            'title' => "Beranda",
            'archives' => $this->archiveModel->orderBy('created_at', 'DESC')->findAll()
        ];
        
        return view('archive/index', $data);
    }
}
