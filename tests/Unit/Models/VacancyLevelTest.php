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
}
