<?php

namespace modules\twittermodule\controllers;

use Craft;
use craft\web\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use yii\web\Response;

class SearchController extends Controller
{
    /**
     * @var bool|array
     */
    protected $allowAnonymous = ['index'];

    private const CACHE_KEY = 'twitter-search';
    private const CACHE_DURATION = 10;

    public function actionIndex(): Response
    {
        $cache = Craft::$app->getCache();

        $response = $cache->getOrSet(
            self::CACHE_KEY,
            static function () {
                $connection = new TwitterOAuth(
                    getenv('TWITTER_CONSUMER_KEY'),
                    getenv('TWITTER_CONSUMER_SECRET'),
                    getenv('TWITTER_ACCESS_TOKEN'),
                    getenv('TWITTER_ACCESS_TOKEN_SECRET'),
                );

                $connection->setTimeouts(30, 30);

                return $connection->get('search/tweets', [
                    'q' => '#coding',
                    'count' => 35,
                    'result_type' => 'recent'
                ]);
            },
            self::CACHE_DURATION,
        );

        return $this->asJson($response);
    }
}
