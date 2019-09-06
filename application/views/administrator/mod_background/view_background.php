<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Background Website </h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/background',$attributes); 
                error_reporting(0);
                if ($rows['gambar']=='red'){
                  $red = 'checked';
                }elseif ($rows['gambar']=='green'){
                  $green = 'checked';
                }elseif ($rows['gambar']=='blue'){
                  $blue = 'checked';
                }elseif ($rows['gambar']=='orange'){
                  $orange = 'checked';
                }elseif ($rows['gambar']=='purple'){
                  $purple = 'checked';
                }elseif ($rows['gambar']=='pink'){
                  $pink = 'checked';
                }elseif ($rows['gambar']=='toska'){
                  $toska = 'checked';
                }elseif ($rows['gambar']=='black'){
                  $black = 'checked';
                }
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>

                      <tr bgcolor=#fe3e82><td><input name='a' value='pink' type='radio' $pink><b style='color:#fff'> Pink</b> </td></tr>
                  </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/background'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
