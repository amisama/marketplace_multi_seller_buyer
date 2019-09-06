      <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Reseller</h3>
                </div>
                <div class='box-body'>

                  <div class='panel-body'>
                    <ul id='myTabs' class='nav nav-tabs' role='tablist'>
                      <li role='presentation' class='active'><a href='#profile' id='profile-tab' role='tab' data-toggle='tab' aria-controls='profile' aria-expanded='true'>Data Konsumen </a></li>
                      <li role='presentation' class=''><a href='#pembelian' role='tab' id='pembelian-tab' data-toggle='tab' aria-controls='pembelian' aria-expanded='false'>History Pembelian</a></li>
                      <li role='presentation' class=''><a href='#penjualan' role='tab' id='penjualan-tab' data-toggle='tab' aria-controls='penjualan' aria-expanded='false'>History Penjualan</a></li>
                      <li role='presentation' class=''><a href='#keuangan' role='tab' id='keuangan-tab' data-toggle='tab' aria-controls='keuangan' aria-expanded='false'>Data Keuangan dan Referral</a></li>
                      <li role='presentation' class=''><a href='#keuangan1' role='tab' id='keuangan1-tab' data-toggle='tab' aria-controls='keuangan1' aria-expanded='false'>Data Penjualan dan Bonus Reward</a></li>
                    </ul><br>

                    <div id='myTabContent' class='tab-content'>
                      <div role='tabpanel' class='tab-pane fade active in' id='profile' aria-labelledby='profile-tab'>
                          <div class='col-md-12'>
                            <table class='table table-condensed table-bordered'>
                            <tbody>
                              <?php 
                              if (trim($rows['foto'])==''){ $foto_user = 'blank.png'; }else{ $foto_user = $rows['foto']; } 
                              $ko = $this->db->query("SELECT * FROM rb_kota where kota_id='$rows[kota_id]'")->row_array();
                              ?>
                              <tr bgcolor='#e3e3e3'><th rowspan='13' width='110px'><center><?php echo "<img style='border:1px solid #cecece; height:85px; width:85px' src='".base_url()."asset/foto_user/$foto_user' class='img-circle img-thumbnail'>"; ?></center></th></tr>
                              <tr><th width='130px' scope='row'>Username</th> <td><?php echo $rows['username']?></td></tr>
                              <tr><th scope='row'>Password</th> <td>xxxxxxxxxxxxxxx</td></tr>
                              <tr><th scope='row'>Nama Reseller</th> <td><?php echo $rows['nama_reseller']?></td></tr>
                              <tr><th scope='row'>Jenis Kelamin</th> <td><?php echo $rows['jenis_kelamin']?></td></tr>
                              <tr><th scope='row'>Kota</th> <td><?php echo $ko['nama_kota']?></td></tr>
                              <tr><th scope='row'>Alamat Lengkap</th> <td><?php echo $rows['alamat_lengkap']?></td></tr>
                              <tr><th scope='row'>No Hp</th> <td><?php echo $rows['no_telpon']?></td></tr>

                              <tr><th scope='row'>Alamat Email</th> <td><?php echo $rows['email']?></td></tr>
                              <tr><th scope='row'>Kode Pos</th> <td><?php echo $rows['kode_pos']?></td></tr>
                              <tr><th scope='row'>Keterangan</th> <td><?php echo $rows['keterangan']?></td></tr>
                              <tr><th scope='row'>Referral</th> <td><?php echo $rows['referral']?></td></tr>
                              <tr><th scope='row'>Tanggal Daftar</th> <td><?php echo tgl_indo($rows['tanggal_daftar']); ?></td></tr>
                            </tbody>
                            </table>
                          </div>
                          <div style='clear:both'></div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='pembelian' aria-labelledby='pembelian-tab'>
                          <div class='col-md-12'>
                            <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th style='width:30px'>No</th>
                                  <th>Kode Transaksi</th>
                                  <th>Nama Pembeli</th>
                                  <th>Waktu Transaksi</th>
                                  <th>Status</th>
                                  <th>Total Tagihan</th>
                                  <th>Proses / Keterangan</th>
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
                                        <td><a href='".base_url()."administrator/detail_penjualan/$row[id_penjualan]'>$row[kode_transaksi]</a></td>
                                        <td>$row[nama_reseller]</td>
                                        <td>$row[waktu_transaksi]</td>
                                        <td>$proses</td>
                                        <td style='color:red;'>Rp ".rupiah($total['total'])."</td>
                                        <td>$service</td>
                                    </tr>";
                                $no++;
                              }
                            ?>
                            </tbody>
                          </table>
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='penjualan' aria-labelledby='penjualan-tab'>
                          <div class='col-md-12'>
                            <table id="example11" class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th style='width:40px'>No</th>
                                  <th>Kode Transaksi</th>
                                  <th>Nama Konsumen</th>
                                  <th>Waktu Transaksi</th>
                                  <th>Status</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>
                            <?php 
                              $no = 1;
                              foreach ($penjualan->result_array() as $row){
                              if ($row['proses']=='0'){ $proses = '<i class="text-danger">Pending</i>'; $status = 'Proses'; $icon = 'star-empty'; $ubah = 1; }elseif($row['proses']=='1'){ $proses = '<i class="text-success">Proses</i>'; $status = 'Pending'; $icon = 'star text-yellow'; $ubah = 0; }else{ $proses = '<i class="text-info">Konfirmasi</i>'; $status = 'Proses'; $icon = 'star'; $ubah = 1; }
                              $total = $this->db->query("SELECT sum((a.harga_jual*a.jumlah)-a.diskon) as total FROM `rb_penjualan_detail` a where a.id_penjualan='$row[id_penjualan]'")->row_array();
                              echo "<tr><td>$no</td>
                                        <td>$row[kode_transaksi]</td>
                                        <td><a href='".base_url()."administrator/detail_konsumen/$row[id_konsumen]'>$row[nama_lengkap]</a></td>
                                        <td>$row[waktu_transaksi]</td>
                                        <td>$proses</td>
                                        <td style='color:red;'>Rp ".rupiah($total['total'])."</td>
                                    </tr>";
                                $no++;
                              }
                            ?>
                            </tbody>
                          </table>
                          </div>
                      </div>


                      <div role='tabpanel' class='tab-pane fade' id='keuangan' aria-labelledby='keuangan-tab'>
                          <div class='col-md-12'>
                              <?php
                              $id_reseller = $this->uri->segment(3);
                              $res = $this->db->query("SELECT * FROM rb_reseller where id_reseller='$id_reseller'")->row_array();
                              $pembelian = $this->db->query("SELECT sum((b.jumlah*b.harga_jual)-b.diskon) as total FROM rb_penjualan a JOIN rb_penjualan_detail b ON a.id_penjualan=b.id_penjualan where a.status_penjual='admin' AND a.id_pembeli='".$id_reseller."' AND a.proses='1'")->row_array();
                              $penjualan_perusahaan = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                          JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$id_reseller."' AND c.proses='1'")->row_array();
                              $penjualan = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                          JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan='0' AND id_penjual='".$id_reseller."' AND c.proses='1'")->row_array();
                              $modal_perusahaan = $this->db->query("SELECT sum(a.jumlah*b.harga_reseller) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_pembeli='konsumen' AND c.proses='1' AND c.id_penjual='".$id_reseller."' AND b.id_produk_perusahaan!='0'")->row_array();
                              $modal_pribadi = $this->db->query("SELECT sum(a.jumlah*b.harga_beli) as total FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_pembeli='konsumen' AND c.proses='1' AND c.id_penjual='".$id_reseller."' AND b.id_produk_perusahaan='0'")->row_array();
                              $set = $this->db->query("SELECT * FROM rb_setting where aktif='Y'")->row_array();
                              

                              echo "<table class='table table-striped table-condensed'>
                                <tr><td width='190px'>Belanja ke Perusahaan</td>                <td> : Rp ".rupiah($pembelian['total'])."</td></tr>
                                <tr><td>Penjualan Produk Perusahaan</td>                        <td> : Rp ".rupiah($penjualan_perusahaan['total'])." (".rupiah($penjualan_perusahaan['produk'])." Produk)</td></tr>
                                <tr><td>Modal Produk Perusahaan</td>                            <td> : Rp ".rupiah($modal_perusahaan['total'])."</td></tr>
                                <tr><td>Penjualan Produk Pribadi</td>                           <td> : Rp ".rupiah($penjualan['total'])."</td></tr>
                                <tr><td>Modal Produk Pribadi</td>                               <td> : Rp ".rupiah($modal_pribadi['total'])."</td></tr>

                                <tr class='success'><td>Keuntungan </td>                        <td> : Rp ".rupiah(($penjualan['total']+$penjualan_perusahaan['total'])-($modal_perusahaan['total']+$modal_pribadi['total']))."</td></tr>
                              </table>

                              <div class='alert alert-success'>Data Reseller Referral Anda :</div>
                              <table class='table table-striped table-condensed table-bordered'>
                                <tr style='background:#e3e3e3'>
                                    <th>No </th>
                                    <th>Nama Toko / Reseller</th>
                                    <th>Penjualan Produk Perusahaan</th>
                                    <th>Bonus Anda $set[referral]%</th>
                                </tr>";
                              $no = 1;
                              $total_jual = 0;
                              $total_bonus = 0;
                              $reseller = $this->db->query("SELECT * FROM rb_reseller where referral='".$res['username']."'");
                              if ($reseller->num_rows()<=0){
                                echo "<tr><td colspan='4'><center style='color:red; padding:40px'><i>Anda Belum Memiliki Toko / Reseller Referral!,.. ^_^</i></center></td></tr>";
                              }else{
                                foreach ($reseller->result_array() as $row) {
                                  $pp = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                            JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$row['id_reseller']."' AND c.proses='1'")->row_array();
                                  $total_jual = $total_jual+$pp['total'];
                                  $total_bonus = $total_bonus+($set['referral']/100*$pp['total']);
                                  echo "<tr><td width='20px'>$no</td>
                                            <td><b>$row[nama_reseller]</b></td>  
                                            <td>: Rp ".rupiah($pp['total'])." (".rupiah($pp['produk'])." Produk)</td>
                                            <td>: Rp ".rupiah($set['referral']/100*$pp['total'])."</td>
                                        </tr>";
                                  $no++;
                                }
                              }
                              echo "<tr class='alert alert-danger'>
                                          <th colspan='2'>Total</th> 
                                          <th>Rp ".rupiah($total_jual)."</th> 
                                          <th>Rp ".rupiah($total_bonus)."</th>
                                    </tr>
                                </table>";
                            ?>
                          </div>
                      </div>

                      <div role='tabpanel' class='tab-pane fade' id='keuangan1' aria-labelledby='keuangan1-tab'>
                          <div class='col-md-12'>
                            <?php 
                              if ($_GET['tahun']==''){
                                $tahun = date('Y');
                              }else{
                                $tahun = $_GET['tahun'];
                              }
                              echo "<div class='alert alert-success'><b>Total Penjualan anda Pada Tahun $tahun :</b> </div>
                                    <table class='table table-striped table-condensed'>
                                      <tr><td width='190px'>Penjualan Produk Perusahaan</td>    <td style='color:red'> : Rp ".rupiah($penjualan_perusahaan['total'])."</td></tr>
                                      <tr><td>Jumlah Produk Terjual</td>                        <td style='color:red'> : ".rupiah($penjualan_perusahaan['produk'])." Produk</td></tr>
                                    </table>

                                  <table class='table table-bordered table-striped table-condensed'>
                                        <thead>
                                          <tr bgcolor='#e3e3e3'>
                                            <th style='width:20px'>No</th>
                                            <th>Bulan (Tahun $tahun)</th>
                                            <th>Total Penjualan</th>
                                            <th>Bonus / Reward</th>
                                          </tr>
                                        </thead>
                                        <tbody>";
                                        for ($i=1; $i <=12 ; $i++) { 
                                          $bulan = $tahun."-".sprintf("%02d", $i);
                                          $ppb = $this->db->query("SELECT sum((a.jumlah*a.harga_jual)-a.diskon) as total, sum(a.jumlah) as produk FROM `rb_penjualan_detail` a JOIN rb_produk b ON a.id_produk=b.id_produk
                                                                          JOIN rb_penjualan c ON a.id_penjualan=c.id_penjualan where c.status_penjual='reseller' AND b.id_produk_perusahaan!='0' AND id_penjual='".$id_reseller."' AND c.proses='1' AND substr(c.waktu_transaksi,1,7)='$bulan'")->row_array();
                                          echo "<tr bgcolor='#e3e3e3'>
                                                  <td>$i</td>
                                                  <td><b>".bulan($i)."</b></td>
                                                  <td>Rp ".rupiah($ppb['total'])."</td>
                                                  <td>";
                                                      $nomor = 1;
                                                      $rew = $this->db->query("SELECT * FROM `rb_reward` where posisi<='$ppb[total]'");
                                                      foreach ($rew->result_array() as $re) {
                                                        echo "$nomor. $re[reward]<br>";
                                                        $nomor++;
                                                      }
                                                  echo "</td>
                                                </tr>";
                                        }
                                  echo "</tbody></table>";
                              ?>
                          </div>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
        </div>