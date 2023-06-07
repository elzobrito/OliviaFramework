<?php

namespace OliviaFrameLib;

use DateTime;

trait Funcoes
{
    public function setGetRequest($item)
    {
        $var[$item . '_cript'] = $this->requestGet($item);
        $var[$item] = $this->decryptIt($var[$item . '_cript']);
        return $var;
    }

    public function setPostRequest($item)
    {
        $var[$item . '_cript'] = $this->requestPost($item);
        $var[$item] = $this->decryptIt($var[$item . '_cript']);
        return $var;
    }

    public function findObject($wheres, $values, $array)
    {
        $arrayFinal = [];

        foreach ($array as $item) {
            $match = true;

            foreach ($wheres as $key => $value) {
                if ($item->$value != $values[$key]) {
                    $match = false;
                    break;
                }
            }

            if ($match) {
                $arrayFinal[] = $item;
            }
        }

        return $arrayFinal;
    }

    public function capitalizeWords($string)
    {
        $arr = explode(' ', $string);
        foreach ($arr as $key => $word) {
            $word = strtolower($word);
            $arr[$key] = (strlen($word) > 3 ? ucfirst($word) : $word);
        }

        return implode(' ', $arr);
    }

    public function getMonthName($month)
    {
        $months = [
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'
        ];

        $numero = intval($month);
        return $months[$numero - 1] ?? '';
    }

    public function removeAccents($string)
    {
        $search = ['á', 'à', 'ã', 'â', 'ä', 'Á', 'À', 'Ã', 'Â', 'Ä', 'é', 'è', 'ê', 'ë', 'É', 'È', 'Ê', 'Ë', 'í', 'ì', 'î', 'ï', 'Í', 'Ì', 'Î', 'Ï', 'ó', 'ò', 'õ', 'ô', 'ö', 'Ó', 'Ò', 'Õ', 'Ô', 'Ö', 'ú', 'ù', 'û', 'ü', 'Ú', 'Ù', 'Û', 'Ü', 'ñ', 'Ñ', 'ç', 'Ç'];
        $replace = ['a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'o', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'O', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'n', 'N', 'c', 'C'];

        return str_replace($search, $replace, $string);
    }

    public function formatDate($data, $includeDate = true, $includeTime = false)
    {
        if ($data != null) {
            $dateTime = new DateTime($data);
            $formatoData = $includeDate ? 'd/m/Y' : '';
            $formatoHora = $includeTime ? 'H:i' : '';

            return $dateTime->format("$formatoData $formatoHora");
        }
    }

    public function getArrays(): array
    {
        return $this->arrays;
    }

    public function setArrays(array $arrays): void
    {
        $this->arrays = $this->requestArrayPost($arrays);
    }

    public function getAllParametros(): array
    {
        return $this->parametros;
    }

    public function getParametros($indice)
    {
        return $this->parametros[$indice] ?? null;
    }

    public function setParametros($nome = null): void
    {
        $this->parametros = $this->requestArrayPost($nome ?? 'params');
    }

    public function getDateTime($format): string
    {
        return (new DateTime())->format($format);
    }

    public function requestFile($dado)
    {
        return $_FILES[$dado] ?? null;
    }

    public function requestArrayGet($dado): array
    {
        return (array) filter_input(INPUT_GET, $dado, FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    }

    public function requestArrayPost($dado): array
    {
        return (array) filter_input(INPUT_POST, $dado, FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    }

    public function requestPost($dado)
    {
        return filter_input(INPUT_POST, $dado);
    }

    public function requestGet($dado)
    {
        return filter_input(INPUT_GET, $dado);
    }

    public function decodeJwtToken($token)
    {
        if (!empty($token)) {
            $parts = explode('.', $token);
            if (count($parts) === 3) {
                $decodedToken = base64_decode(str_replace('_', '/', str_replace('-', '+', $parts[1])));
                return json_decode($decodedToken);
            }
        }

        return null;
    }
}