<div class="widget" style='overflow:hidden'>
<center>Yuk Temukan Toko Terdekat dari tempat tinggal anda agar belanja lebih mudah. <a class='btn btn-danger btn-block' href='<?php echo base_url(); ?>produk/reseller'><span class='glyphicon glyphicon-search'></span> Klik / Cari Disini</a></center>
</div>

<div class='ideaboxWeather' id='example1'>
  <h1>Loading....</h1>
</div>
<hr>

<?php 
$yahoo = $this->model_utama->view('mod_ym');
if ($yahoo->num_rows() >= 1){
echo "<div class='widget'>
	<h3>Online Support (Chat)</h3>";
	foreach ($yahoo->result_array() as $ym) {	
		echo "<center>$ym[nama]<br>
				<a href='ymsgr:sendIM?$ym[username]'> 
				<img src='http://opi.yahoo.com/online?u=$ym[username]&amp;m=g&amp;t=$ym[ym_icon]&amp;l=us'/></a></center><hr>";
	}
echo "</div>";
}
?>

<div class="widget">
	<?php
	  $pasangiklan2 = $this->model_utama->view_ordering_limit('pasangiklan','id_pasangiklan','ASC',1,1);
	  foreach ($pasangiklan2->result_array() as $b) {
		$string = $b['gambar'];
		if ($b['gambar'] != ''){
			if(preg_match("/swf\z/i", $string)) {
				echo "<embed src='".base_url()."asset/foto_pasangiklan/$b[gambar]' width=300 height=240 quality='high' type='application/x-shockwave-flash'>";
			} else {
				echo "<a href='$b[url]' target='_blank'><img style='width:100%' src='".base_url()."asset/foto_pasangiklan/$b[gambar]' alt='$b[judul]' /></a>
					  <a href='$b[url]' class='ad-link'><span class='icon-text'>&#9652;</span>$b[judul]<span class='icon-text'>&#9652;</span></a>";
			}
		}
	  }
	?>
</div><hr>

<div class="widget">
	<h3>Temukan juga kami di</h3>
	<div class="widget-social">
		<div class="social-bar">
		<?php
			$sosmed = $this->model_utama->view('identitas')->row_array();
			$pecahd = explode(",", $sosmed['facebook']);
		?>
		<a target="_BLANK" href="<?php echo $pecahd[0]; ?>" class="social-icon"><span class="facebook">Facebook</span></a>
		<a target="_BLANK" href="<?php echo $pecahd[1]; ?>" class="social-icon"><span class="twitter">Twitter</span></a>
		<a target="_BLANK" href="<?php echo $pecahd[2]; ?>" class="social-icon"><span class="google">Google+</span></a>
		<a target="_BLANK" href="<?php echo $pecahd[3]; ?>" class="social-icon"><span class="linkedin">Linkedin</span></a>
		</div>
		<p>Ikuti kami di facebook, twitter, Google+, Linkedin dan dapatkan informasi terbaru dari kami disana.</p>
	</div>
</div>

<div class="widget">
	<h3>Berita Terbaru</h3>
	<div class="widget-articles">
		<ul>
			<li>
				<?php 
					$terbaru = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.status' => 'Y'),'id_berita','DESC',0,5);
					foreach ($terbaru->result_array() as $r2x) {
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
			</li>
		</ul>
	</div>
</div>

<div class="widget">
	<h3>Berita Populer</h3>
	<div class="widget-articles">
		<ul>
			<li>
				<?php 
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
				?>
			</li>
		</ul>
	</div>
</div>

<div class="widget">
  <h3>Tag Berita</h3>
  <div class="tag-cloud">
  	<?php 
		$tag = $this->model_utama->view_ordering_limit('tag','id_tag','RANDOM',0,50);
  		foreach ($tag->result_array() as $row) {
			echo "<a href='".base_url()."tag/detail/$row[tag_seo]' class='badge'>$row[nama_tag]</a>";
		}
	?>
	  	

  </div>
</div>

<div class="widget">
	<h2 class="list-title" style="color: #2277c6;border-bottom: 2px solid #2277c6;">Jejak Pendapat</h2>
		<?php
		  $t = $this->model_utama->view_where('poling',array('aktif' => 'Y','status' => 'Pertanyaan'))->row_array();
		  echo " <div style='color:#000; font-weight:bold;'>$t[pilihan] <br></div>";
		  echo "<form method=POST action='".base_url()."polling/hasil'>";
			  $pilih = $this->model_utama->view_where('poling',array('aktif' => 'Y','status' => 'Jawaban'));
			  foreach ($pilih->result_array() as $p) {
			  echo "<input class=marginpoling type=radio name=pilihan value='$p[id_poling]'/>
					<class style=\"color:#666;font-size:12px;\">&nbsp;&nbsp;$p[pilihan]<br />";}
			  echo "<br><center><input style='width: 110px; padding:2px' type=submit class=simplebtn value='PILIH' />
		  </form>
		  <a href='".base_url()."polling'>
		  <input style='width: 110px; padding:2px;' type=button class=simplebtn value='LIHAT HASIL' /></a></center>";
		?>
</div>

<div class="widget">
	<h3>Komentar Terakhir</h3>
	<div class="widget-comments">
		<ul>
			<?php
				$komentar = $this->model_utama->view_where_ordering_limit('komentar',array('aktif' => 'Y'),'id_komentar','DESC',0,3);
			  	foreach ($komentar->result_array() as $r) {
					$tgl = tgl_indo($r['tgl']);
					$isi_komentar = strip_tags($r['isi_komentar']); 
					$isi = substr($isi_komentar,0,100); 
					$isi = substr($isi_komentar,0,strrpos($isi," "));
					$avatar = md5(strtolower(trim($r['email'])));
					$b = $this->model_utama->view_where('berita',array('id_berita' => $r['id_berita']))->row_array();

					echo "<li>
						<div class='comment-photo'>
							<span class='hover-effect'>";
								if ($r['email'] == ''){
									echo "<img style='width:50px; height:50px;' src='".base_url()."asset/foto_user/blank.png' alt='avatar-1' />";
								}else{
									echo "<img style='width:50px; height:50px;' src='http://www.gravatar.com/avatar/$avatar.jpg?s=100'/>";
								}
							echo "</span>
						</div>
						<div class='comment-content'>
							<h3>$r[nama_komentar]</h3>
							<p>$isi ...</p>
							<span class='meta'>
								<a href='".base_url()."$b[judul_seo]'><span class='icon-text'>&#59212;</span>View Article</a>
							</span>
						</div>
					 </li>";
				}
			?>
		</ul>
	</div>
</div>

<div class="widget">
	<h3>Video Terbaru</h3>
	<div class="latest-galleries">
		<?php						  
		  $video = $this->model_utama->view_ordering_limit('video','id_video','DESC',0,1);
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
						<h4><a href='".base_url()."playlist/watch/$d[video_seo]' title='$d[jdl_video]'>$judul . . .</a></h4>
						<span class='meta'>
							<span class='right'>$d[hari], $tgl - Dilihat $baca Kali</span>
							<a href='".base_url()."playlist/watch/$d[video_seo]'><span class='icon-text'>&#59212;</span>Lihat Video</a>
						</span>
					</div>
				</div>";
		  }
		?>
	</div>
<a href="<?php echo base_url()."playlist"; ?>" class="more">View All Video</a>
</div>