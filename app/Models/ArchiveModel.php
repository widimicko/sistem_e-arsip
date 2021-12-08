<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchiveModel extends Model {

  protected $table = 'archive';
  protected $primaryKey = 'id';
  protected $useAutoIncrement = true;
  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $allowedFields = ['id', 'title', 'document', 'id_category', 'created_at', 'updated_at'];

}