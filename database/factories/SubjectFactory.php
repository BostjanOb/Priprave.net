<?php

namespace Database\Factories;

use App\Models\SchoolType;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'school_type_id' => SchoolType::factory(),
            'name' => fake()->unique()->word(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Subject $subject): void {
            $subject->schoolTypes()->syncWithoutDetaching([(int) $subject->school_type_id]);
        });
    }

    public function forSchoolType(SchoolType|int $schoolType): static
    {
        return $this->state(fn (): array => [
            'school_type_id' => $schoolType instanceof SchoolType ? $schoolType->id : $schoolType,
        ]);
    }
}
