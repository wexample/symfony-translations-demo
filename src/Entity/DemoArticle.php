<?php

namespace Wexample\SymfonyTranslationsDemo\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Wexample\SymfonyHelpers\Entity\AbstractEntity;
use Wexample\SymfonyTranslations\Attribute\Translatable;
use Wexample\SymfonyTranslationsDemo\Repository\DemoArticleRepository;

/**
 * Content written in the default locale and read in every other one.
 *
 * Only the title and the summary are marked: the slug is an identifier, the
 * same whatever the language, and stays out of the translation table.
 *
 * Its identity derives from its slug, so the articles a page asks for are made
 * once and found on every visit after.
 */
#[ORM\Entity(repositoryClass: DemoArticleRepository::class)]
#[ORM\Table(name: 'demo_article')]
#[ORM\UniqueConstraint(columns: ['slug'])]
class DemoArticle extends AbstractEntity
{
    public const string ID_NAMESPACE = '0c9f3a6e-2b71-5e84-9d3c-7a15e8b40f62';

    #[ORM\Column(type: Types::STRING, length: 128)]
    protected string $slug;

    #[Translatable]
    #[ORM\Column(type: Types::STRING, length: 255)]
    protected string $title;

    #[Translatable]
    #[ORM\Column(type: Types::TEXT)]
    protected string $summary;

    public function __construct(
        string $slug,
        string $title,
        string $summary
    ) {
        parent::__construct();

        $this->slug = $slug;
        $this->title = $title;
        $this->summary = $summary;

        $this->setId(self::idFor($slug));
    }

    public static function idFor(string $slug): Uuid
    {
        return Uuid::v5(Uuid::fromString(self::ID_NAMESPACE), $slug);
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }
}
