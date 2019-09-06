<div class="main-page full-width">
	<div class="content-block main">
		<div class="block">
			<div class="block-title">
				<a href="index.php" class="right">Back to homepage</a>
				<h2><?php 
					echo "<form action='".base_url()."berita/indeks_berita' method='POST'>
						Lihat Indeks Tanggal &nbsp; &nbsp; &nbsp;
						<select name='tanggal' class='select'>";
							for($n=1; $n<=31; $n++){
								if (isset($_POST['filter'])){ $tgls = $_POST['tanggal']; }else{ $tgls = date("d"); }
								if ($tgls==$n){
									echo "<option value='$n' selected>$n</option>";
								}else{
									echo "<option value='$n'>$n</option>";
								}
							}
						echo "</select>

						<select name='bulan' class='select'> ";
							$bln = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
							for($n=1; $n<=12; $n++){
								if (isset($_POST['filter'])){ $blns = $_POST['bulan']; }else{ $blns = date("n"); }
								if ($blns == $n){
									echo "<option value='$n' selected>$bln[$n]</option>";
								}else{
									echo "<option value='$n'>$bln[$n]</option>";
								}
							}
						echo "</select>

						<select name='tahun' class='select'> ";
							for($n=2008; $n<=date('Y'); $n++){ 
								if (isset($_POST['filter'])){ $year = $_POST['tahun']; }else{ $year = date("Y"); }
								if ($year == $n){
									echo "<option value='$n' selected>$n</option>";
								}else{
									echo "<option value='$n'>$n</option>";
								}
							} 											
						echo "</select>
								<input style='padding:0px 6px 0px 6px;' type='submit' name='filter' value='Lihat Indeks'>";
					  echo "</form>";
					?>
				</h2>
			</div>
			<div style='width:97%' class="block-content archive">
			<?php
			
				if (isset($_POST['filter'])){
					$bulan = strlen($_POST['bulan']);
					$tanggal = strlen($_POST['tanggal']);		
					if ($bulan <= 1){ $bulann = '0'.$_POST['bulan']; }else{ $bulann = $_POST['bulan']; }
					if ($tanggal <= 1){ $tanggall = '0'.$_POST['tanggal']; }else{ $tanggall = $_POST['tanggal']; }
					$fil = $_POST['tahun'].'-'.$bulann.'-'.$tanggall;
				}else{
					$fil = date("Y-m-d");
				}

				$col = 5; 
				$warna = array("red","blue","red","purple","orange","black","yellow","red","blue","green");
				if ($record->num_rows() > 0) {
					echo "<table><tr>";
					$cnt = 0;
					foreach ($record->result_array() as $t) {
						$total = $this->model_utama->view_where('berita',array('id_kategori' => $t['id_kategori'],'tanggal' => $fil,'status' => 'Y'))->num_rows();
						if ($total >= 1){	
							if ($cnt >= $col){ echo "</tr><tr>"; $cnt = 0; } $cnt++;
								echo "<td style='padding:5px; width:230px'> 
									<div class='block'>
										<h2 style='color:$warna[$cnt]' class='list-title'>$t[nama_kategori]</h2>
										<ul class='article-list'>";
										$sql = $this->model_utama->view_where_ordering_limit('berita',array('id_kategori' => $t['id_kategori'],'tanggal' => $fil,'status' => 'Y'),'id_berita','DESC',0,5);
										foreach($sql->result_array() as $r) {
											$judul = substr($r['judul'],0,40); 
											$total_komentar = $this->model_utama->view_where('komentar',array('id_berita' => $r['id_berita']))->num_rows();
											echo "<li><a title='$r[judul]' href='".base_url()."$r[judul_seo]'>$judul,..</a><a href='".base_url()."$r[judul_seo]' class='h-comment'>$total_komentar</a><span class='meta-date'>".tgl_indo($r['tanggal'])."</span></li>";
										}
										echo "</ul>
										<a href='".base_url()."kategori/detail/$t[kategori_seo]' class='more'>Read More</a>
									</div>
								</td>";
						}
					}
					echo "</tr></table>";
				}
			if ($hitung->num_rows()<1){
				echo "<center style='padding:15%'>Maaf, Belum ada artikel yang diterbitkan pada hari ini (".tgl_indo($hari_ini).").</center>";
			}
			?>
			</div>
		</div>
	</div>
</div>


