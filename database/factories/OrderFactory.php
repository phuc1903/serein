<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'payment_method' => $this->faker->randomElement(['momo', 'cod']),
            'total_price' => 0,  // Tạm thời để 0, sẽ cập nhật sau
            'status' => $this->faker->randomElement(['Đang giao hàng', 'Đang xét duyệt', 'Giao hàng thành công', 'Đã hủy']),
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),  // Dùng pluck thay vì select
        ];
    }

    public function createOrderDetails(int $count = 3): Factory
    {
        return $this->afterCreating(function (Order $order) use ($count) {
            $orderDetails = OrderDetail::factory()->count($count)->create([
                'order_id' => $order->id,
                'product_id' => $this->faker->randomElement(Product::pluck('id')->toArray()),  // Dùng pluck thay vì select
            ]);

            $totalPrice = $orderDetails->sum(function ($orderDetail) {
                return $orderDetail->price * $orderDetail->quantity;
            });

            $order->update(['total_price' => $totalPrice]);
        });
    }
}
