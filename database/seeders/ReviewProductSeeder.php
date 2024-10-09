<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewProductSeeder extends Seeder
{

    public function run()
    {
        DB::table('review_products')->delete();
        DB::table('review_products')->truncate();

        DB::table('review_products')->insert([
            [
                'id_product' => 1,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Nhân',
                'avatar_user' => 'ao-khoac1.jpg',
                'review' => 'Sản phẩm rất tốt, tôi rất hài lòng!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 2,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Khang',
                'avatar_user' => 'ao-khoac2.jpg',
                'review' => 'Chất lượng sản phẩm tốt, sẽ mua tiếp!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 3,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Duy',
                'avatar_user' => 'ao-khoac2.jpg',
                'review' => 'Sản phẩm đẹp nhưng giao hàng hơi chậm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 4,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Nghĩa',
                'avatar_user' => 'ao-khoac2.jpg',
                'review' => 'Đóng gói cẩn thận, sản phẩm chất lượng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 5,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Hậu',
                'avatar_user' => 'ao-khoac2.jpg',
                'review' => 'Sản phẩm tốt, sẽ giới thiệu cho bạn bè.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 6,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Thanh',
                'avatar_user' => 'ao-khoac1.jpg',
                'review' => 'Mua lần thứ 2, chất lượng vẫn rất tốt.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 5,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Thành',
                'avatar_user' => 'ao-khoac2.jpg',
                'review' => 'Đáng tiền, sẽ mua thêm sản phẩm khác.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 2,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Khải',
                'avatar_user' => 'ao-khoac1.jpg',
                'review' => 'Sản phẩm ổn, đúng với mô tả.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 1,
                'id_user' => 2,
                'name_user' => 'Lê Trọng An',
                'avatar_user' => 'ao-khoac2.jpg',
                'review' => 'Chất lượng tốt, giá cả hợp lý.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 2,
                'id_user' => 2,
                'name_user' => 'Lê Trọng Thành2',
                'avatar_user' => 'ao-khoac1.jpg',
                'review' => 'Sản phẩm này thực sự rất tuyệt vời!',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
