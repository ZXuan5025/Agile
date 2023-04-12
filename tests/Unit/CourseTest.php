<?php

namespace Tests\Unit;

use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CourseTest extends TestCase
{
   

    /** @test */
    public function it_creates_a_new_course()
    {
        $data = [
            'staffID' => 5,
            'cName' => 'Software Project Management',
            'cDescription' => 'Here is the description',
            'cPrice' => 199,
            'cDay' => 5,
            'cStartTime' => '09:00:00',
            'cEndTime' => '11:00:00',
        ];

        $this->post('/createCourse', $data);
        $this->assertDatabaseHas('courses', $data);
    }

    /** @test */
    public function error_when_creating_existing_course()
    {
        $data = [
            'staffID' => 5,
            'cName' => 'Blockchain Application Development',
            'cDescription' => 'Here is the description',
            'cPrice' => 199,
            'cDay' => 4,
            'cStartTime' => '09:00:00',
            'cEndTime' => '11:00:00',
        ];

        $cName = Course::where('cName',$data['cName'])->first();
        //true means same value with existing record in database
        $this->assertNotEquals($cName, null);
        
        $this->post('/createCourse', $data);
        $this->assertDatabaseMissing('courses', [
            'id' => DB::table('courses')->orderByDesc('id')->value('id'),
            'cName' => $data['cName'],
        ]);
    }

    /** @test */
    public function error_when_clashing_time()
    {
        $data = [
            'staffID' => 5,
            'cName' => 'Blockchain',
            'cDescription' => 'Here is the description',
            'cPrice' => 199,
            'cDay' => 3,
            'cStartTime' => '09:00:00',
            'cEndTime' => '11:00:00',
        ];

        $course = Course::where('cDay',$data['cDay'])->where('cStartTime',$data['cStartTime'])->first();
        //true means same value with existing record in database
        $this->assertNotEquals($course, null);

        $this->post('/createCourse', $data);
        $this->assertDatabaseMissing('courses', [
            'id' => DB::table('courses')->orderByDesc('id')->value('id'),
            'cName' => $data['cName'],
        ]);
    }
}
