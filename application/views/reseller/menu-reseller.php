        <section class="sidebar">
          <!-- Sidebar user panel -->
          <?php
          $log = $this->model_app->edit('rb_reseller',array('id_reseller'=>$this->session->id_reseller))->row_array(); 
          if ($log['foto']==''){ $foto = 'blank.png'; }else{ $foto = $log['foto']; }
            echo "<div class='user-panel'>
              <div class='pull-left image'>
                <img src='".base_url()."asset/foto_user/$foto' class='img-circle' alt='User Image'>
              </div>
              <div class='pull-left info'>
                <p>$log[nama_reseller]</p>
                <a href=''><i class='fa fa-circle text-success'></i> Online</a>
              </div>
            </div>";
          ?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU PELAPAK</li>
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-th-large"></i> <span>Referensi</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <?php 
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/rekening'><i class='fa fa-circle-o'></i> No Rekening Anda</a></li>";
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/keterangan'><i class='fa fa-circle-o'></i> Info/Keterangan</a></li>";
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/produk'><i class='fa fa-circle-o'></i> Data Produk Anda</a></li>";
                    ?>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#"><i class="fa fa-shopping-cart"></i> <span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <?php 
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/pembelian'><i class='fa fa-circle-o'></i> Pembelian Ke Pusat</a></li>";
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/penjualan'><i class='fa fa-circle-o'></i> Penjualan ke Konsumen</a></li>";
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/pembayaran_konsumen'><i class='fa fa-circle-o'></i> Pembayaran Konsumen</a></li>";
                    ?>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#"><i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <?php 
                        echo "<li><a href='".base_url().$this->uri->segment(1)."/keuangan'><i class='fa fa-circle-o'></i> Data Keuangan</a></li>";
                    ?>
                </ul>
            </li>

            <li><a href="<?php echo base_url(); ?>reseller/edit_reseller/<?php echo $this->session->id_reseller; ?>"><i class="fa fa-user"></i> <span>Edit Profile</span></a></li>
            <li><a href="<?php echo base_url(); ?>reseller/logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
          </ul>
        </section>