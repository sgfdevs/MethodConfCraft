<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        'sessions.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'session'],
                'transformer' => function(Entry $entry) {
                    $speaker = $entry->speaker->one();
                    $image = ($speaker && $speaker->image) ? $speaker->image->one() : null;
                    $sessionType = $entry->sessionType->one();

                    return [
                        'title' => $entry->title,
                        'url' => $entry->url,
                        'status' => $entry->status,
                        'description' => $entry->description,
                        'time' => $entry->timeLabel,
                        'type' => $sessionType->title,
                        'speaker' => [
                            'name' => $speaker ? $speaker->title : null,
                            'title' => $speaker ? $speaker->professionalTitle : null,
                            'image' => $image ? $image->url : null,
                            'bio' => $speaker ? $speaker->bio : null,
                            'professionalTitle' => $speaker ? $speaker->professionalTitle : null,
                            'websiteURL' => $speaker ? $speaker->websiteUrl : null,
                            'twitterUrl' => $speaker ? $speaker->twitterUrl : null,
                            'twitter2Url' => $speaker ? $speaker->twitter2Url : null,
                            'githubUrl' => $speaker ? $speaker->githubUrl : null,
                            'linkedinUrl' => $speaker ? $speaker->linkedinUrl : null
                        ]
                    ];
                },
            ];
        },
        'sponsors.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'sponsors'],
                'transformer' => function(Entry $entry) {
                    $image = $entry->sponsorImage->one();

                    return [
                        'title' => $entry->title,
                        'url' => $entry->websiteUrl,
                        'image' => $image ? $image->url : null,
                        'mobileSponsor' => $entry->mobileSponsor
                    ];
                },
            ];
        },
        'speakers.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'speaker'],
                'transformer' => function(Entry $entry) {
                    $image = $entry->image->one();

                    return [
                        'title' => $entry->title,
                        'url' => $entry->url,
                        'image' => $image ? $image->url : null,
                    ];
                },
            ];
        },
    ]
];
