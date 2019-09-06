<?php
  $file = fopen("rss.xml", "w");
  fwrite($file, '<?xml version="1.0" encoding="UTF-8"?> 
  <rss version="2.0">');
  fwrite($file, "<channel> 
				<title>RSS $iden[nama_website]</title> 
				<description>$iden[meta_deskripsi]</description>
				<link>$iden[url]</link> 
				<language>id-id</language>");

				foreach ($rss->result_array() as $row) {
					$isi = $row['isi_berita']; 
					fwrite($file, "<item>
						                <title>".cetak_meta($row['judul'],0,255)."</title>
						                <link>".base_url()."berita/detail/$row[judul_seo]</link>
						                <description>".strip_tags(html_entity_decode($isi))."</description>
					                </item>");
				}
  fwrite($file, "</channel>
  	</rss>");
  fclose($file);
?>