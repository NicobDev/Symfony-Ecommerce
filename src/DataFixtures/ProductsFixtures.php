<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class ProductsFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        
        $product = new Products();
        $product->setName('Optix MAG301CR2');
        $product->setDescription('écran gaming MSI Optix MAG301CR2 est doté d une dalle VA incurvée de 29.5 pouces avec résolution WFHD pour vous transporter au coeur de l action. Découvrez des perfo');
        $product->setSlug('PB00383111');
        $product->setPrice('37900');
        $product->setStock('9');
        $product->setWeight('7');

        //On va chercher une référence de catégorie
        $category = $this->getReference('cat-3');
        $product->setCategories($category);

        $this->setReference('prod-667', $product);
        $manager->persist($product);
        
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');

        for($prod = 1; $prod <= 10; $prod++){
            $product = new Products();
            $product->setName($faker->text(15));
            $product->setDescription($faker->text());
            $product->setSlug($this->slugger->slug($product->getName())->lower());
            $product->setPrice($faker->numberBetween(900, 150000));
            $product->setStock($faker->numberBetween(0, 10));
            $product->setWeight($faker->numberBetween(0, 100));

            //On va chercher une référence de catégorie
            $category = $this->getReference('cat-'. rand(1, 8));
            $product->setCategories($category);

            $this->setReference('prod-'.$prod, $product);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
