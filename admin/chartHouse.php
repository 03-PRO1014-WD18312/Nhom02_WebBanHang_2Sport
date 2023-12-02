<?php
    include "../model/pdo.php";
    include "../model/thongke.php";
    include "../model/taikhoan.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            const data = google.visualization.arrayToDataTable([
                ['Danh mục', 'Doanh thu'],
                <?php
                    $thongke_doanh_thu_follow_date=thongke_doanh_thu_follow_date();
                    foreach ($thongke_doanh_thu_follow_date as $tk_date_dt ) {
                        extract($tk_date_dt);
                        echo "['$date', $totalOrder],";
                    }
                ?>

            ]);
            // Set Options
            const options = {
                title: 'BIỂU ĐỒ DOANH THU THEO NGÀY',
                is3D: true,
                colors: ['#DB0000']
            };
            // Draw
            const chart = new google.visualization.LineChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
        <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            const data = google.visualization.arrayToDataTable([
                ['Khách hàng', ''],
                <?php
                    $countUser=countUser();
                    foreach ($countUser as $count ) {
                        extract($count);
                        echo "['Khách hàng', $countKH],";
                    }
                ?>

            ]);
            // Set Options
            const options = {
                title: 'THỐNG KÊ LƯỢNG KHÁCH HÀNG',
                is3D: true
            };
            // Draw
            const chart = new google.visualization.PieChart(document.getElementById('piechart_4d'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div style="display: flex;">
        <div id="piechart_3d" style="width: 900px; height: 400px;"></div>
        <div id="piechart_4d" style="width: 500px; height: 400px;"></div>
    </div>
</body>
</html>

