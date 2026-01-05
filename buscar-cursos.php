<?php

require 'vendor/autoload.php';
require 'src/Buscador.php';

use src\Buscador;
use Symfony\Component\DomCrawler\Crawler;

$cliente = new \GuzzleHttp\Client(['base_uri'=>'https://www.alura.com.br/']);
$crawler = new Crawler();

$buscador = new Buscador($cliente, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao');

foreach ($cursos as $curso){
    echo $curso . PHP_EOL;
}