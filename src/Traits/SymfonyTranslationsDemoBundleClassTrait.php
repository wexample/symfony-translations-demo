<?php

namespace Wexample\SymfonyTranslationsDemo\Traits;

use Wexample\SymfonyHelpers\Traits\BundleClassTrait;
use Wexample\SymfonyTranslationsDemo\WexampleSymfonyTranslationsDemoBundle;

trait SymfonyTranslationsDemoBundleClassTrait
{
    use BundleClassTrait;

    public static function getBundleClassName(): string
    {
        return WexampleSymfonyTranslationsDemoBundle::class;
    }
}
