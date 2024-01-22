<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
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
    #example1 th, td{
        text-align: center;
        font-size: 0.9em;
    }
     /* untuk mengatur tampilan modal agar lebih luas */
    .modal-dialog{
        max-width: 900px;
    }
     /* pengaturan modal hapus */
    .hapusmdl{
        max-width: 500px;
        margin: 1.75rem auto;
    }
     /* memberi jarak pada textbox modal agar berjarak dengan yg dibawahnya */
    .col-md-6{
        margin-bottom: 1em;
    }
    /* memberi jarak pada textbox modal agar berjarak dengan yg dibawahnya  */
    .col-12{
        margin-bottom: 1em;
    }
    /* memperkecil tulisan pada tabel*/
    label{
        font-weight: 400 !important;
    }
    /* memberikan background pada header table*/
    #basic-datatable th{
        background: rgb(240,240,240);
        border: 1px solid rgb(200,200,200) !important;
    }
    /* agar tulisan daftar item tidak berjarak dengan tulisan di bawahnya*/
    .nomargin{
        margin: 0;
    }
    
    .odd{
        background-color: white !important;
    }
    /* melengkungkan pinggiran modal*/
    .modal-content{
        border-radius: 1em !important;
    }
    /* melengkungkan pinggiran modal*/
    .modal-header{
        border-radius: 1em 1em 0 0;
    }
    /* memindahkan button tambah barang di modal menjadi ke sebelah kanan ujung*/
    .rights{
        flex: 1;
        display: flex;
        gap: 1em;
        justify-content: flex-end;
        padding-right: 1em;
    }
    /* memperkecil font pada table*/
    body{
        font-size: 0.9em;
    }
    /* memindahkan button submit di modal menjadi ke sebelah kanan ujung*/
    .modal-footer{
        flex: 1;
        display: flex;
        gap: 0;
        justify-content: flex-end;
        padding-right: 0;
    }
    .list-tbl{
        width: 100% !important;
    }
    /* untuk mengatur tulisan tabel header menjadi rata tengah */
    th{
        text-align: center;
    }
    /* untuk mengatur warna tabel header dan ketebalan garisnya */
    #list-item-update {
        background: rgb(240,240,240);
        border: 1px solid rgb(200,200,200) !important;
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
                            <h1 class="m-0">Permohonan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Permohonan</li>
                            </ol>
                        </div><!-- /.col -->
                        <button type="button" class="btn btn-primary mt-3 btnupdate" data-toggle="modal"
                            data-target="#exampleModal">
                            + Tambah Permohonan
                        </button>
                        <br>
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
                                    <h3 class="card-title">Pengajuan Permohonan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Pengaju</th>
                                            <th>Nomor Surat</th>
                                            <th>Divisi</th>
                                            <th>Catatan</th>
                                            <th>Status Laporan</th>
                                            <th>Alasan</th>
                                            <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($permohonan as $row) : 
                                                $id_permohonan = $row['id_permohonan'];
                                                $created_date= $row['created_date'];
                                                $no_surat = $row['no_surat'];
                                                $catatan = $row['catatan'];
                                                $idakun = $row['idakun'];
                                                $nama = $row['nama'];
                                                $iddepartemen = $row['iddepartemen'];
                                                $divisi = $row['divisi'];
                                                $id_status_laporan = $row['id_status_laporan'];
                                                $alasan = $row['alasan'];   
                                            ?>  
                                            <tr>
                                                <td><?= $created_date ?></td>
                                                <td><?= $nama ?></td>                       
                                                <td><?= $no_surat ?></td>                        
                                                <td><?= $divisi ?></td>   
                                                <td><?= $catatan ?></td> 
                                                <td><?php if($id_status_laporan == 1){ ?>
                                                    <div class="table-responsive">
                                                        <a href="" class="badge badge-warning" data-toggle="modal"
                                                            data-target="#Menunggu<?=$id_status_laporan ?>">
                                                                Menunggu 
                                                        </a>
                                                    </div>
                                                    <?php }elseif($id_status_laporan == 2){?>
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
                                                <td class="btnlist"> 
                                                    <?php if($id_status_laporan == 1){
                                                        ?>
                                                        <a 
                                                            href="<?php echo base_url('Permohonan/edit/') . $id_permohonan ?>" 
                                                            class="btn btn-warning btn-update"
                                                            dataid="<?= $id_permohonan ?>" 
                                                            data-toggle="modal" 
                                                            data-target="#editpermohonan"
                                                            >
                                                        <i class="fas fa-edit" title="Edit"></i>
                                                        </a>
                                                        <a href="<?php echo base_url('Permohonan/delete/') . $id_permohonan ?>" 
                                                        data-toggle="modal" 
                                                        data-target="#delete<?= $id_permohonan ?>" 
                                                        class="btn btn-danger"
                                                        >
                                                        <i class="fas fa-trash" title="Hapus"></i>
                                                            </a>
                                                    <?php } ?>
                                                        <a target="_blank" href="<?php echo base_url('Laporanms/print_surat/') . $id_permohonan ?>" class="btn btn-success"><i class="fas fa-print" title="Print"></i>
                                                        </a>
                                                </td>                       
                                            </tr> 
                                            <!-- Modal Hapus Data Permohonan -->
                                            <div class="modal fade" id="delete<?= $id_permohonan ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog hapusmdl">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-colored-header bg-danger">
                                                            <h4 class="modal-title fs-5" id="exampleModalLabel">Hapus Data
                                                            Permohonan
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="<?php echo base_url()?>Permohonan/delete"
                                                                method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="hidden" name="id_permohonan"
                                                                            value="<?php echo $id_permohonan?>" />
                                                                        <p>Apakah kamu yakin ingin menghapus data
                                                                            ini?</i></b></p>
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
                                            <?php endforeach ?>
                                        </tbody> 
                                    </table>
                                    <!-- Modal Edit Permohonan -->
                                    <div class="modal fade" id="editpermohonan" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-colored-header bg-warning">
                                                    <h5 class="modal-title fs-5" id="exampleModalLabel">Edit
                                                    Permohonan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" id="myFormEdit" action="<?=base_url();?>Permohonan/edit"
                                                        method="POST">
                                                        <input type="text" name="id_permohonan_edit" id="id_permohonan_edit"
                                                            value="" hidden>
                                                        <div class="col-md-12">
                                                            <label for="catatan">Catatan</label>
                                                            <input type="text" class="form-control"
                                                                id="catatan-edit" required autocomplete="off">
                                                        </div>
                                                    </form>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h5 class="nomargin"><b>Daftar Item</b></h5>
                                                            <p class="font-gray-dark">
                                                                Silahkan tambahkan barang / item sesuai kebutuhan.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <form id="editformbtn">
                                                        <div class="row">
                                                            <div class="col md-6">
                                                                <label for="created_date">Nama Barang</label>
                                                                <input type="text" class="form-control"
                                                                    id="nama_barang-edit" aria-describedby="nama_barang"
                                                                    name="nama_barang" required autocomplete="off">
                                                            </div>
                                                            <div class="col md-6">
                                                                <label for="created_date">Kuantitas</label>
                                                                <input type="number" min="0" class="form-control"
                                                                    id="kuantitas-edit" aria-describedby="kuantitas"
                                                                    name="kuantitas" required autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col md-6">
                                                                <label for="created_date">Satuan</label>
                                                                <input type="text" class="form-control"
                                                                    id="satuan-edit" aria-describedby="satuan"
                                                                    name="satuan" required autocomplete="off">
                                                            </div>
                                                            <div class="col md-6">
                                                                <label for="created_date">Agenda</label>
                                                                <input type="text" class="form-control"
                                                                    id="agenda-edit" aria-describedby="agenda"
                                                                    name="agenda" required autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-end">
                                                            <div class="col md-6">
                                                                <label for="created_date">Tanggal Agenda</label>
                                                                <input type="date" min="<?=date('Y-m-d');?>" class="form-control"
                                                                    id="agenda_date-edit" aria-describedby="agenda_date"
                                                                    name="agenda_date" required>
                                                            </div>
                                                            <div class="d-flex align-items-end rights">
                                                                <button type="submit" class="btn btn-info btnaddupdateitem">Tambah Barang</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <table id="list-item-update" class="list-tbl table table-bordered table-striped dt-responsive nowrap w-100 ">
                                                    </table>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                            class="btn btn-info ripple save-category submitupdate">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
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
            <!-- /.content -->
            <!-- Modal Tambah Permohonan -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-info">
                            <h4 class="modal-title fs-5" id="exampleModalLabel">Tambah Permohonan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form class="row g-3" id="myForm" action="<?= base_url(); ?>Permohonan/tambah" method="POST">
                            <div class="col-md-6">
                                <label for="no_surat" class="form-label">Nomor Surat</label>
                                <input type="text" readonly id="no_surat" class="form-control" value="<?=$last->id_permohonan+1?>/HCGA/PPA-GRYA/RKB/<?=$month?>/<?=$year?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="catatan">Catatan</label>
                                <input type="text" class="form-control" id="catatan" placeholder="e.g. Barang diantar ke Main Office" required autocomplete="off">
                            </div>

                            <div class="col-md-12 mt-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="nomargin"><b>Daftar Item</b></h5>
                                    <p class="font-gray-dark">
                                        Silahkan tambahkan barang / item sesuai kebutuhan.
                                    </p>
                                </div>
                            </div>
                            <form id="formtambah" class="row">
                                <div class="col md-6">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" placeholder="e.g. Air Mineral" required autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label for="kuantitas">Kuantitas / Jumlah</label>
                                    <input type="number" min="0" class="form-control" id="kuantitas" placeholder="e.g. 1" required autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" placeholder="e.g. Dus / Kotak" required autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label for="agenda">Nama Agenda</label>
                                    <input type="text" class="form-control" id="agenda" placeholder="e.g. Meeting Bulanan" required autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label for="agenda_date">Tanggal Agenda</label>
                                    <input type="date" min="<?=date('Y-m-d');?>" class="form-control" id="agenda_date" required>
                                </div>
                                <div class="d-flex align-items-end rights">
                                    <a  class="btn btn-info mb-3 btnadditem">Tambah Barang</a>
                                </div>
                            </form>
                            <div class="col-12 overflow-auto">
                                <table id="basic-datatable" class="table table-bordered table-striped dt-responsive nowrap w-100 ">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Kuantitas</th>
                                            <th>Satuan</th>
                                            <th>Nama Agenda</th>
                                            <th>Tanggal Agenda</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    </tbody>
                                </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info mb-3 btnSubmitAdd">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <?php $this->load->view("admin/components/js.php") ?>
<script> 
// untuk mengatur modal edit //   
    $(document).ready(function () {
        localStorage.removeItem('list-item')
    $('#myForm').submit(function (e) {
        e.preventDefault();

        // Ambil data dari form
        var created_date = $('#created_date').val();
        var nama = $('#nama').val();

        // Lakukan AJAX untuk menyimpan data ke server
        $.ajax({
            type: 'POST',
            url: '<?= base_url("Permohonan/tambah"); ?>',
            data: {
                created_date: created_date,
                nama: nama
            },
            success: function (response) {
                // Setelah berhasil tambahkan data ke DataTable
                var table = $('#basic-datatable').DataTable();
                table.row.add([created_date, nama]).draw(false);

                // Bersihkan formulir
                $('#myForm')[0].reset();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    function loadTabelItem(id){
        $.ajax({
            url: `<?= base_url()?>Permohonan/get_list_item/${id}`,
            method: 'GET',
            success: data => {
                let convertedData = JSON.parse(data)
                if(convertedData.length){
                    $('#catatan').val(convertedData[0].catatan)
                    convertedData = convertedData.map((it, index) => ({...it, no: index+1}))
                }
                $('#list-item-update').DataTable({
                    destroy: true,
                    data: convertedData,
                    columns: [
                        {data: 'nama_barang', title: 'Nama Barang'},
                        {data: 'kuantitas', title: 'Kuantitas'},
                        {data: 'satuan', title: 'Satuan'},
                        {data: 'agenda', title: 'Agenda'},
                        {data: 'agenda_date', title: 'Agenda_Date'},
                        {data: 'id_item', title: 'Aksi', render: function(data){
                            return `
                                <a class="deleteitemupdate"> 
                                    <i title="Hapus Barang / Item" class="fas fa-trash"></i>
                                </a>
                            `
                        }},
                    ]
                })
            }
        })
    }
    $('.btn-update').on('click', function(){
        let id = $(this).attr('dataid')
        //
        loadTabelItem(id)
    })

    function refreshTable(){
        let data = localStorage.getItem('list-item')
        if(data == null){
            data = []
        } else {
            data = JSON.parse(data)
            data = data.map((it, index) => ({no: index+1, ...it}))
        }
        $('#basic-datatable').DataTable({
            destroy: true,
            data: data,
            paging: false,
            searching: false,
            columns: [
                {data: 'nama_barang', title: 'Nama Barang'},
                {data: 'kuantitas', title: 'Kuantitas'},
                {data: 'satuan', title: 'Satuan'},
                {data: 'agenda', title: 'Agenda'},
                {data: 'agenda_date', title: 'Tanggal Agenda'},
                {data: 'nama_barang', title: 'Aksi', render: function(data){
                    return `
                    <a dataid="${data}" class="btndelitem">
                        <i title="Hapus Barang / Item" class="fas fa-trash"></i>
                    </a>
                `
                }},
            ]
        })
        // function hapus item
        $('.btndelitem').on('click', function(){
            let listitem = localStorage.getItem('list-item')
            listitem = JSON.parse(listitem)
            listitem = listitem.filter(it => it.nama_barang != $(this).attr('dataid'))
            localStorage.setItem('list-item', JSON.stringify(listitem))
            refreshTable()
        })
    }

    $('.btnupdate').on('click', function(){
        refreshTable()
    })

    // pengaturan modal btn tambah //
    $('.btnadditem').on('click ',function(e){
        e.preventDefault()
        let nama_barang = $('#nama_barang').val()
        let kuantitas = $('#kuantitas').val()
        let satuan = $('#satuan').val()
        let agenda = $('#agenda').val()
        let agenda_date = $('#agenda_date').val()
        if(nama_barang && kuantitas && satuan && agenda && agenda_date){
            // data barang yang diinput
            let data = {
                nama_barang: nama_barang,
                kuantitas: kuantitas,
                satuan: satuan,
                agenda: agenda,
                agenda_date: agenda_date
            }
            let arrayItem = localStorage.getItem('list-item')
            if(arrayItem == null){
                arrayItem = []
            } else {
                arrayItem = JSON.parse(arrayItem)
            }
            arrayItem.push(data)

            localStorage.setItem('list-item', JSON.stringify(arrayItem))
            refreshTable()
            $('#nama_barang').val("")
            $('#kuantitas').val("")
            $('#satuan').val("")
            $('#agenda').val("")
            $('#agenda_date').val("")
        } else {
            alert('Silahkan lengkapi form isian')
        }
    })

    // pengaturan btn submit pada modal tambah //
    $('.btnSubmitAdd').on('click',function(){
        let created_date = $('#created_date').val()
        let no_surat = $('#no_surat').val()
        let divisi = $('#iddepartemen').val()
        let catatan = $('#catatan').val()
        let daftar_item = localStorage.getItem('list-item')
        daftar_item = JSON.parse(daftar_item)
        daftar_item = daftar_item.map(it => ({...it, id_permohonan: ''}))
        // data barang yang diinput
        let data = {
            created_date: created_date,
            no_surat: no_surat,
            idakun: '<?=$idakun?>',
            alasan: '',
            catatan: catatan,
            status: 1,
            id_status_laporan: 1,
            id_p: "-",
            daftar_item: daftar_item,
        }
        $.ajax({
            url: `<?=base_url()?>/Permohonan/tambah`,
            method: 'POST',
            data: data,
            success: data => {
                localStorage.removeItem('list-item')
                if(data > 0){
                    window.location.href="<?=base_url()?>Permohonan/success_message"
                }
            }
        })
        // console.log(data)
    })
    // pengaturan pada loading sistem //
    const img = document.querySelector('.preloader img')
    setTimeout(() => {
        img.style = 'display: block'
    },500)
    setTimeout(() => {
        img.style = 'display: none'
    },2200)

    // edit proposal
    $('.btn-update').on('click', function(){
        let idpermohonan = $(this).attr('dataid');
        $.ajax({
            url: `<?=base_url()?>/Permohonan/get_det_permohonan/${idpermohonan}`,
            method: 'GET',
            success: data => {
                let convData = JSON.parse(data)
                convData = convData.map((it, index) => ({...it, no: index+1}))
                if(convData.length){
                    $('#catatan-edit').val(convData[0].catatan);
                    $('#id_permohonan_edit').val(convData[0].id_permohonan);
                    localStorage.removeItem('list-item');
                    let resData = []
                    convData.forEach(it => {
                        resData.push(it)
                    })
                    localStorage.setItem('list-item', JSON.stringify(resData))
                    updatedatatableedit()
                }
            }
        })
    })
    function updateListItemEdit(id){
        let data = localStorage.getItem('list-item')
        data = JSON.parse(data)
        if(data.length){
            let filtered = data.filter(it => it.no != id)
            localStorage.setItem('list-item', JSON.stringify(filtered))
            updatedatatableedit()
        }
    }
    function updatedatatableedit(){
        let data = JSON.parse(localStorage.getItem('list-item'));
        data = data.map((it, index) => ({...it, no: index+1}))
        $('#list-item-update').DataTable({
            destroy: true,
            data: data,
            columns: [
                {data: 'nama_barang', title: 'Nama Barang'},
                {data: 'kuantitas', title: 'Kuantitas'},
                {data: 'satuan', title: 'Satuan'},
                {data: 'agenda', title: 'Agenda'},
                {data: 'agenda_date', title: 'Agenda_Date'},
                {data: 'no', title: 'Aksi', render: function(data){
                    return `
                        <a class="deleteitemupdate" dataid="${data}"> 
                            <i title="Hapus Barang / Item" class="fas fa-trash"></i>
                        </a>
                    `
                }},
            ]
        })
        $('.deleteitemupdate').on('click', function(){
            updateListItemEdit($(this).attr('dataid'))
        })
    }
    // pengaturan update item //
    $('.btnaddupdateitem').on('click ',function(e){
        e.preventDefault()
        let nama_barang = $('#nama_barang-edit').val()
        let kuantitas = $('#kuantitas-edit').val()
        let satuan = $('#satuan-edit').val()
        let agenda = $('#agenda-edit').val()
        let agenda_date = $('#agenda_date-edit').val()
        if(nama_barang && kuantitas && satuan && agenda && agenda_date){
            // data barang yang diinput
            let data = {
                nama_barang: nama_barang,
                kuantitas: kuantitas,
                satuan: satuan,
                agenda: agenda,
                agenda_date: agenda_date
            }
            let arrayItem = localStorage.getItem('list-item')
            if(arrayItem == null){
                arrayItem = []
            } else {
                arrayItem = JSON.parse(arrayItem)
            }
            arrayItem.push(data)
            localStorage.setItem('list-item', JSON.stringify(arrayItem))
            updatedatatableedit()
            $('#nama_barang-edit').val("")
            $('#kuantitas-edit').val("")
            $('#satuan-edit').val("")
            $('#agenda-edit').val("")
            $('#agenda_date-edit').val("")
        } else {
            alert('Silahkan lengkapi form isian')
        }
    })
    // on submit update
    $('.submitupdate').on('click', function(){
        let catatan = $('#catatan-edit').val()
        let idpermohonan = $('#id_permohonan_edit').val()
        let listitem = localStorage.getItem('list-item')
        if(listitem){
            listitem = JSON.parse(listitem)
        } else {
            listitem = []
        }
        let data = {
            catatan, 
            idpermohonan,
            listitem: listitem.map(it => ({
                nama_barang: it.nama_barang,
                kuantitas: it.kuantitas,
                satuan: it.satuan,
                agenda: it.agenda,
                agenda_date: it.agenda_date,
                id_permohonan: idpermohonan
            }))
        }
        $.ajax({
            url: `<?=base_url()?>Permohonan/update_permohonan`,
            method: 'POST',
            data: data,
            success: data => {
                if(data <= 0){
                    alert('Gagal update permohonan')
                } else {
                    window.location.href="<?=base_url()?>Permohonan/success_message"
                }
            }
        })
    })
});
</script>
</body>
</html>