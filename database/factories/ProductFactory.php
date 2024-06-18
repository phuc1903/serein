<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = ['01-vcb03-thumb-compress.png', 'bong-tai-bac.png', 'bong-tai-bac-2.png', 'bong-tai-bac-3.png', 'bong-tai-vang-2.png', 'bong-tay-vang.png', 'day-chuyen-vang-dinh-kim-cuong.png', 'Mặt-Dây-Nữ-Vàng-18k-M292.png', 'nhan-vang-18k-dinh-da-citrine-pnj-2.png', 'vong-tay-vang-dinh-kim-cuong.png', 'Vong-Tay-Swarovski-Thien-Nga-Chinh-Hang-Dazzling-Swan-Bracelet-01.png'];

        return [
            'title' => $this->faker->sentence,
            'image' => $this->faker->randomElement($images),
            'price' => $this->faker->numberBetween(1000, 100000),
            'sale' => $this->faker->numberBetween(0, 50),
            'description' => $this->faker->paragraph,
            'detail' => $this->faker->text,
            'status' => $this->faker->numberBetween(0, 1),
            'category_id' => $this->faker->randomElement(Category::select('id')->get()),
        ];
    }
}
