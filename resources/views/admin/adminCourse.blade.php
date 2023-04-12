<style>
  body{
  /* overflow: hidden; */
  background-color: #7f5539;
}

.body{
  width: 70%;
  margin: 0 15% 0 15%;
  min-height: 100vh;
}

.collapsible {
    background-color: #b08968;
    color: white;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 18px;
  }

  .collapsible i{
    float: right;
  }
  
  .active1, .collapsible:hover {
    background-color: #b08968;
  }
  
  .content1 {
    padding: 20px 18px;
    display: none;
    overflow: hidden;
    background-color: #f1f1f1;
  }

  .ann_date{
    text-align: right;
  }

  /* Achievement */
  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 70%;
  height: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

/* form */
input[type=text], textarea, select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.left, .right{
  width: 50%;
  float: left;
  padding: 10px;
}

.course input[type=text], input[type=time], textarea, select {
  width: 80%;
  float: left;
  padding: 12px 20px;
  margin: 8px 0;
}

.course label{
  float: left;
  width: 20%;
}

input[type=textbox] {
  height: 300px;
}

input[type=submit] {
  width: 100%;
  background-color: #b08968;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #7f5539;
}

button{border-radius: 8px;background-color: #7f5539; border: none; color: white;padding: 10px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;width: 80%;}
</style>
@include('admin/adminHeader')

<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>SmartEDU - Education Responsive HTML5 Template</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="Student/images/favicon.ico" type="Student/images/x-icon" />
    <link rel="apple-touch-icon" href="Student/images/apple-touch-icon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Student/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="Student/css/style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="Student/css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="Student/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Student/css/custom.css">
    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<!-- SweetAlert JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


    <!-- Modernizer for Portfolio -->
    <script src="Student/js/modernizer.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body> 
  <div class="main">
	<div class="all-title-box">
		<div class="container text-center">
			<h1>Courses<span class="m_1">Lorem Ipsum dolroin gravida nibh vel velit.</span></h1>
		</div>
    @error('message')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

	</div>
	
    <div id="overviews" class="section wb">
        <div class="container">
            <div class="section-title row text-center">
                <div class="col-md-8 offset-md-2">
                    <p class="lead">Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem!</p>
                </div>
            </div><!-- end title -->
            <div class="primary-btn">
              <!-- <a class="btn btn-primary myBtn" style="color: white;"><i class="fa fa-edit"></i></a> -->
          <button class="btn btn-primary myBtn"> Create</button></td>
          <div class="modal">
              <div class="modal-content">
                  <span class="close">&times;</span>
                  <form method="POST" action="/createCourse" class="course">
                  @csrf
                  @method('PUT')
                  <div class="left">
                  <input type="hidden" id="staffID" name="staffID" value=2>
                  <label for="title">Course Name</label>
                  <input type="text" id="cName" name="cName" value="{{old('cName')}}" required>

                  <label for="content">Course Description</label>
                  <textarea id="cDescription" style="height: 250px" name="cDescription" value="{{old('cDescription')}}" required>{{old('cDescription')}}</textarea>
                  </div>
                  <div class="right">
                  <label for="title">Course Price</label>
                  <input type="text" id="cPrice" name="cPrice" value="{{old('cPrice')}}" required>

                  <label for="content">Course Day</label>
                  <select name="cDay">
                    <option name="cDay" id="day1" value="1">Monday</option>
                    <option name="cDay" id="day2" value="2">Tuesday</option>
                    <option name="cDay" id="day3" value="3">Wednesday</option>
                    <option name="cDay" id="day4" value="4">Thursday</option>
                    <option name="cDay" id="day5" value="5">Friday</option>
                    <option name="cDay" id="day6" value="6">Saturday</option>
                    <option name="cDay" id="day7" value="7">Sunday</option>
                  </select>
                  <!-- <input type="text" id="cDay" name="cDay" value="{{old('cDay')}}" required> -->

                  <label for="title">StartTime</label>
                  <input type="time" id="startTime" name="cStartTime" value="{{old('cStartTime')}}" required>

                  <label for="content">EndTime</label>
                  <input type="time" id="endTime" name="cEndTime" value="{{old('cEndTime')}}" required>
                  </div>
                  <input type="submit" value="Submit">
                  </form>
              </div>
              </div>
          </div>
          <hr class="invis"> 
          <div class="row"> 
          @foreach ($courses as $course)
            
            <div class="col-lg-3 col-md-6 col-12">
              <div class="course-item">
						    <div class="image-blog">
                  <img src="Student/images/blog_1.jpg" alt="" class="img-fluid">
                </div>
						    <div class="course-br">
							    <div class="course-title">   
                    <div class="course">
                        <div class="course-title">
                            <h2><a href="#" title="">{{ $course->cName }}</a></h2>
                        </div>
                        <div class="course-desc">
                            <p>{{ $course->cDescription }}</p>
                        </div>
                    </div>

							<div class="course-rating">
								4.5
								<i class="fa fa-star"></i>	
								<i class="fa fa-star"></i>	
								<i class="fa fa-star"></i>	
								<i  class="fa fa-star"></i>	
								<i class="fa fa-star-half"></i>		
                <div class="primary-btn">
                  <a class="btn btn-primary myBtn" style="color: white;"><i class="fa fa-edit"></i></a>
              <!-- <button class="myBtn"><i class="fa fa-edit"> Edit</i></button></td> -->
              <div class="modal">
                  <div class="modal-content">
                      <span class="close">&times;</span>
                      <form method="POST" action="/updateCourse/{{ $course->id }}">
                      @csrf
                      @method('PUT')
                      <input type="hidden" id="staffID" name="staffID" value=2>
                      <div class="left">
                      <label for="title">Course Name</label>
                      <input type="text" id="cName" name="cName" value="{{ $course->cName }}" required>
  
                      <label for="content">Course Description</label>
                      <textarea type="text" id="cDescription" style="height: 110px; width: 600px;" name="cDescription" value="{{ $course->cDescription }}" required>{{ $course->cDescription }}</textarea>
                      </div>
                      <div class="right">
                      <label for="title">Course Price</label>
                      <input type="number" step=".01" id="cPrice" name="cPrice" value="{{ $course->cPrice }}" required>
  
                      <label for="content">Course Day</label>
                      <select name="cDay">
                        <option name="cDay" id="day1" value="1">Monday</option>
                        <option name="cDay" id="day2" value="2">Tuesday</option>
                        <option name="cDay" id="day3" value="3">Wednesday</option>
                        <option name="cDay" id="day4" value="4">Thursday</option>
                        <option name="cDay" id="day5" value="5">Friday</option>
                        <option name="cDay" id="day6" value="6">Saturday</option>
                        <option name="cDay" id="day7" value="7">Sunday</option>
                      </select>
                    
                      <label for="title">StartTime</label>
                      <input type="time" id="startTime" name="cStartTime" value="{{ $course->cStartTime }}" required>
  
                      <label for="content">EndTime</label><br>
                      <input type="time" id="endTime" name="cEndTime" value="{{ $course->cEndTime }}" required>
                      </div>
                      <input type="submit" value="Submit">
                    </form>                    
                  </div>
                  </div>
                  <form action="{{ route('course.deleteCourse', ['id' => $course->id]) }}) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i></button>
                </form>		
              </div>

							</div>
						</div>
					</div>
                    </div>
                    </div> 
                     
                <!-- <a class="btn btn-primary myBtn" style="color: white;"><i class="fa fa-edit"></i></a> -->
            
            
            @endforeach
        </div><!-- end col -->
    </div><!-- end row -->
  </div>     
</div>   
    <!-- ALL JS FILES -->
    <script src="Student/js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="Student/js/custom.js"></script>
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