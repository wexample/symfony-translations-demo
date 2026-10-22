<?php

namespace Wexample\SymfonyTranslationsDemo\Controller\Pages;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Wexample\SymfonyHelpers\Helper\VariableHelper;
use Wexample\SymfonyLoader\Controller\AbstractPagesController;
use Wexample\SymfonyTranslations\Service\ContentTranslationService;
use Wexample\SymfonyTranslationsDemo\Repository\DemoArticleRepository;
use Wexample\SymfonyTranslationsDemo\Traits\SymfonyTranslationsDemoBundleClassTrait;

/**
 * The same page in every language the application speaks: its wording comes
 * from the yml files, its articles from the content_translation table.
 */
#[Route(path: '/translations/', name: 'translations_demo_')]
final class TranslationsController extends AbstractPagesController
{
    use SymfonyTranslationsDemoBundleClassTrait;

    final public const string ROUTE_INDEX = VariableHelper::INDEX;

    final public const string ROUTE_SYNTAX = 'syntax';

    #[Route(path: '', name: self::ROUTE_INDEX)]
    public function index(
        DemoArticleRepository $articleRepository,
        ContentTranslationService $contentTranslationService,
    ): Response {
        return $this->renderPage(self::ROUTE_INDEX, [
            'articles' => $articleRepository->findOrCreateDemoArticles(),
            'source_locale' => $contentTranslationService->getSourceLocale(),
        ]);
    }

    /**
     * What a translation file can say besides plain wording: domains relative
     * to the page, includes, extensions, and keys handed to javascript.
     */
    #[Route(path: self::ROUTE_SYNTAX, name: self::ROUTE_SYNTAX)]
    public function syntax(): Response
    {
        return $this->renderPage(self::ROUTE_SYNTAX);
    }
}
