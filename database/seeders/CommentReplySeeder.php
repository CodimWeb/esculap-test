<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 20; $i++) {
            $user = User::query()->inRandomOrder()->first();
            $news = News::query()->inRandomOrder()->first();
            $comment = Comment::query()->inRandomOrder()->first();
            DB::table('comments')->insert(
                [
                    'text' => fake()->text(),
                    'user_id' => $user['id'],
                    'news_id' => $news['id'],
                    'parent_id' =>$comment['id'],
                    'created_at' => fake()->dateTime,
                    'updated_at' => fake()->dateTime,
                ]
            );
        }
    }
}
