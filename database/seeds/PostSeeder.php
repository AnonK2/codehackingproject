<?php

use Illuminate\Database\Seeder;

use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
          'user_id' => 1,
          'category_id' => 1,
          'photo_id' => 1,
          'title' => 'first post title',
          'body' => 'first post body',
        ]);
    }
}
