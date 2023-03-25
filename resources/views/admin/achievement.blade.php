<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Student/css/ks.css">
    <title>Achievement</title>
</head>
<body>
    <button class="myBtn"><i class="fa fa-edit"> Edit</i></button>
    <div class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="POST" action="/addAchievement/{{ $users->id }}">
            @csrf
            @method('PUT')
                <input type="hidden" name="adminID" value=2>
                <label for="title">Title</label>
                <input type="text" id="title" name="aTitle" placeholder="Announcement Title..." value="{{ $announcement->aTitle }}">

                <label for="content">Content</label>
                <input type="textbox" id="content" name="aContent" placeholder="Content.." value="{{ $announcement->aContent }}">
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
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
      </script>
</body>
</html>