<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Akses Terbatas</title>
        <link rel="icon" type="image/png" href="<?= base_url();?>assets/login/images/pt.ppa.png"/>
    </head>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Mongolian&display=swap');
        .wrappers{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Noto Sans Mongolian', sans-serif;
            padding-top: 2em;
        }
        .wrappers img{
            width: 30em;
        }
        .wrappers div{
            width: 50%;
            text-align: center;
        }
        .wrappers p{
            font-size: 0.9em;
            color: rgb(120,120,120);
        }
        .wrappers h3{
            font-size: 1.7em;
            margin-bottom: 0;
        }
        .wrappers a{
            color: cornflowerblue;
            margin-top: 0.3em;
        }
    </style>
    <body>
        <div class="wrappers">
            <img src="<?= base_url();?>assets/login/images/error.svg" alt="Error" />
            <div>
                <h3>Akses Unauthorized</h3>
                <p>Maaf, Anda Tidak Memiliki Izin Untuk Mengakses Halaman ini. Jika Anda yakin ini adalah kesalahan, mohon hubungi administrator kami untuk mendapatkan bantuan lebih lanjut.</p>
                <a href="#" class="back">Kembali</a>
            </div>
        </div>
        <script>
            let btn=document.querySelector('.back')
            btn.addEventListener('click', function (){
                window.history.back()
            })
        </script>
    </body>
</html>
