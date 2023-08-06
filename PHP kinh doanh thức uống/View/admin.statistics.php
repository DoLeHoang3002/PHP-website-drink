<div class="list-thuc-uong">
    <div class="container">
        <div>
            <form action="" method="post">
                <select class="form-select w-25 d-inline" name="Time_Quarter" id="">
                    <?php
                        $curYear = date('Y');
                        $curMonth = date("m", time());
                        $curQuarter = ceil($curMonth/3);
                        for ($i=0; $i < 4; $i++) { 
                            $quarter = ($curQuarter-$i)>0?($curQuarter-$i):4+($curQuarter-$i);
                            $year = ($curQuarter-$i)>0?$curYear:$curYear-1;
                            echo "<option value='".$quarter."-".$year."' ".
                            ((isset($_POST["Time_Quarter"])&&$_POST["Time_Quarter"]==($quarter."-".$year))?"selected":"")
                            .">Quý $quarter năm $year</option>";
                        }
                    ?>
                </select>
                <button class="btn btn-outline-success d-inline mb-1">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-center">
            <div id="chart_div"></div>
            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script>
                google.load('visualization', '1.0', {'packages': ['corechart']});
                google.setOnLoadCallback(() => {
                    var data = new google.visualization.DataTable();
                    var tenhh = new Array();
                    var soluongban = new Array();
                    var datahh = 0;
                    var slb = 0;
                    var rows = new Array();
                    <?php
                        $hh = new bill();
                        $quarter = $curQuarter;
                        $year = $curYear;
                        if (isset($_POST['Time_Quarter'])) {
                            $quarter = explode("-",$_POST['Time_Quarter'])[0];
                            $year = explode("-",$_POST['Time_Quarter'])[1];
                        }
                        $result = $hh->thongke($quarter,$year);
                        foreach ( $result as $item) {
                            $tenhh = $item["Name_hh"];
                            $soluong = $item["Amount"];
                            echo "tenhh.push('".$tenhh."');";
                            echo "soluongban.push('".$soluong."');";
                        }
                    ?>
                    for (var i = 0; i <tenhh.length; i++)
                    {
                        datahh = tenhh[i];
                        slb = parseInt(soluongban[i]);
                        rows.push([datahh, slb]);
                    };
                    data.addColumn('string', 'Tên hàng hoá');
                    data.addColumn('number', 'Số lượng bán');
                    data.addRows(rows);
                    var option={
                        title:'Thống kê sản phẩm bán được theo quý <?php echo $quarter." năm ".$year?>',
                        'width': 600,
                        'height': 400,
                        'backgroundColor': '#FFFFFF',
                        is3D: true,
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                    chart.draw(data,option);
                });
            </script>
        </div>
    </div>
</div>