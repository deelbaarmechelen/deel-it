<?php
namespace Deelbaarmechelen\DeelIt\Tests\Snipe\Models;

use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Traits\Acceptable;
use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Traits\Searchable;
use AssetPresenter;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Model for Assets.
 *
 * @version    v1.0
 */
class Asset extends Depreciable
{
    use SoftDeletes;

    const LOCATION = 'location';
    const ASSET = 'asset';
    const USER = 'user';

    use Acceptable;


    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'assets';



//    /**
//     * Get the next autoincremented asset tag
//     *
//     * @author [A. Gianotto] [<snipe@snipe.net>]
//     * @since [v4.0]
//     * @return string | false
//     */
//    public static function autoincrement_asset()
//    {
//        $settings = \App\Models\Setting::getSettings();
//
//
//        if ($settings->auto_increment_assets == '1') {
//            $temp_asset_tag = \DB::table('assets')
//                ->where('physical', '=', '1')
//                ->max('asset_tag');
//
//            $asset_tag_digits = preg_replace('/\D/', '', $temp_asset_tag);
//            $asset_tag = preg_replace('/^0*/', '', $asset_tag_digits);
//
//            if ($settings->zerofill_count > 0) {
//                return $settings->auto_increment_prefix.Asset::zerofill($settings->next_auto_tag_base, $settings->zerofill_count);
//            }
//            return $settings->auto_increment_prefix.$settings->next_auto_tag_base;
//        } else {
//            return false;
//        }
//    }


//    /**
//     * Get the next base number for the auto-incrementer.
//     *
//     * We'll add the zerofill and prefixes on the fly as we generate the number.
//     *
//     * @author [A. Gianotto] [<snipe@snipe.net>]
//     * @since [v4.0]
//     * @return int
//     */
//    public static function nextAutoIncrement($assets)
//    {
//
//        $max = 1;
//
//        foreach ($assets as $asset) {
//            $results = preg_match ( "/\d+$/" , $asset['asset_tag'], $matches);
//
//            if ($results)
//            {
//                $number = $matches[0];
//
//                if ($number > $max)
//                {
//                    $max = $number;
//                }
//            }
//        }
//        return $max + 1;
//
//    }



//    /**
//     * Add zerofilling based on Settings
//     *
//     * We'll add the zerofill and prefixes on the fly as we generate the number.
//     *
//     * @author [A. Gianotto] [<snipe@snipe.net>]
//     * @since [v4.0]
//     * @return string
//     */
//    public static function zerofill($num, $zerofill = 3)
//    {
//        return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
//    }


}
