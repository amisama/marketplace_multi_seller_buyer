<style type="text/css">
  .sekolah{
    float: left;
    background-color: transparent;
    background-image: none;
    padding: 15px 15px;
    font-family: fontAwesome;
    color:#fff;
  }
  .sekolah:hover{
    color:#fff;
  }
</style>
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ADMINISTRATOR</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <?php if ($this->session->level=='admin'){ ?>
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i> Pesan Masuk
                  <?php $jmlh = $this->model_app->view_where('hubungi', array('dibaca'=>'N'))->num_rows(); ?>
                  <span class="label label-success"><?php echo $jmlh; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $jmlh; ?> new messages</li>
                  <li>
                    <ul class="menu">
                      <?php 
                        $pesan = $this->model_app->view_ordering_limit('hubungi','id_hubungi','DESC',0,10);
                        foreach ($pesan->result_array() as $row) {
                          $isi_pesan = substr($row['pesan'],0,30);
                          $waktukirim = cek_terakhir($row['tanggal'].' '.$row['jam']);
                          if ($row['dibaca']=='N'){ $color = '#f4f4f4'; }else{ $color = '#fff'; }
                          echo "<li style='background-color:$color'>
                                  <a href='".base_url().$this->uri->segment(1)."/detail_pesanmasuk/$row[id_hubungi]'>
                                    <div class='pull-left'>
                                      <img src='".base_url()."asset/foto_user/blank.png' class='img-circle' alt='User Image'>
                                    </div>
                                    <h4>$row[nama]<small><i class='fa fa-clock-o'></i> $waktukirim</small></h4>
                                    <p>$isi_pesan...</p>
                                  </a>
                                </li>";
                        }
                      ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo base_url().$this->uri->segment(1); ?>/pesanmasuk">See All Messages</a></li>
                </ul>
              </li>
              <?php } ?>
              <li>
                <a target='_BLANK' href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-new-window"></i></a>
              </li>

            </ul>
          </div>
        </nav>