<?php

namespace OliviaFrameLib;

use DateTime;
use OliviaCryptography\AESDecrypt;
use OliviaCryptography\AESEncrypt;

class Funcoes
{
    private $parametros;
    private $arrays;

    public static function setGetRequest($item)
    {
        $AESDecrypt = new AESDecrypt();
        $var[$item . '_cript'] = self::requestGet($item);
        $var[$item] = $AESDecrypt->decrypt($var[$item . '_cript'], $_SESSION['secret_key'], $_SESSION['secret_iv']);
        return $var;
    }

    public static function setPostRequest($item)
    {
        $AESDecrypt = new AESDecrypt();
        $var[$item . '_cript'] = self::requestPost($item);
        $var[$item] = $AESDecrypt->decrypt($var[$item . '_cript'], $_SESSION['secret_key'], $_SESSION['secret_iv']);
        return $var;
    }

    public static function findObject($wheres, $values, $array)
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

    public static function capitalizeWords($string)
    {
        $arr = explode(' ', $string);
        foreach ($arr as $key => $word) {
            $word = strtolower($word);
            $arr[$key] = (strlen($word) > 3 ? ucfirst($word) : $word);
        }

        return implode(' ', $arr);
    }

    public static function getMonthName($month)
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

    public static function removeAccents($string)
    {
        $search = ['á', 'à', 'ã', 'â', 'ä', 'Á', 'À', 'Ã', 'Â', 'Ä', 'é', 'è', 'ê', 'ë', 'É', 'È', 'Ê', 'Ë', 'í', 'ì', 'î', 'ï', 'Í', 'Ì', 'Î', 'Ï', 'ó', 'ò', 'õ', 'ô', 'ö', 'Ó', 'Ò', 'Õ', 'Ô', 'Ö', 'ú', 'ù', 'û', 'ü', 'Ú', 'Ù', 'Û', 'Ü', 'ñ', 'Ñ', 'ç', 'Ç'];
        $replace = ['a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'e', 'e', 'e', 'e', 'E', 'E', 'E', 'E', 'i', 'i', 'i', 'i', 'I', 'I', 'I', 'I', 'o', 'o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'O', 'u', 'u', 'u', 'u', 'U', 'U', 'U', 'U', 'n', 'N', 'c', 'C'];

        return str_replace($search, $replace, $string);
    }

    public static function formatDate($data, $includeDate = true, $includeTime = false)
    {
        if ($data != null) {
            $dateTime = new DateTime($data);
            $formatoData = $includeDate ? 'd/m/Y' : '';
            $formatoHora = $includeTime ? 'H:i' : '';

            return $dateTime->format("$formatoData $formatoHora");
        }
    }

    public static function getArrays(): array
    {
        return self::$arrays;
    }

    public static function setArrays(array $arrays): void
    {
        self::$arrays = self::requestArrayPost($arrays);
    }

    public static function getAllParametros(): array
    {
        return self::$parametros;
    }

    public static function getParametros($indice)
    {
        return self::$parametros[$indice] ?? null;
    }

    public static function setParametros($nome = null): void
    {
        self::$parametros = self::requestArrayPost($nome ?? 'params');
    }

    public static function getDateTime($format): string
    {
        return (new DateTime())->format($format);
    }

    public static function requestFile($dado)
    {
        return $_FILES[$dado] ?? null;
    }

    public static function requestArrayGet($dado): array
    {
        return (array) filter_input(INPUT_GET, $dado, FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    }

    public static function requestArrayPost($dado): array
    {
        return (array) filter_input(INPUT_POST, $dado, FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    }

    public static function requestPost($dado)
    {
        return filter_input(INPUT_POST, $dado);
    }

    public static function requestGet($dado)
    {
        return filter_input(INPUT_GET, $dado);
    }

    public static function decodeJwtToken($token)
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
