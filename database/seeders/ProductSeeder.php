<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'id' => 1,
                'tag_search' => 'Backpacker',
                'name' => 'William Polo Locust Men\'s Travel Backpack',
                'description' => 'With an address in Ho Chi Minh City, Giao Long is known as the place to distribute and trade genuine products of the William Polo brand. With many attractive warranty and product return policies, Giao Long confidently always gives customers the best service to bring home a high-class backpack for you.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-nam-hang-hieu-william-polo-locust-giaolong-.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-nam-da-nang-william-polo-giaolong-1-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-nam-william-polo-locust-giaolong-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 2,
                'tag_search' => 'Backpacker',
                'name' => 'Unisex Beautiful Backpack William Polo Cock',
                'description' => 'William Polo Cock is a high-end product for women, suitable for many occasions such as going out, traveling or even going to school or work. Currently the product is being sold at Giao Long HCMC and Giao Long\'s official website. Immediately contact the hotline to get advice from a staff member and answer all questions as well as all policies.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-nu-chinh-hang-william-polo-cock-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-nu-nho-gon-william-polo-cock-giaolong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-nu-da-nang-william-polo-cock-giaolong-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 3,
                'tag_search' => 'Backpacker',
                'name' => 'Quechua NH100 20L Backpack – Genuine Travel Backpack',
                'description' => 'One of Decathlon\'s best products. The Quechua Hiking NH100 20L backpack was released with a compact and convenient design. Suitable for all ages, occupations with the best prices in the market. Suitable for travel, backpacking, hiking. Let\'s experience great moments with this Quechua 20L backpack.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/02/balo-quechua-nh100-20l-5.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/02/balo-quechua-nh100-20l-4-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/02/balo-quechua-nh100-20l-2-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/02/balo-quechua-nh100-20l-1-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 4,
                'tag_search' => 'Premium Backpack',
                'name' => 'Tigernu Obese Premium Anti-Theft Backpack',
                'description' => 'Giao Long always carries a sincere heart in each order. We always want our customers to have the best experience with every purchase. Therefore, products in Giao Long are always 100% genuine. Any product defect issues are resolved by our staff as quickly as possible and completely free of charge. ',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-laptop-nam-hcm-tigernu-obese-giaolong-.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-laptop-chong-nuoc-tigernu-obese-giaolong--100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-nam-ben-dep-tigernu-obese-giaolong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-nam-chong-trom-tigernu-obese-giaolong-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 5,
                'tag_search' => 'Premium Backpack',
                'name' => 'RZTX Fox Waterproof Laptop Backpack',
                'description' => 'All problems related to product quality are guaranteed. All complaints and dissatisfaction of customers will be fully and enthusiastically supported by Giao Long\'s professional staff. We will always support you with the free policy of exchange, return as well as advice in the most thorough way before you come to the final decision.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/cap-dung-laptop-RZTX-fox-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-da-nang-RZTX-fox-giaolong--100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-laptop-gia-re-RZTX-fox-giaolong--100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 6,
                'tag_search' => 'Premium Backpack',
                'name' => 'Mark Ryden Mason Backpack – Premium Smart Backpack.',
                'description' => 'A beautiful and trendy backpack is not only the perfect storage accessory, but also embellishes your outfit in the most subtle way. High-end fashion men\'s backpack Mark Ryden Mason\'s latest design from Bange is a suggestion for you to choose a backpack model that is both convenient and fashionable.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/cap-dung-laptop-RZTX-fox-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-hang-hieu-mark-ryden-mason-baloxinh-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-hang-hieu-mark-ryden-mason-balo-xinh-1-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-hang-hieu-mark-ryden-mason-balo-xinh-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 7,
                'tag_search' => 'Travel Backpack',
                'name' => 'Parsonker Racoon Laptop Leather Backpack',
                'description' => 'We are a distributor of fashion backpacks that are loved by many shoppers and have the most positive reviews.
                Fast delivery in Ho Chi Minh City within 24 hours.
                Receive nationwide delivery with preferential ship code.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-cao-cap-hang-hieu-parsonker-racoon-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-laptop-chinh-hang-parsonker-racoon-giaolong--100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-laptop-chong-nuoc-parsonker-racoon-giaolong-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 8,
                'tag_search' => 'Travel Backpack',
                'name' => 'Outwalk Seal Men\'s Backpack',
                'description' => 'In addition to ensuring product quality is 100% genuine, we also support delivery to you with a free policy of all shipping costs and especially support fast delivery within 24 hours for customers. in HCMC
                Of course, if customers have any complaints, or any dissatisfaction with the product, we always do our best to support and answer in the fastest and most effective way. Coupled with that is a full return policy for defective or damaged products.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-laptop-gon-nhe-outwalk-seal-giaolong.webp',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-laptop-nu-outwalk-seal-giaolong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-laptop-nhieu-ngan-outwalk-seal-giaolong-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 9,
                'tag_search' => 'Travel Backpack',
                'name' => 'Kaka Hin Trekking Backpack',
                'description' => 'Proud to be one of the leading units in providing 100% genuine imported backpack models, Giao Long will be the perfect choice for those who love to travel. We always have many preferential policies for customers such as: 1 - 1 refund if there is a manufacturing error, 24h super fast delivery, ... you will surely be extremely satisfied when you experience our products.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-kaka-hin-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-di-phuot-chat-luong-kaka-hin-giaolong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-du-lich-cao-cap-chinh-hang-kaka-hin-giaolong-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 10,
                'tag_search' => 'School Backpack',
                'name' => 'Unisex Beautiful Backpack William Polo Cock',
                'description' => 'William Polo Cock is a high-end product for women, suitable for many occasions such as going out, traveling or even going to school or work. Currently the product is being sold at Giao Long HCMC and Giao Long\'s official website. Immediately contact the hotline to get advice from a staff member and answer all questions as well as all policies.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-nu-chinh-hang-william-polo-cock-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-nu-nho-gon-william-polo-cock-giaolong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-hcm-william-polo-cock-giaolong--100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 11,
                'tag_search' => 'School Backpack',
                'name' => 'Fedom Pooch Backpack – Super Stylish Laptop Backpack',
                'description' => 'Fedom Pooch backpack with modern style, unique design, youthful and dynamic is the most sought-after backpack model in 2021. Used by waterproof polyester material, durable over time. . Limit scratches, shockproof when strong impact affects the equipment inside. The durable honeycomb foam padded shoulder strap is breathable, more supportive and more comfortable to use.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-pooch-balo-laptop-sieu-phong-cach-10.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-pooch-2-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-pooch-1-1-100x100.jpg',
                'status' => true,
            ], [
                'id' => 12,
                'tag_search' => 'School Backpack',
                'name' => 'Fedom Kinck Backpack – Stylish Waterproof Backpack',
                'description' => 'Backpacks are a fashion field that is focused and invested in. In addition to the stylish eye-catching design, the function of a backpack is extremely important. Of the 100 customers recently surveyed by Balo Xinh, the waterproof and anti-hunchback function are the two functions that customers care about and respond to the most with Balo Xinh. Fedom Kinck Backpack will help you overcome those things.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-kinck-balo-chong-nuoc-phong-cach-nam-tinh-7.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-kinck-1-1-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-kinck-1-100x100.jpg',
                'status' => true,
            ], [
                'id' => 13,
                'tag_search' => 'Laptop bag',
                'name' => 'Mark Ryden Mate Backpack – Premium Smart Backpack',
                'description' => 'A beautiful and trendy backpack is not only the perfect storage accessory, but also embellishes your outfit in the most subtle way. High-end fashion men\'s backpack Mark Ryden Mate, the latest design from Bange is a suggestion for you to choose a backpack model that is both convenient and fashionable.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-hang-hieu-mark-ryden-mate-9.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-hang-hieu-mark-ryden-mate-baloxinh-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-hang-hieu-mark-ryden-mate-15-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 14,
                'tag_search' => 'Laptop bag',
                'name' => 'The Louie Red BLX10 Laptop Backpack – Genuine Product',
                'description' => 'Are you a follower of Mikkor? Do you want to own a genuine Mikkor backpack just go to school, go out, protect your laptop? Don\'t wait any longer to pick up a pretty backpack from MIKKOR\'s THE LOUIE collection!. Worthy of being a companion on your journey.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-louie-red-hang-cao-cap-1.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-louie-red-hang-chinh-hang-1-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-louie-red-hong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-louie-red-hang-mat-truoc-100x100.jpg',
                'status' => true,
            ], [
                'id' => 15,
                'tag_search' => 'Laptop bag',
                'name' => 'Mark Ryden King Backpack – Premium Smart Backpack',
                'description' => 'A beautiful and trendy backpack is not only the perfect storage accessory, but also embellishes your outfit in the most subtle way. High-end fashion men\'s backpack Mark Ryden King, the latest design from Bange, is a suggestion for you to choose a backpack model that is both convenient and fashionable.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-chinh-hang-mark-ryden-king.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-chinh-hang-mark-ryden-king-1-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-chinh-hang-mark-ryden-king-2-100x100.jpg',
                'status' => true,
            ], [
                'id' => 16,
                'tag_search' => 'Men backpack',
                'name' => 'Fedom Nitro Backpack – European American Brand Travel Backpack',
                'description' => 'Oumantu O6118S Travel Business Backpack Simple The travel backpack is an indispensable item for you in your travels with family and friends. In addition to the stylish and trendy shape, the interior design is also an important part of creating a top-notch backpack. Understanding the need for backpacks today,. Fedom Nitro backpack of European and American brand is a product worth your choice.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/05/balo-mau-xanh-balo-dep-1.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-nitro-thuong-hieu-au-my-3-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-nitro-thuong-hieu-au-my-4-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/05/balo-fedom-nitro-thuong-hieu-au-my-10-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 17,
                'tag_search' => 'Men backpack',
                'name' => 'Oumantu O6118S Travel Business Backpack Simple',
                'description' => 'A super product only available at Balo Xinh. If you are looking for a suitable backpack for business people or a travel backpack. Then this high-end backpack model from the Oumantu O6118S brand is the perfect choice for you and luxurious beauty for users.
                A handy backpack that can protect the items inside is indispensable for each of us. Very convenient for every long trip or short business trip. ',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/03/balo-thoi-trang-du-lich-don-gian.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/03/4-mau-cua-balo-oumatu-cao-cap-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/03/balo-oumantu-cao-cap-xam-xanh-100x100.jpg',
                'status' => true,
            ], [
                'id' => 18,
                'tag_search' => 'Men backpack',
                'name' => 'O6702 Premium Oumantu Backpack For Work',
                'description' => 'If you are a business person, you definitely cannot ignore this high-end Oumantu backpack O6702!!
                Designed specifically for the office style. Luxurious colors that harmoniously combine 3 colors black, gray and light gray attract the attention of the opposite person. The square design is not ostentatious by the delicate angular lines. The spacious compartment can hold a laptop up to 16 inches and convenient items suitable for business use. ',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/03/balo-oumantu-cao-cap-sang-trong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/03/balo-oumantu-cao-cap-tai-balo-xinh-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/03/balo-oumantu-cao-cap-danh-cho-nam-1-1-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 19,
                'tag_search' => 'Women\'s Backpack',
                'name' => 'Korean Women\'s Backpack Danbaoly Hint',
                'description' => 'So far, Giao Long has always put prestige on top, taking customer satisfaction and product quality as the criteria for development. Therefore, each product is taken care of by Giao Long shop very carefully, warranty little by little. The warranty period here can be up to 5 years,  new and loyal customers.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-danbaoly-hint-giaolong-13.webp',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-nho-cho-nu-danbaoly-hint-giaolong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-dung-laptop-nu-dep-danbaoly-hint-giaolong-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 20,
                'tag_search' => 'Women\'s Backpack',
                'name' => 'Danbaoly Mesi Fashion Women\'s Leather Backpack',
                'description' => 'Danbaoly Mesi leather backpack is a very personal cowhide backpack that is suitable for many different combinations and colors. You can use it to travel, go to school or go to work, it\'s great, it will help enhance your natural beauty, elegance, nobility.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/Balo-Da-Nu-Thoi-Trang-Cao-Cap-Danbaoly-Mesi-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/balo-da-dep-cho-nu-Danbaoly-Mesi-giaolong-1-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/balo-nu-da-mem-Danbaoly-Mesi-giaolong-1-100x100.jpg',
                'status' => true,
            ], [
                'id' => 21,
                'tag_search' => 'Women\'s Backpack',
                'name' => 'Backpack BLX06 The Ella Orange – Genuine Product From Mikkor',
                'description' => 'As one of the latest models from the famous brand Mikkor, embellished with vibrant orange color, stylish design and personality. Mikkor The Ella Orange backpack is one of the most sought-after products of young people from students to working people.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-laptop-blx06-mikkor-the-ella-orange-2.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-laptop-blx06-mikkor-the-ella-orange-3-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2020/08/balo-laptop-blx06-mikkor-the-ella-orange-4-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 22,
                'tag_search' => 'One Strap Backpack',
                'name' => 'The Arnold Delux Red BLX21 Backpack – Single Handle Laptop Backpack',
                'description' => 'The Arnold Delux Red 1 Strap Backpack The Arnold Delux Red is the latest line of single-strap laptop backpacks from the Mikkor brand. Designed in the style of a dynamic, single-shoulder laptop backpack with a chest strap to help balance and fix the backpack when you wear it. to pick up. Here is some information about this product.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2020/08/tui-balo-1-quai-mikkor-the-arnold-delux-red.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2020/08/tui-balo-1-quai-mikkor-the-arnold-delux-red-4-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2020/08/tui-balo-1-quai-mikkor-the-arnold-delux-red-3-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 23,
                'tag_search' => 'One Strap Backpack',
                'name' => 'Backpack BLX22 The Arnold Delux Dark Mouse Gray – Single Handle Laptop Backpack',
                'description' => 'The Arnold Delux Dark Mouse Gray 1 Strap Backpack BLX22 - Mouse Gray is the latest line of single-strap laptop backpacks from the Mikkor brand. Designed in the style of a dynamic, single-shoulder laptop backpack with a chest strap to help balance and fix the backpack when you wear it. to pick up.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-arnold-delux-dark-mouse-grey-1.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-arnold-delux-dark-mouse-grey-4-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-arnold-delux-dark-mouse-grey-5-100x100.jpg',
                'status' => true,
            ], [
                'id' => 24,
                'tag_search' => 'One Strap Backpack',
                'name' => 'BLX24 The Arnold Delux Graphite Backpack – Single Handle Laptop Backpack',
                'description' => 'The Arnold Delux Graphite 1 Strap Backpack The Arnold Delux Graphite is the latest single-strap laptop backpack from the Mikkor brand. Designed in the style of a dynamic, single-shoulder laptop backpack with a chest strap to help balance and fix the backpack when you wear it. to pick up. Here is some information about this product.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-arnold-delux-graphite.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-arnold-delux-graphite-balo-than-sau-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2020/08/balo-mikkor-the-arnold-delux-graphite-cao-cap-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 25,
                'tag_search' => 'Branded Backpacks',
                'name' => 'Tigernu Shy Premium Men\'s Crossbody Bag',
                'description' => 'Tigernu Shy brings strength, masculinity and elegance to users. This product is going to create a big fever so hurry up and order a Tigernu Shy bag before it\'s sold out on all fronts. Giao Long, dedicated customer care, and product quality to bring excellent, high-class experiences and services. best for you.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-deo-cheo-nam-gia-re-tigernu-shy-giaolong-900x900.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-deo-cheo-tigernu-shy-giaolong--100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/tui-hcm-tigernu-shy-giaolong--100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 26,
                'tag_search' => 'Branded Backpacks',
                'name' => 'Mark Ryden Raw Premium Backpack',
                'description' => 'A beautiful and trendy backpack is not only the perfect storage accessory, but also embellishes your outfit in the most subtle way. High-end fashion men\'s backpack Mark Ryden Raw, the latest design from Bange is a suggestion for you to choose a backpack model that is both convenient and fashionable.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-chinh-hang-mark-ryden-raw-14.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-chinh-hang-mark-ryden-raw-11-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2021/08/Balo-cao-cap-chinh-hang-mark-ryden-raw-10-100x100.jpg',
                'status' => true,
            ], [
                'id' => 27,
                'tag_search' => 'Branded Backpacks',
                'name' => 'B2B05 L.NAVY BAG – GENUINE SIMPLECARRY',
                'description' => 'SimpleCarry B2B05 L.navy Backpack is one of the most popular models on the market today. With a unique design, convenient to go out, work or go to school. Therefore, this is a backpack that is the most sought-after by young people today.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-laptop-sc-b2b05-l-navy.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2020/08/balo-laptop-sc-b2b05-l-navy-1-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2020/08/balo-laptop-sc-b2b05-l-navy-3-100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 28,
                'tag_search' => 'Gift Backpacks',
                'name' => 'William Polo Moth Guangzhou Luxury Handbags',
                'description' => 'William Polo Moth is expected to make waves in the community and sell out on all fronts in the near future. Quickly book yourself a William Polo Moth at Giao Long website to receive the hottest deals, the best warranty policies and the best staff at Giao Long.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-xach-da-that-william-polo-month-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-xach-thoi-trang-cao-cap-william-polo-month-giaolong--100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/tui-nam-cao-cap-william-polo-month-giaolong--100x100.jpg',
                'status' => true,
            ],
            [
                'id' => 29,
                'tag_search' => 'Gift Backpacks',
                'name' => 'William Polo Ox Women\'s High Quality Leather Handbag',
                'description' => 'All products that are delivered to you are guaranteed to be 100% genuine, all problems related to product quality are resolved neatly and quickly. Besides, Giao Long always opens promotions, free shipping for customers. Our staff is always ready to answer any questions and give our best advice to consumers.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-xach-thoi-trang-gia-re-william-polo-ox-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-da-da-nang-william-polo-ox-giaolong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/tui-xach-hcm-william-polo-ox-giaolong-100x100.jpg',
                'status' => true,
            ], [
                'id' => 30,
                'tag_search' => 'Gift Backpacks',
                'name' => 'William Polo Lux Men\'s Leather Handbag',
                'description' => 'With long experience and professionalism in consulting and serving, Giao Long will be a prestigious choice for all customers wishing to buy William polo Lux handbags. We always sell 100% genuine products, uphold the quality and say no to imitations and fake goods. With a team of elite, dedicated and enthusiastic professionals, every customer who comes to Giao Long is guided and selected the most satisfactory bag model without worrying too much about the price.',
                'image' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-xach-da-cao-cap-william-polo-lux-giaolong.jpg',
                'image_slider' => 'https://baloxinh.vn/wp-content/uploads/2022/10/tui-xach-cao-cap-william-polo-lux-giaolong-100x100.jpg,https://baloxinh.vn/wp-content/uploads/2022/10/tui-xach-hang-hieu-william-polo-lux-giaolong--100x100.jpg',
                'status' => true,
            ]
        ];

        $colors = ['#2596be', '#041014', '#be2596', '#bea925', '#6c25be', '#be4d25', '#de0994'];
        $price_key = [10, 20, 30, 34, 5, 2, 8, 4, 3, 1];
        foreach ($data as $key => $item) {
            $id = DB::table('products')->insertGetId([
                'category_id' => Category::where('name', 'like', '%' . $item['tag_search'] . '%')->first()->id ?? "1",
                'name' => $item['name'],
                'description' => $item['description'],
                'image' => $item['image'],
                'image_slide' => $item['image_slider'],
                'status' => $item['status'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            DB::table('product_details')->insert([
                'product_id' => $id,
                'code_color' => Arr::random($colors),
                'amount' => 50,
                'price' => 50 * (Arr::random($price_key) + 1),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
