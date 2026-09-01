<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppearanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $response = $this->get(route('appearance.edit'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_view_the_appearance_controls(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('appearance.edit'));

        $response->assertOk()
            ->assertSee('data-appearance-control="light"', false)
            ->assertSee('data-appearance-control="dark"', false)
            ->assertSee('data-appearance-control="system"', false)
            ->assertSee("x-on:click=\"select('light')\"", false)
            ->assertSee("x-on:click=\"select('dark')\"", false)
            ->assertSee("x-bind:aria-pressed=\"appearance === 'system'\"", false)
            ->assertSee("document.addEventListener('livewire:navigated', handleLivewireNavigation)", false)
            ->assertSee('localStorage.setItem(appearanceKey, appearance)', false);
    }
}
