<div class="main-page left">
	<div class="single-block">
		<div class="content-block main left">
			<div class="block">
				<div class="block-title" style="background: #bf4b37;">
					<a href="index.php" class="right">Back to homepage</a>
					<h2>Total Hasil Persentasi / Perhitungan Poling</h2>
				</div>
				<div class="block-content">
					<div class="shortcode-content">
						<div class="paragraph-row">
							<div class="column3">
								<h3 class="highlight-title">Berita Populer</h3>
								<ul class="article-block">
									<?php 
										$hot = $this->model_utama->view_join_two('berita','users','kategori','username','id_kategori',array('status' => 'Y'),'dibaca','DESC',0,8);
										foreach ($hot->result_array() as $row) {	
											echo "<li><a href='".base_url()."$row[judul_seo]'>$row[judul]</a></li>";
										}
									?>
								</ul>
							</div>
							<div class="column9">
								<?php
								echo "<center style='margin-top:5%; margin-bottom:5%;'><h4>Berikut Adalah hasil Perhitungan sementara Poling yang masuk. <br>
											Silahkan untuk selalu mengunjungi halaman ini untuk melihat hasil terbarunya.<br>
											Terima kasih,..</center></h4>";
											
								 echo "<table width=100% style='border: 0pt dashed #CCC;padding: 10px;'>";
										  foreach ($polling->result_array() as $s) {
										  $prosentase = sprintf("%2.1f",(($s['rating']/$rows['jml_vote'])*100));
										  $gbr_vote   = $prosentase * 3;
									  		echo "<tr>
												<td width='40%'>
												  <b>$s[pilihan] <span class style=\"color:#EA1C1C;\">($s[rating])</span> </b></td><td width=200> 
												  <img src=".base_url()."asset/images/red.jpg width=$gbr_vote  width='200' height='18' border=0>   
												  <span class style=\"color:#EA1C1C;\"><b>$prosentase % </b> </span> <hr style='margin:3px 0px 3px 0px'>
												</td>
											</tr>";
										  }
								  echo "</table>
								  <br/><h4>Jumlah Pemilih: <class style=\"color:#EA1C1C;\">$rows[jml_vote]</h4>";
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class='main-sidebar right'>
<?php include "sidebar_kontributor.php"; ?>
</div>