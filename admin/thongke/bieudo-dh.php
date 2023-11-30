<!DOCTYPE html>
<html>
  <head>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Tên danh mục','Doanh thu','Lãi'],
          <?php 
            foreach ($thongke_dt as $tkdt) {
                extract($tkdt);
                $lai=$tongtien * 20/100;
                $tongdoanhthu+=$lai;
                echo "['$name',$tongtien,$lai],
                ";
            }
            echo "['Tổng doanh thu', null, $tongdoanhthu]";
          ?>

        ]);

        var options = {
          title : 'THỐNG KÊ ĐƠN HÀNG THEO DOANH THU',
          vAxis: {title: 'Doanh thu'},
          hAxis: {title: 'Tên danh mục'},
          seriesType: 'bars',
          series: {2: {
            type: 'line',
            }
          }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
        <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tên danh mục','Số lượng đặt hàng thành công'],
          <?php 
            foreach ($thongke_dt as $tkdt) {
                extract($tkdt);
                echo "['$name',$soluongdh,],
                ";
            }
          ?>
        ]);

        var options = {
          title: 'THỐNG KÊ SỐ LƯỢNG ĐƠN HÀNG THÀNH CÔNG THEO DANH MỤC',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
      <style>
    #header{
      display: none;
    }
  </style>
  </head>
  <body>
    <div style="display: flex;">
        <div id="chart_div" style="width: 900px; height: 500px;"></div>
        <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    </div>
  </body>

</html>

