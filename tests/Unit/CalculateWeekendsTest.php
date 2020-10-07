<?php

declare(strict_types=1);

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class CalculateWeekendsTest extends TestCase
{
    /**
     * @test
     * @throws FileNotFoundException
     */
    public function calculateWeek(): void
    {
        $firstDate = '2020-10-1';
        $secondDate = '2020-10-31';

        $parse = Carbon::rawParse($firstDate)->diffAsCarbonInterval($secondDate);
        $weeks = $parse->get('weeks');
        $fileName = Str::random($weeks) . "$firstDate-$secondDate.txt";
        Storage::put($fileName, $weeks, 'public');

        $storageDisk = Storage::disk('local');
        $storageDisk->assertExists($fileName);
        $storageDiskFileValue = $storageDisk->get($fileName);
        self::assertSame(4, (int) $storageDiskFileValue);
        self::assertSame(4, $weeks);
    }
}
