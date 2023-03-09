
@include('Student/header')
@if(Session::get('wrong'))
    <script>
        swal({
        title: "Wrong",
        text: "Email Or Phone In Used Already",
        icon: "error",
        });
    </script>
@endif
@if(Session::get('wrong2'))
    <script>
        swal({
        title: "Wrong",
        text: "Password and Confirm Password not match",
        icon: "error",
        });
    </script>
@endif
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
         @import url(https://fonts.googleapis.com/css?family=Cookie|Raleway:300,700,400);
/* *{
	box-sizing: border-box;
	font-size: 1em;
	margin: 0;
	padding: 0;
	overflow: hidden;
} */
body{
	background-image: url('img/bg-1.jpg') center no-repeat;
	background-size: cover;
	color: #333;
	font-size: 18px;
	font-family: 'Raleway', sans-serif;
}
.container1{
	border-radius: 0.5em;
	box-shadow: 0 0 1em 0 rgba(51,51,51,0.25);
	display: block;
	max-width: 380px;
	overflow: hidden;
	-webkit-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	padding: 2em;
	position: absolute;
		top: 33%;
		left: 50%;
		z-index: 1;
width: 98%;
height: auto;
}

.footer{
margin-top: 480px;
}
.container1:before{
background: url('img/bg-1.jpg') center no-repeat;
background-size: cover;
content: '';
-webkit-filter: blur(10px);
filter: blur(10px);
height: 100vh;
position: absolute;
    top: 50%;
    left: 50%;
    z-index: -1;
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
width: 100vw;
}
.container1:after{
background: rgba(255,255,255,0.6);
content: '';
display: block;
height: 100%;
position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
width: 100%;
}

form button.submit{
background: rgba(255,255,255,0.25);
border: 1px solid #333;
line-height: 1em;
padding: 0.5em 0.5em;
-webkit-transition: all 0.25s;
transition: all 0.25s;
}
form button:hover,
form button:focus,
form button:active,
form button.loading{
background: #333;
color: #fff;
outline: none;
}
form button.success{
background: #27ae60;
border-color: #27ae60;
color: #fff;
}
@-webkit-keyframes spin{
from{ transform: rotate(0deg); }
to{ transform: rotate(360deg); }
}
@keyframes spin{
from{ transform: rotate(0deg); }
to{ transform: rotate(360deg); }
}
form button span.loading-spinner{
-webkit-animation: spin 0.5s linear infinite;
animation: spin 0.5s linear infinite;
border: 2px solid #fff;
border-top-color: transparent;
border-radius: 50%;
display: inline-block;
height: 1em;
width: 1em;
}

form label{
border-bottom: 1px solid #333;
display: block;
font-size: 1.25em;
margin-bottom: 0.5em;
-webkit-transition: all 0.25s;
transition: all 0.25s;
}
form label.col-one-half1{
float: left;
width: 50%;
}
form label.col-one-half1:nth-of-type(even){
border-left: 1px solid #333;
padding-left: 0.25em;
}
form label input{
background: none;
border: none;
line-height: 1em;
font-weight: 300;
padding: 0.125em 0.25em;
width: 100%;
}
form label input:focus{
outline: none;
}
form label input:-webkit-autofill{
background-color: transparent !important;
}
form label span.label-text1{
display: block;
font-size: 0.5em;
font-weight: bold;
padding-left: 0.5em;
text-transform: uppercase;
-webkit-transition: all 0.25s;
transition: all 0.25s;
}
form label.checkbox1{
border-bottom: 0;
text-align: center;
}
form label.checkbox1 input{
display: none;
}
form label.checkbox1 span{
font-size: 0.5em;
}
form label.checkbox1 span:before{
content: '\e157';
display: inline-block;
font-family: 'Glyphicons Halflings';
font-size: 1.125em;
padding-right: 0.25em;
position: relative;
    top: 1px;
}
form label.checkbox1 input:checked + span:before{content: '\e067';}
form label.invalid{border-color: #c0392b !important;}
form label.invalid span.label-text1{color: #c0392b;}
form label.password1{position: relative;}
form label.password1 button.toggle-visibility1{
background: none;
border: none;
cursor: pointer;
font-size: 0.75em;
line-height: 1em;
position: absolute;
    top: 50%;
    right: 0.5em;
text-align: center;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
-webkit-transition: all 0.25s;
transition: all 0.25s;
}
form label.password1 button.toggle-visibility1:hover,
form label.password1 button.toggle-visibility1:focus,
form label.password1 button.toggle-visibility1:active{
color: #000;
outline: none;
}
form label.password1 button.toggle-visibility1 span{vertical-align: middle;}

.container1 h1{
font-size: 3em;
margin: 0 0 0.5em 0;
text-align: center;
font-family: 'Cookie', cursive;
}
.registerlogo img{
height: auto;
margin: 0 auto;
max-width: 240px;
width: 100%;
}
/* html{
font-size: 18px;
height: 100%;
} */

.text-center1{
text-align: center;
font-family: 'Cookie', cursive;
}

registration-form1{
margin: 0 auto;
height: 520px;
}
    </style>
</head>
<body>
<div class="container1">

{{-- <header>
    <h1>
        <a href="#" class="registerlogo">
            <img src="http://tfgms.com/sandbox/dailyui/logo-1.png" alt="Authentic Collection">
        </a>
    </h1>
</header> --}}
<h1 class="text-center1">Register</h1>
<form method="POST" action="/registersubmit">
    @csrf
    <label class="col-one-half1">
        <span class="label-text1">Name</span>
        <input type="text" name="name" placeholder="Name" maxlength="50"  required="required" value="{{old('name')}}" />
    </label>
    <label class="col-one-half1">
        <span class="label-text1">Phone</span>
        <input type="text" name="phone" placeholder="Phone"  maxlength="14" required="required" value="{{old('phone')}}" />
    </label>
    <label class="col-one-half1">
        <span class="label-text1">Email</span>
        <input type="text"  name="email" placeholder="Email" maxlength="30" required="required" value="{{old('email')}}" />
    </label>
    <label class="col-one-half1">
        <span class="label-text1">Age</span>
        <input type="text"  name="age" placeholder="Age"  pattern="[1-9]{2}" required="required"  title="Please enter numeric only." value="{{old('age')}}" />
    </label>
    <label>
        <span class="label-text1">Password</span>
        <input type="password"  name="password" id="password" placeholder="Password"  maxlength="50" required="required" value="{{old('password')}}" />
    </label>
    <label>
        <span class="label-text1">Confirm Password</span>
        <input type="password"  name="cpassword" id="cpassword" placeholder="Confirm Password"  maxlength="50" required="required" value="{{old('cpassword')}}" />
    </label>
    <script type="text/javascript">
        $('#password, #cpassword').on('keyup', function () {
            if ($('#password').val() == $('#cpassword').val()) {
                $('#message').html('Password matching').css('color', 'green');
            } else
                $('#message').html('Password not matching with Confirm Password.Please enter again!').css('color', 'red');
        });
        function Validate() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("cpassword").value;
            if (password != confirmPassword) {
                alert("Passwords do not match with Confirm Password.");
                return false;
            }
            return true;
        }
    </script>
      <span id="message"></span>
    <div class="text-center1">
        <button type="submit">Submit</button>
    </div>
</form>
</div>
</body>
</html>



@include('Student/footer')
