<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelTransaksi extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getLogs($filter = null)
  {
    $query = "
        SELECT 
            log.*, user.fullname,
            CASE 
                WHEN log.kategori_sarpras = 'Ruang' THEN ruang.jenis
                WHEN log.kategori_sarpras = 'Peralatan' THEN peralatan.jenis
                ELSE NULL
            END AS jenis_sarpras
        FROM log
        LEFT JOIN ruang ON log.id_sarpras = ruang.id AND log.kategori_sarpras = 'Ruang'
        LEFT JOIN peralatan ON log.id_sarpras = peralatan.id AND log.kategori_sarpras = 'Peralatan'
        LEFT JOIN user ON log.id_user = user.id
        ORDER BY log.tanggal DESC
    ";

    if ($filter) {
      $query .= " WHERE " . $filter;
    }

    return $this->db->query($query)->result_array();
  }

  public function addLog($data)
  {
    return $this->db->insert('log', $data);
  }
}

/* End of file ModelTransaksi.php */