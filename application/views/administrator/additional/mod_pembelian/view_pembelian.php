            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Transaksi Pembelian (PO)</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_pembelian'>Tambah Pembelian</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Pembelian</th>
                        <th>Nama Supplier</th>
                        <th>Waktu Pembelian</th>
                        <th>Total</th>
                        <th style='width:120px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    $total = $this->db->query("SELECT sum(a.harga_pesan*a.jumlah_pesan) as total FROM `rb_pembelian_detail` a where a.id_pembelian='$row[id_pembelian]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td>$row[kode_pembelian]</td>
                              <td>$row[nama_supplier]</td>
                              <td>$row[waktu_beli]</td>
                              <td style='color:red;'>Rp ".rupiah($total['total'])."</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."administrator/detail_pembelian/$row[id_pembelian]'><span class='glyphicon glyphicon-search'></span> Detail</a>
                                <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url()."administrator/edit_pembelian/$row[id_pembelian]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url()."administrator/delete_pembelian/$row[id_pembelian]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              </div>
              </div>
              