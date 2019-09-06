            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Semua Produk</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_produk'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Produk</th>
                        <th>Modal</th>
                        <th>Reseller</th>
                        <th>Konsumen</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Berat</th>
                        <th style='width:50px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                      $res = $this->db->query("SELECT * FROM rb_reseller a JOIN rb_kota b ON a.kota_id=b.kota_id where a.id_reseller='$row[id_reseller]'")->row_array();
                      if ($row['id_reseller']=='0'){
                        $jual = $this->model_reseller->jual($row['id_produk'])->row_array();
                        $beli = $this->model_reseller->beli($row['id_produk'])->row_array();
                        $produk = "<i style='color:blue'>(Perusahaan)</i>"; 
                      }else{ 
                        $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                        $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                        $produk = "<i style='color:green'><a title='$res[nama_reseller] ($res[nama_kota], $res[alamat_lengkap])' style='color:green' href='".base_url()."/administrator/detail_reseller/$row[id_reseller]'>(Toko / Reseller)</a></i>"; 
                      }
                    echo "<tr><td>$no</td>
                              <td>$row[nama_produk] 
                                  <small>$produk</small></td>
                              <td>".rupiah($row['harga_beli'])."</td>
                              <td>".rupiah($row['harga_reseller'])."</td>
                              <td>".rupiah($row['harga_konsumen'])."</td>
                              <td>".($beli['beli']-$jual['jual'])."</td>
                              <td>$row[satuan]</td>
                              <td>$row[berat] G</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url()."administrator/edit_produk/$row[id_produk]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_produk/$row[id_produk]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>