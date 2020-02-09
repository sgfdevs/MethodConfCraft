<?php

namespace modules\twittermodule;

use Craft;
use yii\base\Module;

class TwitterModule extends Module
{
    /**
     * @var TwitterModule
     */
    public static $instance;

    /**
     * @inheritDoc
     */
    public function __construct($id, $parent = null, $config = [])
    {
        Craft::setAlias('@modules/twittermodule', $this->getBasePath());
        $this->controllerNamespace = 'modules\twittermodule\controllers';

        static::setInstance($this);

        parent::__construct($id, $parent, $config);
    }

    public function init()
    {
        parent::init();
        self::$instance = $this;
    }
}
