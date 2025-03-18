<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyLevel extends Model
{
    use HasFactory;

    private $remainingCount;

    public function __construct($remainingCount)
    {
        $this->remainingCount = $remainingCount;
    }

    public function mark()
    {
        // slug(文字列)に対応したmark(◎など)を定義
        $marks = ['empty' => '×', 'few' => '△', 'enough' => '◎'];
        // slugが返す値(文字列)を格納
        $slug = $this->slug();
        // assertでエラー対策
        assert($marks[$slug], new \DomainException('invalid slug value.'));

        // slugに対応したmarkを返却
        return $marks[$slug];
    }

    public function slug()
    {
        if ($this->remainingCount === 0) {
            return 'empty';
        } else if ($this->remainingCount < 5) {
            return 'few';
        } else {
            return 'enough';
        }
    }
}
