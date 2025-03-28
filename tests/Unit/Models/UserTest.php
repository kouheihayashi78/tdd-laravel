<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * @param string $plan
     * @param int $remainingCount
     * @param int $reservationCount
     * @param bool $canReserve
     * @dataProvider dataCanReserve
     */
    public function testCanReserve(string $plan, int $remainingCount, int $reservationCount, bool $canReserve)
    {
        $user = new User();
        $user->plan = $plan;

        $this->assertSame($canReserve, $user->canReserve($remainingCount, $reservationCount));
    }

    public function dataCanReserve()
    {
        return [
            '予約可:レギュラー,空きあり,月の上限以下' => [
            'plan' => 'regular',
            'remainingCount' => 1,
            'reservationCount' => 4,
            'canReserve' => true,
            ],
            '予約不可:レギュラー,空きあり,月の上限' => [
                'plan' => 'regular',
                'remainingCount' => 1,
                'reservationCount' => 5,
                'canReserve' => false,
            ],
            '予約不可:レギュラー,空きなし,月の上限以下' => [
                'plan' => 'regular',
                'remainingCount' => 0,
                'reservationCount' => 4,
                'canReserve' => false,
            ],
            '予約可:ゴールド,空きあり,月の上限なし' => [
                'plan' => 'gold',
                'remainingCount' => 3,
                'reservationCount' => 0,
                'canReserve' => true,
            ],
            '予約可:ゴールド,空きなし,月の上限なし' => [
                'plan' => 'gold',
                'remainingCount' => 0,
                'reservationCount' => 0,
                'canReserve' => false,
            ],
        ];
    }
}
