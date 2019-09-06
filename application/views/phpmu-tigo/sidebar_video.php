<div class="widget">
	<h3>Video Terbaru</h3>
	<div class="latest-galleries">
		<?php						  
		  $video = $this->model_utama->view_ordering_limit('video','id_video','DESC',0,7);
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
