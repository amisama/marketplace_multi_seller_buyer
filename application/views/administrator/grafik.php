<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: ''
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        'Ada ' + this.point.y + ' Orang';
                }
            }
        });
    });
</script>

<div class="box box-success">
    <div class="box-header">
    <i class="fa fa-th-list"></i>
    <h3 class="box-title">Grafik Kunjungan</h3>
        <div class="box-tools pull-right">
           <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
        </div>

<div class="box-body chat" id="chat-box">
<div id="container" style="min-width: 310px; height: 340px; margin: 0 auto"></div>
<table id="datatable" style='display:none'>
    <thead>
        <tr>
            <th></th>
            <th>Jumlah Kunjungan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $grafik = $this->model_app->grafik_kunjungan();
            foreach ($grafik->result_array() as $row){
                echo "<tr>
                        <th>".tgl_grafik($row['tanggal'])."</th>
                        <td>$row[jumlah]</td>
                      </tr>";
            }
        ?>
    </tbody>
</table>
</div><!-- /.chat -->
</div><!-- /.box (chat box) -->

