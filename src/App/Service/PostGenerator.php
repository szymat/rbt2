<?php

namespace App\Service;

use App\Entity\Post;
use joshtronic\LoremIpsum;

class PostGenerator
{
    private LoremIpsum $loremIpsum;

    public function __construct(LoremIpsum $loremIpsum)
    {
        $this->loremIpsum = $loremIpsum;
    }

    public function generateByType(string $type) : Post
    {
        if ($type === 'summary') {
            return $this->generateSummaryPost();
        }

        return $this->generateRandomPost();
    }

    public function generateRandomPost(): Post
    {
        $post = new Post();

        $title = $this->loremIpsum->words(random_int(4, 6));
        $content = $this->loremIpsum->paragraphs(2);

        $post->setTitle($title);
        $post->setContent($content);

        return $post;
    }

    public function generateSummaryPost(): Post
    {
        $post = new Post();

        $content = $this->loremIpsum->paragraphs(1);
        $date = (new \DateTime())->format('Y-m-d');
        $post->setTitle("Summary $date");
        $post->setContent($content);

        return $post;
    }
}
