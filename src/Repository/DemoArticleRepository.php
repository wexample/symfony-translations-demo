<?php

namespace Wexample\SymfonyTranslationsDemo\Repository;

use Wexample\SymfonyHelpers\Repository\AbstractRepository;
use Wexample\SymfonyTranslationsDemo\Entity\DemoArticle;
use Wexample\SymfonyTranslationsDemo\Entity\Traits\Manipulator\DemoArticleEntityManipulatorTrait;

/**
 * @method DemoArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemoArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemoArticle[]    findAll()
 * @method DemoArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemoArticleRepository extends AbstractRepository
{
    use DemoArticleEntityManipulatorTrait;

    /**
     * What the demo shows, in the default locale. Each holds a parameter or
     * some markup, which a translation must bring back untouched.
     */
    private const array ARTICLES = [
        'welcome' => [
            'Welcome to the translation demo',
            'This article is written in English. Switch the language: its title and summary are translated the first time they are read, then served from the database.',
        ],
        'placeholders' => [
            'Placeholders survive translation',
            'Hello %name%, you have {count} new messages. Parameters like these are hidden from the engine and put back afterwards.',
        ],
        'markup' => [
            'Markup is kept as it is',
            'A sentence with <strong>bold words</strong> and a <em>subtle emphasis</em>, whose tags never reach the engine.',
        ],
    ];

    /**
     * A demo has no fixtures: the articles are made the first time the page is
     * opened, and found on every visit after.
     *
     * @return DemoArticle[]
     */
    public function findOrCreateDemoArticles(): array
    {
        $articles = [];

        foreach (self::ARTICLES as $slug => [$title, $summary]) {
            $article = $this->find(DemoArticle::idFor($slug));

            if (null === $article) {
                $article = new DemoArticle($slug, $title, $summary);
                $this->getEntityManager()->persist($article);
            }

            $articles[] = $article;
        }

        $this->getEntityManager()->flush();

        return $articles;
    }
}
