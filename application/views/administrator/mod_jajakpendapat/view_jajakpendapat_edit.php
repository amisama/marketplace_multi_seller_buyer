<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Poling / jajak Pendapat</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart($this->uri->segment(1).'/edit_jajakpendapat',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                    <tbody>
                      <input type='hidden' name='id' value='$rows[id_poling]'>
                       <tr><th scope='row' width='120px'>Pertanyaan</th> <td><input type='text' class='form-control' name='a' value='$rows[pilihan]' required></td></tr>
                       <tr><th scope='row'>Status</th>                 <td>"; if ($rows['status']=='Jawaban'){ echo "<input type='radio' name='b' value='Jawaban' checked> Jawaban &nbsp; <input type='radio' name='b' value='Pertanyaan'> Pertanyaan"; }else{ echo "<input type='radio' name='b' value='Jawaban'> Jawaban &nbsp; <input type='radio' name='b' value='Pertanyaan' checked> Pertanyaan"; } echo "</td></tr>
                       <tr><th scope='row'>Aktif </th>        <td>"; if ($rows['aktif']=='Y'){ echo "<input type='radio' name='c' value='Y' checked> Ya &nbsp; <input type='radio' name='c' value='N'> Tidak"; }else{ echo "<input type='radio' name='c' value='Y'> Ya &nbsp; <input type='radio' name='c' value='N' checked> Tidak"; } echo "</td></tr>
                    </tbody>
                  </table>
                </div>
              
              <div class='box-footer'>
                    <button type='submit' name='submit' class='btn btn-info'>Update</button>
                    <a href='".base_url().$this->uri->segment(1)."/jajakpendapat'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
            </div></div></div>";
            echo form_close();
