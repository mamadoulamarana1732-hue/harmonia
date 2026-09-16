<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use App\Factory\AlbumFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\TypeFactory;
use App\Factory\ArtistFactory;
use App\Factory\HistoryFactory;
use App\Factory\PlaylistFactory;
use App\Factory\SonFactory;
use App\Factory\UserFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        TypeFactory::createone([
            'color' => "rose",
            'name' => "RNB",
        ]);
        TypeFactory::createMany(100);

         ArtistFactory::createone([
             'biography' => "Je suis un artiste de RNB réconneu sous le pseudonyme de Mista X",
            'countryOrigin' =>"France",
            'name' => "Mista X",
        ]);

        ArtistFactory::createMany(100);

        UserFactory::createOne([
            'email' =>"mamadou@gmail.com",
            'pseudo'=>"RAMADHANE",
            'password' =>"rougui",
            'roles' => ["ROLES_ADMIN"],
        ]);
        UserFactory::createMany(100);

        AlbumFactory::createOne([
            'cover' => "Image de l'artiste",
            'title' => "Enfant du Pays",
            'type' => 'EP',
        ]);
        AlbumFactory::createMany(50);

        PlaylistFactory::createMany(100);

        SonFactory::createMany(100);

        HistoryFactory::createMany(100);

        


        $manager->flush();
    }
}
