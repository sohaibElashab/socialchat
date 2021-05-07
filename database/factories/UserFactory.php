<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'mobile' => $this->faker->phoneNumber,
            'adress' => $this->faker->address,
            'website' => 'https://www.google.com/', 
            'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'gender' => $gender,
            'facebook' => 'https://web.facebook.com/',
            'twitter' => 'https://twitter.com/',
            'instagram' => 'https://www.instagram.com/',
            'youtube' => 'https://www.youtube.com/', 
            'linkedin' => 'https://www.linkedin.com/', 
            'about' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'quote' => $this->faker->realText($maxNbChars = 200, $indexSize = 2) ,
            'interested' => 'Designing',
            'language' => 'English, French',
            'remember_token' => Str::random(10),
            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
