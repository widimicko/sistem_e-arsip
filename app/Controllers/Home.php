<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Beranda";
        return view('archive/index', $data);
    }
}
