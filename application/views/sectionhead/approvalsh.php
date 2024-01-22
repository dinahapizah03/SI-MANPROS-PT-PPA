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
    /* melengkungkan pinggiran modal*/
    .modal-content{
        border-radius: 1em !important;
    }
    /* melengkungkan pinggiran modal*/
    .modal-header{
        border-radius: 1em 1em 0 0;
    }
    /* memindahkan button submit di modal menjadi ke sebelah kanan ujung*/
    .modal-footer{
        flex: 1;
        display: flex;
        gap: 0;
        justify-content: flex-end;
        padding-right: 0;
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
        text: "Status SK Berhasil Diubah!",
        icon: "success"
    });
    </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_input')){ ?>
    <script>
    swal({
        title: "Erorr!",
        text: "Status SK Gagal Diubah!",
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
                            <h1 class="m-0">Approval</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Approval</li>
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
                                    <h3 class="card-title">Data Menunggu Persetujuan</h3>
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
                                            <th>Status Laporan</th>
                                            <th>Alasan</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        foreach ($approval as $row) :
                                            $id_permohonan = $row['id_permohonan'];
                                            $created_date= $row['created_date'];
                                            $idakun = $row['idakun'];
                                            $nrp = $row['nrp'];
                                            $nama = $row['nama'];
                                            $divisi = $row['divisi'];
                                            $alasan = $row['alasan']; 
                                            $id_status_laporan = $row['id_status_laporan'];
                                        ?>
                                            <tr>
                                                <td><?= $created_date?></td>
                                                <td><?= $nrp ?></td>
                                                <td><?= $nama ?></td>
                                                <td><?= $divisi ?></td>
                                                <td><?php if($id_status_laporan == 2){?>
                                                    <div class="table-responsive">
                                                             <a href="" class="badge badge-warning" data-toggle="modal"
                                                                data-target="#Menunggu<?=$id_status_laporan ?>">
                                                                Menunggu 
                                                            </a>
                                                        </div>
                                                    <?php }?>
                                                </td>
                                                <td><?= $alasan ?></td>
                                                <td class="btnlist">
                                                    <a href="<?php echo base_url('Approvalsh/setujuLevel2/') . $id_permohonan ?>" class="btn btn-info" data-toggle="modal" data-target="#Disetujui<?= $id_permohonan ?>"><i class="nav-icon fas fa-check" title="Setuju"></i>
                                                    </a>
                                                    <a href="" data-toggle="modal" data-target="#Ditolak<?= $id_permohonan ?>" class="btn btn-danger"><i class="nav-icon fas fa-times" title="Tolak"></i>
                                                    </a>
                                                    <a target="_blank" href="<?php echo base_url('Laporanms/print_surat/'.$id_permohonan) ?>" class="btn btn-success"><i class="nav-icon fas fa-print" title="Print"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                              <!-- Modal Setuju Proposal -->
                                              <div class="modal fade" id="Disetujui<?= $id_permohonan ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-colored-header bg-info">
                                                            <h5 class="modal-title" id="exampleModalLabel">Setujui Data
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form
                                                                action="<?php echo base_url()?>Approvalsh/acc_laporan_sh/4"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="id_permohonan"
                                                                            value="<?php echo $id_permohonan?>" />
                                                                        <input type="hidden" name="id_status_laporan"
                                                                            value="<?php echo $id_status_laporan?>" />
                                                                        <p>Apakah kamu yakin ingin Menyetujui Proposal
                                                                            ini?</i></b></p>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleFormControlTextarea1">Alasan</label>
                                                                            <textarea class="form-control"
                                                                                id="alasan"
                                                                                name="alasan"
                                                                                rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger ripple"
                                                                        data-dismiss="modal">Tidak</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success ripple save-category">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                              <!-- Modal Tidak Setuju Proposal -->
                                            <div class="modal fade" id="Ditolak<?= $id_permohonan ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-colored-header bg-danger">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tolak Data
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form
                                                                action="<?php echo base_url()?>Approvalsh/acc_laporan_sh/3"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="idlaporan"
                                                                            value="<?php echo $id_permohonan?>" />
                                                                            <input type="hidden" name="id_status_laporan"
                                                                            value="<?php echo $id_permohonan?>" />
                                                                        <p>Apakah kamu yakin ingin Menolak Proposal
                                                                            ini?</i></b></p>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleFormControlTextarea1">Alasan</label>
                                                                            <textarea class="form-control"
                                                                                id="alasan"
                                                                                name="alasan"
                                                                                rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger ripple"
                                                                        data-dismiss="modal">Tidak</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success ripple save-category">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("sectionhead/components/js.php") ?>
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