
@include('Student/header')
<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<title>My Course</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="stylesheet" href="Student/css/bootstrap.min.css">
	<link rel="stylesheet" href="Student/css/ks.css">
    <link rel="stylesheet" href="Student/css/style.css">
    <link rel="stylesheet" href="Student/css/versions.css">
    <link rel="stylesheet" href="Student/css/responsive.css">
    <link rel="stylesheet" href="Student/css/custom.css">

    <script src="js/modernizer.js"></script>

</head>
<body class="host_version">
	<div class="body">
	@foreach ($enrollments as $enrollment)
	<div class="course-item">
		<div class="course-title">
			<h2>{{ $enrollment->cName }}</h2>
		</div>
		<div class="course-desc">
			<p>@if ($enrollment->cDay == 1) Monday
				@elseif ($enrollment->cDay == 2) Tuesday
				@elseif ($enrollment->cDay == 3) Wednesday
				@elseif ($enrollment->cDay == 4) Thursday
				@elseif ($enrollment->cDay == 5) Friday
				@elseif ($enrollment->cDay == 6) Saturday
				@else ($enrollment->cDay == 7) Sunday
				@endif<br>
				{{ $enrollment->cStartTime}} - {{ $enrollment->cEndTime}}<br>
				{{ $enrollment->cDescription }}
			</p>
			{{-- <button onclick="evaluation({{ $enrollment->id }})" >Evaluation</button> --}}
            <button onclick="evaluation({{ $enrollment->id }})">Evaluation</button>



		<button onclick="var url = '{{ $enrollment->url }}'; window.open(url)">Materials</button>
			</div>
		<div class="course-prog">
			<div class="progress-radial progress-{{$enrollment->progress}}">
				<div class="overlay">{{$enrollment->progress}}%</div>
			</div>
		</div>
		<div class="course-title">

		</div>
	</div>

	@endforeach

	</div>

    <script src="js/all.js"></script>
    <script src="js/custom.js"></script>
	<script>
		var modals = document.querySelectorAll(".modal");
		var btns = document.querySelectorAll(".myBtn");
		var spans = document.querySelectorAll(".close");
		btns.forEach(function(btn, index) {
		  btn.onclick = function() {
			modals[index].style.display = "block";
		  }
		});
		spans.forEach(function(span, index) {
		  span.onclick = function() {
			modals[index].style.display = "none";
		  }
		});
		window.onclick = function(event) {
		  modals.forEach(function(modal) {
			if (event.target == modal) {
			  modal.style.display = "none";
			}
		  });
		}

		function openPdfFile($filePath) {
			window.open($filePath, '_blank');
		}

        // function evaluation(eid) {
        //     window.location.href = '/evaluation/' + eid;
        // }
        function evaluation(enrollmentId) {
    const evaluationUrl = '/evaluation/' + enrollmentId;
    window.location.href = evaluationUrl;
}

	  </script>


</body>
</html>
@include('Student/footer')
