<!DOCTYPE html>
<html lang="en">

<head>
    
</head>
<style>
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
</style>
<body class="hold-transition sidebar-mini layout-fixed">

    <?php if ($this->session->flashdata('edit')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Diedit!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_edit')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Diedit !",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('hapus')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Data Berhasil Dihapus!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_hapus')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Data Gagal Dihapus !",
        icon: "error"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('input')){ ?>
    <script>
    swal({
        title: "Success!",
        text: "Status Cuti Berhasil Diubah!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_input')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Status Cuti Gagal Diubah!",
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
                            <h1 class="m-0">Laporan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Laporan</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
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
                                    <h3 class="card-title">Data Approval Permohonan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>Tanggal Pengajuan</th>
                                            <th>NRP</th>
                                            <th>Pengaju</th>
                                            <th>Divisi</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($laporan as $row) :
                                            $id_permohonan = $row['id_permohonan'];
                                            $created_date= $row['created_date'];
                                            $idakun = $row['idakun'];
                                            $nrp = $row['nrp'];
                                            $nama = $row['nama'];
                                            $iddepartemen = $row['iddepartemen'];
                                            $divisi = $row['divisi'];
                                        ?>
                                            <tr>
                                                <td><?= $created_date?></td>
                                                <td><?= $nrp ?></td>
                                                <td><?= $nama ?></td>
                                                <td><?= $divisi ?></td>
                                                <td class="btnlist">
                                                    <a target="_blank" href="<?php echo base_url('Laporanms/view_history/'.$id_permohonan) ?>" class="btn btn-info"><i class="nav-icon fas fa-eye" title="Detail Laporan"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php endforeach; ?> 
                                </tbody>
                            </table>      
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
             </div>
          </div><!-- /.container-fluid -->
        </section>
            <!-- /.content -->
        <
    </div>
    <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
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