<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // عطور رجالية (category_id: 1)
            [
                'category_id' => 1,
                'name' => 'ديور سوفاج',
                'slug' => 'dior-sauvage',
                'description' => 'عطر رجالي فاخر من ديور بنفحات خشبية وحارة، مثالي للاستخدام اليومي والمناسبات.',
                'price' => 350.00,
                'image' => 'products/dior-sauvage.jpg',
                'brand' => 'ديور',
                'volume' => '100ml',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'بلو دي شانيل',
                'slug' => 'bleu-de-chanel',
                'description' => 'عطر رجالي أنيق من شانيل بمزيج من النعناع وخشب الأرز والليمون.',
                'price' => 420.00,
                'image' => 'products/bleu-de-chanel.jpg',
                'brand' => 'شانيل',
                'volume' => '100ml',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'أكوا دي جيو',
                'slug' => 'acqua-di-gio',
                'description' => 'عطر منعش من جورجيو أرماني برائحة البحر والحمضيات.',
                'price' => 300.00,
                'image' => 'products/acqua-di-gio.jpg',
                'brand' => 'أرماني',
                'volume' => '75ml',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => 1,
                'name' => 'فيرساتشي بور هوم',
                'slug' => 'versace-pour-homme',
                'description' => 'عطر رجالي كلاسيكي من فيرساتشي بنفحات البحر الأبيض المتوسط.',
                'price' => 280.00,
                'image' => 'products/versace-pour-homme.jpg',
                'brand' => 'فيرساتشي',
                'volume' => '100ml',
                'is_active' => true,
                'is_featured' => false,
            ],

            // عطور نسائية (category_id: 2)
            [
                'category_id' => 2,
                'name' => 'شانيل نمبر 5',
                'slug' => 'chanel-no5',
                'description' => 'العطر النسائي الأيقوني من شانيل، مزيج فاخر من الورد والياسمين.',
                'price' => 480.00,
                'image' => 'products/chanel-no5.jpg',
                'brand' => 'شانيل',
                'volume' => '100ml',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'جوي من ديور',
                'slug' => 'miss-dior',
                'description' => 'عطر نسائي راقي بنفحات الورد والفواكه الطازجة.',
                'price' => 390.00,
                'image' => 'products/miss-dior.jpg',
                'brand' => 'ديور',
                'volume' => '50ml',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'لانكوم لا في إست بيل',
                'slug' => 'lancome-la-vie-est-belle',
                'description' => 'عطر نسائي حلو وأنيق من لانكوم بنفحات السوسن والبرالين.',
                'price' => 360.00,
                'image' => 'products/lancome-la-vie-est-belle.jpg',
                'brand' => 'لانكوم',
                'volume' => '75ml',
                'is_active' => true,
                'is_featured' => false,
            ],

            // عطور مشتركة (category_id: 3)
            [
                'category_id' => 3,
                'name' => 'توم فورد عود وود',
                'slug' => 'tom-ford-oud-wood',
                'description' => 'عطر فاخر مشترك من توم فورد بنفحات العود وخشب الصندل.',
                'price' => 750.00,
                'image' => 'products/tom-ford-oud-wood.jpg',
                'brand' => 'توم فورد',
                'volume' => '100ml',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'جو مالون وود سيج',
                'slug' => 'jo-malone-wood-sage',
                'description' => 'عطر بريطاني أنيق بنفحات المريمية وملح البحر.',
                'price' => 450.00,
                'image' => 'products/jo-malone-wood-sage.jpg',
                'brand' => 'جو مالون',
                'volume' => '100ml',
                'is_active' => true,
                'is_featured' => false,
            ],

            // بخور وعود (category_id: 4)
            [
                'category_id' => 4,
                'name' => 'دهن عود كمبودي',
                'slug' => 'cambodian-oud-oil',
                'description' => 'دهن عود كمبودي أصلي فاخر، رائحة غنية وعميقة.',
                'price' => 1200.00,
                'image' => 'products/cambodian-oud-oil.jpg',
                'brand' => 'بيت العطور',
                'volume' => '12ml',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'بخور العود الملكي',
                'slug' => 'royal-oud-incense',
                'description' => 'بخور عود ملكي فاخر للمجالس والمناسبات.',
                'price' => 180.00,
                'image' => 'products/royal-oud-incense.jpg',
                'brand' => 'بيت العطور',
                'volume' => '50g',
                'is_active' => true,
                'is_featured' => false,
            ],

            // مخلطات عطرية (category_id: 5)
            [
                'category_id' => 5,
                'name' => 'مخلط ليالي العرب',
                'slug' => 'layali-al-arab-blend',
                'description' => 'مخلط عطري شرقي فاخر بنفحات العود والمسك والعنبر.',
                'price' => 250.00,
                'image' => 'products/layali-al-arab-blend.jpg',
                'brand' => 'بيت العطور',
                'volume' => '100ml',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'مخلط سحر الشرق',
                'slug' => 'sehr-al-sharq-blend',
                'description' => 'مخلط عطري فريد يجمع بين الورد الطائفي والعنبر والمسك.',
                'price' => 200.00,
                'image' => 'products/sehr-al-sharq-blend.jpg',
                'brand' => 'بيت العطور',
                'volume' => '100ml',
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
