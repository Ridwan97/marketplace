<head>
 <!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- My Css -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="shortcut icon" type="text/css" href="assets/img/homepage/favicon.ico"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


	<script  type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="assets/js/materialize.min.js"></script>
			<script>
			$(document).ready(function(){
				$(".carousel.carousel-slider").carousel({
					fullWidth: true,
					indicators: true
				});
				setInterval(function(){
					$('.carousel.carousel-slider').carousel('next');   
				}, 3000);
			});
		</script>