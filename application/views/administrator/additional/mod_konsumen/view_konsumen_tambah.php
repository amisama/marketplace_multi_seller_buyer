<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Konsumen</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/tambah_konsumen',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='130px' scope='row'>Username</th>                     <td><input class='form-control' type='text' name='aa'></td></tr>
                    <tr><th scope='row'>Password</th>                     <td><input class='form-control' type='password' name='a'></td></tr>
                    <tr><th scope='row'>Nama Lengkap</th>                 <td><input class='form-control' type='text' name='b'></td></tr>
                    <tr><th scope='row'>Alamat Email</th>                 <td><input class='form-control' type='email' name='c'></td></tr>
                    <tr><th scope='row'>No Hp</th>                        <td><input class='form-control' type='number' name='k'></td></tr>
                    <tr><th scope='row'>Jenis Kelamin</th>                <td><input type='radio' value='Laki-laki' name='d' checked> Laki-laki <input type='radio' value='Perempuan' name='d'> Perempuan</td></tr>
                    <tr><th scope='row'>Tanggal Lahir</th>                <td><input class='datepicker form-control' type='text' name='e' data-date-format='yyyy-mm-dd'></td></tr>
                    <tr><th scope='row'>Alamat</th>               <td><input class='form-control' type='text' name='g'></td></tr>
                    <tr><th scope='row'>Provinsi</th>               <td><select class='form-control' name='fa' id='state_reseller' required>
                                                                      <option value=''>- Pilih -</option>";
                                                                      foreach ($negara as $rows) {
                                                                          echo "<option value='$rows[provinsi_id]'>$rows[nama_provinsi]</option>";
                                                                      }
                                                                  echo "</select>
                    </td></tr>

                    <tr><th scope='row'>Kota</th>               <td><select class='form-control' name='ga' id='city_reseller' required>
                                                                    <option value=''>- Pilih -</option>
                                                                  </select>
                    </td></tr>

                    

                    <tr><th scope='row'>Kecamatan</th>               <td><input type='text' class='required form-control' name='ia'></td></tr>
                    <tr><th scope='row'>Foto</th>                 <td><input type='file' class='form-control' name='gg'></td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Tambah</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
