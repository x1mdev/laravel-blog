<?php

namespace Tests\Browser\Admin;

use App\Post;

use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\BrowserKitTest;

class PostsBrowserTest extends BrowserKitTest
{
    use DatabaseMigrations;

    public function testPostIndexAuthorLink()
    {
        $anakin = factory(User::class)->states('anakin')->create();
        $post = factory(Post::class)->create(['author_id' => $anakin->id]);

        $this->actingAsAdmin()
            ->visit('/admin/posts')
            ->click('Anakin')
            ->seeRouteIs('admin.users.edit', $post->author);
    }

    public function testUpdatePost()
    {
        $author = $this->admin();
        $post = factory(Post::class)->create();
        $faker = Factory::create();

        $this->actingAsAdmin()
            ->visit("/admin/posts/{$post->slug}/edit")
            ->type($faker->sentence, 'title')
            ->type($faker->paragraph, 'content')
            ->type($faker->datetime->format('Y-m-d\TH:i'), 'posted_at')
            ->select($author->id, 'author_id')
            ->press('Mettre à jour')
            ->see('Article mis à jour avec succès');
    }

    public function testPostCreateForm()
    {
        $faker = Factory::create();
        $author = $this->admin();

        $this->actingAsAdmin()
            ->visit('/admin/posts/create')
            ->type($faker->sentence, 'title')
            ->type($faker->paragraph, 'content')
            ->select($author->id, 'author_id')
            ->type(now()->format('Y-m-d\TH:i'), 'posted_at')
            ->press('Sauvegarder')
            ->see('Article créé avec succès');
    }

    public function testDeletePost()
    {
        $post = factory(Post::class)->create();

        $this->actingAsAdmin()
            ->visit("/admin/posts/{$post->slug}/edit")
            ->press('Supprimer')
            ->see('Article supprimé avec succès');
    }
}
