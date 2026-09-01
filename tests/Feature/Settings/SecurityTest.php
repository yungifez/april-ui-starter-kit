<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_security_settings_page_requires_password_confirmation(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('security.edit'))
            ->assertRedirect(route('password.confirm'));
    }

    public function test_security_settings_page_renders_password_controls(): void
    {
        $this->actingAs($user = User::factory()->create())
            ->withSession(['auth.password_confirmed_at' => time()])
            ->get(route('security.edit'))
            ->assertOk()
            ->assertSee('Update password')
            ->assertSee('Current password')
            ->assertDontSee('Passkeys')
            ->assertDontSee('Two-factor authentication');
    }

    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);

        $this->actingAs($user);

        Livewire::test('pages::settings.security')
            ->set('current_password', 'password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('updatePassword')
            ->assertHasNoErrors();

        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    public function test_password_update_requires_the_current_password(): void
    {
        $user = User::factory()->create(['password' => Hash::make('password')]);

        $this->actingAs($user);

        Livewire::test('pages::settings.security')
            ->set('current_password', 'wrong-password')
            ->set('password', 'new-password')
            ->set('password_confirmation', 'new-password')
            ->call('updatePassword')
            ->assertHasErrors(['current_password']);
    }
}
