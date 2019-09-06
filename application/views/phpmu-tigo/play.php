<?php
$lihat = $rows['dilihat']+1;
$total_komentar = $this->model_utama->view_where('komentarvid',array('id_video' => $rows['id_video']))->num_rows();
?>	
<div class="full-width">
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
				<div class="clear-float"></div>
			</div>
			<div>
				<a href="javascript:printArticle();" class="small-button"><span class="icon-text">&#59158;</span>&nbsp;&nbsp;Print this article</a>
				<a href="#" class="small-button"><span class="icon-text">&#9993;</span>&nbsp;&nbsp;Send e-mail</a>
			</div>
		</div>

		<h1><?php echo "<b>$rows[jdl_video]</b>"; ?></h1>
		<div class="author">
			<span class="hover-effect left">
			<?php $gravatar = md5(strtolower(trim($rows['email']))); 
				echo "<img src='http://www.gravatar.com/avatar/$gravatar.jpg?s=100'/>";
			?>
			</span>
			<div class="a-content">
				<span>By <b><?php echo "$rows[nama_lengkap]"; ?></b></span>
				<span class="meta"><?php echo tgl_indo($rows['tanggal']).", $rows[jam] WIB"; ?>
					<span class="tag" style="background-color: #2a8ece;"><a href="<?php echo base_url()."playlist/detail/$rows[playlist_seo]"; ?>"><?php echo "$rows[jdl_playlist]"; ?></a></span>
				</span>
			</div>
		</div>
	</div>
</div>

<div class="main-page left">
	<div class="single-block">
		<div class="content-block main left">
			<div class="block">
				<div class="block-content">
					<p><span style="height:10%; overflow:hidden; background:none;" class="hover-effect">
					<?php
						if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rows['youtube'], $match)) {
                            echo "<iframe width='855px' height='500px' src='https://www.youtube.com/embed/".$match[1]."' frameborder='0' allowfullscreen></iframe>";
                        } 	
					?>
					</span></p>
					<div class="shortcode-content">
						<div class="paragraph-row">
							<div class="column3">
								<h3 class="highlight-title">Random Video</h3>
								<ul>
									<?php 
										$randvideo = $this->model_utama->view_ordering_limit('video','id_video','RANDOM',0,5);
										foreach ($randvideo->result_array() as $r2) {	
											echo "<li><a href='".base_url()."playlist/watch/$r2[video_seo]'>$r2[jdl_video]</a></li>";
										}
									?>
								</ul>
							</div>
							<div class="column9">
								<?php echo $rows['keterangan']; ?>
							</div>
						</div>
					</div>
				</div>
				<?php
					$ia = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',4,1)->row_array();
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
				<div id="fb-root"></div>
				<div id="viewcomment" class="block-title">
					<a href="#writecomment" class="right">Write a Facebook Comment</a>
					<h2>Komentar dari Facebook</h2>
				</div>

				<div class="block-content">
					<div class="comment-block">
						<div class="fb-comments" data-href="<?php echo base_url().'/playlist/watch/'.$rows['video_seo']; ?>" data-width="855" data-numposts="5" data-colorscheme="light"></div> 
					</div>
				</div>
			<?php if ($total_komentar > 0){ ?>	
				<div id="viewcomment listcomment" class="block-title">
					<a href="#writecomment" class="right">Write a comment</a>
					<h2><?php echo "Ada $total_komentar Komentar untuk Video Ini"; ?></h2>
				</div>
				<div class="block-content">
					<div class="comment-block">
						<ol class="comments">
							<li>
								<?php
									$no = 1;
									$komentar = $this->model_utama->view_where_ordering_limit('komentarvid',array('id_video' => $rows['id_video'],'aktif' => 'Y'),'id_video','ASC',0,100);
			  						foreach ($komentar->result_array() as $kka) {
										$isian=nl2br($kka['isi_komentar']); 
										$komentarku = sensor($isian); 
										
										if(($no % 2)==0){ $warna="#ffffff;"; }else{ $warna="#e3e3e3"; }
										$gravatar = md5(strtolower(trim($kka['url'])));	
										echo "<div style='background:$warna' class='commment-content'>
												<div class='user-avatar'>
													<a href='#' class='hover-effect'>";
														if ($kka['url'] == ''){
															echo "<img class='setborder' src='".base_url()."asset/foto_user/blank.png'/>";
														}else{
															echo "<img class='setborder' src='http://www.gravatar.com/avatar/$gravatar.jpg?s=100'/>";
														}
													echo "</a>
												</div>
												<strong class='user-nick'><a href='$kka[url]'>$kka[nama_komentar]</a></strong>
												<span class='time-stamp'>".tgl_indo($kka['tgl']).", $kka[jam_komentar] WIB</span>
												<div class='comment-text'><p>$komentarku</p></div>
											  </div>";
										$no++;
									}
								?>
							</li>
						</ol>
					</div>
				</div>
				<?php } ?>

				<div class="block-title">
					<a href="#viewcomment" class="right">View all comments</a>
					<h2>Write a comment</h2>
				</div>
				<div class="block-content">
					<div id="writecomment">
				
						<form action="<?php echo base_url(); ?>playlist/kirim_komentar" method="POST" onSubmit="return validasi(this)" id="form_komentar">
							<input type="hidden" name='a' value='<?php echo "$rows[id_video]"; ?>'>
							<p class="contact-form-user">
								<label for="c_name">Nickname<span class="required">*</label>
								<input type="text" placeholder="Nickname" id="nama" name='b' class="required" required/>
								
							</p>
							<p class="contact-form-email">
								<label for="c_email">E-mail<span class="required">*</span></label>
								<input type="text" name='c' placeholder="E-mail" id="email" class="required" required/>
							</p>
							<p class="contact-form-message">
								<label for="c_message">Comment<span class="required">*</span></label>
								<textarea name='d' placeholder="Your message.." class="required" required></textarea>
							</p>
							<p class="contact-form-message">
								<label for="c_message">
								<?php echo $image; ?><br></label>
								<input name='secutity_code' maxlength=6 type="text" class="required" placeholder="Masukkkan kode di sebelah kiri..">
							</p>
							<p><input type="submit" name="submit" class="styled-button" value="Post a Comment" onclick="return confirm('Haloo, Pesan anda akan tampil setelah kami setujui?')"/></p>
						</form>
						
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class='main-sidebar right'>
	<?php include "sidebar_video.php"; ?> 
</div>