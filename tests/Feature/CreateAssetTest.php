<?php

namespace Deelbaarmechelen\DeelIt\Tests\Feature;


use Deelbaarmechelen\DeelIt\Models\AssetTagPattern;
use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Asset;
use Deelbaarmechelen\DeelIt\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateAssetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function creating_an_asset_with_tag()
    {
        $this->withoutExceptionHandling();

        $response = $this->post(route('api.assets.store'), [
            'asset_tag' => 'tag',
            'company_id' => '1',
        ]);

        $asset = Asset::first();
        $this->assertEquals('tag', $asset->asset_tag);
    }

    /** @test */
    function creating_an_asset_without_tag_will_generate_it()
    {
        $this->withoutExceptionHandling();

        $this->post(route('api.assets.store'), [
            'company_id' => '2',
        ]);

        $asset = Asset::first();
        $this->assertEquals('DB-'.date('y').'-001', $asset->asset_tag);

        $newPattern = AssetTagPattern::first();
        $this->assertEquals(2, $newPattern->next_auto_id);
    }

    /** @test */
    function creating_an_asset_without_tag_will_increment_seq()
    {
        $this->withoutExceptionHandling();

        $pattern = new AssetTagPattern();
        $pattern->pattern = 'DB-'.date('y').'-000';
        $pattern->next_auto_id = 5;
        $pattern->save();

        $this->post(route('api.assets.store'), [
            'company_id' => '2',
        ]);

        $asset = Asset::first();
        $this->assertEquals('DB-'.date('y').'-005', $asset->asset_tag);

        $newPattern = AssetTagPattern::first();
        $this->assertEquals(6, $newPattern->next_auto_id);
    }
}