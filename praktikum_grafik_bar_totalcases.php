<?php
include('koneksi2.php');
$label = ["India","S.Korea","Turkey","Vietnam","Japan","Iran","Indonesia","Malaysia","Thailand","Israel"];
 
for($id = 1;$id < 13;$id++)
{
	$query = mysqli_query($koneksi,"select sum(total_cases) as total_cases from tb_covid where id_country='$id'");
	$row = $query->fetch_array();
	$jumlah_produk[] = $row['total_cases'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Grafik total cases</title>
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
					label: 'Grafik total cases',
					data: <?php echo json_encode($jumlah_produk); ?>,
					backgroundColor: 'rgba(244, 67, 54, 0.2)',
					borderColor: 'rgba(244, 67, 54, 1)',
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