<?php

declare(strict_types=1);

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CalculateWeekendsController
{
    final public function index(string $firstDate, string $secondDate): int
    {
        $parse = Carbon::rawParse($firstDate)->diffAsCarbonInterval($secondDate);
        $weeks = $parse->get('weeks');
        $fileName = Str::random($weeks) . "$firstDate-$secondDate.txt";
        Storage::put($fileName, $weeks, 'public');

        return $weeks;
    }
}
