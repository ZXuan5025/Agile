@include('admin/adminHeader')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cfnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Student/css/ks.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Announcement</title>
</head>
<body>
<div class="main">
      <h1 class="logo" style="color: black;">Manage Announcement</h1>
      
      <table class="table table-hover">
        <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 30%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
        </colgroup>
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Date</th>
            <th><button class="myBtn"><i class="fa fa-plus"> Create</i></button></th>
            <div class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form method="POST" action="/addAnnouncement">
                    @csrf
                      <input type="hidden" name="adminID" value=2>
                      <label for="title">Title</label>
                      <input type="text" id="title" name="aTitle" placeholder="Announcement Title...">
                      <label for="content">Content</label>
                      <input type="textbox" id="content" name="aContent" placeholder="Content..">
                      <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
          </tr>
        </thead>
        <tbody>
        @foreach ($announcements as $announcement) 
          <tr>
            <th scope="row">{{ $announcement->id }}</th>
            <td>{{ $announcement->aTitle }}</td>
            <td>{{ $announcement->aContent}}</td>
            <td>{{ date('Y-m-d', strtotime($announcement->aDate)) }}</td>
            <td><button class="myBtn"><i class="fa fa-edit"> Edit</i></button></td>
            <div class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form method="POST" action="/updateAnnouncement/{{ $announcement->id }}">
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
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    @if ($errors->any())
    <script>
        alert("{{ implode('\n', $errors->all()) }}");
    </script>
    @endif
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