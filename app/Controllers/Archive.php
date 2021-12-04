<?php

namespace App\Controllers;

use App\Models\ArchiveModel;

class Archive extends BaseController {
    protected $archiveModel;

    public function __construct() {
        $this->archiveModel = new ArchiveModel();
    }

    public function add() {
      $data['title'] = 'Tambah Arsip';

      return view('archive/add', $data);
    }

    public function create() {

      $uploadedFile = $this->request->getFile('document');
  
      $listDocument = $this->archiveModel->where('document', $uploadedFile->getName())->findAll();
  
      if (!empty($listDocument)) {
        session()->setFlashData('tx_error_message', 'Dokumen "'. $uploadedFile->getName() .'" sudah ada di direktori');
        return redirect()->to('/archive/add')->withInput();
      }
  
      $uploadedFile->move('document/');
  
      $this->archiveModel->insert([
        'title' => $this->request->getVar('title'),
        'category' => $this->request->getVar('category'),
        'document' => $uploadedFile->getName(),
      ]);
  
      session()->setFlashData('tx_success_message', 'Arsip "'. $this->request->getVar('title') .'" berhasil ditambahkan');
      return redirect()->to('/archive');
    }

    public function detail($id) {
  
      $data = [
        'title' => 'Detail Arsip',
        'archive' => $this->archiveModel->find($id)
      ];
  
      return view('archive/detail', $data);
    }
  
    public function edit($id) {
  
      $data = [
        'title' => 'Ubah Data',
        'archive' => $this->archiveModel->find($id)
      ];
  
      return view('archive/edit', $data);
    }

    public function update($id) {

      $archive = $this->archiveModel->find($id);
  
      if (empty($archive)) {
        session()->setFlashData('tx_error_message', 'Arsip tidak ditemukan');
        return redirect()->to('/archive');
      }
  
      $uploadedFile = $this->request->getFile('document');
      $isFileUploaded = null;
  
      if ($uploadedFile->getError() !== 4) {
        $listDocument = $this->archiveModel->where('document', $uploadedFile->getName())->findAll();
  
        if (!empty($listDocument)) {
          session()->setFlashData('tx_error_message', 'Dokumen "'. $uploadedFile->getName() .'" sudah ada di direktori');
          return redirect()->to('/archive/edit')->withInput();
        }
    
        $isFileUploaded = true;
        unlink('document/' . $archive['document']);
        $uploadedFile->move('document/');
      }  else if ($uploadedFile->getError() == 4) {
        $isFileUploaded = false;
      }

      
  
      $this->archiveModel->update($id, [
        'title' => $this->request->getVar('title'),
        'category' => $this->request->getVar('category'),
        'document' => $isFileUploaded ? $uploadedFile->getName() : $archive['document'],
      ]);
  
      session()->setFlashData('tx_success_message', 'Arsip "'.$archive['title'].'" berhasil diubah');
      return redirect()->to('/archive');
    }

    public function delete($id) {

      $archive = $this->archiveModel->find($id);
  
      if (empty($archive)) {
        session()->setFlashData('tx_error_message', 'Arsip tidak ditemukan');
        return redirect()->to('/archive');
      }
  
      unlink('document/' . $archive['document']);
      $this->archiveModel->delete($id);
  
      session()->setFlashData('tx_success_message', 'Arsip "'.$archive['title'].'" berhasil dihapus');
      return redirect()->to('/archive');
    }

    public function download($id){

      $archive = $this->archiveModel->find($id);
  
      $filePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .'document/' . $archive['document'];
  
      return $this->response->download($filePath, null);
    }

}