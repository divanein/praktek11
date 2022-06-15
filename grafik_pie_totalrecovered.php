<?php
include('koneksi2.php');
$produk = mysqli_query($koneksi,"select * from tb_covid");
while($row = mysqli_fetch_array($produk)){
	$nama_produk[] = $row['country'];
	$query = mysqli_query($koneksi,"select sum(total_recovered) as total_recovered from tb_covid where id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$jumlah_produk[] = $row['total_recovered'];
}
?>
<!doctype html>
<html>
 
<head>
	<title>Grafik Pie Total Recovered</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div id="canvas-holder" style="width:70%">
		<canvas id="chart-area"></canvas>
	</div>
	<script>
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data:<?php echo json_encode($jumlah_produk); ?>,
					backgroundColor: [
					'rgba(3, 169, 244, 0.3)',
					'rgba(244, 67, 54, 0.3)',
					'rgba(233, 30, 99, 0.3)',
					'rgba(156, 39, 176, 0.3)',
                    'rgba(63, 81, 181, 0.3)',
                    'rgba(76, 175, 80, 0.3)',
                    'rgba(0, 150, 136, 0.2)',
                    'rgba(121, 85, 72, 0.3)',
                    'rgba(255, 152, 0, 0.3)',
                    'rgba(0, 0, 0, 0.3)',
					],
					borderColor: [
					'rgba(3, 169, 244, 1)',
					'rgba(244, 67, 54, 1)',
					'rgba(233, 30, 99, 1)',
					'rgba(156, 39, 176, 1)',
                    'rgba(63, 81, 181, 1 )',
                    'rgba(76, 175, 80, 1 )',
                    'rgba(0, 150, 136, 1 )',
                    'rgba(121, 85, 72, 1 )',
                    'rgba(255, 152, 0, 1)',
                    'rgba(0, 0, 0, 1 )',
					],
					label: 'Presentase Penjualan Barang'
				}],
				labels: <?php echo json_encode($nama_produk); ?>},
			options: {
				responsive: true
			}
		};
 
		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};
 
		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});
 
			window.myPie.update();
		});
 
		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};
 
			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
 
				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}
 
			config.data.datasets.push(newDataset);
			window.myPie.update();
		});
 
		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
</body>
</html>