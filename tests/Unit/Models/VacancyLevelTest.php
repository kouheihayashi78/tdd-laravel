<?php

namespace Tests\Unit\Models;

use App\Models\Models\VacancyLevel;
use PHPUnit\Framework\TestCase;

class VacancyLevelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $this->assertTrue(true);
    // }

    /**
     * @test
     * @covers VacancyLevel::mark
     *
     * @return void
     */
    public function testMark()
    {
        // 0なら枠数なしとして×をテスト
        $level = new VacancyLevel(0);
        $this->assertSame('×', $level->mark());

        // 1~4なら少し枠数があるとして△をテスト
        $level = new VacancyLevel(4);
        $this->assertSame('△', $level->mark());

        // 5以上なら枠数が十分にあるとして◎をテスト
        $level = new VacancyLevel(5);
        $this->assertSame('◎', $level->mark());

    }
}
