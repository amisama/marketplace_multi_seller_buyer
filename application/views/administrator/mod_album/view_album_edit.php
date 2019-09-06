<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Album Berita Foto</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_album',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_album]'>
                    <tr><th width='120px' scope='row'>Judul Album</th>   <td><input type='text' class='form-control' name='a' value='$rows[jdl_album]'></td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><textarea class='ckeditor form-control' name='b' style='height:260px'>$rows[keterangan]</textarea></td></tr>
                    <tr><th scope='row'>Ganti Cover</th>          <td><input type='file' class='form-control' name='c'><hr style='margin:5px'>";
                                                                   if ($rows['gbr_album']!=''){ echo " Gambar Saat ini : <a target='_BLANK' href='".base_url()."asset/img_album/$rows[gbr_album]'>$rows[gbr_album]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Aktif </th>        <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='d' value='Y' checked> Ya &nbsp; <input type='radio' name='d' value='N'> Tidak"; }else{ echo "<input type='radio' name='d' value='Y'> Ya &nbsp; <input type='radio' name='d' value='N' checked> Tidak"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/album'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();