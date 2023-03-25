@include('Student/header')
@if(Session::get('successupdate'))
    <script>
        swal({
        title: "Success!",
        text: "Profile updated successfully!",
        icon: "success",
        });
    </script>
@endif
@if(Session::get('wrongcrash'))
    <script>
        swal({
        title: "Wrong",
        text: "Crash Email or Phone with database",
        icon: "error",
        });
    </script> 
@endif
<link rel="stylesheet" href="Student/css/ks.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="Student/css/timetable.css" rel="stylesheet">
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="Student/css/bootstrap.min.css">
 <!-- ALL VERSION CSS -->
 <link rel="stylesheet" href="Student/css/versions.css">
 <!-- Responsive CSS -->
 <link rel="stylesheet" href="Student/css/responsive.css">
 <!-- Custom CSS -->
 <link rel="stylesheet" href="Student/css/custom.css">
 
<style>
.card1 {
    margin-top:10% !important;
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    height: 400px;
}

.me-2 {
    margin-right: .5rem!important;
}

.profile-pic {
    width: 200px;
    max-height: 200px;
    display: inline-block;
}

.file-upload {
    display: none;
}
.circle {
    border-radius: 100% !important;
    overflow: hidden;
    width: 128px;
    height: 128px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    position: absolute;
    top: 72px;
}
img {
    max-width: 100%;
    height: auto;
}
.p-image {
  position: absolute;
  top: 167px;
  right: 30px;
  color: #666666;
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
}
.p-image:hover {
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
}
.upload-button {
  font-size: 1.2em;
}

.upload-button:hover {
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
  color: #999;
}
button, .button, .btn{
    width: 150px;
}
input[type=submit]{
    width: 150px; background-color: white; border: 1px solid #2986cc; color: black; line-height: 8px;
}
input[type=submit]:hover {
  background-color: #2986cc;
}
</style>

<script>
$(document).ready(function() {
var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-pic').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(".file-upload").on('change', function(){
    readURL(this);
});

$(".upload-button").on('click', function() {
   $(".file-upload").click();
});
});
</script>
<div style="min-height: 60vh; margin-top: 50px;">
<form id="profile-form" method="POST" action="/profileUpdatestudent" enctype="multipart/form-data">
    @csrf

<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card1">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
 
                            <!--<div class="row">
                                <div class="small-12 medium-2 large-2 columns"> -->
                                  <div class="circle" style="position: relative; top: 0; bottom: 0;">
                                    <img class="profile-pic" src="{{ asset('student/upload/' . old('image', Auth::user()->image)) }}" alt="User Profile Image">
                                  </div>
                                  <div class="p-image" style="position: relative; top: 0; ">
                                    <i class="fa fa-camera upload-button"></i>
                                    <input class="file-upload" name="image" id="image" type="file" accept="image/*" value="{{ old('image', Auth::user()->image) }}">
                                  </div>
                               <!-- </div>
                            </div> -->

                            <div class="mt-3">
                                <h4>{{ old('name', Auth::user()->name) }}</h4>
                                <a class="btn btn-outline-primary myBtn">Achievement</a><br>
                                <div class="modal">
                                    <div class="modal-content" style="width: 70%">
                                        <span class="close">&times;</span>
                                        @foreach($achievements as $achievement)
                                        <div class="achievementCard">
                                            <h4><b>{{ $achievement->acTitle }}</b></h4><hr>
                                            <p>{{ $achievement->acResult }}</p>
                                        </div> 
                                        @endforeach
                                    </div>
                                </div>
                                <a class="btn btn-outline-primary myBtn">Timetable</a><br>
                                <div class="modal">
                                    <div class="modal-content" style="width: 70%; height: 120%; margin-top: -7%;">
                                        <span class="close">&times;</span>
                                        
                                    </div>
                                </div>
                                <a href="/deleteStudent" class="btn btn-outline-primary" style="background-color: red; color: white;">Delete Account?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" style="position: relative; margin-top: -40px;">
                <div class="card1">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Date of Birth</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', Auth::user()->dob) }}"  max="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <input class= "btn btn-outline-primary" type="submit" value="Save Changes">
                                <button id="logout-btn" type="button" class="btn btn-primary px-4" style="background: red;">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</form>
</div>
<script>
    document.getElementById('logout-btn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('profile-form').action = "{{ route('logoutStudent') }}";
        document.getElementById('profile-form').submit();
    });
</script>
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

      function confirmDelete(id) {
          if (confirm('Are you sure you want to delete this announcement?')) {
              // Redirect to the delete route with the announcement ID as a parameter
              window.location.href = '/deleteAnnouncement/' + id;
          }
      }
    </script>
@include('Student/footer')

