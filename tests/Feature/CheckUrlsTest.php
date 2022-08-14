<?php

namespace Tests\Feature;

use Tests\TestCase;

class CheckUrlsTest extends TestCase
{
    /**
     * A basic test to check urls.
     *
     * @return void
     */
    public function test_check_url_sale()
    {
        $response = $this->get('/sale');

        $response->assertStatus(200);
    }

    public function test_check_url_sales()
    {
        $response = $this->get('/sales');

        $response->assertStatus(200);
    }

    public function test_check_url_dummy_fail()
    {
        $response = $this->get('/dummy');

        $response->assertStatus(404);
    }
}
