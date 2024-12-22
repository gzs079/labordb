<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Parameter;
use App\Models\Result;
use App\Models\Sample;
use App\Models\Unit;

use function Laravel\Prompts\select;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Result::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $value = $this->generateValue();
        return [
            'sample_id' => Sample::inRandomOrder()->first()->id,
            'parameter_id' => Parameter::inRandomOrder()->first()->id,
            'unit_id' => Unit::inRandomOrder()->first()->id,
            'value' => $value,
            'loq' => $this->loq($value),
            'maxrange' => $this->maxrange($value),
            'valueassigned' => $this->valueassigned($value),
        ];
    }

    private function generateValue() {

        $randomChoice = $this->faker->numberBetween(1, 100);

        if ($randomChoice<3) {
            return $this->faker->regexify('[A-Za-z]{10}');
        }
        elseif ($randomChoice<5) {
            return ">" . $this->faker->numberBetween(500, 600);
        }
        elseif ($randomChoice<10) {
            return ">" . "0." . $this->faker->numberBetween(10, 100);
        }
        elseif ($randomChoice<15) {
            return ">" . "0," . $this->faker->numberBetween(10, 100);
        }
        elseif ($randomChoice<20) {
            return "<" . $this->faker->numberBetween(1, 10);
        }
        elseif ($randomChoice<25) {
            return "<" . "1." . $this->faker->numberBetween(10, 100);
        }
        elseif ($randomChoice<30) {
            return "<" . "1," . $this->faker->numberBetween(10, 100);
        }
        elseif ($randomChoice<35) {
            return 0;
        }
        elseif ($randomChoice<55) {
            return $this->faker->numberBetween(1, 10) . '.' . $this->faker->numberBetween(1, 100);
        }
        elseif ($randomChoice<75) {
            return $this->faker->numberBetween(1, 10) . ',' . $this->faker->numberBetween(1, 100);
        }
        else {
            return $this->faker->numberBetween(10, 500);
        }

    }

    private function loq($value) {

        $value = str_replace(',','.',$value);

        if (substr($value, 0, 1) === '<') {
            return (float) substr($value, 1);
        }
        return null;
    }

    private function maxrange($value) {

        $value = str_replace(',','.',$value);

        if (substr($value, 0, 1) === '>') {
            return (float) substr($value, 1);
        }
        return null;
    }

    private function valueassigned($value) {

        $value = str_replace(',','.',$value);

        if (substr($value, 0, 1) === '<') {
            return (float) substr($value, 1)/2.;
        }
        elseif (substr($value, 0, 1) === '>') {
            return (float) substr($value, 1);
        }
        else {
            if (is_numeric($value)) {
                return (float)$value;
            }
            else {
                return null;
            }
        }
    }

}