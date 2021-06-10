<?php
require('./functions.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data_mhs = select_one("SELECT * from mahasiswa WHERE id=$id");
} else {
    echo "
    <script>
    alert('Mahasiswa Tidak Ditemukan');
    document.location.href = 'index.php';
    </script>
    ";
}

if (isset($_POST['submit'])) {
    $response = edit_mahasiswa($id, $data_mhs, $_POST);
    echo "
    <script>
    alert('" . $response['message'] . "');
    </script>
    ";
}
$data_mhs = get_detail_mahasiswa($id);
//print_r($data_mhs);
$data_prodi = get_prodi();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <title>Edit Mahasiswa</title>
</head>

<body style="background-color: #ddd;">
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header bg-primary text-light">Edit Mahasiswa</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <form method="post">
                                    <div class="form-group row">
                                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nim" name="nim" value="<?= $data_mhs['nim'] ?>" placeholder="Masukkan NIM" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data_mhs['nama'] ?>" placeholder="Masukkan Nama" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="jurusan" name="jurusan" required>
                                                <option value="">Pilih Jurusan</option>
                                                <?php foreach ($data_prodi as $i => $row) :
                                                    $selected = "";
                                                    if ($row['kode_prodi'] == $data_mhs['kode_prodi']) {
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                    <option value="<?= $row['kode_prodi'] ?>" <?= $selected ?>><?= $row['nama_prodi'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" value="<?= $data_mhs['email'] ?>" placeholder="Masukkan Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat"><?= $data_mhs['alamat'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-5">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                            <a href="index.php" class="btn btn-danger">Batal</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>