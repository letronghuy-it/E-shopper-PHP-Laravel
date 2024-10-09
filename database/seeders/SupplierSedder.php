<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSedder extends Seeder
{

    public function run()
    {
        DB::table('suppliers')->delete();
        DB::table('suppliers')->truncate();

        DB::table('suppliers')->insert([
            [
                'tax_code'          => '0312345678',
                'name_company'      => 'Công Ty CP Thời Trang Việt (Viet Fashion)',
                'representative'    => 'Nguyễn Thanh Tùng',
                'phone_number'      => '0901234567',
                'email_address'     => 'info@vietfashion.com.vn',
                'address'           => '123 Lý Thường Kiệt, Quận Tân Bình, TP. Hồ Chí Minh',
                'nick_name'         => 'Viet Fashion',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0108765432',
                'name_company'      => 'Công Ty TNHH Đầu Tư Thời Trang Yody',
                'representative'    => 'Trần Văn Tuấn',
                'phone_number'      => '0902345678',
                'email_address'     => 'contact@yody.vn',
                'address'           => '456 Cầu Giấy, Quận Cầu Giấy, Hà Nội',
                'nick_name'         => 'Yody',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0301236789',
                'name_company'      => 'Công Ty TNHH Giày Dép Biti\'s',
                'representative'    => 'Võ Văn Long',
                'phone_number'      => '0903456789',
                'email_address'     => 'info@bitis.com.vn',
                'address'           => 'A23 Tân Bình Industrial Park, Quận Tân Bình, TP. Hồ Chí Minh',
                'nick_name'         => 'Biti\'s',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0313456789',
                'name_company'      => 'Công Ty CP Đồng Hồ Galle Watch',
                'representative'    => 'Phạm Thanh Hà',
                'phone_number'      => '0904567890',
                'email_address'     => 'info@gallewatch.vn',
                'address'           => '72B Lý Thường Kiệt, Quận Hoàn Kiếm, Hà Nội',
                'nick_name'         => 'Galle Watch',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0101234567',
                'name_company'      => 'Công Ty CP Đồng Hồ Đăng Quang Watch',
                'representative'    => 'Nguyễn Văn Đăng',
                'phone_number'      => '0905678901',
                'email_address'     => 'info@dangquangwatch.vn',
                'address'           => '75 Bà Triệu, Quận Hai Bà Trưng, Hà Nội',
                'nick_name'         => 'Đăng Quang Watch',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0102345678',
                'name_company'      => 'Công Ty TNHH PNJ (Phú Nhuận Jewelry)',
                'representative'    => 'Lê Trí Thông',
                'phone_number'      => '0906789012',
                'email_address'     => 'info@pnj.com.vn',
                'address'           => '170E Phan Đăng Lưu, Quận Phú Nhuận, TP. Hồ Chí Minh',
                'nick_name'         => 'PNJ',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0201234567',
                'name_company'      => 'Công Ty CP Thời Trang Ivy Moda',
                'representative'    => 'Nguyễn Vũ Hùng',
                'phone_number'      => '0907890123',
                'email_address'     => 'info@ivymoda.vn',
                'address'           => '22 Thành Công, Quận Ba Đình, Hà Nội',
                'nick_name'         => 'Ivy Moda',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0401234567',
                'name_company'      => 'Công Ty TNHH Đồng Hồ Julius',
                'representative'    => 'Lê Thị Thanh Hương',
                'phone_number'      => '0908901234',
                'email_address'     => 'info@juliuswatch.vn',
                'address'           => '19 Nguyễn Thị Minh Khai, Quận 1, TP. Hồ Chí Minh',
                'nick_name'         => 'Julius Watch',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0501234567',
                'name_company'      => 'Công Ty CP Vàng Bạc Đá Quý DOJI',
                'representative'    => 'Đỗ Minh Phú',
                'phone_number'      => '0909012345',
                'email_address'     => 'info@doji.vn',
                'address'           => '5 Lê Duẩn, Quận Ba Đình, Hà Nội',
                'nick_name'         => 'DOJI',
                'status'            => 'active'
            ],
            [
                'tax_code'          => '0601234567',
                'name_company'      => 'Công Ty TNHH Thời Trang Canifa',
                'representative'    => 'Hoàng Đức Minh',
                'phone_number'      => '0910123456',
                'email_address'     => 'info@canifa.com',
                'address'           => '30 Nguyễn Văn Huyên, Quận Cầu Giấy, Hà Nội',
                'nick_name'         => 'Canifa',
                'status'            => 'active'
            ]
        ]);

    }
}
