<?php

namespace App\Services\MovieData;


use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

Class MovieDataService {

    private $client;
    /**
     * Class __contruct
     */
    public function __construct()
    {
        $this->client = new Client([
            'timeout'   => 10,
            'verify'    => false
        ]);
    }

    public function getInfo($url) {
        $response = $this->client->get($url);
        $content = $response->getBody()->getContents();
        $crawler = new Crawler( $content );
        $_this = $this;
        $data = $crawler->filter('section.ipc-page-section')
            ->each(function (Crawler $node, $i) use($_this) {
                return $_this->getNodeContent($node);
            }
            );
        dd($data[0]);
        if ($json_decoded_response->ok) {
            try {
                dd(1);
            } catch (\Throwable $throwable) {
                dump($throwable);
                Log::error($throwable);
            }
        }
    }
    private function hasContent($node)
    {
        return $node->count() > 0 ? true : false;
    }

    private function getNodeContent($node)
    {
        $array = [
            'name' => $this->hasContent($node->filter('h1')) != false ? $node->filter('h1')->text() : 'navid',
            'director' => $this->hasContent($node->filter('div.Hero__ContentContainer-sc-kvkd64-10 div.PrincipalCredits__PrincipalCreditsPanelWideScreen-sc-hdn81t-0')) != false ? $node->filter('div.Hero__ContentContainer-sc-kvkd64-10 ul li a')->text() : 'navid',
            'year' => $this->hasContent($node->filter('div.TitleBlock__TitleMetaDataContainer-sc-1nlhx7j-2')) != false ? $node->filter('div.TitleBlock__TitleMetaDataContainer-sc-1nlhx7j-2 span')->text() : 'navid',
            'age_limit' => $this->hasContent($node->filter('div.TitleBlock__TitleMetaDataContainer-sc-1nlhx7j-2')) != false ? $node->filter('div.TitleBlock__TitleMetaDataContainer-sc-1nlhx7j-2 span')->eq(1)->text() : 'navid',
            'time' => $this->hasContent($node->filter('div.TitleBlock__TitleMetaDataContainer-sc-1nlhx7j-2')) != false ? $node->filter('div.TitleBlock__TitleMetaDataContainer-sc-1nlhx7j-2 li')->eq(2)->text() : 'navid',
            'user_reviews' => $this->hasContent($node->filter('ul.ReviewContent__StyledInlineList-sc-vlmc3o-0')) != false ? $node->filter('ul.ReviewContent__StyledInlineList-sc-vlmc3o-0 li span span')->eq(0)->text() : 'navid',
            'critic_reviews' => $this->hasContent($node->filter('ul.ReviewContent__StyledInlineList-sc-vlmc3o-0')) != false ? $node->filter('ul.ReviewContent__StyledInlineList-sc-vlmc3o-0 li')->eq(1)->filter('span span')->eq(0)->text() : 'navid',
            'meta_score' => $this->hasContent($node->filter('ul.ReviewContent__StyledInlineList-sc-vlmc3o-0')) != false ? $node->filter('ul.ReviewContent__StyledInlineList-sc-vlmc3o-0 li')->eq(2)->filter('span span')->eq(0)->text() : 'navid',
            'genre' => $this->hasContent($node->filter('div.GenresAndPlot__GenresChipList-sc-cum89p-4')) != false ? preg_split('/(^[^A-Z]+|[A-Z][^A-Z]+)/',
                $node->filter('div.GenresAndPlot__GenresChipList-sc-cum89p-4')->text(), -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE) : 'navid',
            'stars' => $this->hasContent($node->filter('div.Hero__ContentContainer-sc-kvkd64-10 div.PrincipalCredits__PrincipalCreditsPanelWideScreen-sc-hdn81t-0')) != false ? $node->filter('div.PrincipalCredits__PrincipalCreditsPanelWideScreen-sc-hdn81t-0 ul li')->eq(6)->filter('div.ipc-metadata-list-item__content-container ul')->text() : '',
            'genre_links' => $this->hasContent($node->filter('div.GenresAndPlot__GenresChipList-sc-cum89p-4')) != false ? $node->filter('div.GenresAndPlot__GenresChipList-sc-cum89p-4 a')->eq(2)->attr('href') : 'navid'
        ];
        return $array;
    }
}
