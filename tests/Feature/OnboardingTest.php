<?php

namespace Tests\Feature;

use App\Repositories\AppPerformance;
use App\User;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\Concerns\RefreshDatabase;

class OnboardingTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * checks db connection is correct
     */

    /** @test */
    public function doesCreateDefaults()
    {
        $oDefaultUser = factory(User::class)->create();

        $oUser = User::find($oDefaultUser->user_id);

        $this->assertEquals(0, $oUser->onboarding_percentage);
        $this->assertEquals(0, $oUser->count_applications);
        $this->assertEquals(0, $oUser->accepted_applications);
        $this->assertEquals(date('Y-m-d'), $oUser->created_at);
    }

    /** @test */
    public function doesCreateMaximums()
    {
        //sample maximums. not equivalent to max number of integers but max numbers of real life.
        $oDefaultUser = factory(User::class)->create(['onboarding_percentage' => 100, 'count_applications' => 65000, 'accepted_applications' => 58000]);

        $oUser = User::find($oDefaultUser->user_id);

        $this->assertEquals(100, $oUser->onboarding_percentage);
        $this->assertEquals(65000, $oUser->count_applications);
        $this->assertEquals(58000, $oUser->accepted_applications);
        $this->assertEquals(date('Y-m-d'), $oUser->created_at);
    }

    /** @test */
    public function createsOnboardGraphDataWithDefaults()
    {
        $oDefaultUser = factory(User::class)->create();

        $oAppPerformance = new AppPerformance();
        $aData = $oAppPerformance->getOnboardData();

        $oDate = new \DateTime();
        $iWeek = $oDate->format("W");

        $this->assertTrue(array_key_exists($iWeek, $aData['weekly_counts']));
        $this->assertEquals("$iWeek week", $aData['graph_data'][0]['name']);
    }


    /** @test */
    public function createsOnboardGraphDataWithMaximums()
    {
        $oDefaultUser = factory(User::class)->create(['onboarding_percentage' => 100, 'count_applications' => 65000, 'accepted_applications' => 58000]);

        $oAppPerformance = new AppPerformance();
        $aData = $oAppPerformance->getOnboardData();

        $oDate = new \DateTime();
        $iWeek = $oDate->format("W");

        $this->assertTrue(array_key_exists($iWeek, $aData['weekly_counts']));
        $this->assertEquals("$iWeek week", $aData['graph_data'][0]['name']);
    }

    /** @test */
    public function isAStep()
    {
        // 77 is not a step of onboarding.
        $oDefaultUser = factory(User::class)->create(['onboarding_percentage' => 99]);

        $oAppPerformance = new AppPerformance();
        $aData = $oAppPerformance->getOnboardData();

        $oDate = new \DateTime();
        $iWeek = $oDate->format("W");

        $this->assertTrue(array_key_exists(99, $aData['weekly_counts'][$iWeek]));
    }

    /** @test */
    public function isNotAStep()
    {
        // 77 is not a step of onboarding.
        $oDefaultUser = factory(User::class)->create(['onboarding_percentage' => 77]);

        $oAppPerformance = new AppPerformance();
        $aData = $oAppPerformance->getOnboardData();

        $oDate = new \DateTime();
        $iWeek = $oDate->format("W");

        $this->assertFalse(array_key_exists(77, isset($aData['weekly_counts'][$iWeek]) ? $aData['weekly_counts'][$iWeek] : array()));
    }

    /** @test */
    public function hasValidStepsOnly()
    {
        //valid steps
        factory(User::class)->create(['onboarding_percentage' => 100]);
        factory(User::class)->create(['onboarding_percentage' => 99]);
        factory(User::class)->create(['onboarding_percentage' => 90]);
        factory(User::class)->create(['onboarding_percentage' => 70]);
        factory(User::class)->create(['onboarding_percentage' => 50]);
        factory(User::class)->create(['onboarding_percentage' => 40]);
        factory(User::class)->create(['onboarding_percentage' => 20]);
        factory(User::class)->create(['onboarding_percentage' => 0]);

        //invalid step (none considering steps)
        factory(User::class)->create(['onboarding_percentage' => 15]);
        factory(User::class)->create(['onboarding_percentage' => 66]);

        $oAppPerformance = new AppPerformance();
        $aData = $oAppPerformance->getOnboardData();

        $oDate = new \DateTime();
        $iWeek = $oDate->format("W");

        $this->assertEquals(8, count($aData['weekly_counts'][$iWeek]));
    }

    /**
     * Correct json structure returns for graph
     *
     * @return void
     */
    /** @test */
    public function checkOnboardingGraphDataResponse()
    {
        factory(User::class)->create(['onboarding_percentage' => 0]);

        $response = $this->json('GET', '/admin/graph/onboarding');

        $response->assertStatus(200)
            ->assertJson([0 => [
                'name' => true,
                'data' => []
            ]
            ]);
    }

}

