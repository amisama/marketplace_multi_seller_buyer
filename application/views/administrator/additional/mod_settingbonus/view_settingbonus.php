<?php 
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Setting Bonus</h3>
                </div>
              <div class='box-body'>";
              $attributes = array('class'=>'form-horizontal','role'=>'form');
              echo form_open_multipart('administrator/settingbonus',$attributes); 
          echo "<div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$record[id_setting]'>
                    <tr><th width='150px' scope='row'>Bonus Referral (%)</th>         <td><input type='text' style='width:200px !important; display:inline-block' class='form-control' name='aa' value='$record[referral]'> %</td></tr>
                    <tr><th scope='row'>Tanggal Pencairan</th>                        <td><input type='text' style='width:100px !important; display:inline-block' class='form-control' name='bb' value='$record[tanggal_pencairan]'> Tiap Bulannya</td></tr>
                  </tbody>
                  </table>
                  <button type='submit' name='submit' class='btn btn-info'>Update</button>
                  <hr>

                  <table class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th width='20%'>Penjualan</th>
                        <th>Bonus / Reward</th>
                        <th style='width:90px'>Action</th>
                      </tr>
                      <tr>
                        <th><input type='hidden' name='idr' value='".$this->uri->segment(3)."'></th>
                        <th><input type='number' class='form-control' name='a' value='$rows[posisi]'></th>
                        <th><input type='text' class='form-control' name='b' value='$rows[reward]'></th>
                        <th>
                            <button type='submit' name='submit2' class='btn btn-success  btn-sm'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
                            <a class='btn btn-danger btn-sm' title='Delete Data' href='".base_url()."administrator/settingbonus'><span class='glyphicon glyphicon-remove'></span></a>
                        </th>
                      </tr>
                    </thead>
                    <tbody>";

                    $no = 1;
                    foreach ($reward as $row){
                    echo "<tr><td>$no</td>
                              <td>Rp ".rupiah($row['posisi'])."</td>
                              <td>$row[reward]</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/settingbonus/$row[id_reward]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_reward/$row[id_reward]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }

                  echo "</tbody>
                </table>
                </div>
              </div>
            </div>";
