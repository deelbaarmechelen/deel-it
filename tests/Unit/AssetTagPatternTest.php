<?php

namespace Deelbaarmechelen\DeelIt\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Deelbaarmechelen\DeelIt\Tests\TestCase;
use Deelbaarmechelen\DeelIt\Models\AssetTagPattern;

class AssetTagPatternTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_asset_tag_has_a_pattern()
    {
        $pattern = factory(AssetTagPattern::class)->create(['pattern' => 'DB-000', 'next_auto_id' => 1]);
        $this->assertEquals('DB-000', $pattern->pattern);
    }
}