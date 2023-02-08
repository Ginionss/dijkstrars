<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">

<title>COESITAL</title>
<!-- Favicons -->
<link href="../assets/img/icon.ico" rel="shortcut icon">
<link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="../assets/vendor/aos/aos.css" rel="stylesheet">
<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


<!-- Template Main CSS File -->
<link href="../assets/css/style.css" rel="stylesheet">
<style>
	html,
	body,
	#map-canvas {
		width: 99%;
		height: 88%;
		/* //margin: 0px;
		//padding: 0px */
	}

	a {
		cursor: pointer;
		text-decoration: underline;
	}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/9.3.2/math.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1UhV7s_4c-E3p33HyK_P-N7uEs8qqfpg&language=id&region=ID"></script>
<script>
	// map
	var poly = '';
	var map;
	var markeruser = '';
	var markerdestination = '';

	// boolean
	var __global_user = false;
	var __global_destination = false;
	var pin = false;
	var update_timeout;
	// var teks;
	var nmkec;
	var nilai_awal;
	var nilai_des;
	var jalur_dilewati;
	var muncul = false;



	/**
	 * INITIALIZE GOOGLE MAP
	 */

	function initialize() {
		/* setup map */
		var mapOptions = {
			zoom: 13,
			center: new google.maps.LatLng(-10.176976670644589, 123.60493295656552)
		};

		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		// handle click and dblclick same time
		google.maps.event.addListener(map, 'dblclick', function(event) {
			clearTimeout(update_timeout);
		});
	}

	/**
	 * PILIH DESTINATION (RUMAH SAKIT) VIA <SELECT>
	 */
	function choose_destination(value) {
		var splitt = value.split("_");
		nilai_des = Number(splitt[1]);
		// teks option
		var teks = $("#select_tujuan option:selected").text();

		// -- PILIH -- dipilih
		if (splitt[0] == 'pilih') return false;

		// reset polyline
		if (poly != '') poly.setMap(null);


		var location = JSON.parse(splitt[0]);
		icons = 'https://icons.iconarchive.com/icons/fatcow/farm-fresh/32/health-icon.png';

		if (__global_destination == false) {
			markerdestination = new google.maps.Marker({
				position: location,
				map: map,
				icon: icons,
				draggable: false,
				title: 'TUJUAN : ' + teks,
			});

			__global_destination = true;
		} else {
			markerdestination.setPosition(location);
			markerdestination.setTitle('TUJUAN : ' + teks);
			if (pin == true) {
				markerdestination = new google.maps.Marker({
					position: location,
					map: map,
					icon: icons,
					draggable: false,
					title: 'TUJUAN : ' + teks,
				});
				pin = false;
			}
		}

	}

	/**
	 * PILIH DESTINATION (KECAMATAN) VIA <SELECT>
	 */
	function choose_awal(value) {
		var splitt = value.split("_");
		nilai_awal = Number(splitt[1]);
		pin = true;
		// teks option
		var teks = $("#select_awal option:selected").text();

		// -- PILIH -- dipilih
		if (splitt[0] == 'pilih') return false;


		// reset polyline
		if (poly != '') poly.setMap(null);

		var location = JSON.parse(splitt[0]);
		icons = 'https://icons.iconarchive.com/icons/umar123/build/48/0014-Pin-icon.png';
		mapOptions = {
			zoom: 10,
			center: new google.maps.LatLng(location)
		};

		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		update_timeout = setTimeout(function() {


			markeruser = new google.maps.Marker({
				position: location,
				map: map,
				icon: icons,
				draggable: false,
				title: 'test drag',
			});

		}, 200);

		var teks = '';
		if (splitt[0] == '{"lat": -10.192032042929519, "lng": 123.5584319382906}') {
			teks = 'http://arsipbkeuda.com/Alak.kml';
		} else if (splitt[0] == '{"lat": -10.183603440712032, "lng":  123.62282574176788}') {
			teks = 'http://arsipbkeuda.com/Maulafa.kml';
		} else if (splitt[0] == '{"lat": -10.170743964933386, "lng": 123.59976142644882}') {
			teks = "http://arsipbkeuda.com/Oebobo.kml";
		} else if (splitt[0] == '{"lat": -10.178872607796235, "lng":  123.5932731628418}') {
			teks = "http://arsipbkeuda.com/Kota_Raja.kml";
		} else if (splitt[0] == '{"lat": -10.158679980635691, "lng": 123.59354943037033}') {
			teks = "http://arsipbkeuda.com/Kota_Lama.kml";
		} else if (splitt[0] == '{"lat": -10.149683508283182, "lng": 123.61897945404053}') {
			teks = "http://arsipbkeuda.com/Kelapa_Lima.kml";
		}

		var KMLkupang = new google.maps.KmlLayer({
			url: teks,
			map: map
		});
		google.maps.event.addListener(map, 'dblclick', function(event) {
			clearTimeout(update_timeout);
		});


	}


	/**
	 * GET JSON DIJSKTRA VIA AJAX
	 */
	function send_dijkstra() {

		muncul = true;
		if (markeruser == '' || markerdestination == '') {
			alert('Isi dulu koordinat user & tujuan');
			return false;
		}
		console.log(markeruser.position.lat());
		console.log(markeruser.position.lng());
		console.log(markerdestination.position.lat());
		console.log(markerdestination.position.lng());
		now_koord_user = '{"lat": ' + markeruser.position.lat() + ', "lng": ' + markeruser.position.lng() + '}';
		now_koord_destination = '{"lat": ' + markerdestination.position.lat() + ', "lng": ' + markerdestination.position.lng() + '}';

		console.log(now_koord_user);
		console.log(now_koord_destination);
		// loading
		$('#run_dijkstra').hide();
		$('#loading').show();

		$.ajax({
			method: "POST",
			url: "Main.php",
			data: {
				koord_user: now_koord_user,
				koord_destination: now_koord_destination
			},
			success: function(response) {

				// remove loading
				$('#run_dijkstra').show();
				$('#loading').hide();

				var json = JSON.parse(response);
				//console.log(response);
                nod = json['node'];
				console.log(nod);

				// RESET POLYLINE
				if (poly != '') poly.setMap(null);


				// ERROR ALGORITMA DIJKSTRA
				if (json.hasOwnProperty("error")) alert(json['error']['teks']);

				// GAMBAR JALUR SHORTEST PATH
				/* setup polyline */
				var polyOptions = {
					/*path: [
					{"lat": 37.772, "lng": -122.214},
					{"lat": 21.291, "lng": -157.821},
					{"lat": -18.142, "lng": 178.431},
					{"lat": -27.467, "lng": 153.027}],
					*/
					path: json['jalur_shortest_path'],
					geodesic: true,
					strokeColor: 'rgb(20, 120, 218)',
					strokeOpacity: 1.0,
					strokeWeight: 2,
				};
				poly = new google.maps.Polyline(polyOptions);
				poly.setMap(map);


			},
			error: function(er) {
				alert('error: ' + er);

				// remove loading
				$('#run_dijkstra').show();
				$('#loading').hide();
			}
		});
		<?php
include_once "Main.php";
$m = new Main();
$koneksi = $m->koneksi;
$sqll = "SELECT * FROM jarak";
$run_jarak = mysqli_query($koneksi, $sqll);
?>
		var jarak = new Array(20);
		for (var i = 0; i < jarak.length; i++) {
			jarak[i] = new Array(20);
		}
		<?php while ($fetch = mysqli_fetch_array($run_jarak, MYSQLI_ASSOC)) {?>
			jarak[<?=$fetch['simpul_awal']?>][<?=$fetch['simpul_tujuan']?>] =
				<?=$fetch['bobot'] / 1000?>.toFixed(2);
		<?php }?>
		var cap = jarak[nilai_awal - 1][nilai_des - 1];


		document.getElementById('jarak').innerHTML = "Jarak: <strong><span>" + cap + " Km</span></strong>";

		//menampilkan rekomendasi terdekat
		var text1 = "Rekomendasi Terdekat : <strong><span> - </span></strong>";
		if (nilai_awal == 15 && nilai_des != 14) {
			text1 = "Rekomendasi Terdekat : <strong><span>RS Samuel J. Moeda (" + jarak[14][13] + "Km) </span></strong>";
		} else if (nilai_awal == 16 && nilai_des != 4) {
			text1 = "Rekomendasi Terdekat : <strong><span>RSU Leona (" + jarak[15][3] + " Km) </span></strong>";
		} else if (nilai_awal == 17 && nilai_des != 10) {
			text1 = "Rekomendasi Terdekat : <strong><span>RS Bhayangkara (" + jarak[16][9] + " Km) </span></strong>";
		} else if (nilai_awal == 18 && nilai_des != 11) {
			text1 = "Rekomendasi Terdekat : <strong><span>RSU UNDANA (" + jarak[17][10] + " Km) </span></strong>";
		} else if (nilai_awal == 19 && nilai_des != 10) {
			text1 = "Rekomendasi Terdekat : <strong><span>RS Bhayangkara (" + jarak[18][9] + " Km) </span></strong>";
		} else if (nilai_awal == 20 && nilai_des != 8) {
			text1 = "Rekomendasi Terdekat : <strong><span>RSU Mamami (" + jarak[19][7] + " Km) </span></strong>";
		}
		document.getElementById('rekomendasi').innerHTML = text1;

		//menampilkan faskes
		var text2;
		var text3;
		if(muncul == true){
		text2 = "<a style='color:black; text-decoration : none' href='http://localhost/dijkstrars/dijkstra/kamar/"+nilai_des+".pdf' target='myframe'>Lihat Fasilitas Rumah Sakit</a>";
		document.getElementById('faskes').innerHTML = text2;
		 text3 = "<iframe name='myframe' width='100%' height='700' frameborder='0' scrolling='no'></iframe>";
		document.getElementById('pdf').innerHTML = text3;
		muncul == false;
		}else{
		text2 = "<a style='color:black; text-decoration : none' href='http://localhost/dijkstrars/dijkstra/kamar/"+nilai_des+".pdf' target='myframe'>Lihat Fasilitas Rumah Sakit</a>";
		document.getElementById('faskes').innerHTML = text2;
		 text3 = "";
		document.getElementById('pdf').innerHTML = text3;
		}
	}

	// function myFunction() {
	// <?php
