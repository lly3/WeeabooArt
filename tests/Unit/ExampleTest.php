<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    public function test_that_false_is_false()
    {
        $this->assertFalse(false);
    }

//    public function test_env_is_testing()
//    {
//        $expected = "testing";
//        $actual = env('DB_DATABASE');
//        $this.assertEquals($expected, $actual);
//    }
}
