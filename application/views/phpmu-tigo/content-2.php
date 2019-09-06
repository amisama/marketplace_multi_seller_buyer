<div class="main-page left">
	<div class="double-block">
		<div class="content-block main right">
			<div class="block">
				<div class="featured-block">
					<?php
						$cekslide = $this->model_utama->view_single('berita',array('headline' => 'Y','status' => 'Y'),'id_berita','DESC');
						if ($cekslide->num_rows() > 0){
						  include "slide.php";
						}
					?>	
				</div>
			</div>

			<div class="block">
				<div class="block-title">
					<a href="<?php echo base_url(); ?>produk" class="right">+ Produk Lainnya</a>
					<h2>PRODUK TERKINI</h2>
				</div>
				<div class="block-content">
				<ul class="article-block-big">
			<?php 
			  $no = 1;
			  $record = $this->db->query("SELECT * FROM rb_produk where id_reseller!='0' AND id_produk_perusahaan='0' ORDER BY id_produk DESC LIMIT 6");
			    foreach ($record->result_array() as $row){
			    $ex = explode(';', $row['gambar']);
			    if (trim($ex[0])==''){ $foto_produk = 'no-image.png'; }else{ $foto_produk = $ex[0]; }
			    if (strlen($row['nama_produk']) > 43){ $judul = substr($row['nama_produk'],0,43).',..';  }else{ $judul = $row['nama_produk']; }
			    $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
			    $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();
			    if ($beli['beli']-$jual['jual']<=0){ $stok = '<b style="color:red">Stok Habis</b>'; }else{ $stok = "".($beli['beli']-$jual['jual'])." $row[satuan]"; }

			    echo "<li style='width:180px'>
						<div class='article-photo'>
							<a class='hover-effect' href='".base_url()."produk/detail/$row[produk_seo]'><img style='height:140px; width:200px' src='".base_url()."asset/foto_produk/$foto_produk' alt='' /></a>
						</div>
						<div class='article-content'><center>
							<h4><a href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a></h4>
							<span style='color:red;'>".rupiah($row['harga_konsumen'])."</span> - <i>$stok</i><br>
							</center>
							<span class='meta'>";
								if ($this->session->level=='konsumen'){
				                  echo "<a class='btn btn-success btn-block btn-sm' style='color:#fff' href='".base_url()."members/keranjang/$row[id_reseller]/$row[id_produk]'>Beli Sekarang</a>";
				                }else{
				                  echo "<a class='btn btn-success btn-block btn-sm' style='color:#fff' href='".base_url()."produk/keranjang/$row[id_reseller]/$row[id_produk]'>Beli Sekarang</a>";
				                }
							echo "</span>
						</div>
					   </li>";
			      $no++;
			    }
			  echo "<div style='clear:both'><br></div>";
			  ?>
			  </ul>
			  </div>
			</div>
			
			<div class="block">
				<div class="block-title">
					<a href="<?php echo base_url(); ?>berita/indeks_berita" class="right">+ Indexs Berita</a>
					<h2>Berita Utama</h2>
				</div>
				<div class="block-content">
					<ul class="article-block-big">
						<?php 
							$no = 1;
							$hot = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('utama' => 'Y','status' => 'Y'),'id_berita','DESC',0,6);
                			foreach ($hot->result_array() as $row) {	
							$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $row['id_berita']))->num_rows();
							$tgl = tgl_indo($row['tanggal']);
							echo "<li style='width:180px'>
									<div class='article-photo'>
										<a href='".base_url()."$row[judul_seo]' class='hover-effect'>";
											if ($row['gambar'] ==''){
												echo "<a class='hover-effect' href='".base_url()."$row[judul_seo]'><img style='height:110px; width:200px' src='".base_url()."asset/foto_berita/no-image.jpg' alt='' /></a>";
											}else{
												echo "<a class='hover-effect' href='".base_url()."$row[judul_seo]'><img style='height:110px; width:200px' src='".base_url()."/asset/foto_berita/$row[gambar]' alt='' /></a>";
											}
									echo "</a>
									</div>
									<div class='article-content'>
										<h4><a href='".base_url()."$row[judul_seo]'>$row[judul]</a><a href='".base_url()."$row[judul_seo].html' class='h-comment'>$total_komentar</a></h4>
										<span class='meta'>
											<a href='".base_url()."$row[judul_seo]'><span class='icon-text'>&#128340;</span>$row[jam], $tgl</a>
										</span>
									</div>
								  </li>";
							}
						?>
					</ul>
				</div>
			</div>
			
			 <?php
				$ia = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',0,1)->row_array();
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
					
			<div class="block">
			<?php $r = $this->model_utama->view_where('kategori',array('sidebar' => 1))->row_array(); ?>
				<div class="block-title">
					<a href="<?php echo base_url()?>kategori/detail/<?php echo $r['kategori_seo']; ?>" class="right">Semua Artikel dari kategori ini </a>
					<h2>Berita kategori <?php echo "$r[nama_kategori]"; ?></h2>
				</div>
				<div class="block-content">
					<?php 
						$kategori1 = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $r['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',0,1);			
						foreach ($kategori1->result_array() as $r1) {
							$tglr = tgl_indo($r1['tanggal']);
							$isi_berita = strip_tags($r1['isi_berita']); 
							$isi = substr($isi_berita,0,250); 
							$isi = substr($isi_berita,0,strrpos($isi," "));
							$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r1['id_berita']))->num_rows();
							echo "<div class='wide-article'>
								<div class='article-photo'>";
									if ($r1['gambar'] ==''){
										echo "<a class='hover-effect' href='".base_url()."$r1[judul_seo]'><img style='width:160px; height:117px;' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='' /></a>";
									}else{
										echo "<a class='hover-effect' href='".base_url()."$r1[judul_seo]'><img style='width:160px; height:117px;' src='".base_url()."asset/foto_berita/$r1[gambar]' alt='' /></a>";
									}
							echo "</div>
							
								<div class='article-content'>
									<h2><a href='".base_url()."$r1[judul_seo]'>$r1[judul]</a><a href='".base_url()."$r1[judul_seo]' class='h-comment'>$total_komentar</a></h2>
									<span class='meta'>
										<a href='".base_url()."$r1[judul_seo]'><span class='icon-text'>&#128340;</span>$r1[jam], $tglr - Oleh : $r1[nama_lengkap]</a>
									</span>
									<p>$isi . . .</p>
								</div>
							</div>";
						}
					?>

					<div class="paragraph-row">
						<!-- BEGIN .column6 -->
						<div class="column6">
							<ul class="article-block">
								<?php 
									$kategori1a = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $r['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',1,3);			
									foreach ($kategori1a->result_array() as $r2) {
									$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r2['id_berita']))->num_rows();
									$tglr2 = tgl_indo($r2['tanggal']);
									echo "<li>
											<div class='article-photo'>";
												if ($r2['gambar'] ==''){
													echo "<a class='hover-effect' href='".base_url()."$r2[judul_seo]'><img style='width:59px; height:42px' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='small_no-image.jpg' /></a>";
												}else{
													echo "<a class='hover-effect' href='".base_url()."$r2[judul_seo].html'><img style='width:59px; height:42px' src='".base_url()."asset/foto_berita/$r2[gambar]' alt='$r2[gambar]' /></a>";
												}
										echo "</div>
											<div class='article-content'>
												<h4><a href='".base_url()."$r2[judul_seo]'>$r2[judul]</a><a href='".base_url()."$r2[judul_seo]' class='h-comment'>$total_komentar</a></h4>
												<span class='meta'>
													<a href='".base_url()."$r2[judul_seo]'><span class='icon-text'>&#128340;</span>$r2[jam], $tglr2</a>
												</span>
											</div>
										</li>";
									}
								?>
							</ul>
						<!-- END .column6 -->
						</div>
						
						<!-- BEGIN .column6 -->
						<div class="column6">
							<ul class="article-block">
								<?php 
									$kategori1b = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $r['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',6,3);			
									foreach ($kategori1b->result_array() as $r2x) {
									$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r2x['id_berita']))->num_rows();
									$tglr2 = tgl_indo($r2x['tanggal']);
										echo "<li>
												<div class='article-photo'>";
													if ($r2x['gambar'] ==''){
														echo "<a class='hover-effect' href='".base_url()."$r2x[judul_seo]'><img style='width:59px; height:42px' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='small_no-image.jpg' /></a>";
													}else{
														echo "<a class='hover-effect' href='".base_url()."$r2x[judul_seo]'><img style='width:59px; height:42px' src='".base_url()."asset/foto_berita/$r2x[gambar]' alt='$r2x[gambar]' /></a>";
													}
											echo "</div>
												<div class='article-content'>
													<h4><a href='".base_url()."$r2x[judul_seo]'>$r2x[judul]</a><a href='".base_url()."$r2x[judul_seo]' class='h-comment'>$total_komentar</a></h4>
													<span class='meta'>
														<a href='".base_url()."$r2x[judul_seo]'><span class='icon-text'>&#128340;</span>$r2x[jam], $tglr2</a>
													</span>
												</div>
											</li>";
									}
								?>
							</ul>
						<!-- END .column6 -->
						</div>
					</div>

				</div>
			</div>
			
			<?php
				$ib = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',1,1)->row_array();
				echo "<a href='$ib[url]' target='_blank'>";
					$string = $ib['gambar'];
					if ($ib['gambar'] != ''){
						if(preg_match("/swf\z/i", $string)) {
							echo "<embed style='margin-top:-10px' src='".base_url()."asset/foto_iklantengah/$ib[gambar]' width='100%' height=90px quality='high' type='application/x-shockwave-flash'>";
						} else {
							echo "<img style='margin-top:-10px; margin-bottom:5px' width='100%' src='".base_url()."asset/foto_iklantengah/$ib[gambar]' title='$ib[judul]' />";
						}
					}
				echo "</a>";
			?>

			<div class="block">
			<?php $ra = $this->model_utama->view_where('kategori',array('sidebar' => 2))->row_array(); ?>
				<div class="block-title" style="background: #2182b4;">
					<a href="<?php echo base_url(); ?>kategori/detail/<?php echo "$ra[kategori_seo]"; ?>" class="right">Semua Artikel dari kategori ini </a>
					<h2>Berita kategori <?php echo "$ra[nama_kategori]"; ?></h2>
				</div>
				<div class="block-content">
					<?php 
						$kategori2 = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $ra['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',0,1);			
						foreach ($kategori2->result_array() as $r1m) {
						$tglr = tgl_indo($r1m['tanggal']);
						$isi_berita = strip_tags($r1m['isi_berita']); 
						$isi = substr($isi_berita,0,250); 
						$isi = substr($isi_berita,0,strrpos($isi," "));
						$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r1m['id_berita']))->num_rows();
							echo "<div class='wide-article'>
								<div class='article-photo'>";
									if ($r1m['gambar'] ==''){
										echo "<a class='hover-effect' href='".base_url()."$r1m[judul_seo]'><img style='width:160px; height:117px;' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='' /></a>";
									}else{
										echo "<a class='hover-effect' href='".base_url()."$r1m[judul_seo]'><img style='width:160px; height:117px;' src='".base_url()."asset/foto_berita/$r1m[gambar]' alt='' /></a>";
									}
							echo "</div>
							
								<div class='article-content'>
									<h2><a href='".base_url()."$r1m[judul_seo]'>$r1m[judul]</a><a href='".base_url()."$r1m[judul_seo]' class='h-comment'>$total_komentar</a></h2>
									<span class='meta'>
										<a href='".base_url()."$r1m[judul_seo]'><span class='icon-text'>&#128340;</span>$r1m[jam], $tglr - Oleh : $r1[nama_lengkap]</a>
									</span>
									<p>$isi . . .</p>
								</div>
							</div>";
					}
					
					?>

					<div class="paragraph-row">
						<!-- BEGIN .column6 -->
						<div class="column6">
							<ul class="article-block">
								<?php 
									$kategori2a = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $ra['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',1,3);			
									foreach ($kategori2a->result_array() as $r2) {
									$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r2['id_berita']))->num_rows();
									$tglr2 = tgl_indo($r2['tanggal']);
									echo "<li>
											<div class='article-photo'>";
												if ($r2['gambar'] ==''){
													echo "<a class='hover-effect' href='".base_url()."$r2[judul_seo]'><img style='width:59px; height:42px' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='small_no-image.jpg' /></a>";
												}else{
													echo "<a class='hover-effect' href='".base_url()."$r2[judul_seo].html'><img style='width:59px; height:42px' src='".base_url()."asset/foto_berita/$r2[gambar]' alt='$r2[gambar]' /></a>";
												}
										echo "</div>
											<div class='article-content'>
												<h4><a href='".base_url()."$r2[judul_seo]'>$r2[judul]</a><a href='".base_url()."$r2[judul_seo]' class='h-comment'>$total_komentar</a></h4>
												<span class='meta'>
													<a href='".base_url()."$r2[judul_seo]'><span class='icon-text'>&#128340;</span>$r2[jam], $tglr2</a>
												</span>
											</div>
										</li>";
									}
								?>
							</ul>
						<!-- END .column6 -->
						</div>
						
						<!-- BEGIN .column6 -->
						<div class="column6">
							<ul class="article-block">
								<?php 
									$kategori2b = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.id_kategori' => $ra['id_kategori'],'berita.status' => 'Y'),'id_berita','DESC',6,3);			
									foreach ($kategori2b->result_array() as $r2x) {
									$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r2x['id_berita']))->num_rows();
									$tglr2 = tgl_indo($r2x['tanggal']);
									echo "<li>
											<div class='article-photo'>";
												if ($r2x['gambar'] ==''){
													echo "<a class='hover-effect' href='".base_url()."$r2x[judul_seo]'><img style='width:59px; height:42px' src='".base_url()."asset/foto_berita/small_no-image.jpg' alt='small_no-image.jpg' /></a>";
												}else{
													echo "<a class='hover-effect' href='".base_url()."$r2x[judul_seo]'><img style='width:59px; height:42px' src='".base_url()."asset/foto_berita/$r2x[gambar]' alt='$r2x[gambar]' /></a>";
												}
										echo "</div>
											<div class='article-content'>
												<h4><a href='".base_url()."$r2x[judul_seo]'>$r2x[judul]</a><a href='".base_url()."$r2x[judul_seo]' class='h-comment'>$total_komentar</a></h4>
												<span class='meta'>
													<a href='".base_url()."$r2x[judul_seo]'><span class='icon-text'>&#128340;</span>$r2x[jam], $tglr2</a>
												</span>
											</div>
										</li>";
									}
								?>
							</ul>
						<!-- END .column6 -->
						</div>
					</div>

				</div>
			</div>
			
			<?php
				$ic = $this->model_utama->view_ordering_limit('iklantengah','id_iklantengah','ASC',2,1)->row_array();
				echo "<a href='$ic[url]' target='_blank'>";
					$string = $ic['gambar'];
					if ($ic['gambar'] != ''){
						if(preg_match("/swf\z/i", $string)) {
							echo "<embed style='margin-top:-10px' src='".base_url()."asset/foto_iklantengah/$ic[gambar]' width='100%' height=90px quality='high' type='application/x-shockwave-flash'>";
						} else {
							echo "<img style='margin-top:-10px; margin-bottom:5px' width='100%' src='".base_url()."asset/foto_iklantengah/$ic[gambar]' title='$ic[judul]' />";
						}
					}
				echo "</a>";
			?>
			
			<div class="block">
				<div class="block-title" style="background: #dd8229;">
					<a href="#" class="right">Beberapa Berita Pilihan</a>
					<h2>Berita Pilihan Redaksi</h2>
				</div>
				<div class="block-content">
					<ul class="article-block-big">
						<?php 
							$pilihan = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('berita.aktif' => 'Y','berita.status' => 'Y'),'id_berita','DESC',0,6);
							foreach ($pilihan->result_array() as $pi) {
							$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $pi['id_berita']))->num_rows();
							 $tgl = tgl_indo($pi['tanggal']);
								echo "<li style='width:180px'>
										<div class='article-photo'>
											<a href='".base_url()."$pi[judul_seo]' class='hover-effect'>";
												if ($pi['gambar'] ==''){
													echo "<a class='hover-effect' href='".base_url()."$pi[judul_seo]'><img style='height:110px; width:210px' src='".base_url()."asset/foto_berita/no-image.jpg' alt='' /></a>";
												}else{
													echo "<a class='hover-effect' href='".base_url()."$pi[judul_seo]'><img style='height:110px; width:210px' src='".base_url()."asset/foto_berita/$pi[gambar]' alt='' /></a>";
												}
										echo "</a>
										</div>
										<div class='article-content'>
											<h4><a href='".base_url()."$pi[judul_seo]'>$pi[judul]</a><a href='".base_url()."$pi[judul_seo]' class='h-comment'>$total_komentar</a></h4>
											<span class='meta'>
												<a href='".base_url()."$pi[judul_seo]'><span class='icon-text'>&#128340;</span>$pi[jam], $tgl</a>
											</span>
										</div>
									  </li>";
							}
						?>
					</ul>
				</div>
			</div>
		</div>				
		<div class="content-block left">
			<?php include "sidebar_kiri.php"; ?>
		</div>
	</div>
</div>
<div class="main-sidebar right">
	<?php include "sidebar_kanan.php"; ?>
</div>