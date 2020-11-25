<?php

namespace Deelbaarmechelen\DeelIt\Tests\Unit;


use Deelbaarmechelen\DeelIt\Http\Middleware\GenerateAssetTag;
use Deelbaarmechelen\DeelIt\Tests\TestCase;
use Illuminate\Http\Request;

class GenerateAssetTagMiddelwareTest extends TestCase
{
    /** @test */
    function it_generates_asset_tag()
    {
        // Given we have a request
        $request = new Request();

        // with a 'company_id' parameter, but no 'asset_tag' parameter
        $request->merge(['company_id' => 2]);

        // when we pass the request to this middleware,
        // it should've generated the asset tag
        (new GenerateAssetTag())->handle($request, function ($request) {
            $this->assertEquals('DB-'. date('y') .'-001', $request->asset_tag);
        });
    }
    /** @test */
    function it_preserves_existing_asset_tag()
    {
        // Given we have a request
        $request = new Request();

        // with a 'company_id' and 'asset_tag' parameter
        $request->merge(['company_id' => 1, 'asset_tag' => 'KB-001-20-123']);

        // when we pass the request to this middleware,
        // it should'nt update the asset tag
        (new GenerateAssetTag())->handle($request, function ($request) {
            $this->assertEquals('KB-001-20-123', $request->asset_tag);
        });
    }
}