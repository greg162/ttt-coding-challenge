<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicConnection()
    {
        $response = $this->get('/api/events');

        $response->assertStatus(200);
    }

    /* REQUEST START DATE TESTS */

    public function testValidStartDate()
    {
        $response = $this->get('/api/events?start_date=2020+Oct+1');

        $response->assertStatus(200);
    }

    public function testInvalidStartDateDay()
    {
        $response = $this->get('/api/events?start_date=2020+Feb+31');
        $response->assertStatus(422);
    }

    public function testInvalidStartDateFormat()
    {
        $response = $this->get('/api/events?start_date=2020-02-02');
        $response->assertStatus(422);
    }

    /* REQUEST END DATE TESTS */

    public function testValidEndDate()
    {
        $response = $this->get('/api/events?end_date=2020+Oct+1');

        $response->assertStatus(200);
    }

    public function testInvalidEndDateDay()
    {
        $response = $this->get('/api/events?end_date=2020+Feb+31');
        $response->assertStatus(422);
    }

    public function testInvalidEndDateFormat()
    {
        $response = $this->get('/api/events?end_date=2020-02-02');
        $response->assertStatus(422);
    }

    /* REQUEST START AND END DATE TESTS */

    public function testValidStartAndEndDate()
    {
        $response = $this->get('/api/events?start_date=2020+Oct+1&end_date=2020+Oct+31');
        $response->assertStatus(200);
    }


    /* REQUEST QUERY TESTS */

    public function testValidQuery()
    {
        $response = $this->get('/api/events?query=Van');
        $response->assertStatus(200)
        ->assertJsonPath('0.id', 1);
    }

    public function testQueryWithPercentage()
    {
        $response = $this->get('/api/events?query=Van%');

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

}
