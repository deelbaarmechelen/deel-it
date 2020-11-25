<?php
namespace Deelbaarmechelen\DeelIt\Tests\Unit;

use Deelbaarmechelen\DeelIt\Models\AssetTagPattern;
use Deelbaarmechelen\DeelIt\Observers\AssetObserver;
use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Asset;
use Deelbaarmechelen\DeelIt\Tests\TestCase;

class AssetObserverTest extends TestCase
{
    /** @test */
    function next_asset_tag_is_incremented()
    {
        $pattern = factory(AssetTagPattern::class)->create(['pattern' => 'DB-20-000', 'next_auto_id' => 1]);
        $this->assertEquals('DB-20-000', $pattern->pattern);
        $this->assertEquals(1, $pattern->next_auto_id);

        $asset = factory(Asset::class)->create(['asset_tag' => 'DB-20-123']);
        (new AssetObserver())->created($asset);

        $updatedPatter = AssetTagPattern::where('pattern', 'DB-20-000')->first();
        $this->assertEquals(124, $updatedPatter->next_auto_id);
    }
}