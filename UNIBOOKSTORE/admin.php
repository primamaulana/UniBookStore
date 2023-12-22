<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark ">
        <div class="container">
            <a href="" class="navbar-brand">
                <h1 class="d-inline-block align-text-top rounded">UNIBOOKSTORE</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pengadaan.php">Pengadaan</a>
                    </li>
            </div>
    </nav>

    <?php
    include 'pagination.php';

    $q = isset($_REQUEST['q']) ? urldecode($_REQUEST['q']) : ''; // untuk keyword pencarian
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // untuk nomor halaman
    $adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; // khusus style pagination 2 dan 3
    $rpp = 15; // jumlah record per halaman

    $db_link = mysqli_connect('localhost', 'root', '', 'unibookstore');
    $sql = "SELECT * FROM buku WHERE nama_buku LIKE '%$q%' OR id_buku LIKE '%$q%' ORDER BY nama_buku";
    $result = mysqli_query($db_link, $sql); // eksekusi query

    $sql2 = "SELECT * FROM penerbit WHERE nama_penerbit LIKE '%$q%' OR id_penerbit LIKE '%$q%' ORDER BY nama_penerbit";
    $result2 = mysqli_query($db_link, $sql2); // eksekusi query

    $tcount = mysqli_num_rows($result); // jumlah total baris
    $tpages = isset($tcount) ? ceil($tcount / $rpp) : 1; // jumlah total halaman
    $count = 0; // untuk paginasi
    $i = ($page - 1) * $rpp; // batas paginasi
    $no_urut = ($page - 1) * $rpp; // nomor urut

    $tcount2 = mysqli_num_rows($result2); // jumlah total baris
    $tpages2 = isset($tcount2) ? ceil($tcount2 / $rpp) : 1; // jumlah total halaman
    $count2 = 0; // untuk paginasi
    $i2 = ($page - 1) * $rpp; // batas paginasi
    $no_urut2 = ($page - 1) * $rpp; // nomor urut
    $reload = $_SERVER['PHP_SELF'] . "?q=" . $q . "&amp;adjacents=" . $adjacents; // untuk link ke halaman lain
    ?>
    <div class="container mt-5 mb-5">
        <!--judul -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <h1>Tabel Buku</h1>
            </div>
        </div>

        <!--tabel-->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="th">No</th>
                            <th class="th">ID Buku</th>
                            <th class="th">Kategori</th>
                            <th class="th">Nama Buku</th>
                            <th class="th">Harga</th>
                            <th class="th">Stok</th>
                            <th class="th">Penerbit</th>
                            <th class="th">Pengarang</th>
                            <th class="th">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($data = mysqli_fetch_array($result)) {
                            $pengarang = isset($data['pengarang']) ? $data['pengarang'] : '';
                        ?>
                            <tr class="tr">
                                <td width="40px">
                                    <?php echo ++$no_urut; ?>
                                </td>
                                <td>
                                    <?php echo $data['id_buku']; ?>
                                </td>
                                <td>
                                    <?php echo $data['kategori']; ?>
                                </td>
                                <td>
                                    <?php echo $data['nama_buku']; ?>
                                </td>
                                <td>
                                    <?php echo $data['harga']; ?>
                                </td>
                                <td>
                                    <?php echo $data['stok']; ?>
                                </td>
                                <td>
                                    <?php echo $data['penerbit']; ?>
                                </td>
                                <td>
                                    <?php echo $data['pengarang']; ?>
                                </td>
                                <td width="150px" class="text-center">
                                    <div class="btn-group btn-group-justified">
                                        <a href="" data-toggle="modal" data-target="#ModalEditBuku<?php echo $data['id_buku']; ?>"><button type="button" class="btn btn-info"><i class="bi bi-pencil-square"></i></button></a>
                                        <a href="" data-toggle="modal" data-target="#ModalHapusBuku<?php echo $data['id_buku']; ?>"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Hapus -->
                            <div class="modal fade" id="ModalHapusBuku<?php echo $data['id_buku']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus item <?php echo $data['id_buku']; ?>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="hapusbuku.php?id_buku=<?php echo $data['id_buku']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Hapus -->
                            <div class="modal fade" id="ModalEditBuku<?php echo $data['id_buku']; ?>" role="dialog" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data Buku</h1>
                                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                                        </div>

                                        <form role="form" action="editbuku.php?id_buku=<?php echo $data['id_buku']; ?>" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="id_buku" value="<?php echo $data['id_buku']; ?>" required="" disabled>
                                                    <label for="floatingInput">ID Buku</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="kategori" required>
                                                        <option value="<?php echo $data['kategori']; ?>"><?php echo $data['kategori']; ?></option>
                                                        <option value="Keilmuan">Keilmuan</option>
                                                        <option value="Bisnis">Bisnis</option>
                                                        <option value="Novel">Novel</option>
                                                    </select>
                                                    <label for="floatingSelect">Kategori</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="nama_buku" value="<?php echo $data['nama_buku']; ?>" required="">
                                                    <label for="floatingInput">Nama Buku</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="harga" value="<?php echo $data['harga']; ?>" required="">
                                                    <label for="floatingInput">Harga</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="stok" value="<?php echo $data['stok']; ?>" required="">
                                                    <label for="floatingInput">Stok</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="penerbit" required>
                                                        <option value="<?php echo $data['penerbit']; ?>"><?php echo $data['penerbit']; ?></option>
                                                        <?php
                                                        include 'koneksi.php';
                                                        $sql3 = "SELECT * FROM penerbit";
                                                        $query = mysqli_query($connect, $sql3);
                                                        $i = 1;
                                                        while ($data = mysqli_fetch_array($query)) {
                                                        ?>
                                                            <option value="<?= $data['nama_penerbit'] ?>"><?= $data['nama_penerbit'] ?></option>
                                                        <?php $i++;
                                                        } ?>
                                                    </select>
                                                    <label for="floatingSelect">Penerbit</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="pengarang" value="<?= $pengarang ?>" required>
                                                    <label for="floatingInput">Pengarang</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" value="Upload">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Edit -->
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!--pagination-->
        <div class="row mb-5">
            <div class="col-md-12">
                <a href="" data-toggle="modal" data-target="#ModalTambahBuku" class="btn btn-primary">+ Tambah Data Buku</a>
            </div>
        </div>
        <div class="modal fade" id="ModalTambahBuku" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Buku</h1>
                        <button type="button" class="btn-close" data-dismiss="modal"></button>
                    </div>

                    <form role="form" action="tambahbuku.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="id_buku" required="">
                                <label for="floatingInput">ID Buku</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="kategori" required>
                                    <option value="">Pilih kategori...</option>
                                    <option value="Keilmuan">Keilmuan</option>
                                    <option value="Bisnis">Bisnis</option>
                                    <option value="Novel">Novel</option>
                                </select>
                                <label for="floatingSelect">Kategori</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="nama_buku" required="">
                                <label for="floatingInput">Nama Buku</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="harga" required="">
                                <label for="floatingInput">Harga</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="stok" required="">
                                <label for="floatingInput">Stok</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="penerbit" required>
                                    <option value="">Pilih penerbit...</option>
                                    <?php
                                    include 'koneksi.php';
                                    $sql3 = "SELECT * FROM penerbit";
                                    $query = mysqli_query($connect, $sql3);
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?= $data['nama_penerbit'] ?>"><?= $data['nama_penerbit'] ?></option>
                                    <?php $i++;
                                    } ?>
                                </select>
                                <label for="floatingSelect">Penerbit</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="pengarang" required="">
                                <label for="floatingInput">Pengarang</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" value="Upload">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <!--judul -->
        <div class="row mt-5">
            <div class="col-md-12 mb-3">
                <h1>Tabel Penerbit</h1>
            </div>
        </div>

        <!--tabel-->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="th">No</th>
                            <th class="th">ID Penerbit</th>
                            <th class="th">Nama</th>
                            <th class="th">Alamat</th>
                            <th class="th">Kota</th>
                            <th class="th">Telepon</th>
                            <th class="th">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($data = mysqli_fetch_array($result2)) {
                        ?>
                            <tr class="tr">
                                <td width="40px">
                                    <?php echo ++$no_urut2; ?>
                                </td>
                                <td>
                                    <?php echo $data['id_penerbit']; ?>
                                </td>
                                <td>
                                    <?php echo $data['nama_penerbit']; ?>
                                </td>
                                <td>
                                    <?php echo $data['alamat']; ?>
                                </td>
                                <td>
                                    <?php echo $data['kota']; ?>
                                </td>
                                <td>
                                    <?php echo $data['telepon']; ?>
                                </td>
                                <td width="150px" class="text-center">
                                    <div class="btn-group btn-group-justified">
                                        <a href="" data-toggle="modal" data-target="#ModalEditPenerbit<?php echo $data['id_penerbit']; ?>"><button type="button" class="btn btn-info"><i class="bi bi-pencil-square"></i></button></a>
                                        <a href="" data-toggle="modal" data-target="#ModalHapusPenerbit<?php echo $data['id_penerbit']; ?>"><button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit-->
                            <div class="modal fade" id="ModalEditPenerbit<?php echo $data['id_penerbit']; ?>" role="dialog" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data Penerbit</h1>
                                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                                        </div>

                                        <form role="form" action="editpenerbit.php?id_penerbit=<?php echo $data['id_penerbit']; ?>" method="POST" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="id_penerbit" value="<?php echo $data['id_penerbit']; ?>" required="" disabled>
                                                    <label for="floatingInput">ID Penerbit</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="nama_penerbit" value="<?php echo $data['nama_penerbit']; ?>" required="">
                                                    <label for="floatingInput">Nama Penerbit</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="alamat" value="<?php echo $data['alamat']; ?>" required="">
                                                    <label for="floatingInput">Alamat</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="kota" value="<?php echo $data['kota']; ?>" required="">
                                                    <label for="floatingInput">Kota</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="telepon" value="<?php echo $data['telepon']; ?>" required="">
                                                    <label for="floatingInput">Telepon</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" value="Upload">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Edit -->
                            <!-- Modal Hapus -->
                            <div class="modal fade" id="ModalHapusPenerbit<?php echo $data['id_penerbit']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin untuk menghapus item <?php echo $data['id_penerbit']; ?>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="hapuspenerbit.php?id_penerbit=<?php echo $data['id_penerbit']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Hapus -->
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--pagination-->
        <div class="row">
            <div class="col-md-12">
                <a href="" data-toggle="modal" data-target="#ModalTambahPenerbit"> <input class="btn btn-primary" type=button value="+ Tambah Data Penerbit"></a>
            </div>
        </div>
        <div class="modal fade" id="ModalTambahPenerbit" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Penerbit</h1>
                        <button type="button" class="btn-close" data-dismiss="modal"></button>
                    </div>

                    <form role="form" action="tambahpenerbit.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="id_penerbit" required="">
                                <label for="floatingInput">ID Penerbit</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="nama_penerbit" required="">
                                <label for="floatingInput">Nama Penerbit</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="alamat" required="">
                                <label for="floatingInput">Alamat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="kota" required="">
                                <label for="floatingInput">Kota</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="telepon" required="">
                                <label for="floatingInput">Telepon</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" value="Upload">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>