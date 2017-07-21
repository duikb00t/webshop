<?php

use Doctrine\ORM\EntityManager;
use WTG\ContentManager\Entities\Block;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlocksToBlocksTable extends Migration
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * AddBlocksToBlocksTable constructor.
     */
    public function __construct()
    {
        $this->em = app()->make(EntityManager::class);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createBlock('news', 'Nieuws', '<h3>Dit is het nieuws blok</h3>');
        $this->createBlock('about', 'Over ons', '<h3>Dit is het over ons blok</h3>');
        $this->createBlock('downloads.catalog', 'Catalogus', '<h3>Dit is het catalogus blok</h3>');
        $this->createBlock('downloads.flyers', 'Flyers', '<h3>Dit is het flyers blok</h3>');
        $this->createBlock('downloads.products', 'Artikelbestanden', '<h3>Dit is het artikelbestanden blok</h3>');

        $this->em->flush();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->em->getRepository(Block::class);
    }

    /**
     * Create a new block.
     *
     * @param  string  $name
     * @param  string  $title
     * @param  string  $content
     * @return Block
     */
    private function createBlock($name, $title, $content): Block
    {
        $block = new Block($name, $title, $content);

        $this->em->persist($block);

        return $block;
    }
}
