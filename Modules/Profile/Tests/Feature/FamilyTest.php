<?php

namespace Modules\Profile\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Modules\Profile\Entities\PersonalDetail;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Datakraf\User;

class FamilyTest extends TestCase
{
    use RefreshDatabase, WithFaker,WithoutMiddleware;

    public function test_user_can_view_family_page()
    {
        $response = $this->get('profile/family');
        $response->assertSuccessful();
        $response->assertViewIs('profile::forms.personal-details.family-details');
    }

    public function test_user_can_save_familiy_data()
    {
        $this->test_user_can_view_family_page();

        $user = factory(User::class)->create();
        $data = [
            [

            ]
        ];

        $personalDetail = Family::createMany($data);

        $this
            ->post(route('profile.store'), $data)
            ->assertStatus(200)
            ->assertRedirect(route('home'))
            ->assertSessionHas('message', 'Create data successful!');
    }
}
   