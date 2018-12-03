<?php

use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    use \Illuminate\Foundation\Testing\WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUpFaker();

        factory(App\Models\Subscriber::class, 50)
            ->create()
            ->each(function (\App\Models\Subscriber $subscriber) {
                for ($i = 1; $i <= mt_rand(2, 5); $i++) {
                    /** @var \App\Models\Field $field */
                    $field = \App\Models\Field::inRandomOrder()->first();

                    // String type
                    $value = str_random();

                    if ($field->type == \App\Models\Field::TYPE_BOOLEAN) {
                        $value = $this->faker->boolean;
                    }

                    if ($field->type == \App\Models\Field::TYPE_DATE) {
                        $value = now()->subDays(mt_rand(1, 100));
                    }

                    if ($field->type == \App\Models\Field::TYPE_NUMBER) {
                        $value = $this->faker->numberBetween(1, 1000);
                    }

                    $subscriber->fields()->attach($field->id, ['value' => $value]);
                }
            });
    }
}
