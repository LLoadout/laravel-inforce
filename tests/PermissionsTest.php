<?php

namespace Permissions\Tests;

use LLoadoutInforce\Services\Grouper;
use PHPUnit\Framework\TestCase;


class PermissionsTest extends TestCase
{
    /** @test */
    public function test()
    {
        $grouper = app(Grouper::class);

        $grouped = $grouper->exec(collect(['string.string', 'otherstring.otherstring']));
        $this->assertIsArray($grouped);
        $this->assertCount(2, $grouped);
    }
}
