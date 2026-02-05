<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $name = fake()->name();
        $slug = Str::slug($name);

        // $imageUrl = "https://picsum.photos/640/480?random=".rand();
        // $imageName = "images_".uniqid();
        // file_put_contents(public_path('images/'.$imageName. '.jpg'), file_get_contents($imageUrl));

        return [
            'name' => $name,
            'slug' => $slug,
            'price' => fake()->randomFloat(2, 100, 200),
            'sku' => fake()->numerify('sku-#####'),
            'qty' => fake()->randomNumber(3, false),
            'description' => fake()->sentence(),
            'short_description' => fake()->sentence(5),
            'status' => fake()->boolean(),
            // 'image' =>  $imageName. '.jpg',
            'discount_price' => fake()->randomFloat(2, 0, 99),
            'product_category_id' => fake()->randomElement(ProductCategory::pluck('id'))
        ];
    }
}
