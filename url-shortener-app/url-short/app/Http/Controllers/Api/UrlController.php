<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\UrlMapper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class UrlController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function url()
    {
        $post = file_get_contents('php://input');
        $postJson = json_decode($post, true);
        if (!empty($postJson['url'])) {
            $url = $postJson['url'];
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $urlMapper = UrlMapper::where('url', $postJson['url'])->first();
                if ($urlMapper) {
                    return new JsonResponse(['shortUrl' => 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/su/' . $urlMapper->url_code]);
                } else {
                    return new JsonResponse(['error' => 'Url not found'], 400);
                }

            } else {
                return new JsonResponse(['error' => 'Invalid Request'], 400);
            }

        } else {
            return new JsonResponse(['error' => 'Invalid Request'], 400);
        }

    }

    /**
     * @return JsonResponse
     */
    public function top()
    {
        $urlMappers = DB::table('url_mappers')
            ->orderBy('visits_count', 'desc')
            ->limit(100);

        if ($urlMappers->count()) {
            return new JsonResponse($urlMappers->get());
        } else {
            return new JsonResponse(['message' => 'No result was found!']);
        }
    }

    public function getUrl($code)
    {
        $urlMapper = UrlMapper::where(['url_code' => $code])->first();
        if ($urlMapper) {
            return new JsonResponse(['url' => $urlMapper->url]);
        } else {
            return new JsonResponse(['message' => 'No result was found!']);
        }
    }

}
