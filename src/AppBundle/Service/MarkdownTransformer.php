<?php


namespace AppBundle\Service;


use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser; // Creating the property that will be assigned to the object.

    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, Cache $cache) // Using a constructor method for Dependency Injection, passing the object I want as the argument
    {
        $this->markdownParser = $markdownParser; // Assigning the property to the object
        $this->cache = $cache;
    }

    public function parse($str)
    {
        $cache = $this->cache;
        $key = md5($str);
        if ($cache->contains($key)) {
            return $cache->fetch($key);
        }

        sleep(1);
         $str = $this->markdownParser // Calling the property so that we can use the markdownParser object
            ->transformMarkdown($str);
        $cache->save($key, $str);

        return $str;
    }

}