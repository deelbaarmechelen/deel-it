<?php

namespace Deelbaarmechelen\DeelIt\Tests;

use Deelbaarmechelen\DeelIt\DeelItServiceProvider;
use Deelbaarmechelen\DeelIt\Observers\AssetObserver;
use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Asset;
use Deelbaarmechelen\DeelIt\Tests\Snipe\Providers\RouteServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
        Asset::observe(AssetObserver::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            DeelItServiceProvider::class,
            RouteServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
        // import the CreateAssetTagPatternTable class from the migration
        include_once __DIR__ . '/../database/migrations/create_asset_tag_pattern_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_assets_table.php';

        // run the up() method of that migration class
        (new \CreateAssetTagPatternTable)->up();
        (new \CreateAssetsTable)->up();
    }
}
