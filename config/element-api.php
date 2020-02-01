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
                        'speakerName' => $speaker ? $speaker->title : null,
                        'speakerTitle' => $speaker ? $speaker->professionalTitle : null,
                        'speakerImage' => $image ? $image->url : null,
                        'speakerBio' => $speaker ? $speaker->bio : null,
                        'speakerProfessionalTitle' => $speaker ? $speaker->professionalTitle : null,
                        'speakerWebsiteURL' => $speaker ? $speaker->websiteUrl : null,
                        'speakerTwitterUrl' => $speaker ? $speaker->twitterUrl : null,
                        'speakerTwitter2Url' => $speaker ? $speaker->twitter2Url : null,
                        'speakerGithubUrl' => $speaker ? $speaker->githubUrl : null,
                        'speakerLinkedinUrl' => $speaker ? $speaker->linkedinUrl : null
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
