<?php

namespace Cube\RedactorBundle\Util;

class JsonConverter
{
    public static function buildBrokenJson(array $data)
    {
        $result = '{';

        $separator = '';
        foreach ($data as $key => $val) {
            $result .= $separator . $key . ':';

            if (is_int($val)) {
                $result .= $val;
            } elseif (is_string($val)) {
                $result .= '"' . str_replace('"', '\"', $val) . '"';
            } elseif (is_bool($val)) {
                $result .= $val ? 'true' : 'false';
            } else {
                $result .= $val;
            }

            $separator = ', ';
        }

        $result .= '}';

        return $result;
    }
}
