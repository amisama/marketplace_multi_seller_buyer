<?php $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array(); ?>
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Daftar Semua Keuangan reseller</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:20px'>No</th>
                        <th>Nama Reseller</th>
                        <th>Referral</th>
                        <th>Belanja</th>
                        <th>Penjualan Perusahaan</th>
                        <th>Penjualan Pribadi</th>
                        <th>Keuntungan</th>
                        <th>Sisa Referral</th>
                        <th style='width:110px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($record as $row){
                    $pembelian = $this->db->query("SELECT sum((b.jumlah*b.harga_jual)-b.diskon) as total FROM rb_penjualan a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where a.status_penjual='admin' AND a.id_pembeli='$row[id_reseller]' AND a.proses='1'")->row_array();
                    $penjualan_perusahaan = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='$row[id_reseller]' AND c.proses='1'")->row_array();
                    $penjualan = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan='0' AND id_penjual='$row[id_reseller]' AND c.proses='1'")->row_array();
                    $modal_perusahaan = $this->db->query("SELECT sum(a.jumlah*b.harga_reseller) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_pembeli='konsumen' AND c.proses='1' AND c.id_penjual='$row[id_reseller]' AND b.id_produk_perusahaan!='0'")->row_array();
                    $modal_pribadi = $this->db->query("SELECT sum(a.jumlah*b.harga_beli) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_pembeli='konsumen' AND c.proses='1' AND c.id_penjual='$row[id_reseller]' AND b.id_produk_perusahaan='0'")->row_array();
                    $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();

                    $total_jual = 0;
                    $total_bonus = 0;
                    $reseller = $this->db->query("SELECT * FROM rb_reseller where referral='$row[username]'");
                      foreach ($reseller->result_array() as $rows) {
                        $pp = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                  JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$rows['id_reseller']."' AND c.proses='1'")->row_array();
                        $total_jual = $total_jual+$pp['total'];
                        $total_bonus = $total_bonus+($set['referral']/100*$pp['total']);
                      }

                    $pen = $this->db->query("SELECT sum(bonus_referral) as pencairan FROM rb_pencairan_bonus where id_reseller='$row[id_reseller]'")->row_array();
                    echo "<tr><td>$no</td>
                              <td>$row[nama_reseller]</td>
                              <td style='color:red'>$row[referral]</td>
                              <td>Rp ".rupiah($pembelian['total'])."</td>
                              <td>Rp ".rupiah($penjualan_perusahaan['total'])."</td>
                              <td>Rp ".rupiah($penjualan['total'])."</td>
                              <td>Rp ".rupiah(($penjualan['total']+$penjualan_perusahaan['total'])-($modal_perusahaan['total']+$modal_pribadi['total']))."</td>
                              <td>Rp ".rupiah($total_bonus-$pen['pencairan'])."</td>
                              <td><center>
                                <a class='btn btn-success btn-xs' title='Detail Data' href='".base_url()."administrator/detail_reseller/$row[id_reseller]'><span class='glyphicon glyphicon-search'></span> Detail</a>
                                <a class='btn btn-info btn-xs' title='Bayarkan Bonus Rerral' href='".base_url()."administrator/bayar_bonus/$row[id_reseller]'><span class='glyphicon glyphicon-ok'></span> Bayar</a>
                              </center></td>
                          </tr>";
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>