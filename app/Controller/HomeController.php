<?php

namespace OliviaFrameApp\Controller;

use OliviaFrameApp\Abstracts\AbstractController;
use OliviaFramePublico\E404;
use OliviaFramePublico\Home\Index;

use HttpServiceSrc\HttpClient\ServicoHttpClient;
use HttpServiceSrc\service\ServicoService;

class HomeController extends AbstractController
{
    public function index()
    {
        // Cria uma instância do ServicoHttpClient passando a base URL
        $httpClient = new ServicoHttpClient('https://dummyjson.com', 'Content-Type: application/json\r\n', '1.1');

        // Cria uma instância do ServicoService passando o HttpClient
        $servicoService = new ServicoService($httpClient);
        $result = $servicoService->getSearchWithSlash('products/1'); // Corrigido: passando uma string como argumento
        print_r(json_decode($result));
        // $parametros = $this->config_controller();
        // new Index($parametros);
    }

    public function error404()
    {
        $parametros = $this->config_controller();
        new E404($parametros);
    }
}
