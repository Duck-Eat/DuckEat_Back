<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Message;
use App\Models\Note;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Type::factory(4)->create();

        User::factory(500)->create()->each(function($user) {

                Restaurant::factory()->create([
                    'user_id' => $user->id
                ])->types()->save(Type::all()->random());
                Restaurant::factory()->create([
                    'user_id' => $user->id
                ])->types()->save(Type::all()->random());


            $user->types()->save(Type::all()->random());
        });

        User::each(function($user) {
            Message::factory(10)->create([
                'user_id' => $user->id,
                'from_user_id' => User::where('id', '!=', $user->id)->inRandomOrder(1)->first()
            ]);

            Note::factory()->create([
                'restaurant_id' => Restaurant::all()->random(),
                'user_id' => $user->id
            ]);
        });

        $this->command->getOutput()->writeln('');
    }
}
