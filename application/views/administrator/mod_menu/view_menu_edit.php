<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Menu Website</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_menuwebsite',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$rows[id_menu]'>
                    <tr><th width='120px' scope='row'>Link Menu</th>   <td><input type='text' class='form-control' name='a' value='$rows[link]'></td></tr>
                    <tr><th scope='row'>Level Menu</th>                <td><select name='b' class='form-control'>
                                                                                <option value='0'>Menu Utama</option>";
                                                                            foreach ($record as $row){
                                                                              if ($row['id_menu']==$rows['id_parent']){
                                                                                echo "<option value='$row[id_menu]' selected>$row[nama_menu] </option>";
                                                                              }else{
                                                                                echo "<option value='$row[id_menu]'>$row[nama_menu]</option>";
                                                                              }
                                                                            }
                    echo "</select></td></tr>
                    <tr><th scope='row'>Nama Menu</th>                 <td><input type='text' class='form-control' name='c' value='$rows[nama_menu]'></td></tr>
                    <tr><th scope='row'>Position</th>                  <td>"; if ($rows['position'] == 'Top'){
                                                                                echo "<input type='radio' name='d' value='Top' checked> Top 
                                                                                      <input type='radio' name='d' value='Bottom'> Bottom";
                                                                              }else{
                                                                                echo "<input type='radio' name='d' value='Top'> Top 
                                                                                      <input type='radio' name='d' value='Bottom' checked> Bottom";
                                                                              }
                    echo "</td></tr>
                    <tr><th scope='row'>Urutan</th>                    <td><input type='number' class='form-control' name='e' style='width:70px' value='$rows[urutan]'></td></tr>
                    <tr><th scope='row'>Aktif</th>                  <td>"; if ($rows['aktif'] == 'Ya'){
                                                                                echo "<input type='radio' name='f' value='Ya' checked> Ya 
                                                                                      <input type='radio' name='f' value='Tidak'> Tidak";
                                                                              }else{
                                                                                echo "<input type='radio' name='f' value='Ya'> Ya 
                                                                                      <input type='radio' name='f' value='Tidak' checked> Tidak";
                                                                              }
                    echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/menuwebsite'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
