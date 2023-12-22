<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniBook Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include 'pagination.php';

    $q = isset($_REQUEST['q']) ? urldecode($_REQUEST['q']) : ''; // untuk keyword pencarian
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // untuk nomor halaman
    $adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; // khusus style pagination 2 dan 3
    $rpp = 15; // jumlah record per halaman

    $db_link = mysqli_connect('localhost', 'root', '', 'unibookstore');
    $sql = "SELECT * FROM buku WHERE nama_buku LIKE '%$q%' OR id_buku LIKE '%$q%' ORDER BY nama_buku";
    $result = mysqli_query($db_link, $sql); // eksekusi query

    $tcount = mysqli_num_rows($result); // jumlah total baris
    $tpages = isset($tcount) ? ceil($tcount / $rpp) : 1; // jumlah total halaman
    $count = 0; // untuk paginasi
    $i = ($page - 1) * $rpp; // batas paginasi
    $no_urut = ($page - 1) * $rpp; // nomor urut
    $reload = $_SERVER['PHP_SELF'] . "?q=" . $q . "&amp;adjacents=" . $adjacents; // untuk link ke halaman lain
    ?>
    <header id="header">
        <a href="#" class="logo">UNIBOOKSTORE</a>
        <ul>
            <li><a href="#home" onclick="toggle()">Home</a></li>
            <li><a href="admin.php" onclick="toggle()">Admin</a></li>
            <li><a href="pengadaan.php" onclick="toggle()">Pengadaan</a></li>
        </ul>
        <div class="toggle" onclick="toggle()"></div>
    </header>

    <section class="banner" id="home">
        <h2>UNI<span>BOOK</span><br>STORE</h2>
    </section>

    <section class="sec" id="about">
        <div class="content">
            <!--judul -->
            <div class="row">
                <div class="col-md-12">
                    <h1>List Buku</h1>
                </div>
            </div>

            <!--form pencarian-->
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." name="q" value="<?php echo $q ?>">
                            <span class="input-group-btn">
                                <?php
                                if ($q <> '') {
                                ?>
                                    <a class="btn btn-default" href="<?php echo $_SERVER['PHP_SELF'] ?>">Reset</a>
                                <?php
                                }
                                ?>
                                <button class="btn btn-primary" type="submit">Go!</button>
                            </span>
                        </div>
                    </form>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while (($count < $rpp) && ($i < $tcount)) {
                                mysqli_data_seek($result, $i);
                                $data = mysqli_fetch_array($result);
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
                                </tr>
                            <?php
                                $i++;
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--pagination-->
            <div class="row">
                <div class="col-md-12">
                    <?php echo paginate_one($reload, $page, $tpages); ?>
                </div>
            </div>
        </div>
    </section>

    <script src="js/script.js"></script>
</body>

</html>