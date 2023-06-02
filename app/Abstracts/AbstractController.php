<?php

namespace OliviaFrameApp\Abstracts;

class AbstractController
{
    protected function config_controller($table_coord = null, $pre_url = null)
    {
        $parametros['nivel'] = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $parametros['pre_url'] = $pre_url ?? '';
        $parametros['table_coord'] = $table_coord;
        $parametros['error'] = '';
        
        return $parametros;
    }
}