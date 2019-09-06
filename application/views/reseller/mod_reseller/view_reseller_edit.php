<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Profile</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_reseller',$attributes); 
              $ko = $this->db->query("SELECT * FROM rb_kota where kota_id='$rows[kota_id]'")->row_array();
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden'  value='$rows[id_reseller]' name='id'>";
                    if (trim($rows['foto'])==''){ $foto_user = 'blank.png'; }else{ $foto_user = $rows['foto']; }
                    echo "<tr bgcolor='#e3e3e3'><th rowspan='14' width='110px'><center><img style='border:1px solid #cecece; height:85px; width:85px' src='".base_url()."asset/foto_user/$foto_user' class='img-circle img-thumbnail'></center></th></tr>
                    <tr><th width='130px' scope='row'>Username</th>       <td><input class='form-control' type='text' name='a' value='$rows[username]' disabled></td></tr>
                    <tr><th scope='row'>Password</th>                     <td><input class='form-control' type='password' name='b'></td></tr>
                    <tr><th scope='row'>Nama Reseller</th>                <td><input class='form-control' type='text' name='c' value='$rows[nama_reseller]'></td></tr>
                    <tr><th scope='row'>Jenis Kelamin</th>                <td>"; if ($rows['jenis_kelamin']=='Laki-laki'){ echo "<input type='radio' value='Laki-laki' name='d' checked> Laki-laki <input type='radio' value='Perempuan' name='d'> Perempuan "; }else{ echo "<input type='radio' value='Laki-laki' name='d'> Laki-laki <input type='radio' value='Perempuan' name='d' checked> Perempuan "; } echo "</td></tr>
                    <tr><th scope='row'>Provinsi</th>                     <td><select class='form-control' name='state' id='state_reseller' required>
                                                                            <option value=''>- Pilih -</option>";
                                                                            $provinsi = $this->model_app->view_ordering('rb_provinsi','provinsi_id');
                                                                            foreach ($provinsi as $row) {
                                                                              if ($ko['provinsi_id']==$row['provinsi_id']){
                                                                                echo "<option value='$row[provinsi_id]' selected>$row[nama_provinsi]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[provinsi_id]'>$row[nama_provinsi]</option>";
                                                                              }
                                                                            }
                                                                          echo "</select></td></tr>
                    <tr><th scope='row'>Kota</th>                         <td><select class='form-control' name='kota' id='city_reseller' required>
                                                                                <option value=''>- Pilih -</option>";
                                                                            $kota = $this->model_app->view_where_ordering('rb_kota',array('provinsi_id'=>$ko['provinsi_id']),'kota_id','DESC');
                                                                            foreach ($kota as $row) {
                                                                              if ($ko['kota_id']==$row['kota_id']){
                                                                                echo "<option value='$row[kota_id]' selected>$row[nama_kota]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[kota_id]'>$row[nama_kota]</option>";
                                                                              }
                                                                            }
                                                                              echo "</select></td></tr>
                    <tr><th scope='row'>Alamat Lengkap</th>               <td><input class='form-control' type='text' name='e' value='$rows[alamat_lengkap]'></td></tr>
                    <tr><th scope='row'>No Hp</th>                        <td><input class='form-control' type='number' name='f' value='$rows[no_telpon]'></td></tr>
                    <tr><th scope='row'>Alamat Email</th>                 <td><input class='form-control' type='email' name='g' value='$rows[email]'></td></tr>
                    <tr><th scope='row'>Kode Pos</th>                     <td><input class='form-control' type='number' name='h' value='$rows[kode_pos]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>                   <td><textarea class='form-control' name='i'>$rows[keterangan]</textarea></td></tr>
                    <tr><th scope='row'>Referral</th>                     <td><input class='form-control' type='text' name='j' value='$rows[referral]'></td></tr>
                    <tr><th scope='row'>Ganti Foto</th>                         <td><input type='file' class='form-control' name='gg'>";
                                                                               if ($rows['foto'] != ''){ echo "<i style='color:red'>Foto Profile saat ini : </i><a target='_BLANK' href='".base_url()."asset/foto_user/$rows[foto]'>$rows[foto]</a>"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='index.php'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div>";
