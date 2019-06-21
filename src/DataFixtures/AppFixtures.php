<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Post;
class PostFixtures extends Fixture
{
    public function load( ObjectManager $manager)
    {
        $post = new Post();
        $post->setTitle("PruebaFixture");
        $post->setBody("prueba");
        $post->setTag("Ciencia");
        $post->setCreateAt(new \DateTime('now'));
        $manager->persist($post);
        $manager->flush();
    }
}