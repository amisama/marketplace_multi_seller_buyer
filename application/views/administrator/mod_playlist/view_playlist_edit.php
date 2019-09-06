<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Playlist</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_playlist',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_playlist]'>
                    <tr><th width='120px' scope='row'>Judul playlist</th>   <td><input type='text' class='form-control' name='a' value='$rows[jdl_playlist]'></td></tr>
                    <tr><th scope='row'>Ganti Cover</th>          <td><input type='file' class='form-control' name='b'><hr style='margin:5px'>";
                                                                   if ($rows['gbr_playlist']!=''){ echo " Gambar Saat ini : <a target='_BLANK' href='".base_url()."asset/img_playlist/$rows[gbr_playlist]'>$rows[gbr_playlist]</a>"; } echo "</td></tr>
                    <tr><th scope='row'>Aktif </th>        <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='c' value='Y' checked> Ya &nbsp; <input type='radio' name='c' value='N'> Tidak"; }else{ echo "<input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak"; } echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/playlist'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();