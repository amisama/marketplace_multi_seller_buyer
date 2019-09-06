<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Reseller</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_reseller',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='130px' scope='row'>Username</th>       <td><input class='form-control' type='text' name='a'></td></tr>
                    <tr><th scope='row'>Password</th>                     <td><input class='form-control' type='password' name='b'></td></tr>
                    <tr><th scope='row'>Nama Reseller</th>                <td><input class='form-control' type='text' name='c'></td></tr>
                    <tr><th scope='row'>Jenis Kelamin</th>                <td><input type='radio' value='Laki-laki' name='d' checked> Laki-laki <input type='radio' value='Perempuan' name='d'> Perempuan</td></tr>
                    <tr><th scope='row'>Alamat Lengkap</th>               <td><input class='form-control' type='text' name='e'></td></tr>
                    <tr><th scope='row'>No Hp</th>                        <td><input class='form-control' type='number' name='f'></td></tr>
                    <tr><th scope='row'>Alamat Email</th>                 <td><input class='form-control' type='email' name='g'></td></tr>
                    <tr><th scope='row'>Kode Pos</th>                     <td><input class='form-control' type='number' name='h'></td></tr>
                    <tr><th scope='row'>Keterangan</th>                   <td><input class='form-control' type='text' name='i'></td></tr>
                    <tr><th scope='row'>Referral</th>                     <td><input class='form-control' type='text' name='j'></td></tr>
                     <tr><th scope='row'>Foto</th>                        <td><input type='file' class='form-control' name='gg'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
