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

class PersonalDetailTest extends TestCase
{
    use RefreshDatabase, WithFaker,WithoutMiddleware;

    public function test_user_can_view_personal_detail_page()
    {
        $response = $this->get('profile');
        $response->assertSuccessful();
        $response->assertViewIs('profile::forms.personal-details.index');
    }

    public function test_user_can_save_data()
    {
        $this->test_user_can_view_personal_detail_page();

        $user = factory(User::class)->create();
        $data = [
            'user_id' => $user->id,
            'name' => $this->faker->name,
            'ic_number' => 910213085769,
            'staff_number' => 'AKA1079',
            'gender' => $this->faker->word,
            'date_of_birth' => $this->faker->date,
            'phone_number' => $this->faker->phoneNumber,
            'mobile_number' => $this->faker->phoneNumber,
            'alternative_email' => $this->faker->email,
            'address_one' => $this->faker->streetAddress,
            'address_two' => $this->faker->secondaryAddress,
            'postcode' => 31550,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'motorcycle_reg_number' => $this->faker->word,
            'car_reg_number' => $this->faker->word
        ];

        $personalDetail = PersonalDetail::create($data);

        $this
            ->post(route('profile.store'), $data)
            ->assertStatus(200)
            ->assertRedirect(route('home'))
            ->assertSessionHas('message', 'Create data successful!');
    }
}
   