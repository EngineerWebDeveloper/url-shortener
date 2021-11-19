<?php

namespace App\Http\Controllers;


use App\UrlMapper;
use GuzzleHttp\Psr7\Request;

class IndexController extends Controller
{
    public function index($code)
    {
        $urlMapper = UrlMapper::where('url_code', $code)->first();
        if ($urlMapper) {
            $urlMapper->visits_count += 1;
            $urlMapper->save();
            return redirect()->to($urlMapper->url);
        } else {
            abort(404);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addUrlForm()
    {
        return view('index.add');
    }

    public function addUrl(\Illuminate\Http\Request $request)
    {
        $url = $request->get("url");
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $urlMapper = UrlMapper::where('url', $url)->first();
            if($urlMapper){
                echo "Url already exists: ".'http://'. $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/su/' . $urlMapper->url_code ; ;
            }else{
                $newUrlMapper = new UrlMapper();
                $newUrlMapper->url = $url;
                $newUrlMapper->url_code =  substr(md5($url), 0, 8);;
                $newUrlMapper->visits_count = 0;
                $newUrlMapper->save();
                echo "url was successfully added: ". 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/su/' . $newUrlMapper->url_code ;
            }
        } else {
            echo "Invalid URL, please try again!";
        }
    }
}
