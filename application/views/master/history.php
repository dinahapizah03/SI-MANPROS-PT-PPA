<!DOCTYPE html>
<html lang="en">

<head>
    
</head>
<style>
     /* untuk mengatur tampilan aksi agar sejajar ke kanan samping */
    .btnlist{
        display: flex;
        gap: 0.5em;
        justify-content: center;
    }
      /* untuk pengaturan tampilan loading */
    .bg-custom{
        background: rgba(40,40,40,0.7);
        transition:  height 0.2s linear;
        transition-delay: 2s;
    }
     /* untuk menambahkan foto di loading */
    .bg-custom img {
        width: 50% !important;
        display: block;
    }
    /* agar tulisan yg ada pada tabel menjadi rata tengah */
    #example2 th, td{
        text-align: center;
    }
    /* untuk mengatur warna teks level persetujuan GL */
    .textorange{
        color: #ff5b22;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Ditambahkan!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Ditambahkan!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('edit')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Diedit!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_edit')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Diedit!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('hapus')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Dihapus!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_hapus')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Dihapus !",
                icon: "error"
            });
        </script>
    <?php } ?>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center bg-custom">
            <img src="<?= base_url();?>assets/admin_lte/dist/img/Loading.svg"
                alt="AdminLTELogo" />
        </div>

        <!-- Navbar -->
       
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">History</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">History</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <?= $this->session->flashdata('pesan'); ?>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">History Pengajuan Permohonan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>Nama Approval</th>
                                        <th>NRP</th>
                                        <th>Tanggal Approval</th>
                                        <th>Status Laporan</th>
                                        <th>Alasan</th>
                                        <th>Level Persetujuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    foreach ($history_laporan as $row) : 
                                        $id_permohonan = $row['id_permohonan'];
                                        $idakun = $row['idakun'];
                                        $nama = $row['nama'];
                                        $NRP = $row['NRP'];
                                        $tgl_action = $row['tgl_action']; 
                                        $id_status_laporan = $row['id_status_laporan'];
                                        $alasan = $row['alasan'];
                                        $idhistory = $row['idhistory'];
                                        $id_level_persetujuan = $row['id_level_persetujuan'];
                                    ?>
                                        <tr>
                                            <td><?= $nama ?></td>
                                            <td><?= $NRP ?></td>
                                            <td><?= $tgl_action ?></td>                                          
                                            <td><?php if($id_status_laporan == 2){?>
                                                    <div class="table-responsive">
                                                            <a href="" class="badge badge-success" data-toggle="modal"
                                                                data-target="#Disetujui<?= $id_status_laporan ?>">
                                                                Disetujui
                                                            </a>
                                                        </div>
                                                    <?php }elseif($id_status_laporan == 3){?>
                                                    <div class="table-responsive">
                                                            <a href="" class="badge badge-danger" data-toggle="modal"
                                                                data-target="#Ditolak<?= $id_status_laporan ?>">
                                                                Ditolak
                                                            </a>
                                                        </div>
                                                    <?php }elseif($id_status_laporan == 4){?>
                                                    <div class="table-responsive">
                                                            <a href="" class="badge badge-info" data-toggle="modal"
                                                                data-target="#Complete<?= $id_status_laporan ?>">
                                                                Complete
                                                            </a>
                                                        </div>
                                                    <?php }?>
                                                </td>
                                            <td><?= $alasan ?></td>        
                                            <td><?php if($id_level_persetujuan == 12){?>
                                                <div class="table-responsive">
                                                        <a class="textorange" data-toggle="modal"
                                                            data-target="#Disetujui GL<?= $id_level_persetujuan ?>">
                                                            Group Leader
                                                        </a>
                                                    </div>
                                                <?php }elseif($id_level_persetujuan == 13){?>
                                                <div class="table-responsive">
                                                        <a class="textorange" data-toggle="modal"
                                                            data-target="#Ditolak GL<?= $id_level_persetujuan ?>">
                                                            Group Leader
                                                        </a>
                                                    </div>
                                                <?php }elseif($id_level_persetujuan == 21){?>
                                                <div class="table-responsive">
                                                        <a data-toggle="modal"
                                                            data-target="#Disetujui SH<?= $id_level_persetujuan ?>">
                                                            Section Head
                                                        </a>
                                                    </div>
                                                <?php }elseif($id_level_persetujuan == 22){?>
                                                <div class="table-responsive">
                                                        <a data-toggle="modal"
                                                            data-target="#Ditolak SH<?= $id_level_persetujuan ?>">
                                                            Section Head
                                                        </a>
                                                    </div>
                                                <?php }?>
                                            </td>            
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            </div>
                            <!-- /.card-body -->
                         </div>
                         <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
             <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
    </aside>
        <!-- /.control-sidebar -->
</div>
    <!-- ./wrapper -->

    <?php $this->load->view("master/components/js.php") ?>
</body>
<script>
     // pengaturan pada loading sistem //
    const img = document.querySelector('.preloader img')
    setTimeout(() => {
        img.style = 'display: block'
    },500)
    setTimeout(() => {
        img.style = 'display: none'
    },2200)
</script>
</html>