//  $sql1     = "SELECT * FROM graph ORDER BY id DESC LIMIT 1";
//     $query1     = mysqli_query($koneksi, $sql1);
//     $fetch1 = mysqli_fetch_array($query1, MYSQLI_ASSOC);
//     $kon_jar = $fetch1['bobot'] / 1000;
//     $str = "Total jarak: <strong><span>".round($kon_jar,1)." Km</span></strong>";
//     echo "document.getElementById('jarak').innerHTML = '$str'";
//
?>
	// }

	/* load google maps v3 */
	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<header id="header">
	<div class="container d-flex align-items-center justify-content-between">

		<!-- <h1 class="logo"><a href="../index.php">Galfint</a></h1> -->
		<!-- Uncomment below if you prefer to use an image logo -->
		<a style="text-decoration: none" href="../index.php" class="logo"><img src="../assets/img/coesital.png" alt="" class="img-fluid"> COESITAL</a>

		<nav id="navbar" class="navbar">
			<ul>
				<li><a class="nav-link scrollto" href="../index.php">Beranda</a></li>
				<li><a class="nav-link scrollto" href="../index.php#about">Tentang</a></li>
				<li><a class="getstarted scrollto" href="index.php">Peta</a></li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

	</div>

</header>
<br>

<body>
	<div class="container">
		<?php
