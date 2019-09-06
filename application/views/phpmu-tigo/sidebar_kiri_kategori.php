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
	<h2 style='color:#000; border-bottom: 2px solid #000;' class="list-title">Berita Foto</h2>
	<div class="article-block">
	<?php
		$col = 2;
		echo "<table width=100%><tr>";
		$hitung = 0;        
		$album = $this->model_utama->view_where_ordering_limit('album',array('aktif' => 'Y'),'id_album','RANDOM',0,6);
			foreach ($album->result_array() as $row) {
			$jumlah = $this->model_utama->view_where('gallery',array('id_album' => $row['id_album']))->num_rows();
		  if ($hitung >= $col) {
			echo "</tr><tr>";
			$hitung = 0;
		  }
			$hitung++;
		  echo "<td><a href='album/detail/$row[album_seo]'>
				  	<center><img style='padding:3px; border:1px solid #e3e3e3; border-radius:2px' src='".base_url()."asset/img_album/$row[gbr_album]' width=95% height=80 title='$row[jdl_album] - (Ada $jumlah foto)'> </center>
				</a></td>";
		}
		  echo "</tr></table>";
	?>
	</div>
</div>

<div class="block">
	<h2 class="list-title" style="color: #2277c6;border-bottom: 2px solid #2277c6;">Jejak Pendapat</h2>
		<?php
		  $t = $this->model_utama->view_where('poling',array('aktif' => 'Y','status' => 'Pertanyaan'))->row_array();
		  echo " <div style='color:#000; font-weight:bold;'>$t[pilihan] <br></div>";
		  echo "<form method=POST action='polling/hasil_poling'>";
			  $pilih = $this->model_utama->view_where('poling',array('aktif' => 'Y','status' => 'Jawaban'));
			  foreach ($pilih->result_array() as $p) {
			  echo "<input class=marginpoling type=radio name=pilihan value='$p[id_poling]'/>
					<class style=\"color:#666;font-size:12px;\">&nbsp;&nbsp;$p[pilihan]<br />";}
			  echo "<br><center><input style='width: 110px; padding:2px' type=submit class=simplebtn value='PILIH' />
		  </form>
		  <a href='polling/lihat_poling'>
		  <input style='width: 110px; padding:2px;' type=button class=simplebtn value='LIHAT HASIL' /></a></center>";
		?>
</div>

<div class="block">
	<?php
	if ($this->uri->segment(1)=='video'){
		echo "<h2 class='list-title' style='color: #2277c6;border-bottom: 2px solid #2277c6;'>Video Terpopuler</h2>";					  
		  $video = $this->model_utama->view_ordering_limit('video','dilihat','DESC',0,2);
		  foreach ($video->result_array() as $d) {
		  $baca = $d['dilihat']+1;
		  $tgl = tgl_indo($d['tanggal']);
		  $judul = substr($d['jdl_video'],0,35);
		  echo "<div class='gallery-widget'>
					<div class='gallery-photo' rel='hover-parent'>
						<a href='#' class='slide-left icon-text'>&#59229;</a>
						<a href='#' class='slide-right icon-text'>&#59230;</a>
						<ul>
							<li>";
								if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $d['youtube'], $match)) {
                                    echo "<iframe width='100%' height='220' src='https://www.youtube.com/embed/".$match[1]."' frameborder='0' allowfullscreen></iframe>";
                                } 
							echo "</li>
						</ul>
					</div>
					<div class='gallery-content'>
						<h4><a href='".base_url()."video/play/$d[video_seo]' title='$d[jdl_video]'>$judul . . .</a></h4>
						<span class='meta'>
							<span class='right'>$d[hari], $tgl - Dilihat $baca Kali</span>
							<a href='".base_url()."video/play/$d[video_seo]'><span class='icon-text'>&#59212;</span>Lihat Video</a>
						</span>
					</div>
				</div>";
		  }
		  
	}elseif ($this->uri->segment(1)=='kategori'){
		$r = $this->model_utama->view_where('kategori',array('kategori_seo' => $this->uri->segment(3)))->row_array();
		echo "<h2 class='list-title' style='color: #2277c6; border-bottom: 2px solid #2277c6;''>Berita $r[nama_kategori]</h2>
		<ul class='article-block'>";
			$kategori1 = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $r['id_kategori'],'berita.status' => 'Y'),'dibaca','DESC',0,5);			
			foreach ($kategori1->result_array() as $r2x) {
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
							<h4><a href='".base_url()."$r2x[judul_seo]'>$r2x[judul]</a><a href='".base_url()."$r2x[judul_seo]' class='h-comment'>$total_komentar - <b style='color:Red'>$r2x[dibaca] view</b></a></h4>
							<span class='meta'>
								<a href='".base_url()."$r2x[judul_seo]'><span class='icon-text'>&#128340;</span>$r2x[jam], ".tgl_indo($r2x['tanggal'])."</a>
							</span>
						</div>
					  </li>";
			}
		echo "</ul>
		<a href='".base_url()."kategori/detail/$r2x[kategori_seo]' class='more'>Read More</a>";
	}else{
		echo "<h2 class='list-title' style='color:#2277c6; border-bottom: 2px solid #2277c6;''>Berita Populer</h2>
		<ul class='article-block'>";
		$populer = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.status' => 'Y'),'dibaca','DESC',0,5);
		foreach ($populer->result_array() as $r2x) {
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
		echo "</ul>
		<a href='".base_url()."kategori/detail/$r2x[kategori_seo]' class='more'>Read More</a>";
	}
echo "</div>

<div class='block'>
	<div class='banner'>";
		$pasangiklan1 = $this->model_utama->view_ordering_limit('pasangiklan','id_pasangiklan','ASC',0,1);
	  	foreach ($pasangiklan1->result_array() as $b) {
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
	echo "</div>
</div>";