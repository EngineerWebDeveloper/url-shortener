<?php
namespace App\Http\Controllers;


use App\Models\UrlMapper;

class IndexController extends Controller
{
    public function index($code)
    {
        $urlMapper = UrlMapper::where('url_code', $code)->first();
        if ($urlMapper) {
            header("Location: $urlMapper->url");
            die();
        } else {
            abort(404);
        }

    }
}
