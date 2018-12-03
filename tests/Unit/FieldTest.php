<?php

namespace Tests\Unit;

use App\Models\Field;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class FieldTest
 *
 * @package Tests\Unit
 * @author Dominykas Tijūnaitis (dominykas@tijunaitis.lt)
 */
class FieldTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    /** @test */
    public function it_has_four_types()
    {
        $types = Field::TYPES;

        $this->assertContains(Field::TYPE_STRING, $types);
        $this->assertContains(Field::TYPE_DATE, $types);
        $this->assertContains(Field::TYPE_BOOLEAN, $types);
        $this->assertContains(Field::TYPE_NUMBER, $types);
    }

    /** @test */
    public function it_has_a_title()
    {
        /** @var Field $field */
        $field = factory(Field::class)->create([
            'title' => 'Title',
        ]);

        $field->refresh();

        $this->assertEquals('Title', $field->title);
    }

    /** @test */
    public function it_has_a_type()
    {
        /** @var Field $field */
        $field = factory(Field::class)->create([
            'type' => Field::TYPE_STRING,
        ]);

        $field->refresh();

        $this->assertEquals(Field::TYPE_STRING, $field->type);
    }

    /** @test */
    public function it_has_a_key()
    {
        $title = $this->faker->words(3, true);

        $fieldFactory = factory(Field::class);

        /** @var Field $field */
        $field        = $fieldFactory->make();
        $field->title = $title; // Use the mutator to generate the key
        $field->save();

        $field->refresh();

        $this->assertEquals(str_slug($title), $field->key);
    }
}
