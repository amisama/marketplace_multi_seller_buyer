<?php

    echo "<div class='col-md-6'>
          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Selamat Datang di Halaman $users[level]</h3>
            </div>
            <div class='box-body'>
              <p>Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola Tulisan anda pada web ini, berikut informasi akun anda saat ini : </p>
              <dl class='dl-horizontal'>
                <dt>Username</dt>
                <dd>$users[username]</dd>

                <dt>Password</dt>
                <dd>***********</dd>

                <dt>Nama Lengkap</dt>
                <dd>$users[nama_lengkap]</dd>

                <dt>Alamat Email</dt>
                <dd>$users[email]</dd>

                <dt>No. Telpon</dt>
                <dd>$users[no_telp]</dd>

                <dt>Level</dt>
                <dd>$users[level]</dd>

                <dt>Hak Akses</dt>
                <dd>"; 
                    $hakakses = $this->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='".$this->session->id_session."'");
                    foreach ($hakakses->result_array() as $mod1) {
                        echo "<a href='$mod1[link]'>$mod1[nama_modul]</a>, ";
                    }
                echo "</dd>
              </dl>
              <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-info'></i> Info Penting!</h4>
                Diharapkan informasi akun sesuai dengan identitas pada Kartu Pengenal anda, Untuk Mengubah informasi Profile anda klik <a href='".base_url().$this->uri->segment(1)."/edit_manajemenuser/".$this->session->username."'>disini</a>.
              </div>
            </div>
          </div>
        </div>

        <section class='col-lg-6 connectedSortable'>";
        $feedlist = new rss('https://members.phpmu.com/forum.xml'); /* Ubah link feed disini dengan link feed Anda */
        echo $feedlist->display(5,"Forum Swarakalibata"); /* Angka 7 digunakan untuk menampilkan jumlah artikel */
    echo "</section>";