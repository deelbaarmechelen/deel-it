<?php
namespace Deelbaarmechelen\DeelIt\Tests\Snipe\Http\Controllers\Api;

use Deelbaarmechelen\DeelIt\Tests\Snipe\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Http\Controllers\Controller;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Http\Requests\AssetCheckoutRequest;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Http\Transformers\AssetsTransformer;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Http\Transformers\LicensesTransformer;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Http\Transformers\SelectlistTransformer;
use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Asset;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\AssetModel;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Company;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\CustomField;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\License;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Location;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\Setting;
//use Deelbaarmechelen\DeelIt\Tests\Snipe\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Input;
use Paginator;
use Slack;
use Str;
use TCPDF;
use Validator;


/**
 * This class mimics (a simplified) behavior of App\Http\Controllers\Api\AssetsController
 * in the Snipe-IT Asset Management application.
 */
class AssetsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('deelit');
    }

    /**
     * Accepts a POST request to create a new asset
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $asset = new Asset();

        $asset->name                    = $request->get('name');
        $asset->serial                  = $request->get('serial');
        $asset->model_id                = $request->get('model_id');
        $asset->order_number            = $request->get('order_number');
        $asset->notes                   = $request->get('notes');
//        $asset->asset_tag               = $request->get('asset_tag', Asset::autoincrement_asset());
        $asset->asset_tag               = $request->get('asset_tag', 'default');
//        $asset->user_id                 = Auth::id();
        $asset->archived                = '0';
        $asset->physical                = '1';
        $asset->depreciate              = '0';
        $asset->status_id               = $request->get('status_id', 0);
        $asset->warranty_months         = $request->get('warranty_months', null);
        $asset->purchase_date           = $request->get('purchase_date', null);
        $asset->assigned_to             = $request->get('assigned_to', null);
        $asset->supplier_id             = $request->get('supplier_id', 0);
        $asset->requestable             = $request->get('requestable', 0);
        $asset->rtd_location_id         = $request->get('rtd_location_id', null);
        $asset->location_id             = $request->get('rtd_location_id', null);

        if ($asset->save()) {
            return response()->json(self::formatStandardApiResponse('success', $asset, 'Success'));
        }

        return response()->json(self::formatStandardApiResponse('error', null, $asset->getErrors()), 200);
    }

    public static function formatStandardApiResponse($status, $payload = null, $messages = null) {

        $array['status'] = $status;
        $array['messages'] = $messages;
        if (($messages) &&  (is_array($messages)) && (count($messages) > 0)) {
            $array['messages'] = $messages;
        }
        ($payload) ? $array['payload'] = $payload : $array['payload'] = null;
        return $array;
    }
 }
