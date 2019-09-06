            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pembelian Ke Pusat + History Stok Produk anda</h3>
                  <a class='pull-right btn btn-info btn-sm' style='margin-left:5px' data-toggle='modal' data-target='#rekening'>Rekening Pembayaran</a>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url().$this->uri->segment(1); ?>/tambah_pembelian'>Tambah Pembelian</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Kode Transaksi</th>
                        <th>Waktu Transaksi</th>
                        <th>Status</th>
                        <th>Total Tagihan</th>
                        <th>Proses</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record->result_array() as $row){
                    if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; }
                    $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                    if ($row['service']==''){ $service = "<i style='color:green'>Pembelian ke Pusat</i>"; }else{ $service = "<i style='color:blue'>$row[service]</i>"; }
                    echo "<tr><td>$no</td>
                              <td>$row[kode_transaksi]</td>
                              <td>$row[waktu_transaksi]</td>
                              <td>$proses</td>
                              <td style='color:red;'>Rp ".rupiah($total['total'])."</td>
                              <td>$service</td>
                              <td><center>
                                <a style='margin-right:3px' class='btn btn-info btn-xs' title='Detail Data' href='".base_url().$this->uri->segment(1)."/detail_pembelian/$row[id_penjualan]'><span class='glyphicon glyphicon-search'></span> Detail</a>";
                                if ($row['proses']=='0'){
                                  echo "<a class='btn btn-success btn-xs' title='Konfirmasi Pemabayaran' href='".base_url().$this->uri->segment(1)."/konfirmasi_pembayaran/$row[id_penjualan]'> Konfirmasi Pembayaran</a>
                                        <a class='btn btn-warning btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_pembelian/$row[id_penjualan]'><span class='glyphicon glyphicon-edit'></span></a>
                                        <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_pembelian/$row[id_penjualan]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>";
                                }else{
                                  echo "<a class='btn btn-default btn-xs' title='Konfirmasi Pemabayaran' href='#' onclick=\"return alert('Maaf, Transaksi ini sudah di konfirmasi untuk pembayarannya!')\"> Konfirmasi Pembayaran</a>
                                        <a class='btn btn-default btn-xs' title='Edit Data' href='#' onclick=\"return alert('Maaf, Transaksi ini sudah di proses dan tidak bisa di-edit!')\"><span class='glyphicon glyphicon-edit'></span></a>
                                        <a class='btn btn-default btn-xs' title='Delete Data' href='#' onclick=\"return alert('Maaf, Transaksi ini sudah di proses dan tidak bisa di-hapus!')\"><span class='glyphicon glyphicon-remove'></span></a>"; 
                                }
                              echo "</center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              </div>
              </div>
              