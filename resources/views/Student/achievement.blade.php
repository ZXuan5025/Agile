@include('Student/header')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Student/css/ks.css">
    <title>Achievement</title>
</head>
<body style="height: 100vh; background-color: #ede0d4;">
    <div class="body">
        <button id="myBtn">Open Modal</button>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <ul>
                @foreach ($achievements as $achievement)
                    <div class="card">
                        <h4><b>{{ $achievement->acTitle }}</b></h4><hr>
                        <p>{{ $achievement->acResult }}</p>
                    </div> 
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>

@include('Student/footer')