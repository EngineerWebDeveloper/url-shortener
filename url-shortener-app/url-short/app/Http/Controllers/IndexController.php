<?php
namespace App\Http\Controllers;


use App\UrlMapper;

class IndexController extends Controller
{
    public function index($code)
    {
        $urlMapper = UrlMapper::where('url_code', $code)->first();
        if ($urlMapper) {
            $urlMapper->visits_count +=1;
            $urlMapper->save();
            return redirect()->to($urlMapper->url);
        } else {
            abort(404);
        }
    }
}
