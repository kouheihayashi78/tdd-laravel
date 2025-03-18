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
        if(5 <= $this->remainingCount) {
            return '◎';
        } else if (1<= $this->remainingCount){
            return '△';
        } else {
            return '×';
        }
    }
}
