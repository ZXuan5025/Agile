<?php

namespace Tests\Unit;

use App\Models\Achievement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AchievementTest extends TestCase
{


    /** @test */
    public function test_creates_a_new_ahievement(){
        $this->withoutMiddleware();
        $enrollmentID = 5;
        $data = [
            'progress' => 30,
            'acTiTle' => '',
            'acResult' => '',
        ];

        //to check database do not have $data
        $this->assertDatabaseMissing('achievements', [
            'eID' => $enrollmentID,
            'progress' => $data['progress'],
        ]);

        //create achievement
        $this->put('/assignAchievement/'.$enrollmentID, $data);

        //to check database has new record $data
        $this->assertDatabaseHas('achievements', [
            'eID' => $enrollmentID,
            'progress' => $data['progress'],
        ]);
    } 
   
    /** @test */
    public function test_update_existing_ahievement(){
        $this->withoutMiddleware();
        $enrollmentID = 5;
        $existing = Achievement::where('eID',$enrollmentID)->first();

        //to test there is existing record with enrollmentID = 5
        $this->assertNotNull($existing);

        $data = [
            'aID' => $existing->id,
            'progress' => 100,
            'title' => 'Cisco',
            'result' => '2022 Badge of Cisco',
        ];
        
        //edit achievement
        $this->put('/assignAchievement/'.$enrollmentID, $data);

        //check new record is updated as $data
        $this->assertDatabaseHas('achievements', [
            'eID' => $enrollmentID,
            'progress' => $data['progress'],
            'acTitle' => $data['title'],
            'acResult' => $data['result'],
        ]);
    
    } 
}