//include "Main.php";

$tot_jarak = false;
// koneksi
//$m = new Main();
//$koneksi = $m->koneksi;

// query
$sql = "SELECT * FROM camat";
$query = mysqli_query($koneksi, $sql);
$kec = 'Alak';
// select Awal
echo '<div  class = "row">';
echo '<div  class = "col-md-5 form-group">';
echo 'Awal : <select id="select_tujuan" class="form-control"  onchange="choose_awal(this.value)">';
echo '<option value="pilih">-- PILIH --</option>';
while ($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $kec = $fetch['tujuan'];
    $koordinat = $fetch['koordinat'];
    $exp_koordinat = explode(',', $koordinat);
    $json_koordinat = '{"lat": ' . $exp_koordinat[0] . ', "lng": ' . $exp_koordinat[1] . '}_' . $fetch['id'];
    echo "<option  value='$json_koordinat'>$fetch[tujuan]</option>";
}
//map($koordinat);
echo '</select>';
echo '</div>';

$sql1 = "SELECT * FROM rs";
$query1 = mysqli_query($koneksi, $sql1);
// select Tujuan
echo '<div  class = "col-md-5 form-group ">';
echo ' Tujuan : <select id="select_tujuan" class="form-control"  onchange="choose_destination(this.value)">';
echo '<option value="pilih">-- PILIH --</option>';
while ($fetch1 = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
    $koordinat = $fetch1['koordinat'];
    $exp_koordinat = explode(',', $koordinat);
    $json_koordinat = '{"lat": ' . $exp_koordinat[0] . ', "lng": ' . $exp_koordinat[1] . '}_' . $fetch1['id'];

    echo "<option value='$json_koordinat'>$fetch1[tujuan]</option>";
}
echo '</select>';
echo '</div>';
?>
		<div class="col-md-2 form-group">
			<br>
			<span><button onclick="send_dijkstra()" class="form-control btn btn-primary" id='run_dijkstra'>Cari Rute</button><span id='loading' style='display:none'> Memuat Rute ...</span></span>
		</div>
	</div><br>
	<div id="map-canvas"></div>
	<div id='DEBUG'></div>
	<!-- ======= Footer ======= -->

	<footer id="footer">
		<div class="container d-md-flex py-4">
			<div class="me-md-auto text-center text-md-start">
				<div class="rekomendasijarak">
					<h4 id="jarak">Jarak : <strong><span> - Km</span></strong></h3>
					<h9 id = "faskes" class="fasilitas"> <a style="color:black; text-decoration : none" href="" target="myframe">Lihat Fasilitas Rumah Sakit</a></h9>
					<!-- <button type="button" onclick="myFunction()">Coba Klik</button> -->
					<!-- <embed src="kamar/1.pdf" type="application/pdf" width="500" height="700"/> -->
				</div>

			</div>
			<div class="social-links text-center text-md-right pt-3 pt-md-0">

				<h4 id="rekomendasi">Rekomendasi Terdekat: <strong><span> - </span></strong></h3>

			</div>
		</div>
		<p id="pdf"></p>
	</footer><!-- End Footer -->
	</div>
</body>
