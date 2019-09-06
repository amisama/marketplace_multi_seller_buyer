<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Sekilas Info</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_sekilasinfo',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                    <tbody>
                      <input type='hidden' name='id' value='$rows[id_sekilas]'>
                      <tr><th scope='row' width='120px'>Tulis Info</th>             <td><textarea class='form-control' name='a' style='height:200px' required>$rows[info]</textarea></td></tr>
                      <tr><th scope='row'>Ganti Foto</th>          <td><input type='file' class='form-control' name='b'><hr style='margin:5px'>";
                                                                   if ($rows['gambar']!=''){ echo " Gambar Saat ini : <a target='_BLANK' href='".base_url()."asset/foto_info/$rows[gambar]'>$rows[gambar]</a>"; } echo "</td></tr>
                       <tr><th scope='row'>Aktif </th>        <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='f' value='Y' checked> Ya &nbsp; <input type='radio' name='f' value='N'> Tidak"; }else{ echo "<input type='radio' name='f' value='Y'> Ya &nbsp; <input type='radio' name='f' value='N' checked> Tidak"; } echo "</td></tr>
                    </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/sekilasinfo'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
