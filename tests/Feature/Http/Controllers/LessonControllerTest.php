<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Lesson;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
    // テスト実行時にデータベースを再構築
    use RefreshDatabase;

    /**
     * @param int $capacity
     * @param int $reservationCount
     * @param string $expectedVacancyLevelMark
     * @dataProvider dataShow
     */
    public function testShow(int $capacity, int $reservationCount, string $expectedVacancyLevelMark)
    {
        $lesson = Lesson::factory()->create(['name' => '楽しいヨガレッスン', 'capacity' => $capacity]);
        for($i=0; $i<$reservationCount; $i++){
            $user = User::factory()->create();
            Reservation::factory()->create(
                [
                    'lesson_id' => $lesson->id,
                    'user_id' => $user->id
                ]
            );
        }
        // テストしたいURLにアクセスするためにgetを使う
        $response = $this->get("/lessons/{$lesson->id}");

        $response->assertStatus(Response::HTTP_OK);
        // 返却されたレスポンスに含まれていなければならないデータを確認
        $response->assertSee($lesson->name);
        $response->assertSee("空き状況: {$expectedVacancyLevelMark}");
    }

    public function dataShow()
    {
        return [
            '空き十分' => [
                'capacity' => 6,
                'reservationCount' => 1,
                'expectedVacancyLevelMark' => '◎',
            ],
            '空きわずか' => [
                'capacity' => 6,
                'reservationCount' => 2,
                'expectedVacancyLevelMark' => '△',
            ],
            '空きなし' => [
                'capacity' => 1,
                'reservationCount' => 1,
                'expectedVacancyLevelMark' => '×',
            ],
        ];
    }
}
