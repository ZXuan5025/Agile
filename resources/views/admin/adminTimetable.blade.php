<style>
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
</style>
<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
<body><br><br>
<div class="event-schedule-area-two bg-color pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <div class="title-text">
                        <h2>TIMETABLE</h2>
                    </div>
                </div>
            </div>
            <!-- /.col end-->
        </div>
        <!-- row end-->
        <div class="row">
            <div class="col-lg-12">
                <!-- <ul class="nav custom-tab" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="home-taThursday" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Day 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Day 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Day 3</a>
                    </li>
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link" id="sunday-tab" data-toggle="tab" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false">Day 4</a>
                    </li>
                    <li class="nav-item mr-0 d-none d-lg-block">
                        <a class="nav-link" id="monday-tab" data-toggle="tab" href="#monday" role="tab" aria-controls="monday" aria-selected="false">Day 5</a>
                    </li>
                </ul> -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Day</th>
                                        <th scope="col">Speakers</th>
                                        <th scope="col">Session</th>
                                        <!-- <th scope="col">Action</th> -->
                                        <th class="text-center" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adminTimetables as $adminTimetable)
                                    <tr class="inner-box">
                                        <th scope="row">
                                            <div class="event-date">
                                                <span>{{$adminTimetable-> cDay}}</span>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="event-img">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="event-wrap">
                                                <h3><a href="#">{{$adminTimetable-> cName}}</a></h3>
                                                <div class="meta">
                                                    <!-- <div class="organizers">
                                                        <a href="#">Aslan Lingker</a>
                                                    </div>
                                                    <div class="categories">
                                                        <a href="#">Inspire</a>
                                                    </div> -->
                                                    <div class="time">
                                                        <span>{{$adminTimetable->cStartTime}} - {{$adminTimetable->cEndTime}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- <td>
                                            <div class="r-no">
                                                <span>Room B3</span>
                                            </div>
                                        </td>-->
                                        <td>
                                            <div class="primary-btn">
                                                <a class="btn btn-primary myBtn"><i class="fa fa-edit">Update</i></a>
                                            <!-- <button class="myBtn"><i class="fa fa-edit"> Edit</i></button></td> -->
                                            <div class="modal">
                                                <div class="modal-content">
                                                    <span class="close">&times;</span>
                                                    <form method="POST" action="/updateTimetable/{{ $adminTimetable->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="adminID" value=2>
                                                    <label for="title">StartTime</label>
                                                    <input type="text" id="startTime" name="cStartTime" placeholder="09:00:00" value="{{ $adminTimetable->cStartTime }}">

                                                    <label for="content">EndTime</label>
                                                    <input type="textbox" id="endTime" name="cEndTime" placeholder="11:00:00" value="{{ $adminTimetable->cEndTime }}">
                                                    <input type="submit" value="Submit">
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="primary-btn text-center">
                    <a class="btn btn-primary" href="#">Create</a>
                    <a href="#" class="btn btn-primary">Back</a>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
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