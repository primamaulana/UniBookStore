<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebutuhan Buku</title>
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
                        <a class="nav-link" href="admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Pengadaan</a>
                    </li>
            </div>
    </nav>

    <div class="container mt-5 mb-5">
        <!--judul -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <h1>Kebutuhan Buku</h1>
                <hr>
            </div>
            <div class="col-12">
                <div class="row text-dark">
                    <div class="col-sm-12 g-4"></div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Perbarui Stok Buku Berikut</h5>
                            <hr>
                            <form action="" method="POST">
                                <?php
                                include 'koneksi.php';
                                $sql = "SELECT nama_buku, penerbit, min(stok) AS stok FROM buku";
                                $query = mysqli_query($connect, $sql);
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <div class="mb-3 row">
                                    <label for="nama_buku" class="col-sm-3 col-form-label">Judul Buku</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="nama_buku" value="<?= $data['nama_buku'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="penerbit" class="col-sm-3 col-form-label">Nama Penerbit</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="penerbit" value="<?= $data['penerbit'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="stok" value="<?= $data['stok'] ?>">
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <?php
                                } ?>
                        </div>
                    </div>
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