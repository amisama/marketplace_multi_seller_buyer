<?php 
  echo "<p class='sidebar-title text-danger produk-title'> Edit Data Profile Anda</p>
        <p>Berikut Informasi Data Profile anda.<br> 
           Pastikan data-data dibawah ini sudah benar, agar tidak terjadi kesalahan saat transaksi.</p>";                
                  $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                  echo form_open_multipart('members/edit_profile',$attributes); 
                  $ko = $this->db->query("SELECT * FROM rb_kota where kota_id='$row[kota_id]'")->row_array();
                  echo "<table class='table table-hover table-condensed'>
                        <thead>
                          <tr><td width='140px'><b>Username</b></td> <td><input class='required form-control' style='width:50%; display:inline-block' name='aa' type='text' value='$row[username]'></td></tr>
                          <tr><td><b>Password</b></td>       <td><input class='form-control' style='width:50%; display:inline-block' type='password' name='a'> <small style='color:red'><i>Kosongkan Saja JIka Tidak ubah.</i></small></td></tr>
                          <tr><td><b>Nama Lengkap</b></td>   <td><input class='required form-control' type='text' name='b' value='$row[nama_lengkap]'></td></tr>
                          <tr><td><b>Email</b></td>          <td><input class='required email form-control' type='email' name='c' value='$row[email]'></td></tr>
                          <tr><td><b>Jenis Kelamin</b></td>  <td>"; if ($row['jenis_kelamin']=='Laki-laki'){ echo "<input type='radio' value='Laki-laki' name='d' checked> Laki-laki <input type='radio' value='Perempuan' name='d'> Perempuan "; }else{ echo "<input type='radio' value='Laki-laki' name='d'> Laki-laki <input type='radio' value='Perempuan' name='d' checked> Perempuan "; } echo "</td></tr>
                          <tr><td><b>Tanggal Lahir</b></td>  <td><input class='required datepicker form-control' type='text' name='e' value='$row[tanggal_lahir]' data-date-format='yyyy-mm-dd'></td></tr>
                          <tr><td><b>Tempat Lahir</b></td>   <td><input class='required form-control' type='text' name='f' value='$row[tempat_lahir]'></td></tr>
                          <tr><td><b>Alamat</b></td>         <td><textarea class='required form-control' name='g'>$row[alamat_lengkap]</textarea></td></tr>
                          <tr><th scope='row'>Provinsi</th>                     <td><select class='form-control' name='ewrwe' id='state_reseller' required>
                                                                            <option value=''>- Pilih -</option>";
                                                                            foreach ($provinsi as $rows) {
                                                                              if ($ko['provinsi_id']==$rows['provinsi_id']){
                                                                                echo "<option value='$rows[provinsi_id]' selected>$rows[nama_provinsi]</option>";
                                                                              }else{
                                                                                echo "<option value='$rows[provinsi_id]'>$rows[nama_provinsi]</option>";
                                                                              }
                                                                            }
                                                                          echo "</select></td></tr>
                          <tr><th scope='row'>Kota</th>                         <td><select class='form-control' name='ga' id='city_reseller' required>
                                                                                <option value=''>- Pilih -</option>";
                                                                            $kota = $this->model_app->view_where_ordering('rb_kota',array('provinsi_id'=>$ko['provinsi_id']),'kota_id','DESC');
                                                                            foreach ($kota as $rows) {
                                                                              if ($ko['kota_id']==$rows['kota_id']){
                                                                                echo "<option value='$rows[kota_id]' selected>$rows[nama_kota]</option>";
                                                                              }else{
                                                                                echo "<option value='$rows[kota_id]'>$rows[nama_kota]</option>";
                                                                              }
                                                                            }
                                                                              echo "</select></td></tr>
                          </td></tr>
                          <tr><td><b>Kecamatan</b></td>  <td><input type='text' class='required form-control' name='k' value='$row[kecamatan]'></td></tr>
                          <tr><td><b>No Hp</b></td>                  <td><input style='width:40%' class='required number form-control' type='number' name='l' value='$row[no_hp]'></td></tr>
                         
                          <tr><td></td><td><input class='btn btn-sm btn-primary' type='submit' name='submit' value='Simpan Perubahan'></td></tr>
                        </thead>
                    </table>";
                  echo form_close();
?>