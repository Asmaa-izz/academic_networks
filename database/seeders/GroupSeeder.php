<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Group;
use App\Models\GroupJoin;
use App\Models\Post;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $group1 = Group::firstOrCreate(['name' => 'تطبيقات ويب'], [
            'name' => 'تطبيقات ويب',
            'user_id' => 1,
        ]);

        $group1->users()->attach(3, ['is_admin' => true]);
        $group1->users()->attach(2, ['is_admin' => false]);
        $group1->users()->attach(4, ['is_admin' => false]);
        $group1->users()->attach(5, ['is_admin' => false]);

        GroupJoin::firstOrCreate(['group_id' => $group1->id, 'user_join' => 6], ['group_id' => $group1->id, 'user_join' => 6]);

        $p1 = Post::firstOrCreate(['group_id' => $group1->id], [
            'group_id' => $group1->id,
            'user_id' => 2,
            'text' => 'ما هو تقييم للمحاضرات'
        ]);

        // -----------------------------------------------------------

        $group2 = Group::firstOrCreate(['name' => 'تسويق ويب'], [
            'name' => 'التسويق الإلكتورني',
            'user_id' => 1,
        ]);

        $group2->users()->attach(6, ['is_admin' => true]);
        $group2->users()->attach(7, ['is_admin' => false]);
        $group2->users()->attach(8, ['is_admin' => false]);
        $group2->users()->attach(9, ['is_admin' => false]);

        $p2 = Post::firstOrCreate(['group_id' => $group2->id, 'user_id' => 8,], [
            'group_id' => $group2->id,
            'user_id' => 7,
            'text' => 'التسويق الإلكتروني أصبح جزءًا أساسيًا من نجاح الأعمال في العصر الرقمي. فهو يعتمد على استخدام الوسائل التكنولوجية الحديثة للوصول إلى العملاء، مثل مواقع التواصل الاجتماعي، البريد الإلكتروني، وتحسين محركات البحث. بفضل هذه الاستراتيجيات، يمكن للشركات توسيع نطاق عملائها، التواصل بفعالية، وتحليل النتائج لتحقيق أهدافهم بشكل أسرع وأكثر دقة.'
        ]);

        $p3 = Post::firstOrCreate(['group_id' => $group2->id, 'user_id' => 6,], [
            'group_id' => $group2->id,
            'user_id' => 6,
            'text' => 'ما هي أداة التسويق الرقمي التي تعتقد أنها الأكثر فعالية للوصول إلى الجمهور المستهدف، ولماذا؟'
        ]);

        Comment::firstOrCreate(['post_id' => $p3->id, 'user_id' => 7, 'text' => 'SEO'], [
            'post_id' => $p3->id,
            'user_id' => 7,
            'text' => 'SEO'
        ]);
        Comment::firstOrCreate(['post_id' => $p3->id, 'user_id' => 8, 'text' => 'لتسويق عبر وسائل التواصل الاجتماعي'], [
            'post_id' => $p3->id,
            'user_id' => 8,
            'text' => 'لتسويق عبر وسائل التواصل الاجتماعي'
        ]);
        Comment::firstOrCreate(['post_id' => $p3->id, 'user_id' => 9, 'text' => 'البريد الإلكتروني'], [
            'post_id' => $p3->id,
            'user_id' => 9,
            'text' => 'البريد الإلكتروني'
        ]);

    }
}
