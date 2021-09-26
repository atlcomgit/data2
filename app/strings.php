<?php
//______________________________________________________________________________________________________________________________________________________________

namespace App;

class Strings
{
    function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }

    function interval2around($minValue, $maxValue, $getValue)
    {
        $result = $getValue;
        if ($minValue > $maxValue) {
            $m = $maxValue;
            $maxValue = $minValue;
            $minValue = $m;
        }
        if ($getValue < $minValue || $getValue > $maxValue) {
            if ($getValue > $maxValue) $result = (($getValue - $minValue) % ($maxValue - $minValue + 1)) + $minValue;
            else $result = $maxValue - (abs($getValue - $minValue + 1) - abs($maxValue - $minValue + 1) * floor(abs($getValue - $minValue + 1) / ($maxValue - $minValue + 1)));
        }
        return $result;
    }

    function cryptStr($str)
    {
        if ($str != '') {
            mt_srand(self::make_seed());
            $rnd = mt_rand(10, 99);
            $str = strtoupper($str);
            $new = '';
            for ($aa = 0; $aa < strlen($str); $aa++) $new .= (string) ord($str[$aa]);
            $cc = strlen($new);
            $bb = 0;
            for ($aa = 0; $aa < $cc; $aa++) {
                $lb = ord($new[$aa]);
                $new[$aa] = chr(self::interval2around(48, 57, $lb + $aa + $bb + $cc + $rnd));
                $bb = $lb;
            }
        } else {
            $rnd = '';
            $new = '';
        }

        return (string) substr($rnd, 0, 1) . $new . substr($rnd, -1);
    }

    function uncryptStr($str)
    {
        if ($str != '') {
            $rnd = (int) substr($str, 0, 1) . substr($str, -1);
            $str = substr($str, 1, -1);
            $cc = strlen($str);
            $bb = 0;
            for ($aa = 0; $aa < $cc; $aa++) {
                $lb = ord($str[$aa]);
                $str[$aa] = chr(self::interval2around(48, 57, $lb - $aa - $bb - $cc - $rnd));
                $bb = ord($str[$aa]);
            }
            $new = '';
            while ($str != '') {
                $new .= chr(substr($str, 0, 2));
                $str = substr($str, 2);
            }
        } else $new = '';

        return strtolower($new);
    }

    function cryptStrSite($str)
    {
        if ($str != '') {
            mt_srand(self::make_seed());
            $rnd = 77; /*mt_rand(10,99);*/
            $str = strtoupper($str);
            $new = '';
            for ($aa = 0; $aa < strlen($str); $aa++) $new .= (string) ord($str[$aa]);
            $cc = strlen($new);
            $bb = 0;
            for ($aa = 0; $aa < $cc; $aa++) {
                $lb = ord($new[$aa]);
                $new[$aa] = chr(self::interval2around(48, 57, $lb + $aa + $bb + $cc + $rnd));
                $bb = $lb;
            }
        } else {
            $rnd = '';
            $new = '';
        }

        return (string) $rnd . $new;
    }

    function uncryptStrSite($str)
    {
        if ($str != '') {
            $rnd = (int) substr($str, 0, 2);
            $str = substr($str, 2);
            $cc = strlen($str);
            $bb = 0;
            for ($aa = 0; $aa < $cc; $aa++) {
                $lb = ord($str[$aa]);
                $str[$aa] = chr(self::interval2around(48, 57, $lb - $aa - $bb - $cc - $rnd));
                $bb = ord($str[$aa]);
            }
            $new = '';
            while ($str != '') {
                $new .= chr(substr($str, 0, 2));
                $str = substr($str, 2);
            }
        } else $new = '';

        return strtolower($new);
    }

    function cryptStrRus($str)
    {
        if ($str != '') {
            mt_srand(self::make_seed());
            mt_rand(100, 255);
            $new = '';
            for ($aa = 0; $aa < strlen($str); $aa++) $new .= (string) sprintf("%03d", ord($str[$aa]));
            $cc = strlen($new);
            $bb = 0;
            for ($aa = 0; $aa < $cc; $aa++) {
                $lb = ord($new[$aa]);
                $new[$aa] = chr(self::interval2around(48, 57, $lb + $aa + $bb + $cc + $rnd));
                $bb = $lb;
            }
        } else {
            $rnd = '';
            $new = '';
        }

        return (string) $rnd . $new;
    }

    function uncryptStrRus($str)
    {
        if ($str != '') {
            $rnd = (int) substr($str, 0, 3);
            $str = substr($str, 3);
            $cc = strlen($str);
            $bb = 0;
            for ($aa = 0; $aa < $cc; $aa++) {
                $lb = ord($str[$aa]);
                $str[$aa] = chr(self::interval2around(48, 57, $lb - $aa - $bb - $cc - $rnd));
                $bb = ord($str[$aa]);
            }
            $new = '';
            while ($str != '') {
                $new .= chr(substr($str, 0, 3));
                $str = substr($str, 3);
            }
        } else $new = '';

        return $new;
    }

    function completion4str($str, $end0, $end1, $end2)
    {
        $str = floor(floatval($str));
        $bb = (int)substr($str, strlen($str) - 2, 2);
        $aa = $bb % 10;
        if ($aa == 1 && $bb != 11) $result = $end1;
        else if ($aa > 1 && $aa < 5 && !($bb > 11 && $bb < 15)) $result = $end2;
        else $result = $end0;
        return $result;
    }
    function completion2str($str, $end0, $end1, $end2, $addstr = false)
    {
        return (($str !== '' && $addstr) ? "$str " : "") . self::completion4str($str, $end0, $end1, $end2);
    }

    function convert2eng($str)
    {
        $pattern  =     array(
            '/А/', '/Б/', '/В/', '/Г/', '/Д/', '/Е/', '/Ё/', '/Ж/', '/З/', '/И/', '/Й/', '/К/', '/Л/', '/М/', '/Н/', '/О/', '/П/', '/Р/', '/С/', '/Т/', '/У/', '/Ф/', '/Х/', '/Ц/', '/Ч/', '/Ш/', '/Щ/', '/Ъ/', '/Ы/', '/Ь/', '/Э/', '/Ю/', '/Я/',
            '/а/', '/б/', '/в/', '/г/', '/д/', '/е/', '/ё/', '/ж/', '/з/', '/и/', '/й/', '/к/', '/л/', '/м/', '/н/', '/о/', '/п/', '/р/', '/с/', '/т/', '/у/', '/ф/', '/х/', '/ц/', '/ч/', '/ш/', '/щ/', '/ъ/', '/ы/', '/ь/', '/э/', '/ю/', '/я/',
            '/\//'
        );
        $replacement  = array(
            'A', 'B', 'V', 'G', 'D', 'E', 'YO', 'J', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'CH', 'SH', 'SCH', '',   'YI',  '`', 'YE', 'YU', 'YA',
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'j', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', '\'', 'yi',  '`', 'ye', 'yu', 'ya',
            '-'
        );
        $string = preg_replace($pattern, $replacement, $str);
        $string = ereg_replace(' ', '_', $string);
        return $string;
    }
    function lat2rus($str)
    {
        $pattern =         array(
            '/_/',
            '/YO/', '/SCH/', '/CH/', '/SH/', '/YI/', '/YE/', '/YU/', '/YA/', '/A/', '/B/', '/V/', '/G/', '/D/', '/E/', '/J/', '/Z/', '/I/', '/Y/', '/K/', '/L/', '/M/', '/N/', '/O/', '/P/', '/R/', '/S/', '/T/', '/U/', '/F/', '/H/', '/C/',/*'/~/',*/ /*'/`/',*/
            '/yo/', '/sch/', '/ch/', '/sh/', '/yi/', '/ye/', '/yu/', '/ya/', '/a/', '/b/', '/v/', '/g/', '/d/', '/e/', '/j/', '/z/', '/i/', '/y/', '/k/', '/l/', '/m/', '/n/', '/o/', '/p/', '/r/', '/s/', '/t/', '/u/', '/f/', '/h/', '/c/', '/\'/', '/\`/'
        );
        $replacement =     array(
            ' ',
            'Ё', 'Щ', 'Ч', 'Ш', 'Ы', 'Э', 'Ю', 'Я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц',/*'Ъ',*//*'Ь',*/
            'ё', 'щ', 'ч', 'ш', 'ы', 'э', 'ю', 'я', 'а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь'
        );
        $string = preg_replace($pattern, $replacement, $str);
        //$string = ereg_replace(' ', '_', $string);
        return $string;
    }
    function rus2lat2($str)
    {
        $pattern =         array(
            '/\ /', '/\./', '/\,/', '/Ъ/', '/Ь/', '/ъ/', '/ь/',
            '/Ё/', '/Ч/', '/Ш/', '/Щ/', '/Ы/', '/Э/', '/Ю/', '/Я/',
            '/А/', '/Б/', '/В/', '/Г/', '/Д/', '/Е/', '/Ж/', '/З/', '/И/', '/Й/', '/К/', '/Л/', '/М/', '/Н/', '/О/', '/П/', '/Р/', '/С/', '/Т/', '/У/', '/Ф/', '/Х/', '/Ц/',
            '/ё/', '/ч/', '/ш/', '/щ/', '/ы/', '/э/', '/ю/', '/я/',
            '/а/', '/б/', '/в/', '/г/', '/д/', '/е/', '/ж/', '/з/', '/и/', '/й/', '/к/', '/л/', '/м/', '/н/', '/о/', '/п/', '/р/', '/с/', '/т/', '/у/', '/ф/', '/х/', '/ц/'
        );
        $replacement =     array(
            'SPACE', 'TCHK', 'ZPT', 'TZNAK', 'MZNAK', 'tznak', 'mznak',
            'YO', 'CH', 'SH', 'SCH', 'YI', 'YE', 'YU', 'YA',
            'A', 'B', 'V', 'G', 'D', 'E', 'J', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C',
            'yo', 'ch', 'sh', 'sch', 'yi', 'ye', 'yu', 'ya',
            'a', 'b', 'v', 'g', 'd', 'e', 'j', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c'
        );
        $string = preg_replace($pattern, $replacement, $str);
        return $string;
    }
    function lat2rus2($str)
    {
        $pattern =         array(
            '/SPACE/', '/TCHK/', '/ZPT/', '/TZNAK/', '/MZNAK/', '/tznak/', '/mznak/',
            '/YO/', '/SCH/', '/CH/', '/SH/', '/YI/', '/YE/', '/YU/', '/YA/',
            '/A/', '/B/', '/V/', '/G/', '/D/', '/E/', '/J/', '/Z/', '/I/', '/Y/', '/K/', '/L/', '/M/', '/N/', '/O/', '/P/', '/R/', '/S/', '/T/', '/U/', '/F/', '/H/', '/C/',
            '/yo/', '/sch/', '/ch/', '/sh/', '/yi/', '/ye/', '/yu/', '/ya/',
            '/a/', '/b/', '/v/', '/g/', '/d/', '/e/', '/j/', '/z/', '/i/', '/y/', '/k/', '/l/', '/m/', '/n/', '/o/', '/p/', '/r/', '/s/', '/t/', '/u/', '/f/', '/h/', '/c/'
        );
        $replacement =     array(
            ' ', '.', ',', 'Ъ', 'Ь', 'ъ', 'ь',
            'Ё', 'Щ', 'Ч', 'Ш', 'Ы', 'Э', 'Ю', 'Я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц',
            'ё', 'щ', 'ч', 'ш', 'ы', 'э', 'ю', 'я',
            'а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц'
        );
        $string = preg_replace($pattern, $replacement, $str);
        return $string;
    }

    function str2upper($content)
    {
        return strtoupper(strtr($content, 'абвгдеёжзийклмнопрстуфхцчшщъьыэюя', 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЫЭЮЯ'));
    }
    function str2lower($content)
    {
        return strtolower(strtr($content, 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЫЭЮЯ', 'абвгдеёжзийклмнопрстуфхцчшщъьыэюя'));
    }

    function scanFileName($sfs)
    {
        $res = '';
        for ($aa = 0; $aa < strlen($sfs); $aa++) {
            $cc = ord($sfs[$aa]);
            if (($cc == 32 && $cc <= 33) || ($cc >= 35 && $cc <= 46) || ($cc >= 45 && $cc <= 47) || ($cc >= 48 && $cc <= 58) || ($cc == 61) ||
                ($cc >= 64 && $cc <= 91) || ($cc >= 93 && $cc <= 122) || ($cc >= 125 && $cc <= 126) || ($cc >= 125 && $cc <= 126) ||
                ($cc == 171) || ($cc >= 183)
            ) $res .= $sfs[$aa];
        }
        return $res;
    }

    function val2str($val)
    {
        if (trim($val) == '' || $val == '0') $val = '-';
        return $val;
    }
    function ifFloorsEmpty($floor)
    {
        if ($floor == '-/-') $floor = '';
        else $floor = ', этаж ' . $floor;
        return $floor;
    }
    function ifAreaEmpty($area, $edn)
    {
        if ($area == '-/-/-') $area = '';
        else $area = ', S = ' . str_replace('/-/-', '', $area) . ' ' . $edn;
        return $area;
    }
    function addComment(&$cmnt, $str)
    {
        $str = str_replace(',', ', ', trim($str, ', '));
        if ($cmnt != '' && trim($str, ', ') != '') $cmnt .= ', ';
        $cmnt .= trim($str, ', ');
    }

    function swapStr(&$str1, &$str2)
    {
        $ss = $str1;
        $str1 = $str2;
        $str2 = $ss;
    }
    function caseStr($val, $get, $set)
    {
        foreach ($get as $i => $value) {
            if ($get[$i] == $val) if (isset($set[$i])) return $set[$i];
            else return '';
        }
        return $val;
    }
    function firstUpper($str)
    {
        //$str = self::str2lower($str);
        if ($str != '') $str[0] = self::str2upper($str[0]);
        return $str;
    }
    function street4reverse($street)
    {
        $new = "";
        if (trim($street) != '') {
            $spl = explode(' ', $street);
            if (substr($street, 0, 4) == 'пер ') $spl[0] .= 'еулок';
            if (substr($street, 0, 3) == 'ул ') $spl[0] = 'улица';
            if (substr($street, 0, 3) == 'пр ') $spl[0] .= 'оспект';
            if (substr($street, 0, 3) == 'тр ') $spl[0] .= 'акт';
            if (substr($street, 0, 4) == 'прд ') $spl[0] = 'проезд';
            for ($i = 1; $i < count($spl); $i++) $new .= ' ' . $spl[$i];
            $new = trim($new . ' ' . $spl[0]);
        }
        return $new;
    }

    function if2str($if, $then, $else)
    {
        if ($if) return $then;
        else return $else;
    }

    function AgencyName($name)
    {
        $name = str_replace('-', '', $name);
        $name = str_replace(' ', '', $name);
        $name = str_replace('"', '', $name);
        $name = str_replace('ь', '', $name);
        $name = str_replace('Ь', '', $name);
        $name = str_replace('ъ', '', $name);
        $name = str_replace('Ъ', '', $name);
        $name = rus2lat($name);
        return $name;
    }
    function parsePhones($str, $city, $dig7 = '7', $dig8 = '8', $only8 = false)
    {
        $result = array();

        $maxlen = 11;
        $citylen = $maxlen - 1 - strlen($city); // 6
        $str = preg_replace("/\ +/i", ' ', $str);
        $str = str_replace(array(' (', ') '), array('', ''), $str);
        $str = preg_replace('/[-+()]/i', '', $str);
        $str = preg_replace('/[^0-9\s-+]/i', ' ', $str);
        $str = preg_replace("/\ +/i", ' ', $str);
        $phonesA = explode(' ', $str);

        $phonesE = array();
        $phonesN = array();
        if (count($phonesA) > 0) {
            $aa = 0;
            while ($aa < count($phonesA)) {
                $phone = $phonesA[$aa];
                $phlen = strlen($phone);

                if ($phlen > $maxlen && $phlen % $maxlen == 0) {
                    $phcnt = floor($phlen / $maxlen) + 1;
                    for ($bb = 0; $bb < $phcnt; $bb++) $phonesA[] = substr($phone, $bb * $maxlen, $maxlen);
                }
                if ($phlen >= 2 * $citylen && $phlen % $citylen == 0) {
                    $phcnt = floor($phlen / $citylen) + 1;
                    for ($bb = 0; $bb < $phcnt; $bb++) $phonesA[] = substr($phone, $bb * $citylen, $citylen);
                }
                if ($phlen >= ($maxlen + $citylen) && $phlen % ($maxlen + $citylen) == 0) {
                    $phcnt = floor($phlen / ($maxlen + $citylen)) + 1;
                    for ($bb = 0; $bb < $phcnt; $bb++) {
                        $phtmp = substr($phone, $bb * ($maxlen + $citylen), ($maxlen + $citylen));
                        $phonesA[] = substr($phtmp, 0, $citylen);
                        $phonesA[] = substr($phtmp, $maxlen, $citylen);
                        $phonesA[] = substr($phtmp, 0, $maxlen);
                        $phonesA[] = substr($phtmp, $citylen, $maxlen);
                    }
                }
                if (($phlen < 5) || ($city != '' && $phlen < $citylen) || ($city != '' && $phlen > $citylen && $phlen < $maxlen - 1) ||
                    ($phlen < $maxlen - 1 && substr($phone, -4) == '0000') ||
                    ($phlen < $maxlen - 1 && substr($phone, 0, 1) == '0') ||
                    ($city != '' && $phlen >= $maxlen - 1 && in_array(substr($phone, 0, -$citylen), [$city, "$dig7$city", "$dig8$city"]) && substr(substr($phone, -$citylen), 0, 1) == '0') ||
                    ($phlen > $maxlen)
                )
                    array_splice($phonesA, $aa, 1);
                else $aa++;
            }

            for ($aa = 0; $aa < count($phonesA); $aa++) $phonesE[$phonesA[$aa]] = true;
            for ($aa = 0; $aa < count($phonesA); $aa++) {
                $phone = $phonesA[$aa];
                $phlen = strlen($phone);

                if ($city != '' && $phlen == $citylen) $phoneN = "$dig8$city$phone";
                else $phoneN = ""; // ()123456 -> (83822)123456
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }
                if ($phoneN != '') $phoneN[0] = "$dig7"; // -> ()123456 -> (73822)123456
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }

                if ($city != '' && $phlen >= $maxlen && substr($phone, 0, strlen($city) + 1) == "$dig8$city") $phoneN = substr($phone, -$citylen);
                else $phoneN = ""; // (83822)123456 -> ()123456
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }

                if ($city != '' && $phlen >= $maxlen && substr($phone, 0, strlen($city) + 1) == "$dig7$city") $phoneN = substr($phone, -$citylen);
                else $phoneN = ""; // (73822)123456 -> ()123456
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }

                if ($city != '' && $phlen == strlen($city) + $citylen && substr($phone, 0, strlen($city)) == $city) $phoneN = substr($phone, -$citylen);
                else $phoneN = ""; //(3822)123456 -> ()123456
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }
                if ($city != '' && strlen($phoneN) == $citylen) $phoneN = "$dig8$city$phoneN";
                else $phoneN = ""; // -> (3822)123456 -> (83822)123456
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }
                if ($phoneN != '') $phoneN[0] = "$dig7"; // (83822)123456 -> (73822)123456
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }

                if ($city != '' && $phlen >= $maxlen) $phoneN = "$dig8" . substr($phone, 1);
                else $phoneN = ""; // (7)9001234567 -> (8)9001234567
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }

                if ($city != '' && $phlen >= $maxlen) $phoneN = "$dig7" . substr($phone, 1);
                else $phoneN = ""; // (8)9001234567 -> (7)9001234567
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }

                if ($phlen == $maxlen - 1) $phoneN = "$dig7$phone";
                else $phoneN = ""; // ()9001234567 -> (7)9001234567
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }
                if ($phlen == $maxlen - 1) $phoneN = "$dig8$phone";
                else $phoneN = ""; // ()9001234567 -> (8)9001234567
                if ($phoneN != '' && !$phonesE[$phoneN]) {
                    $phonesN[] = $phoneN;
                    $phonesE[$phoneN] = true;
                }
            }
            $result = array_merge($phonesA, $phonesN);
            $result = array_unique($result);
            sort($result);
        }
        unset($phonesA);
        unset($phonesE);
        unset($phonesN);

        if ($only8 && count($result) > 0) {
            $aa = 0;
            while ($aa < count($result)) {
                $phone = $result[$aa];
                $phlen = strlen($phone);
                if ($phlen < $maxlen || ($phlen >= $maxlen && substr($phone, 0, strlen($dig7)) == $dig7) || $phlen > $maxlen) array_splice($result, $aa, 1);
                else $aa++;
            }
        }

        return $result;
    }
    function getDigits($src)
    {
        if ($src == '') return '';

        $res = '';
        for ($aa = 0; $aa < strlen($src); $aa++) {
            if ($res != '') {
                if (ord($src[$aa]) >= 48 && ord($src[$aa]) <= 57) $res .= $src[$aa];
            } else {
                if (ord($src[$aa]) >= 49 && ord($src[$aa]) <= 57) $res .= $src[$aa];
            }
        }

        if ($res == '') $res = '0';
        return $res;
    }
    function getDigitsReal($src)
    {
        if ($src == '') return '';

        $res = '';
        $src = str_replace(',', '.', $src);
        $dot = false;
        for ($aa = 0; $aa < strlen($src); $aa++) {
            if ($res != '') {
                if (ord($src[$aa]) >= 48 && ord($src[$aa]) <= 57) $res .= $src[$aa];
                else if (!$dot && $src[$aa] == '.') {
                    $dot = true;
                    $res .= $src[$aa];
                } else if ($src[$aa] = ' ') break;
            } else {
                if (ord($src[$aa]) >= 49 && ord($src[$aa]) <= 57) $res .= $src[$aa];
                else if (!$dot && $src[$aa] == '.') {
                    $dot = true;
                    $res .= '0' . $src[$aa];
                }
            }
        }

        $res = trim($res, '.');
        if ($res == '') $res = '0.0';
        else if (strpos($res, '.') === false) $res .= '.0';
        return $res;
    }
    function format4phone($gfpStr)
    {
        $dt = 2;
        $nd = 0;
        $gs = '';

        $gfpStr = self::getDigits($gfpStr);
        if ($gfpStr == '') return '';
        if (strpos($gfpStr, '-') > 0) return $gfpStr;

        while ($gfpStr != '') {
            if (strlen($gfpStr) >= $dt) {
                $gs = '-' . substr($gfpStr, strlen($gfpStr) - $dt, $dt) . $gs;
                $gfpStr = substr($gfpStr, 0, strlen($gfpStr) - $dt);
            } else {
                $gs = '-' . $gfpStr . $gs;
                $gfpStr = '';
            }
            $nd = $nd + 1;
            if ($nd >= 2) $dt = 3;
        }
        $gs = trim($gs, '- ');

        return $gs;
    }
    function format4phoneAll($gfpStr)
    {
        $res = "";
        if ($gfpStr == "") return $res;
        $spl = explode(',', $gfpStr);
        for ($aa = 0; $aa < count($spl); $aa++) {
            $spl[$aa] = trim(self::format4phone($spl[$aa]), ', ');
            if ($spl[$aa] != "") {
                if ($aa > 0) $res .= ", ";
                $res .= $spl[$aa];
            }
        }
        return $res;
    }
    function reverseStr($str)
    {
        $result = '';
        if ($str == '') return '';
        for ($aa = strlen($str) - 1; $aa >= 0; $aa--) $result .= $str[$aa];
        return $result;
    }
    function uncryptCode($code)
    {
        $code = self::uncryptStr($code);
        $len = (int) substr($code, 0, 3) * 2 + 2;
        $code = self::reverseStr(self::uncryptStr(substr(substr($code, 3, -5), -$len)));
        return $code;
    }
    function unichr($intval)
    {
        return mb_convert_encoding(pack('n', $intval), 'UTF-8', 'UTF-16BE');
    }
    function uniord($chrval)
    {
        //$entity = mb_encode_numericentity($chrval, array(0x0, 0xffff, 0, 0xffff), 'UTF-8');
        //return preg_replace('`^&#([0-9]+);.*$`', '\\1', $entity);
        $chrval = iconv('windows-1251', 'utf-8', $chrval);
        $chrval = unpack('n', mb_convert_encoding($chrval, 'UTF-16BE', 'UTF-8'));
        return $chrval[1];
    }
    function cryptValue($value)
    {
        $res = '';
        $value = '[' . $value . ']';
        for ($aa = 0; $aa < strlen($value); $aa++) if ($value[$aa] != '') $res .= self::uniord($value[$aa]) . ',';
        $value = substr($res, 0, -1);
        $value = self::cryptStr($value);
        return $value;
    }

    function insertStr($str, $substr, $index)
    {
        if ($index < 0) $index = strlen($str) + $index;
        if ($index > strlen($str)) $index = strlen($str) + 1;
        return substr($str, 0, $index) . $substr . substr($str, $index);
    }

    function minimum($min, $value)
    {
        return ($value < $min) ? $min : $value;
    }
    function maximum($value, $max)
    {
        return ($value > $max) ? $max : $value;
    }

    function prepareServerID($city, $number)
    {
        $result = "";
        if ($city != '' && $number != '') {
            $z = (strpos($number, 'Z') > 0 || strpos($number, 'z') > 0) ? true : false;
            $result = "$city-" . substr("000000000" . $number, -9) . "','$city-" . substr("000000000" . $number, -8) . "";
            //if ($z) $number = substr($number,0,-1);
            //$result = $city.'-'.str_pad($number, 8, "0", STR_PAD_LEFT);
            //if ($z) $result .= 'Z';
        }
        return $result;
    }

    function bracket2str($str, $bracketLeft, $bracketRight, $bracketIndex)
    {
        preg_match("/$bracketLeft(.*?)$bracketRight/siU", $str, $out);
        return $out[$bracketIndex];
    }
    function bracket2replace($str, $bracketLeft, $bracketRight, $bracketIndex, $newstr = '')
    {
        $str = preg_replace("/$bracketLeft(.*?)$bracketRight/siU", $newstr, $str);
        return $str;
    }

    function evalPrice($pricestr)
    {
        $pricestr = str_replace(array('§', '{', '}', 'TRUNC', 'CALCSTR'), array('', '(', ')', 'floor', ''), $pricestr);
        eval(" \$pricestr = ($pricestr); ");
        return $pricestr;
    }

    function charGlas($ch)
    {
        // аеёиоуыэюяАЕЁИОУЫЭЮЯ
        switch ($ch) {
            case 'а':
            case 'А':
            case 'е':
            case 'Е':
            case 'ё':
            case 'Ё':
            case 'и':
            case 'И':
            case 'о':
            case 'О':
            case 'у':
            case 'У':
            case 'ы':
            case 'Ы':
            case 'э':
            case 'Э':
            case 'ю':
            case 'Ю':
            case 'я':
            case 'Я':
                $res = true;
                break;
            default:
                $res = false;
        }
        return $res;
    }
    function cropStr($str, $count)
    {
        if (isset($str[$count]) && self::charGlas($str[$count - 1])) $count = $count - 1;
        return substr($str, 0, $count);
    }
    function cropWords($str, $count, $cropOnGlass = false)
    {
        $_words = explode(' ', $str);
        foreach ($_words as &$word) $word = self::cropStr($word, $count, $cropOnGlass);
        return implode(' ', $_words);
    }

    function m2price($object, $price, $metr, $last, $delta, $dshow)
    {
        $price = (int) $price;
        $last = (int) $last;
        $cur = 'р';

        $percent = 100 - (min($price, $last) / max($price, $last) * 100);
        if ($percent > 0.00) {
            $percent = number_format($percent, 2, ',', '');
            if ($percent != "0,00") $percent = "дельта $percent%";
            else $percent = "";
        } else $percent = "";

        if ($price >= 5000) {
            $price = number_format($price / 1000, 1, ',', ' ');
            $cur = "т$cur";
        } else $price = number_format($price, 0, ',', ' ');
        if ($metr) {
            if ($object == 'Участок') $cur .= "/с";
            else $cur .= "/м<sup>2</sup>";
        }

        return "<span class='fs11 wingdings'>$delta</span> $price <small>$cur</small>" . (($dshow) ? "<br><span class='fs9'>$percent</span>" : "");
    }
    function m2line($city, $object, $rooms, $region, $arenda, $adelta, $prodaja, $pdelta)
    {
        $mcRooms = $m2['mcRooms'];
        if ($mcRooms == '0') $mcRooms = '';
        else if ($mcRooms == '5') $mcRooms = '5+';
        /*$rurl = "#menuclick¦addonAssess#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fobjects¦$object#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fagrees¦#
						#setglobal¦¶PAGENAME{Оценка}".$city."_frooms¦$rooms#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fperiod¦1 месяц#
						#setglobal¦¶PAGENAME{Оценка}".$city."_extend¦1#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fregions¦".self::str2upper($region)."#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fbuilding¦#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fassess¦0#
						#pageupdate¦Оценка#
					";
	$aurl = "#menuclick¦addonAssess#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fobjects¦$object#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fagrees¦аренда#
						#setglobal¦¶PAGENAME{Оценка}".$city."_frooms¦$rooms#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fperiod¦1 месяц#
						#setglobal¦¶PAGENAME{Оценка}".$city."_extend¦1#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fregions¦".self::str2upper($region)."#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fbuilding¦#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fassess¦1#
						#pageupdate¦Оценка#
					";
	$purl = "#menuclick¦addonAssess#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fobjects¦$object#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fagrees¦продажа#
						#setglobal¦¶PAGENAME{Оценка}".$city."_frooms¦$rooms#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fperiod¦1 месяц#
						#setglobal¦¶PAGENAME{Оценка}".$city."_extend¦1#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fregions¦".self::str2upper($region)."#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fbuilding¦#
						#setglobal¦¶PAGENAME{Оценка}".$city."_fassess¦1#
						#pageupdate¦Оценка#
					";
	if (in_array($region,['','пригород','область','республика'])) { $rurl = ""; $aurl = ""; $purl = ""; }
	$rurl1 = "<a href='$rurl'>"; $rurl2 = "</a>";
	$aurl1 = "<a href='$aurl'>"; $aurl2 = "</a>";
	$purl1 = "<a href='$purl'>"; $purl2 = "</a>";
	*/

        if ($arenda == '') {
            $arenda = "<div class='center'>-</div>";
            $aurl = "";
        }
        if ($prodaja == '') {
            $prodaja = "<div class='center'>-</div>";
            $purl = "";
        }
        $acolor = (($adelta == 'б') ? "green" : (($adelta == 'в') ? "red" : "gray"));
        $pcolor = (($pdelta == 'б') ? "green" : (($pdelta == 'в') ? "red" : "gray"));
        return "
				<tr><td width='30%' class='pr4 right'>$rurl1<span class='fs11 clgray'>" . self::cropStr(self::firstUpper($region), 10) . "</span>$rurl2</td>
					<td width='35%' class='pr4 right brdL'>$aurl1<span class='fs11 $acolor'>$arenda</span>$aurl2</td>
					<td width='35%' class='pr4 right brdL'>$purl1<span class='fs11 $pcolor'>$prodaja</span>$purl2</td>
				</tr>";
    }

    function str_replace_once($search, $replace, $text)
    {
        $pos = strpos($text, $search);
        return ($pos !== false) ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
    }

    function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    function intervals2array($intervals, $couner = 0)
    {
        $tmparray = array();
        $result = array();
        $couner = (int) $couner;
        $intervals = str_replace(array(' ', ';', '|', '..', '–', '–', '—', '_'), array(',', ',', ',', '-', '-', '-', '-', '-'), $intervals);
        if ($intervals == '') $tmparray[0] = 0;
        else {
            $ints = explode(',', $intervals);
            for ($aa = 0; $aa < count($ints); $aa++) {
                $minus = (strpos($ints[$aa], '-') !== false) ? true : false;
                if (strpos($ints[$aa], '*') !== false && $couner > 0) {
                    $ints[$aa] = ($minus) ? str_replace('*', $couner, $ints[$aa]) : "1-$couner";
                    $minus = true;
                }
                if ($minus) {
                    $fromto = explode('-', $ints[$aa]); // -7
                    if ($fromto[0] == '' || $fromto[count($fromto) - 1] == '') {
                        if ($fromto[0] != '') $int = (int) $fromto[0];
                        else $int = (int) $fromto[count($fromto) - 1];
                        $tmparray[$int] = $int;
                    } else {
                        $int1 = (int) $fromto[0];
                        $int2 = (int) $fromto[count($fromto) - 1];
                        if ($int1 > $int2) {
                            $tmp = $int1;
                            $int1 = $int2;
                            $int2 = $tmp;
                        }
                        for ($bb = $int1; $bb <= $int2; $bb++) $tmparray[$bb] = $bb;
                    }
                } else {
                    $int = (int) $ints[$aa];
                    $tmparray[$int] = $int;
                }
            }
        }
        if (count($tmparray) > 0) foreach ($tmparray as $key => $value) $result[] = $value;
        return $result;
    }

    function strpos_array($str, $findarr = array(), $findsens = true, $offset = 0)
    {
        $result = array();
        if (!$findsens) $str = self::str2lower($str);
        foreach ($findarr as $findstr) {
            if (!$findsens) $findstr = self::str2lower($findstr);
            $res = strpos($str, $findstr, $offset);
            if ($res !== false) $result[$findstr] = $res;
        }
        if (empty($result)) return false;
        return min($result);
    }

    function get_domain($url = SITE_URL)
    {
        $expurl = explode('.', parse_url($url, PHP_URL_HOST));
        return self::str2upper(trim(((isset($expurl[count($expurl) - 2])) ? $expurl[count($expurl) - 2] : '') . '.' . ((isset($expurl[count($expurl) - 1])) ? $expurl[count($expurl) - 1] : ''), '.'));
        //preg_match("/[a-z0-9\-]{1,63}\.[a-z\.]{2,6}$/", parse_url($url, PHP_URL_HOST), $_domain_tld);
        //return self::str2upper(trim($_domain_tld[0],'.'));
    }
    function between($min, $value, $max)
    {
        return ($value >= $min && $value <= $max) ? true : false;
    }

    function wordExists($str, $words)
    {
        if (!is_array($words)) $words = [$words];
        $str = self::str2lower($str);
        foreach ($words as $word) if ($word != '' && stripos($str, $word) !== false) return true;
        return false;
    }

    //______________________________________________________________________________________________________________________________________________________________

    function firstElementOfArray($_array = [])
    {
        if (!is_array($_array)) return $_array;
        else if (!empty($_array)) return array_shift($_array);
        return false;
    }

    //______________________________________________________________________________________________________________________________________________________________
}