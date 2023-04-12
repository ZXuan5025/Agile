<?php

namespace Tests\Unit;

use App\Models\Evaluations;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EvaTest extends TestCase
{
    /** @test */
    public function test_creates_a_new_eva(){
        $this->withoutMiddleware();
        $enrollmentID = 4;
        $data = [
            'vote1' => 3,
            'vote2' => 4,
            'vote3' => 5,
            'vote4' => 3,
            'vote5' => 3,
            'vote6' => 5,
            'vote7' => 4,
            'vote8' => 4,
            'vote9' => 5,
            'vote10' =>3,
            'evaComment' => 'xxx',
        ];
        $response = $this->post('/createEvaluation/create/'.$enrollmentID, $data);

        $response->assertStatus(302);
        // Check that the evaluation has been assigned in the database
        $evaluation = Evaluations::where('eID', $enrollmentID)->first();
        $this->assertNotNull($evaluation);
    }

    /** @test */
    public function test_updates_existing_eva(){
        $this->withoutMiddleware();
        $existing = Evaluations::where('eID', 4)->first();
        $data = [
            'vote1' => 3,
            'vote2' => 4,
            'vote3' => 5,
            'vote4' => 3,
            'vote5' => 2,
            'vote6' => 5,
            'vote7' => 5,
            'vote8' => 4,
            'vote9' => 5,
            'vote10' =>4,
            'evaComment' => 'Updated Evaluation',
        ];
        $response = $this->post('/editEva/edit/'. $existing->id, $data);

        // Check that the evaluation has been assigned in the database
        $evaluation = Evaluations::where('eID', 4)->first();
        $this->assertNotEquals($evaluation,$existing);
        $this->assertEquals(4, $evaluation->evaRate);
    $this->assertEquals('3, 4, 5, 3, 2', $evaluation->evaCourse);
    $this->assertEquals('5, 5, 4, 5, 4', $evaluation->evaStaff);
    $this->assertEquals($data['evaComment'], $evaluation->evaComment);
    }

}
