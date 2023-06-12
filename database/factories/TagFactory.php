<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tag;

class TagFactory extends Factory
{
    private $categories =  ['Photography','Education','Environtment','Street','Car','Building','House','City'];
    private $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->index = $this->index % count($this->categories);
        $name = $this->categories[$this->index];
        $this->index++;

        return [
            'name' => $name,
            'created_at' => $this->faker->dateTimeBetween('-1 year','now'),
        ];
    }
}
