@include('admin/adminHeader')
@if(Session::get('wrong2'))
    <script>
        swal({
        title: "Wrong",
        text: "Password and Confirm Password not match",
        icon: "error",
        });
    </script>
@endif
@if(Session::get('wrong3'))
    <script>
        swal({
        title: "Wrong",
        text: "Password Incorrect",
        icon: "error",
        });
    </script>
@endif
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cfnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Student/css/ks.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Evaluation</title>
    <style>
        .card1 {
            /* position: relative; */
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: 320px;
            z-index: 0 !important;
            /* Sit on top */
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: .25rem;
            /* margin-bottom: 1.5rem; */
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
            margin-top: 100px;
        }

        /* .card1 {
            margin-top: 10% !important;
        } */

        .profileform {
            margin-left: 180px;
            margin-top: 100px;
        }

        .card1-body {
            margin-top: 120px;
        }

        .me-2 {
            margin-right: .5rem !important;
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
            /* position: absolute; */
            /* top: 100px;
            left: 630px; */
            margin-top: -120px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .p-image {
            /* position: absolute; */
            /* top: 200px;
            right: 700px; */
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

        .achievementbutton,
        .savebutton {
            background: #7f5539;
            color: black;
        }

        .deletebutton,
        .logoutbutton {
            background: rgb(205, 64, 64);
            color: black
        }

        .achievementbutton:hover,
        .savebutton:hover {
            background: #ddb892;
        }

        .deletebutton:hover,
        .logoutbutton:hover {
            background: white;
            color: rgb(205, 64, 64);
        }

        .achievementbutton {
            width: 150px;
            height: 40px;
            font-size: 16px;
            border: none;
        }

        .deletebutton {
            margin-top: 10px;
            font-size: 16px;
            width: 150px;
            height: 40px;
            border: none;
        }

        .savebutton {
            width: 150px;
            height: 40px;
            font-size: 16px;
            border: none;
            margin-left: -100px;
        }

        .logoutbutton {
            margin-top: 10px;
            width: 150px;
            height: 40px;
            font-size: 16px;
            border: none;
            margin-left: -100px;
        }

        .card2 {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
            background-color: #b08968;
            width: 75%;
            height: 520px;
            padding: 45px 20px;
            float: left;
            text-align: center;
            color: #fefefe;
            border-radius: .25rem;
        }

        .title1 {
            margin-top: 20px;
        }

        .close{
            margin-right: 100%;
        }
    </style>


</head>

<body>
    <div class="main">
        <div class="profileform">
            <form id="profile-form" method="POST"  action="{{ route('profileUpdateadmin') }}" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card1">
                                    <div class="card1-body">
                                        <div class="d-flex flex-column align-items-center text-center">

                                            <div class="row">
                                                <div class="small-12 medium-2 large-2 columns">
                                                    <div class="circle">
                                                        <img class="profile-pic"
                                                            src="{{ asset('student/upload/' . old('image', Auth::user()->image)) }}"
                                                            alt="User Profile Image">
                                                    </div>
                                                    <div class="p-image">
                                                        <i class="fa fa-camera upload-button"></i>
                                                        <input class="file-upload" name="image" id="image"
                                                            type="file" accept="image/*"
                                                            value="{{ old('image', Auth::user()->image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <h4>{{ old('name', Auth::user()->name) }}</h4>
                                                <button class="btn btn-outline-primary btn-xs deletebutton myBtn">Delete Account?</button>
                                                <div class="modal">
                                                    <div class="modal-content">
                                                      <span class="close">&times;</span>
                                                     <form id="profile-form" method="POST" action="{{ route('deleteAdmin') }}">
                                                        @csrf
                                                        <label for="content" style="display: inline-block; text-align: left;">Password</label>
                                                        <input type="password" id="password" name="password" placeholder="Password"  maxlength="50" required="required" value="{{old('password')}}" >

                                                        <label for="content" style="display: inline-block; text-align: left;">Confirm Password</label>
                                                        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password"  maxlength="50" required="required" value="{{old('cpassword')}}" >

                                                        <input type="submit" id="delete-btn" value="Submit">
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card2">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0 title1">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', Auth::user()->name) }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0 title1">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone', Auth::user()->phone) }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0 title1">Date of Birth</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="date" class="form-control" id="dob" name="dob"
                                                    value="{{ old('dob', Auth::user()->dob) }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0 title1">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="{{ old('email', Auth::user()->email) }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button id="save-btn" type="submit" class="btn btn-primary px-4 savebutton">Save Changes</button><br>
                                                {{-- <input type="submit" class="btn btn-primary px-4 savebutton" value="Save Changes"> --}}
                                                <button id="logout-btn"
                                                    class="btn btn-primary px-4 logoutbutton">Logout</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                document.getElementById('logout-btn').addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('profile-form').action = "{{ route('logoutAdmin') }}";
                    document.getElementById('profile-form').submit();
                });

                document.getElementById('save-btn').addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('profile-form').action = "{{ route('profileUpdateadmin') }}";
                    document.getElementById('profile-form').submit();
                });

                document.getElementById('delete-btn').addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('profile-form').action = "{{ route('deleteAdmin') }}";
                    document.getElementById('profile-form').submit();
                });


                $(document).ready(function() {
                    var readURL = function(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('.profile-pic').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }


                    $(".file-upload").on('change', function() {
                        readURL(this);
                    });

                    $(".upload-button").on('click', function() {
                        $(".file-upload").click();
                    });
                });


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


        </div>
    </div>


</body>
