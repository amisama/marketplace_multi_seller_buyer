<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Yahoo Messanger</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_ym',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                    <tbody>
                      <input type='hidden' name='id' value='$rows[id]'>
                      <tr><th width='120px' scope='row'>Nama Pengguna</th>    <td><input type='text' class='form-control' name='a' value='$rows[nama]' required></td></tr>
                      <tr><th scope='row'>Username</th>                       <td><input type='text' class='form-control' name='b' value='$rows[username]' required></td></tr>
                      <tr><th scope='row'>Ym Icon</th>                        <td><input type='number' class='form-control' name='c' value='$rows[ym_icon]' required></td></tr>
                    </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/ym'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
