<?php
	$baca = $rows['dibaca']+1;	
	$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $rows['id_berita']))->num_rows();
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

		<h1><?php echo "<b>$rows[judul]</b> <br><span style='font-size:14px; color:blue'>$rows[sub_judul] </span>"; ?></h1>
		<div class="author">
			<span class="hover-effect left">
			<?php $test = md5(strtolower(trim($rows['email']))); 
				echo "<img src='http://www.gravatar.com/avatar/$test.jpg?s=100'/>";
			?>
			</span>
			<div class="a-content">
				<span>By <b><?php echo "$rows[nama_lengkap]"; ?></b></span>
				<span class="meta"><?php echo tgl_indo($rows['tanggal']).", $rows[jam] WIB"; ?>
					<span class="tag" style="background-color: #2a8ece;"><a href="<?php echo base_url()."kategori/detail/$rows[kategori_seo]"; ?>"><?php echo "$rows[nama_kategori]"; ?></a></span>
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
					<div class="shortcode-content">
						<div class="paragraph-row">
							<div class="column3  hidden-xs">
								<h3 class="highlight-title">Berita Terkait</h3>
								<ul>
									<?php
										  $pisah_kata  = explode(",",$rows['tag']);
										  $jml_katakan = (integer)count($pisah_kata);
										  $jml_kata = $jml_katakan-1; 
										  $ambil_id = substr($rows['id_berita'],0,4);
										  $cari = "SELECT * FROM berita WHERE (id_berita<'$ambil_id') and (id_berita!='$ambil_id') and (" ;
										  for ($i=0; $i<=$jml_kata; $i++){
										  $cari .= "tag LIKE '%$pisah_kata[$i]%'";
										  if ($i < $jml_kata ){
										  $cari .= " OR ";}}
										  $cari .= ") ORDER BY id_berita DESC LIMIT 10";
										  $hasil  = $this->db->query($cari);
										  foreach ($hasil->result_array() as $row) {	
											  $total_komentar_terkait = $this->model_utama->view_where('komentar',array('id_berita' => $row['id_berita']))->num_rows();
											  echo "<li><a href='".base_url()."$row[judul_seo]''>$row[judul]</a><a href='#' class='h-comment'>$total_komentar_terkait</a></li>";
										  }      
									?>
								</ul>

								<h3 class="highlight-title">Berita Populer</h3>
								<ul>
									<?php 
										$hot = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('status' => 'Y'),'dibaca','DESC',0,10);
										foreach ($hot->result_array() as $row) {	
											echo "<li><a href='".base_url()."$row[judul_seo]'>$row[judul]</a></li>";
										}
									?>
								</ul>
							</div>
							<div class="column9">
								<?php 
									if ($rows['gambar'] !=''){ echo "<img style='width:100%' src='".base_url()."asset/foto_berita/$rows[gambar]' alt='$rows[judul]' /></a><br><br>"; }
									if ($rows['keterangan_gambar'] !=''){ echo "<center><p><i><b>Keterangan Gambar :</b> $rows[keterangan_gambar]</i></p></center><br>"; }
									
									echo "$rows[isi_berita]<hr>
											<div class='fb-like'  data-href='".base_url()."$rows[judul_seo]' 
												data-send='false'  data-width='600' data-show-faces='false'>
											</div> <br><br>"; 

									if ($rows['youtube']!=''){
										echo "<h4>Video Terkait:</h4>";
										if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $rows['youtube'], $match)) {
                                            echo "<iframe width='100%' height='350px' id='ytplayer' type='text/html'
                                                src='https://www.youtube.com/embed/".$match[1]."?rel=0&showinfo=1&color=white&iv_load_policy=3'
                                                frameborder='0' allowfullscreen></iframe><div class='garis'></div><br/>";
                                        } 
									}
								?>
							</div>
						</div>

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
								<strong>TAGS:</strong>
								<?php
									$tags = (explode(",",$rows['tag']));
									$hitung = count($tags);
									for ($x=0; $x<=$hitung-1; $x++) {
										if ($tags[$x] != ''){
											echo "<a href='".base_url()."tag/detail/$tags[$x]'>$tags[$x]</a>";
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
				
				<?php
				$ia = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',3,1)->row_array();
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
						<div class="fb-comments" data-href="<?php echo base_url().'/'.$rows['judul_seo']; ?>" data-width="830" data-numposts="5" data-colorscheme="light"></div> 
					</div>
				</div>
			
			<?php if ($total_komentar>='1'){ ?>
				<div id="viewcomment listcomment" class="block-title">
					<a href="#writecomment" class="right">Write a comment</a>
					<h2><?php echo "Ada $total_komentar Komentar untuk Berita Ini"; ?></h2>
				</div>
				<div class="block-content">
					<div class="comment-block">
						<ol class="comments">
							<li>
								<?php
									$no = 1;
									$komentar = $this->model_utama->view_where_ordering_limit('komentar',array('id_berita' => $rows['id_berita'],'aktif' => 'Y'),'id_komentar','ASC',0,100);
			  						foreach ($komentar->result_array() as $kka) {
										$isian=nl2br($kka['isi_komentar']); 
										$komentarku = sensor($isian); 
										
										if(($no % 2)==0){ $warna="#ffffff;"; }else{ $warna="#e3e3e3"; }
										$test = md5(strtolower(trim($kka['email'])));	
										echo "<div style='background:$warna' class='commment-content'>
												<div class='user-avatar'>
													<a href='#' class='hover-effect'>";
														if ($kka['email'] == ''){
															echo "<img class='setborder' src='".base_url()."asset/foto_user/blank.png'/>";
														}else{
															echo "<img class='setborder' src='http://www.gravatar.com/avatar/$test.jpg?s=100'/>";
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
						<form action="<?php echo base_url(); ?>berita/kirim_komentar" method="POST" id="form_komentar">
							<input type="hidden" name='a' value='<?php echo "$rows[id_berita]"; ?>'>
							<p class="contact-form-user">
								<label for="c_name">Nickname<span class="required">*</label>
								<input type="text" placeholder="Nickname" value='<?php echo $us['nama_lengkap']; ?>' name='b' class="required" required/>
								
							</p>
							<p class="contact-form-email">
								<label for="c_email">E-mail<span class="required">*</span></label>
								<input type="text" name='e' placeholder="E-mail" value='<?php echo $us['email']; ?>' class="required" required/>
							</p>
							<p class="contact-form-webside">
								<label for="c_webside">Website</label>
								<input type="text" name='c' placeholder="Website" class="required"/>
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
	<?php include "sidebar_kanan.php";  ?>
</div>
