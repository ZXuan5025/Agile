@include('admin/adminHeader')
@if(Session::get('successupdate'))
    <script>
        swal({
        title: "Success!",
        text: "Details updated successfully!",
        icon: "success",
        });
    </script>
@endif
@if(Session::get('successdelete'))
    <script>
        swal({
        title: "Success!",
        text: "Record deleted successfully!",
        icon: "success",
        });
    </script>
@endif
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
    <title>Manage Student</title>
</head>

<style>
    input[type=textbox] {
      height:40px!important;
    }
    </style>
<body>
<div class="main">
      <h1 class="logo" style="color: black;">Manage Student</h1>

      <table class="table table-hover">
        <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 20%;">
        </colgroup>
        <thead>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </thead>
    <tbody>
        @foreach ($users as $user)
          <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->dob }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <button class="myBtn" data-modal-id="{{ $user->id }}"><i class="fa fa-edit"> Edit</i></button>
                <div class="modal" id="modal-{{ $user->id }}">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <form method="POST" action="/updateStudentadmin/{{ $user->id }}">
                        @csrf
                        @method('PUT')
                        <label for="title">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Name" value="{{ $user->name }}">

                        <label for="content">D.O.B</label>
                        <input type="date" id="dob" name="dob" placeholder="Date of Birth" value="{{ $user->dob }}">

                        <label for="content">Phone</label>
                        <input type="textbox" id="phone" name="phone" placeholder="Phone" value="{{ $user->phone }}">

                        <label for="content">Email</label>
                        <input type="textbox" id="email" name="email" placeholder="Email" value="{{ $user->email }}">
                        <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
                <br><br>
                {{-- <button class="myBtn" ><i class="fa fa-trash"> Delete</i></button> --}}
                <a href="/deleteStudentadmin/{{ $user->id }}">
                    <button type="button" class="delete" onclick="return confirm('Are you sure to delete this student?')">
                      <i class="fa fa-trash"></i>Delete
                    </button>
                  </a>
            </td>
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
            var btns = document.querySelectorAll(".myBtn");
        var modals = document.querySelectorAll(".modal");

        btns.forEach(function(btn) {
        btn.onclick = function() {
            var modalId = this.getAttribute("data-modal-id");
            var modal = document.getElementById("modal-" + modalId);
            modal.style.display = "block";
        }
        });

        modals.forEach(function(modal) {
        var span = modal.querySelector(".close");
        span.onclick = function() {
            modal.style.display = "none";
        }
        });

        window.onclick = function(event) {
        modals.forEach(function(modal) {
            if (event.target == modal) {
            modal.style.display = "none";
            }
        });
        };
    </script>
</body>
</html>
