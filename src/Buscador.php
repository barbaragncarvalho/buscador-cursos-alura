<?php

namespace src;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    /**
     * @var Crawler
     */
    private $crawler;
    /**
     * @var Client
     */
    private $clienteHttp;

    public function __construct(Client $clienteHttp, Crawler $crawler)
    {

        $this->crawler = $crawler;
        $this->clienteHttp = $clienteHttp;
    }

    public function buscar(string $url): array
    {
        $resposta = $this->clienteHttp->request('GET', $url);
        $html = $resposta->getBody();
        $this->crawler->addHtmlContent($html);
        $cursosElementos = $this->crawler->filter('span.card-curso__nome');
        $nomesCursos = [];

        foreach ($cursosElementos as $curso){
            $nomesCursos[] = $curso->textContent;
        }
        return $nomesCursos;
    }
}