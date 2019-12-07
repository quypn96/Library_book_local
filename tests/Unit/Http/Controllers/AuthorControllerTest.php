<?php

namespace Tests\Unit\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use App\Http\Controllers\Admin\AuthorController;
use App\Repositories\Author\AuthorRepository;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use App\Helpers\Helper;
use App\Enums\ImageDefault;
use App\Models\Author;

class AuthorControllerTest extends TestCase
{
    public function test_index()
    {
        $mock = Mockery::mock(AuthorRepository::class)->makePartial();
        $mock->shouldReceive('getDataSortAndPaginate')->andReturn(collect([new Author, new Author]));
        $ctl = new AuthorController($mock);
        $request = new Request();
        $view = $ctl->index($request);

        $this->assertEquals('admin.author.index', $view->getName());
        $this->assertArrayHasKey('authors', $view->getData());
    }

    public function test_create()
    {
        $mock = Mockery::mock(AuthorRepository::class)->makePartial();
        $ctl = new AuthorController($mock);
        $view = $ctl->create();

        $this->assertEquals('admin.author.form-add', $view->getName());
    }

    public function test_edit()
    {
        $id = 1;
        $mock = Mockery::mock(AuthorRepository::class)->makePartial();
        $mock->shouldReceive('find')->andReturn(new Author);
        $ctl = new AuthorController($mock);
        $view = $ctl->edit($id);

        $this->assertEquals('admin.author.form-edit', $view->getName());
        $this->assertArrayHasKey('author', $view->getData());
    }

    public function test_store()
    {

        $ctl = new AuthorController(new AuthorRepository);
        $mock = Mockery::mock(AuthorRepository::class)->makePartial();
        $mock->shouldReceive('create');

        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $ctl = new AuthorController($mock);
        $data = [
            'name' => 'test',
            'birthday' => '2019/10/10',
            'description' => 'test',
            'avatar' => $file,
        ];

        $request = new AuthorRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $response = $ctl->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('author.index'), $response->headers->get('Location'));

    }

    public function test_update()
    {
        $ctl = new AuthorController(new AuthorRepository);
        $mock = Mockery::mock(AuthorRepository::class)->makePartial();
        $mock->shouldReceive('update');
        $mock->shouldReceive('findOrFail')->andReturn(new Author);

        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $ctl = new AuthorController($mock);
        $data = [
            'name' => 'test',
            'birthday' => '2019/10/10',
            'description' => 'test',
            'avatar' => $file,
        ];

        $request = new AuthorRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($data));

        $response = $ctl->update($request, 12);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('author.index'), $response->headers->get('Location'));
    }
}
