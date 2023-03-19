

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartEDU - Education Responsive HTML5 Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="Student/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="Student/images/apple-touch-icon.png">
    <link rel="stylesheet" href="Student/css/bootstrap.min.css">
    <link rel="stylesheet" href="Student/css/style.css">
    <link rel="stylesheet" href="Student/css/versions.css">
    <link rel="stylesheet" href="Student/css/responsive.css">
    <link rel="stylesheet" href="Student/css/custom.css">
    <link rel="stylesheet" href="Student/css/ks.css">



    <!-- Modernizer for Portfolio -->
    <script src="Student/js/modernizer.js"></script>
    <title>Document</title>

    <style>
      html{
        overflow-y: scroll;
      }
        body    {min-height: 100vh;}
        .sidebar{width: 20%; float: left; background: #7f5539; color: white; position: fixed;}
        .logo   {text-align: center; color: white; margin-top: 40px; font-weight: 700; margin-bottom: 40px;}
        .nav{margin-left: 60px; margin-right: 60px;}
        .nav li{list-style: none; padding: 12px 18px;}
        .nav li i{margin-right: 8px;}
        .nav li a{color: white; text-decoration: none; font-weight: 1000;}
        .main   {width: 80%; float: left; margin-left: 20%; min-height: 100vh; padding: 0 50px; background-color: #ddb892; color: #7f5539; }
        table button{border-radius: 8px;background-color: #7f5539; border: none; color: white;padding: 10px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;width: 80%;}
        .modal {position: absolute;}
    </style>
</head>
<body>
  @php
    //$role = Auth::user()->role;
    $role = "admin";
  @endphp
  <div class="sidebar" style="min-height: 100vh;">
    <h1 class="logo"><img src="Student/images/logo.png" alt="" /></h1>
    <ul class="nav">
      <li><a href="#"><i class="fa fa-tachometer"></i>Dashboard</a></li>
      <li><a href="#"><i class="fa fa-volume-up"></i>Announcement</a></li>
      @if($role=="admin")
      <li><a href="#"><i class="fa fa-book"></i>Course</a></li>
      <li><a href="#"><i class="fa fa-tasks"></i>Evaluation</a></li>
      <li><a href="/adminStudent"><i class="fa fa-user"></i>User</a></li>
      <li><a href="/adminStaff"><i class="fa fa-users"></i>Staff</a></li>
      <li><a href="#"><i class="fa fa-paypal"></i>Payment</a></li>
      @else
      <li><a href="#"><i class="fa fa-book"></i>My Course</a></li>
      <li><a href="#"><i class="fa fa-tasks"></i>My Evaluation</a></li>
      @endif
    </ul>
    <hr>
    <ul class="nav">
    <li><a href="/adminProfile"><i class="fa fa-id-card"></i>Profile</a></li>
    <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-user-circle"></i>Log Out</a><li>
        <form id="logout-form" method="POST" action="{{ route('logoutAdmin') }}" style="display: none;">
            @csrf
        </form>
      @if($role=="admin")
      <li class="myBtn"><i class="fa fa-user-plus"></i>Register</li>
      <div class="modal" style="padding-top: 10px!important; width: 100%; height: 120%!important;">
          <div class="modal-content">
            <span class="close">&times;</span>
            <form method="POST" action="/registerAdminsubmit">
            @csrf
            <label for="content" style="color:black;">Full Name</label>
            <input type="text" name="name" style="height:40px!important;"  placeholder="Name" maxlength="50"  required="required" value="{{old('name')}}" />

            <label for="content" style="color:black;">Phone</label>
            <input type="text" name="phone" style="height:40px!important;"  placeholder="Phone"  maxlength="14" pattern="[0-9]{3}-[0-9]{7,8}$" title="(999-999999999)" required="required" value="{{old('phone')}}" />

            <label for="content" style="color:black;">Email</label>
            <input type="text"  name="email" style="height:40px!important;"  placeholder="Email"  title="(name@gmail.com)" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="30" required="required" value="{{old('email')}}" />

            <label for="content" style="color:black;">Date of Birth</label>
            <input type="date"  name="dob" style="height:40px!important;"  placeholder="Date of Birth"  required="required"  value="{{old('dob')}}" max="{{date('Y-m-d')}}" />

            <label for="content" style="color:black;">User Type</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="content" style="color:black;">Admin</label>
            <input type="radio" name="role" value="admin" @if(old('role') == 'admin') checked @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="content" style="color:black;">Staff</label>
            <input type="radio" name="role" value="staff" @if(old('role') == 'staff') checked @endif><br>


            <label for="content" style="color:black;">Password</label>
             <input type="password"  name="password" style="height:40px!important;"  id="password" placeholder="Password"  maxlength="50" required="required" value="{{old('password')}}" />

            <label for="content" style="color:black;">Confirm Password</label>
            <input type="password"  name="cpassword"  style="height:40px!important;" id="cpassword" placeholder="Confirm Password"  maxlength="50" required="required" value="{{old('cpassword')}}" />

            <input type="submit" value="Submit">
              </form>
          </div>
      </div>
      @endif
    </ul>
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
