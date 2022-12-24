<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        DB::table('photos')->delete();
        return [
            'photoable_type'=>"App\Models\Post",
            'photoable_id'=>1,
            'type'=>"null",
            'src'=>"null"
        ];
    }
}
