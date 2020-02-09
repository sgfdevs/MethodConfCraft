<?php

namespace modules\twittermodule\controllers;

use Craft;
use craft\web\Controller;
use TwitterAPIExchange;
use Abraham\TwitterOAuth\TwitterOAuth;

class SearchController extends Controller
{
    /**
     * @var bool|array
     */
    protected $allowAnonymous = ['index'];

    private const CACHE_KEY = 'twitter-search';
    private const CACHE_DURATION = 60 * 5;

    public function actionIndex(): \yii\web\Response
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
                    'count' => 50,
                    'result_type' => 'recent'
                ]);
            },
            self::CACHE_DURATION,
        );

        return $this->asJson($response);
    }
}
