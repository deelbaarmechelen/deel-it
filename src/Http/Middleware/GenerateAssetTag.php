<?php

namespace Deelbaarmechelen\DeelIt\Http\Middleware;

use Closure;
use Deelbaarmechelen\DeelIt\Models\AssetTagPattern;

class GenerateAssetTag
{
    const COMPANY_TOKEN = 'CC';
    const YEAR_4_TOKEN = 'YYYY';
    const YEAR_2_TOKEN = 'YY';

    public function handle($request, Closure $next)
    {
        if (!$request->has('asset_tag') && $request->has('company_id')) {

            $asset_tag_pattern = config('deel-it.pattern');
            $digitsCount = strspn($asset_tag_pattern, '0', strpos($asset_tag_pattern, "0"));
            if (str_contains($asset_tag_pattern, self::COMPANY_TOKEN) ) {
                $companyAbbreviations = config('deel-it.company_abbrev');
                $companyAbbreviation = $companyAbbreviations[$request->get('company_id')];
                $asset_tag_pattern = str_replace(self::COMPANY_TOKEN, $companyAbbreviation, $asset_tag_pattern);
            }
            if (str_contains($asset_tag_pattern, self::YEAR_4_TOKEN) ) {
                $asset_tag_pattern = str_replace(self::YEAR_4_TOKEN, date('Y'), $asset_tag_pattern);
            }
            if (str_contains($asset_tag_pattern, self::YEAR_2_TOKEN) ) {
                $asset_tag_pattern = str_replace(self::YEAR_2_TOKEN, date('y'), $asset_tag_pattern);
            }

            // get next value for asset_tag
            $next_seq_id = 1;
            $assetPattern = AssetTagPattern::query()->where('pattern', '=', $asset_tag_pattern)->first();
            if (isset($assetPattern)) {
                $next_seq_id = $assetPattern->next_auto_id;
            }
            $asset_tag = str_replace(str_repeat('0', $digitsCount), self::zerofill($next_seq_id, $digitsCount), $asset_tag_pattern);

            $request->merge([
                'asset_tag' => $asset_tag
            ]);
        }

        return $next($request);
    }

    public static function zerofill($num, $zerofill = 3)
    {
        return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
    }
}