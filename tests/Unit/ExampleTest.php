<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testAuthForgot()
    {
        $response = $this->get('/auth/forgot');
        $response->assertOk();
    }


    public function testAuthLogin()
    {
        $response = $this->get('/auth/login');
        $response->assertOk();
    }


    public function testAuthRegistration()
    {
        $response = $this->get('/auth/registration');
        $response->assertOk();
    }
}
