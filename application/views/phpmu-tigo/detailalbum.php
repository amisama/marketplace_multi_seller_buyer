<div class="main-page left">
	<div class="single-block">
		<div class="content-block main left">
			<div class="block">
				<div class="block-title" style="background: #bf4b37;">
					<a href="#" class="right"><?php echo ($rows['hits_album']+1)."view"; ?></a>
					<h2><?php echo "$rows[jdl_album]"; ?></h2>
				</div>

				<div class="block-content">
					<div class="shortcode-content">
						<div class="paragraph-row">
							<div class="column3">
								<h3 class="highlight-title">Berita Foto Populer</h3>
								<ul class="article-block">
									<?php 
										$no=$this->uri->segment(4)+1;
										$beritafoto = $this->model_utama->view_ordering_limit('album','hits_album','DESC',0,5);
										foreach ($beritafoto->result_array() as $r2) {	
											echo "<li>
													<div class='article-photo'>";
														if ($r2['gbr_album']==''){
															echo "<a href='".base_url()."albums/detail/$r2[album_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='small_no-image.jpg' /></a>";
														}else{
															echo "<a href='".base_url()."albums/detail/$r2[album_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='".base_url()."asset/img_album/$r2[gbr_album]' alt='$r2[gbr_album]' /></a>";
														}
													echo "</div>
													<div class='article-content'>
														<h4><a href='".base_url()."albums/detail/$r2[album_seo]'>$r2[jdl_album]</a></h4>
														<span class='meta'>
															<a href='".base_url()."albums/detail/$r2[album_seo]'><span class='icon-text'>&#128340;</span>$r2[jam], ".tgl_indo($r2['tgl_posting'])."</a>
														</span>
													</div>
											</li>";
										}
									?>
								</ul>
								
							</div>
							<div class="column9">
							<div class="block-content">
								<?php echo "$rows[keterangan]"; ?>
								<hr style='margin:10px'>
									<ul class='article-block-big'>
										<?php
										  foreach ($detailalbum->result_array() as $h) {	
										  	if (trim($h['gbr_gallery'])==''){ $gbr_gallery = 'no-image.jpg'; }else{ $gbr_gallery = $h['gbr_gallery']; }
												echo "<li style='width:100%; margin-left:-13px'>
														<div class='article-photo'>
															<h3>$no. $h[jdl_gallery]</h3>
															<img class='jslghtbx-thmb' style='width:87%' title='$h[jdl_gallery]' src='".base_url()."asset/img_galeri/$gbr_gallery' alt='$h[jdl_gallery]' data-jslghtbx='".base_url()."asset/img_galeri/$h[gbr_gallery]' data-jslghtbx-group='group3' data-jslghtbx-caption='$h[keterangan]' /><br>
															<p>$h[keterangan]</p>
														</div>
													  </li>";
												$no++;
											}
										?>
									</ul>

									<div class='pagination'>
										<?php echo $this->pagination->create_links(); ?>
									</div>
							</div>
							</div>
						</div>
						<br>
						
						<?php
							$ia = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',5,1)->row_array();
							echo "<a href='$ia[url]' target='_blank'>";
								$string = $ia['gambar'];
								if ($ia['gambar'] != ''){
									if(preg_match("/swf\z/i", $string)) {
										echo "<embed style='margin-top:-10px' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' width='100%' height=90px quality='high' type='application/x-shockwave-flash'>";
									} else {
										echo "<img style='margin-top:-10px; margin-bottom:5px' width='100%' src='".base_url()."asset/foto_iklantengah/$ia[gambar]' title='$ia[judul]' />";
									}
								}
							echo "</a>";
						?>

						<div class="article-title">
							<div class="share-block right">
								<div>
									<div class="share-article left">
										<span>Social media</span>
										<strong>Share this article</strong>
									</div>
									<div class="left">
										<script language="javascript">
										document.write("<a href='http://www.facebook.com/share.php?u=" + document.URL + " ' target='_blank' class='custom-soc icon-text'>&#62220;</a> <a href='http://twitter.com/home/?status=" + document.URL + "' target='_blank' class='custom-soc icon-text'>&#62217;</a> <a href='https://plus.google.com/share?url=" + document.URL + "' target='_blank' class='custom-soc icon-text'>&#62223;</a>");
										</script>
										<a href="#" class="custom-soc icon-text">&#62232;</a>
										<a href="#" class="custom-soc icon-text">&#62226;</a>
									</div>
								</div>
								
							</div>

							<div style="margin-top:0px" class="article-tags tag-cloud">
								<?php echo "<a href='#'>$rows[hari], ".tgl_indo($rows['tgl_posting'])." - $rows[jam] WIB</a>"; ?>
							</div>
						</div>
					</div>
				</div>
			<div id="fb-root"></div>
				<div id="viewcomment" class="block-title">
					<a href="#writecomment" class="right">Write a Facebook Comment</a>
					<h2>
						Tuliskan Komentar anda dari account Facebook
					</h2>
				</div>
				<div class="block-content">
					<div class="comment-block">
						<div class="fb-comments" data-href="<?php echo base_url().'/albums/detail/'.$rows['album_seo']; ?>" data-width="855" data-numposts="5" data-colorscheme="light"></div> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class='main-sidebar right'>
	<?php include "sidebar_halaman.php"; ?>
</div>