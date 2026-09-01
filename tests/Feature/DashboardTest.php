<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_visit_the_dashboard(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('dashboard'));
        $response->assertOk()
            ->assertSee('pattern-', false)
            ->assertDontSee('Recent activity')
            ->assertDontSee('Projects')
            ->assertDontSee('Maya Chen');
    }

    public function test_the_sidebar_uses_the_persisted_cookie_state(): void
    {
        $user = User::factory()->create();

        $response = $this->withUnencryptedCookies(['sidebar_state' => 'false'])
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertOk()
            ->assertSee('x-data="sidebar(false)"', false);
    }
}
