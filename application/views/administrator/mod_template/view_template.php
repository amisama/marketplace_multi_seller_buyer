            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Template Website</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/tambah_templatewebsite'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Template</th>
                        <th>Pembuat</th>
                        <th>Directory</th>
                        <th>Aktif</th>
                        <th style='width:90px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    if ($row['aktif']=='Y'){ $icon = 'star'; $color = 'orange'; }else{ $icon = 'star-empty'; $color = '#8a8a8a'; }
                    echo "<tr><td>$no</td>
                              <td>$row[judul]</td>
                              <td>$row[pembuat]</td>
                              <td>$row[folder]</td>
                              <td>$row[aktif]</td>
                              <td><center>
                                <a class='btn btn-default btn-xs' title='Aktifkan' href='".base_url().$this->uri->segment(1)."/aktif_templatewebsite/$row[id_templates]/$row[aktif]'><span style='color:$color' class='glyphicon glyphicon-$icon'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_templatewebsite/$row[id_templates]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_templatewebsite/$row[id_templates]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>