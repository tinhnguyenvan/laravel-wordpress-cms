<?php

namespace App\Http\Controllers\Site;

use App\Models\Ads;
use Illuminate\Http\Request;

/**
 * Class AdsController.
 */
final class AdsController extends SiteController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tracking(Request $request, $slug)
    {
        $id = base64_decode($slug);
        $ads = Ads::query()->findOrFail($id);

        // update view
        Ads::query()->where('id', $id)->increment('views');

        if (!empty($ads->link)) {
            return redirect($ads->link, 302);
        }

        return redirect(base_url());
    }

}
