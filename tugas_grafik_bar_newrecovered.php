<?php
include('koneksi2.php');
$label = ["India","S.Korea","Turkey","Vietnam","Japan","Iran","Indonesia","Malaysia","Thailand","Israel"];
 
for($id = 1;$id < 13;$id++)
{
	$query = mysqli_query($koneksi,"select sum(new_recovered) as new_recovered from tb_covid where id_country='$id'");
	$row = $query->fetch_array();
	$jumlah[] = $row['new_recovered'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Grafik new recovered</title>
	<script type="text/javascript" src="chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($label); ?>,
				datasets: [{
					label: 'Grafik new recovered',
					data: <?php echo json_encode($jumlah); ?>,
					backgroundColor: 'rgba(156, 39, 176, 0.2)',
					borderColor: 'rgba(156, 39, 176, 1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>