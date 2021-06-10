<?php
require('./koneksi.php');
require('./query.php');

function get_mahasiswa($keyword = "")
{
    if (empty($keyword)) {
        $query = "SELECT m.*,p.nama_prodi FROM mahasiswa m LEFT JOIN prodi p 
        ON p.kode_prodi=m.kode_prodi ORDER BY m.id DESC";
    } else {
        $query = "SELECT m.*,p.nama_prodi FROM mahasiswa m LEFT JOIN prodi p 
        ON p.kode_prodi=m.kode_prodi 
        WHERE 
        m.nim LIKE '%$keyword%' OR
        m.nama LIKE '%$keyword%' OR
        m.email LIKE '%$keyword%' OR
        m.alamat LIKE '%$keyword%' OR
        p.nama_prodi LIKE '%$keyword%'
        ORDER BY m.id DESC";
    }

    $data = select_all($query);
    return $data;
}

function get_detail_mahasiswa($id)
{
    $query = "SELECT m.*,p.nama_prodi FROM mahasiswa m LEFT JOIN prodi p 
    ON p.kode_prodi=m.kode_prodi WHERE m.id=$id";
    $data = select_one($query);
    return $data;
}

function get_prodi()
{
    $query = "SELECT p.* FROM prodi p";
    $data = select_all($query);
    return $data;
}

function tambah_mahasiswa($input)
{
    $nim = $input['nim'];
    $nama = htmlspecialchars($input['nama']);
    $prodi = $input['jurusan'];
    $email = htmlspecialchars($input['email']);
    $alamat = htmlspecialchars($input['alamat']);

    $cek_nim = select_one("SELECT COUNT(nim) as JUM FROM mahasiswa WHERE nim=$nim");
    if ($cek_nim['JUM'] > 0) {
        $response = ['type' => "error", 'message' => "NIM Sudah Ada Yang Memakai"];
    } else {
        $q_insert = "INSERT INTO mahasiswa(nim,nama,kode_prodi,email,alamat) 
                VALUES('$nim','$nama','$prodi','$email','$alamat')";
        $insert = insert_data($q_insert);
        if ($insert) {
            $response = ['type' => "success", 'message' => "Tambah Data Berhasil"];
        } else {
            $response = ['type' => "error", 'message' => "Tambah Data Gagal"];
        }
    }
    return $response;
}

function hapus_mahasiswa($id)
{
    $q_delete = "DELETE FROM mahasiswa WHERE id=$id";
    $deleted = delete_data($q_delete);
    if ($deleted) {
        $response = ['type' => "success", 'message' => "Hapus Data Berhasil"];
    } else {
        $response = ['type' => "error", 'message' => "Hapus Data Gagal"];
    }
    return $response;
}

function edit_mahasiswa($id, $data_detail, $input)
{
    $nim = $input['nim'];
    $nama = htmlspecialchars($input['nama']);
    $prodi = $input['jurusan'];
    $email = htmlspecialchars($input['email']);
    $alamat = htmlspecialchars($input['alamat']);
    $cek_nim['JUM'] = 0;
    if ($data_detail['nim'] != $nim) {
        $cek_nim = select_one("SELECT COUNT(nim) as JUM FROM mahasiswa WHERE nim=$nim");
    }
    if ($cek_nim['JUM'] > 0) {
        $response = ['type' => "error", 'message' => "NIM Sudah Ada Yang Memakai"];
    } else {
        $q_update = "UPDATE mahasiswa SET nim = '$nim',nama='$nama',kode_prodi='$prodi',
        email='$email',alamat='$alamat' WHERE id='$id'";
        $update = update_data($q_update);
        if ($update) {
            $response = ['type' => "success", 'message' => "Edit Data Berhasil"];
        } else {
            $response = ['type' => "error", 'message' => "Edit Data Gagal"];
        }
    }
    return $response;
}
