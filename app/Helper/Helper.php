<?php

namespace App\Helper;

use App\Enum\Date;
use Carbon\Carbon;

class Helper 
{
    public function fileNameFormat($extension=null)
    {
        $currentDateTime = Carbon::now(Date::TIMEZONE);
        $formattedDateTime = $currentDateTime->format('YmdHis');

        if(!is_null($extension)) $fileName = $formattedDateTime.'.'.$extension;

        return $fileName;
    }
}