<?php

namespace Wexample\SymfonyTranslationsDemo\Entity\Traits\Manipulator;

use Wexample\SymfonyHelpers\Entity\Traits\Manipulator\EntityManipulatorTrait;
use Wexample\SymfonyTranslationsDemo\Entity\DemoArticle;

trait DemoArticleEntityManipulatorTrait
{
    use EntityManipulatorTrait;

    public static function getEntityClassName(): string
    {
        return DemoArticle::class;
    }
}
