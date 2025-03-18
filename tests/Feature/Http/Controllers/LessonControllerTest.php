<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
    // テスト実行時にデータベースを再構築
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShow()
    {
        $lesson = Lesson::factory()->create(['name' => '楽しいヨガレッスン']);
        // テストしたいURLにアクセスするためにgetを使う
        $response = $this->get("/lessons/{$lesson->id}");

        $response->assertStatus(Response::HTTP_OK);
        // 返却されたレスポンスに含まれていなければならないデータを確認
        $response->assertSee($lesson->name);
        $response->assertSee('空き状況: ×');
    }
}
