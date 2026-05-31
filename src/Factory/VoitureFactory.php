<?php

namespace App\Factory;

use App\Entity\Voiture;
use App\Enum\BoiteCategories;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Voiture>
 */
final class VoitureFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Voiture::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'boite' => self::faker()->randomElement(BoiteCategories::cases()),
            'description' => self::faker()->text(),
            'nom' => self::faker()->sentence(3),
            'places' => self::faker()->numberBetween(1, 8),
            'tarifJour' => self::faker()->randomFloat(2, 30, 50), // TODO add SMALLFLOAT type manually
            'tarifMois' => self::faker()->randomFloat(2, 800, 999), // TODO add SMALLFLOAT type manually
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Voiture $voiture): void {})
        ;
    }
}
