<div class="block">
	<h2 style='color: #dd8229;border-bottom: 2px solid #dd8229;' class="list-title">Sekilas Info</h2>
	<ul class="article-block">
		<?php 
			$sekilas = $this->model_utama->view_ordering_limit('sekilasinfo','id_sekilas','DESC',0,2);
			foreach ($sekilas->result_array() as $row) {	
			$tgl = tgl_indo($row['tgl_posting']);
			echo "<li>
					<div class='article-photo'>";
						if ($row['gambar'] ==''){
							echo "<a href='#' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_info/small_no-image.jpg' alt='' /></a>";
						}else{
							echo "<a href='#' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_info/$row[gambar]' alt='' /></a>";
						}
					echo "</div>
					<div class='article-content'>
						<h4><a href='#'>$row[info]</a></h4>
						<span class='meta'>
							<a href='#'><span class='icon-text'>&#128340;</span>$tgl</a>
						</span>
					</div>
				  </li>";
			}
		?>
	</ul>
</div>

<div class="block">
	<h2 class="list-title" style="color: green;border-bottom: 2px solid green;">Banner Link</h2>
	<ul class="article-list">
		<?php
		  $banner = $this->model_utama->view_ordering_limit('banner','id_banner','ASC',0,5);
		  foreach ($banner->result_array() as $b) {
					echo "<li><a target='_BLANK' href='$b[url]'>$b[judul]</a></li>";
		  }
		?>
	</ul>
</div>

<div class="block">
  <h2 style='color:#000; border-bottom: 2px solid #000;' class="list-title">Berita Foto</h2>
  <div class="latest-galleries">
	  <div class="gallery-widget">
		  <div class="gallery-photo" rel="hover-parent">
			  <a href="#" class="slide-left icon-text"></a>
			  <a href="#" class="slide-right icon-text"></a>
			  <ul rel="4">
				  <?php 
				  	$album = $this->model_utama->view_where_ordering_limit('album',array('aktif' => 'Y'),'id_album','RANDOM',0,4);
					foreach ($album->result_array() as $row) {
					$jumlah = $this->model_utama->view_where('gallery',array('id_album' => $row['id_album']))->num_rows();
					echo "<li> 
							  <a href='".base_url()."albums/detail/$row[album_seo]' class='hover-effect delegate'>
								  <span class='cover'><i></i>
								  <img width='100%' src='".base_url()."asset/img_album/$row[gbr_album]' alt='$row[jdl_album] - (Ada $jumlah foto)'></span>
							  </a>
						  </li>";
					}
				  ?>
			  </ul>								
		  </div>		
	  </div>	
  </div>	
</div>

<div class="block">
	<?php $rh = $this->model_utama->view_where('kategori',array('sidebar' => 3))->row_array(); ?>
	<h2 class="list-title" style="color: #c42b20;border-bottom: 2px solid #c42b20;">Berita <?php echo "$rh[nama_kategori]"; ?></h2>
	<ul class="article-list">
		<?php 
			$kategori3 = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $rh['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',0,5);			
			foreach ($kategori3->result_array() as $r2z) {
			$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r2z['id_berita']))->num_rows();
				echo "<li><a href='".base_url()."$r2z[judul_seo]'>$r2z[judul]</a>
						  <a href='".base_url()."$r2z[judul_seo]' class='h-comment'>$total_komentar</a><span class='meta-date'>".tgl_indo($r2z['tanggal'])."</span></li>";
			}
		?>
	</ul>
	<a href="<?php echo base_url()."kategori/detail/$rh[kategori_seo]"; ?>" class="more">Read More</a>
</div>

<div class="block">
	<?php $rhx = $this->model_utama->view_where('kategori',array('sidebar' => 4))->row_array(); ?>
	<h2 class="list-title" style="color: #2277c6;border-bottom: 2px solid #2277c6;">Berita <?php echo "$rhx[nama_kategori]"; ?></h2>
	<ul class="article-block">
		<?php 
			$kategori4 = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $rhx['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',0,5);			
			foreach ($kategori4->result_array() as $r2x) {
			$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r2x['id_berita']))->num_rows();
				echo "<li>
						<div class='article-photo'>";
							if ($r2x['gambar'] ==''){
								echo "<a href='".base_url()."$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='' /></a>";
							}else{
								echo "<a href='".base_url()."$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_berita/$r2x[gambar]' alt='' /></a>";
							}
						echo "</div>
						<div class='article-content'>
							<h4><a href='".base_url()."$r2x[judul_seo]'>$r2x[judul]</a><a href='".base_url()."$r2x[judul_seo]' class='h-comment'>$total_komentar</a></h4>
							<span class='meta'>
								<a href='".base_url()."$r2x[judul_seo]'><span class='icon-text'>&#128340;</span>$r2x[jam], ".tgl_indo($r2x['tanggal'])."</a>
							</span>
						</div>
					  </li>";
			}
		?>
	</ul>
	<a href="<?php echo base_url()."kategori/detail/$rhx[kategori_seo]"; ?>" class="more">Read More</a>
