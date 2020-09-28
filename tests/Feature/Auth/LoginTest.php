<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use DatabaseTransactions;

    public function testBasicTest(): void
    {
        $response = $this->get('/login/');

        $response->assertStatus(200)
            ->assertSee('E-Mail Address')
            ->assertSee('Password');
    }

    public function testErrors(): void
    {

        $response = $this->post('/login/', [
            'email'    => '',
            'password' => '',
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function testWhite(): void
    {

        $user = factory(User::class)->create(['status' => User::STATUS_WAIT]);

        $response = $this->post('/login/', [
            'email'    => $user->email,
            'password' => 'secret',
        ]);

        $response->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas('error', 'You need confirm your account. Please check your email!');
    }

    public function testActive(): void
    {

        $user = factory(User::class)->create(['status' => User::STATUS_ACTIVE]);

        $response = $this->post('/login/', [
            'email'    => $user->email,
            'password' => 'secret',
        ]);

        $response->assertStatus(302)
            ->assertRedirect('/cabinet');

        $this->assertAuthenticated();
    }
}
