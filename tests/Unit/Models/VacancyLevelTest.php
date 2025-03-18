<?php

namespace Tests\Unit\Models;

use App\Models\Models\VacancyLevel;
use PHPUnit\Framework\TestCase;

class VacancyLevelTest extends TestCase
{
    /**
     * @covers VacancyLevel::mark
     * @param int $remainingCount
     * @param string $expectedMark
     * @dataProvider dataMark
     */
    public function testMark(int $remainingCount, string $expectedMark): void
    {
        $level = new VacancyLevel($remainingCount);
        $this->assertSame($expectedMark, $level->mark());
    }

    // PHPUnitのデータプロバイダの仕組みを使ってテストパターンを配列で定義し、テストメソッドに順番に渡してテスト
    public function dataMark()
    {
        return [
            // 第一階層のキーはテストケースを表す(3パターン)
            '空きなし' => [
                // 連想配列のキーはテストメソッドの引数名と対応している(キーは書かなくても問題ないが明示的に書いた方がわかりやすい)
                'remainingCount' => 0,
                'expectedMark' => '×',
            ],
            '残りわずか' => [
                'remainingCount' => 4,
                'expectedMark' => '△',
            ],
            '空き十分' => [
                'remainingCount' => 5,
                'expectedMark' => '◎',
            ]
        ];
    }


    /**文字列の出し分けは以下のルールです（記号と同じ）。
    残り枠数 0 = empty
    残り枠数 1 以上 5 より下 = few
    残り枠数が 5 以上 = enough
    テストケースとして、

    empty になるパターン: 空きなし
    few になるパターン: 残りわずか
    enough になるパターン: 空き十分
    **/

    /**
     * @covers VacancyLevel::slug
     * @param int $remainingCount 残り枚数
     * @param string $expectedSlug 返ってくる値
     * @dataProvider dataSlug
     *
     * @return void
     */
    public function testSlug(int $remainingCount, string $expectedSlug)
    {
        $level = new VacancyLevel($remainingCount);
        $this->assertSame($expectedSlug, $level->slug());
    }

    public function dataSlug()
    {
        return [
            '空きなし' => [
                'remainingCount' => 0,
                'expectedSlug' => 'empty',
            ],
            '残りわずか' => [
                'remainingCount' => 4,
                'expectedSlug' => 'few',
            ],
            '空き十分' => [
                'remainingCount' => 5,
                'expectedSlug' => 'enough',
            ]
        ];
    }
}
