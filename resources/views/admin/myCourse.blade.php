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
    <title>Staff Course</title>
</head>
<body>
    <div class="main">
        <h1 class="logo" style="color: #7f5539;">My Course</h1>
        @foreach ($courses as $course) 
        <div class="course-item">
            <div class="course-title">
                <h2 style="font-size: 20px;">{{ $course->cName }}</h2>
            </div>
            <div class="course-desc">
                <p>@if ($course->cDay == 1) Monday 
                    @elseif ($course->cDay == 2) Tuesday
                    @elseif ($course->cDay == 3) Wednesday
                    @elseif ($course->cDay == 4) Thursday
                    @elseif ($course->cDay == 5) Friday
                    @elseif ($course->cDay == 6) Saturday 
                    @else ($course->cDay == 7) Sunday
                    @endif<br>
                    {{ $course->cStartTime}} - {{ $course->cEndTime}}<br>
                    {{ $course->cDescription }}
                </p>
                <!-- <label for="myfile" class="btn">
                  <span>Upload Materials</span>
                </label>
                <input type="file" style="display:none;" id="myfile" name="myfile"> -->
                <form method="POST" action="/uploadMaterials" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <input type="file" name="file">
                  <input type="hidden" name="courseID" value="{{ $course->id }}" >
                  <button type="submit">Upload</button>
                </form>
                <button class="myBtn">Students</button>
                <div class="modal" style=" overflow-y: scroll;">
                  <div class="modal-content">
                      <span class="close">&times;</span>
                      
                      <table>
                        <colgroup>
                          <col style="width: 10%;">
                          <col style="width: 20%;">
                          <col style="width: 50%;">
                          <col style="width: 10%;">
                        </colgroup>
                        <tr>
                          <th>No</th><th>Student Name</th><th>Progress</th><th>Action</th>
                        </tr> 
                        @php
                        $students = app('App\Http\Controllers\AchievementController')->courseStudent($course->id);
                        $i = 1;
                        @endphp
                        @foreach($students as $student)
                        
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ $student->name }}</td>
                          <form method="POST" action="/assignAchievement/{{ $student->eID }}">
                          @csrf
                          @method('PUT')
                          <td>
                            <input type="hidden" name="aID" value="{{ $student->aID }}">
                            <select id="progress" name="progress" class="progress" onchange="showTextbox()">
                              @for ($j=0; $j<=10; $j++)
                              @if ($j*10 == $student->progress)
                              <option value="{{ $j*10 }}" selected>{{ $j*10 }}</option>
                              @else
                              <option value="{{ $j*10 }}">{{ $j*10 }}</option>
                              @endif
                              @endfor
                            </select>
                            
                            <input type="text" name="title" class="title" placeholder="Title" value="{{ $student->acTitle }}" style="display: none">
                            <input type="text" name="result" class="result" placeholder="Result" value="{{ $student->acResult }}" style="display: none">
                          </td>
                          <td><input type="submit" value="Save"></td>
                          </form>
                        </tr> 
                        @php
                        $i++;
                        @endphp
                        @endforeach
                      </table>
                  </div>
                </div>
          </div>
        </div>
        @endforeach
    </div>
    @if (session('success'))
    <script>
        {!! session('success') !!}
    </script>
    @endif
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

        function showTextbox() {
          var dropdowns = document.querySelectorAll(".progress");
          var titles = document.querySelectorAll(".title");
          var results = document.querySelectorAll(".result");
          dropdowns.forEach(function(dropdown, index) {
              if (dropdown.value == 100) {
                  dropdowns[index].style.width = "20%"; dropdowns[index].style.float = "left";
                  titles[index].style.display = "block"; titles[index].style.width = "34%"; titles[index].style.float = "left";
                  results[index].style.display = "block"; results[index].style.width = "45%"; results[index].style.float = "left";
              } else {
                  titles[index].style.display = "none"; titles[index].style.width = "100%";
                  results[index].style.display = "none"; results[index].style.width = "100%";
                  dropdowns[index].style.width = "100%";
              }
          });
      }
    </script>
</body>
</html>