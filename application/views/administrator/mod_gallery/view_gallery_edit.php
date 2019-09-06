<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Gallery Berita Foto</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_gallery',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_gallery]'>
                    <tr><th width='120px' scope='row'>Judul Foto</th>   <td><input type='text' class='form-control' name='b' value='$rows[jdl_gallery]'></td></tr>
                    <tr><th scope='row'>Album</th>               <td><select name='a' class='form-control' required>
                                                                            <option value='' selected>- Pilih Kategori -</option>";
                                                                            foreach ($record as $row){
                                                                              if ($rows['id_album']==$row['id_album']){
                                                                                echo "<option value='$row[id_album]' selected>$row[jdl_album]</option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_album]'>$row[jdl_album]</option>";
                                                                              }
                                                                            }
                    echo "</td></tr>
                    <tr><th scope='row'>Keterangan</th>           <td><textarea class='ckeditor form-control' name='c' style='height:260px'>$rows[keterangan]</textarea></td></tr>
                    <tr><th scope='row'>Ganti Foto</th>          <td><input type='file' class='form-control' name='d'>";
                                                                   if ($rows['gbr_gallery']!=''){ echo " Gambar Saat ini : <a target='_BLANK' href='".base_url()."asset/img_galeri/$rows[gbr_gallery]'>$rows[gbr_gallery]</a>"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/gallery'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();