</div>

<div class="block">
	<?php $rha = $this->model_utama->view_where('kategori',array('sidebar' => 5))->row_array(); ?>
	<h2 class="list-title" style="color:green; border-bottom: 2px solid green;">Berita <?php echo "$rha[nama_kategori]"; ?></h2>
	<ul class="article-block">
		<?php 
			$kategori4 = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $rha['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',0,5);			
			foreach ($kategori4->result_array() as $r2x) {
			$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r2x['id_berita']))->num_rows();
				echo "<li>
						<div class='article-photo'>";
							if ($r2x['gambar'] ==''){
								echo "<a href='".base_url()."$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='' /></a>";
							}else{
								echo "<a href='".base_url()."$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_berita/$r2x[gambar]' alt='' /></a>";
							}
						echo "</div>
						<div class='article-content'>
							<h4><a href='".base_url()."$r2x[judul_seo]'>$r2x[judul]</a><a href='".base_url()."$r2x[judul_seo]' class='h-comment'>$total_komentar</a></h4>
							<span class='meta'>
								<a href='".base_url()."$r2x[judul_seo]'><span class='icon-text'>&#128340;</span>$r2x[jam], ".tgl_indo($r2x['tanggal'])."</a>
							</span>
						</div>
					  </li>";
			}
		?>
	</ul>
	<a href="<?php echo base_url()."kategori/detail/$rhx[kategori_seo]"; ?>" class="more">Read More</a>
</div>

<div class="block">
	<div class="banner">
		<?php
		  $pasangiklan = $this->model_utama->view_ordering_limit('pasangiklan','id_pasangiklan','ASC',0,1);
		  foreach ($pasangiklan->result_array() as $b) {
			$string = $b['gambar'];
			if ($b['gambar'] != ''){
				if(preg_match("/swf\z/i", $string)) {
					echo "<embed src='".base_url()."asset/foto_pasangiklan/$b[gambar]' width=250 height=200 quality='high' type='application/x-shockwave-flash'>";
				} else {
					echo "<a href='$b[url]' target='_blank'><img style='width:250px;' src='".base_url()."asset/foto_pasangiklan/$b[gambar]' alt='$b[judul]' /></a>
						  <a href='$b[url]' class='ad-link'><span class='icon-text'>&#9652;</span>$b[judul]<span class='icon-text'>&#9652;</span></a>";
				}
			}
		  }
		?>
	</div>
</div>

<div class="block">
	<?php $r = $this->model_utama->view_where('kategori',array('sidebar' => 6))->row_array(); ?>
	<h2 class="list-title" style="color: #dd8229;border-bottom: 2px solid #dd8229;">Berita <?php echo "$r[nama_kategori]"; ?></h2>
	<ul class="article-block">
	<?php 
		$kategori5 = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $r['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',0,5);			
		foreach ($kategori5->result_array() as $r2x) {
		$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r2x['id_berita']))->num_rows();
			echo "<li>
					<div class='article-photo'>";
						if ($r2x['gambar'] ==''){
							echo "<a href='".base_url()."$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='' /></a>";
						}else{
							echo "<a href='".base_url()."$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_berita/$r2x[gambar]' alt='' /></a>";
						}
					echo "</div>
					<div class='article-content'>
						<h4><a href='".base_url()."$r2x[judul_seo]'>$r2x[judul]</a><a href='".base_url()."$r2x[judul_seo]' class='h-comment'>$total_komentar</a></h4>
						<span class='meta'>
							<a href='".base_url()."$r2x[judul_seo]'><span class='icon-text'>&#128340;</span>$r2x[jam], ".tgl_indo($r2x['tanggal'])."</a>
						</span>
					</div>
				  </li>";
		}
	?>
	</ul>
	<a href="<?php echo "".base_url()."kategori/detail/$r[kategori_seo]"; ?>" class="more">Read More</a>
</div>