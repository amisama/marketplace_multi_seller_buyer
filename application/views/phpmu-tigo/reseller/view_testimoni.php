  <p class='sidebar-title block-title'> Testimoni Konsumen</p>                
                <table class='table table-condensed table-hover'>
                  <?php 
                  if (isset($_POST['submit'])){
                      echo "<div class='alert alert-success'><center>Testimoni anda Succees Terkirim,.. <br> Testimoni akan muncul setelah disetujui oleh admin..</center></div>";
                  }

                  if ($this->session->id_konsumen != ''){
                    $attributes = array('id' => 'formku','class'=>'form-horizontal','role'=>'form');
                    echo form_open_multipart('testimoni',$attributes); 
                      echo "<tr><td colspan='2'><textarea name='testimoni' style='height:70px' class='required form-control' placeholder='Tulis Testimoni Disini...' required></textarea> <br> 
                                                <input name='submit' type='submit' style='margin-top:-15px' value='Kirimkan Testimoni' class='btn btn-primary btn-sm pull-right'></td></tr>";
                    echo form_close();
                  }
                    $no = 0;
                    foreach ($record->result_array() as $row){
                      if (!file_exists("asset/foto_user/$row[foto]") OR $row['foto']==''){
                        $foto = "blank.png";
                      }else{
                        $foto = $row['foto'];
                      }

                    $tgl_posting = tgl_indo($row['tgl_posting']);
                    echo "<tr><td><img width='70px' class='img-circle' src='".base_url()."asset/foto_user/$foto'></td>
                              <td><div style='border-radius:0px; padding:6px; margin-bottom:3px' class='alert alert-success'><strong>$row[nama_lengkap]</strong></div> 
                                $row[isi_testimoni]</td>
                          </tr>";
                      $no++;
                    }

                echo "</table>";
                echo "<div style='clear:both'></div>";
                echo $this->pagination->create_links();