<?php


namespace AppBundle\Twig;


use AppBundle\Service\MarkdownTransformer;

class MarkdownExtension extends \Twig_Extension // Creating a new twig extension so that we can create custom twig filters to use in our twig files
{

    private $markdownTransformer;

    public function __construct(MarkdownTransformer $markdownTransformer)
    {

        $this->markdownTransformer = $markdownTransformer;
    }

    public function getFilters()
    {
        return [ // Creating an new twig simple filter object and returning it with my custom filters.
            new \Twig_SimpleFilter('markdownify', array($this, 'parseMarkdown'), [ // When 'markdownify' is used as a filter in a twig file, call to this array, which is calling to the function parseMarkdown()
               'is_safe' => ['html']
            ])
        ];
    }

    public function parseMarkdown($str) // When this function is called it returns the string that has the filter on it in upper case.
    {
        return $this->markdownTransformer->parse($str);
    }
    
    public function getName()
    {
        return 'app_markdown';
    }
}