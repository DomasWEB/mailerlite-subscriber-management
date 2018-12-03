<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class SubscriberTest
 *
 * @package Tests\Unit
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 */
class SubscriberTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function it_has_five_states()
    {
        $states = Subscriber::STATES;

        $this->assertContains(Subscriber::STATE_ACTIVE, $states);
        $this->assertContains(Subscriber::STATE_UNCONFIRMED, $states);
        $this->assertContains(Subscriber::STATE_BOUNCED, $states);
        $this->assertContains(Subscriber::STATE_JUNK, $states);
        $this->assertContains(Subscriber::STATE_UNSUBSCRIBED, $states);
    }

    /** @test */
    public function it_has_an_email()
    {
        /** @var Subscriber $subscriber */
        $subscriber = factory(Subscriber::class)->create([
            'email' => 'info@mailerlite.com',
        ]);

        $subscriber->refresh();

        $this->assertEquals('info@mailerlite.com', $subscriber->email);
    }

    /** @test */
    public function it_has_a_name()
    {
        /** @var Subscriber $subscriber */
        $subscriber = factory(Subscriber::class)->create([
            'name' => 'John',
        ]);

        $subscriber->refresh();

        $this->assertEquals('John', $subscriber->name);
    }

    /** @test */
    public function it_has_a_state()
    {
        /** @var Subscriber $subscriber */
        $subscriber = factory(Subscriber::class)->create([
            'state' => Subscriber::STATE_ACTIVE,
        ]);

        $subscriber->refresh();

        $this->assertEquals(Subscriber::STATE_ACTIVE, $subscriber->state);
    }

    /** @test */
    public function it_has_many_fields_with_values()
    {
        /** @var Field $field */
        $field = factory(Field::class)->create();
        $value = $this->faker->word;

        /** @var Field $field2 */
        $field2 = factory(Field::class)->create();
        $value2 = $this->faker->word;

        /** @var Subscriber $subscriber */
        $subscriber = factory(Subscriber::class)->create();

        $subscriber->fields()->attach($field, ['value' => $value]);

        /** @var Field $firstField */
        $firstField = $subscriber->fields()->where('key', $field->key)->first();
        $this->assertEquals($value, $firstField->getRelation('pivot')->value);

        $subscriber->fields()->attach($field2, ['value' => $value2]);

        /** @var Field $secondField */
        $secondField = $subscriber->fields()->where('key', $field2->key)->first();
        $this->assertEquals($value2, $secondField->getRelation('pivot')->value);

        $this->assertCount(2, $subscriber->fields()->get());
    }
}
