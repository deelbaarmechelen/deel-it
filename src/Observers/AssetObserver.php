<?php

namespace Deelbaarmechelen\DeelIt\Observers;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Deelbaarmechelen\DeelIt\Models\AssetTagPattern;

class AssetObserver
{
    /**
     * Listen to the Asset created event, and increment 
     * the next_auto_id value for corresponding asset tag pattern
     *
     * @param  Asset  $asset
     * @return void
     */
    public function created(Model $asset)
    {
        \Log::debug("created event fired for model: updating next_auto_id");

        if (!isset($asset->asset_tag)) { // not an asset
            return;
        }
        $digitsCount = strspn(strrev($asset->asset_tag), "1234567890"); // count digits backwards
        $pattern = substr($asset->asset_tag, 0, $digitsCount * -1) .  str_repeat('0', $digitsCount); // replace last digits by zeroes
        Log::debug('Asset created with pattern ' .$pattern);

        $assetTagPattern = AssetTagPattern::query()->where('pattern', '=', $pattern)->first();
        if (!isset($assetTagPattern)) {
            $assetTagPattern = new AssetTagPattern();
            $assetTagPattern->pattern = $pattern;
            $assetTagPattern->next_auto_id = 1;
            $assetTagPattern->save();
        }

        $assetTagSeqNbr = substr($asset->asset_tag, $digitsCount * -1); // last digits
        Log::debug("Current asset seq value " . intval($assetTagSeqNbr));
        $nextAutoId = intval($assetTagSeqNbr) + 1;
        if ($nextAutoId > $assetTagPattern->next_auto_id) {
            Log::debug('Updating next value for pattern ' . $pattern . ' to ' . $nextAutoId);
            $assetTagPattern->next_auto_id = $nextAutoId;
            $assetTagPattern->save();
        }
    }

}
