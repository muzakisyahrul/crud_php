<?php
require('./functions.php');
if (isset($_GET['id_hapus'])) {
    $id_hapus = $_GET['id_hapus'];
    $response = hapus_mahasiswa($id_hapus);
    if ($response['type'] == "success") {
        echo "
        <script>
        alert('" . $response['message'] . "');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('" . $response['message'] . "');
        </script>
        ";
    }
}
if (isset($_POST['cari'])) {
    $keyword = $_POST['cari'];
    $data_mhs = get_mahasiswa($keyword);
} else {
    $data_mhs = get_mahasiswa();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <title>Data Mahasiswa</title>
</head>

<body style="background-color: #ddd;">
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header bg-primary text-light">Data Mahasiswa</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <a href="tambah_mhs.php" class="btn btn-success">Tambah Data</a>
                            </div>
                            <div class="col-md-4">
                                <form method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cari" value="<?= isset($keyword) ? $keyword : '' ?>" placeholder="Pencarian" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="false">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary" type="button">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 mt-2">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NIM</th>
                                            <th>NAMA</th>
                                            <th>JURUSAN</th>
                                            <th>EMAIL</th>
                                            <th>ALAMAT</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($data_mhs) > 0) { ?>
                                            <?php foreach ($data_mhs as $i => $row) : ?>
                                                <tr>
                                                    <td><?= ++$i  ?></td>
                                                    <td><?= $row['nim'] ?></td>
                                                    <td><?= $row['nama'] ?></td>
                                                    <td><?= $row['nama_prodi'] ?></td>
                                                    <td><?= $row['email'] ?></td>
                                                    <td><?= $row['alamat'] ?></td>
                                                    <td>
                                                        <a href="edit_mhs.php?id=<?= $row['id'] ?>" class="btn btn-primary">Edit Data</a>
                                                        <a href="index.php?id_hapus=<?= $row['id'] ?>" class="btn btn-danger">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7">
                                                    <h4 class="text-center">Data Tidak Ditemukan</h4>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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