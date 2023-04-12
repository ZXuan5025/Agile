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
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Day</th>
                                        <th scope="col">Speakers</th>
                                        <th scope="col">Session</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($timetables as $timetable)
                                    <tr class="inner-box">
                                        <th scope="row">
                                            <div class="event-date">
                                                <span>{{$timetable-> cDay}}</span>
                                            </div>
                                        </th>
                                        <td>
                                            <div class="event-img">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="event-wrap">
                                                <h3><a href="#">{{$timetable-> cName}}</a></h3>
                                                <div class="meta">
                                                    <div class="time">
                                                        <span>{{$timetable->cStartTime}} - {{$timetable->cEndTime}}</span>
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
                    <a href="#" class="btn btn-primary">Back</a>
                </div>
                <br><br>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    </div>
</div>
</body>
</html>