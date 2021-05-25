<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function renderImage($filename, $params = [200,200,'fit'], $patch = true){
    $imageDir = 'storage/';
    $paramString = $params[0].'x'.$params[1].$params[2].'/';
    $outputFilename = $filename;

    if (empty($filename) || !Storage::disk('public')->exists($filename)){
        if ($patch) {
            return asset('images/app/no-image.jpg');
        } else {
            return null;
        }
    }

    if (!empty($filename) && Storage::disk('public')->exists($paramString.$outputFilename)) {
        return url($imageDir.$paramString.$outputFilename);
    }
    $fileContent = Storage::disk('public')->get($filename);

    Storage::disk('public')->put($paramString.$outputFilename, $fileContent, 'public');
    $img = Image::make(public_path($imageDir . $paramString . $outputFilename));
    if ($params[2] == 'fit') {
        $img->fit($params[0],$params[1]);
    }

    if ($params[2] == 'resize') {
        $img->widen($params[0], function ($constraint) {
            $constraint->upsize();
        });

        $img->heighten($params[1], function ($constraint) {
            $constraint->upsize();
        });
    }
    $img->save(public_path($imageDir . $paramString.$outputFilename),80);


    return url($imageDir.$paramString.$outputFilename);
}

function Filenameclean($string) {
    $string = cleanupFilename($string);
    $string = convertAccentsAndSpecialToNormal($string);
    $string = trim($string);

    $search = array('  ', ' - ', ' ', '\'','"','!','/',','   ,'?', ',',  '(', ')');
    $replace = array(' ', '-', '-', '','','','','', '', '', '', '');

    $string = str_replace($search, $replace, $string);
    //$string = strtolower($string);

    return urlencode($string);
}

function cleanupFilename($filename) {
    $search = array(' / ','À','à','Á','á','Â','â','Ã','ã','Ä','ä','Å','å','Ā','ā','Ă','ă','Ą','ą','Ǎ','ǎ','Ǻ','ǻ','Ạ','ạ','Ả','ả','Ấ','ấ','Ầ','ầ','Ẩ','ẩ','Ẫ','ẫ','Ậ','ậ','Ắ','ắ','Ằ','ằ','Ẳ','ẳ','Ẵ','ẵ','Ặ','ặ','Ç','ç','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','È','è','É','é','ê','Ë','ë','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ẹ','ẹ','Ẻ','ẻ','Ẽ','ẽ','Ế','ế','Ề','ề','Ể','ể','Ễ','ễ','Ệ','ệ','ƒ','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ì','ì','Í','í','Î','î','Ï','ï','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ǐ','ǐ','Ỉ','ỉ','Ị','ị','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','ℓ','Ñ','ñ','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ò','ò','Ó','ó','Ô','ô','Õ','õ','Ö','ö','Ø','ø','Ō','ō','Ŏ','ŏ','Ő','ő','Ơ','ơ','Ǒ','ǒ','Ǿ','ǿ','Ọ','ọ','Ỏ','ỏ','Ố','ố','Ồ','ồ','Ổ','ổ','Ỗ','ỗ','Ộ','ộ','Ớ','ớ','Ờ','ờ','Ở','ở','Ỡ','ỡ','Ợ','ợ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ù','ù','Ú','ú','Û','û','Ü','ü','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ư','ư','Ǔ','ǔ','Ǖ','ǖ','Ǘ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ụ','ụ','Ủ','ủ','Ứ','ứ','Ừ','ừ','Ử','ử','Ữ','ữ','Ự','ự','Ŵ','ŵ','Ẁ','ẁ','Ẃ','ẃ','Ẅ','ẅ','Ý','ý','Ÿ','ÿ','Ŷ','ŷ','Ỳ','ỳ','Ỵ','ỵ','Ỷ','ỷ','Ỹ','ỹ','Ź','ź','Ż','ż','Ž','ž',' ','?','\\','/',':','|','<','>','*',
        'А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ь','Ю','Я','а','б','в','г','д','е','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ь','ю','я');
    $replace = array('_','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','A','a','C','c','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','E','e','f','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','I','i','I','i','I','i','I','i','I','i','I','i','I','i','J','j','K','k','L','l','L','l','L','l','L','l','L','l','l','N','n','N','n','N','n','N','n','n','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','O','o','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','U','u','W','w','W','w','W','w','W','w','Y','y','Y','y','Y','y','Y','y','Y','y','Y','y','Y','y','Z','z','Z','z','Z','z','_','_','_','_','_','_','_','_','_',
        'a','b','v','h','d','e','zh','z','y','j','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','shh','','ju','ja','a','b','v','h','d','e','zh','z','y','j','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','','ju','ja');

    $filename = str_replace($search, $replace, $filename);

    return preg_replace("/[^a-zA-Z0-9.]/", "_", $filename);
}

function convertAccentsAndSpecialToNormal($string) {
    $table = array(
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ă' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Æ' => 'A', 'Ǽ' => 'A',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ă' => 'a', 'ā' => 'a', 'ą' => 'a', 'æ' => 'a', 'ǽ' => 'a',
        'Þ' => 'B', 'þ' => 'b', 'ß' => 'Ss',
        'Ç' => 'C', 'Č' => 'C', 'Ć' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C',
        'ç' => 'c', 'č' => 'c', 'ć' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
        'Đ' => 'Dj', 'Ď' => 'D', 'Đ' => 'D',
        'đ' => 'dj', 'ď' => 'd',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ĕ' => 'E', 'Ē' => 'E', 'Ę' => 'E', 'Ė' => 'E',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ĕ' => 'e', 'ē' => 'e', 'ę' => 'e', 'ė' => 'e',
        'Ĝ' => 'G', 'Ğ' => 'G', 'Ġ' => 'G', 'Ģ' => 'G',
        'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g',
        'Ĥ' => 'H', 'Ħ' => 'H',
        'ĥ' => 'h', 'ħ' => 'h',
        'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'İ' => 'I', 'Ĩ' => 'I', 'Ī' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
        'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'į' => 'i', 'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i', 'ı' => 'i',
        'Ĵ' => 'J',
        'ĵ' => 'j',
        'Ķ' => 'K',
        'ķ' => 'k', 'ĸ' => 'k',
        'Ĺ' => 'L', 'Ļ' => 'L', 'Ľ' => 'L', 'Ŀ' => 'L', 'Ł' => 'L',
        'ĺ' => 'l', 'ļ' => 'l', 'ľ' => 'l', 'ŀ' => 'l', 'ł' => 'l',
        'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N', 'Ņ' => 'N', 'Ŋ' => 'N',
        'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŋ' => 'n', 'ŉ' => 'n',
        'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ō' => 'O', 'Ŏ' => 'O', 'Ő' => 'O', 'Œ' => 'O',
        'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ō' => 'o', 'ŏ' => 'o', 'ő' => 'o', 'œ' => 'o', 'ð' => 'o',
        'Ŕ' => 'R', 'Ř' => 'R',
        'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r',
        'Š' => 'S', 'Ŝ' => 'S', 'Ś' => 'S', 'Ş' => 'S',
        'š' => 's', 'ŝ' => 's', 'ś' => 's', 'ş' => 's',
        'Ŧ' => 'T', 'Ţ' => 'T', 'Ť' => 'T',
        'ŧ' => 't', 'ţ' => 't', 'ť' => 't',
        'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ũ' => 'U', 'Ū' => 'U', 'Ŭ' => 'U', 'Ů' => 'U', 'Ű' => 'U', 'Ų' => 'U',
        'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ũ' => 'u', 'ū' => 'u', 'ŭ' => 'u', 'ů' => 'u', 'ű' => 'u', 'ų' => 'u',
        'Ŵ' => 'W', 'Ẁ' => 'W', 'Ẃ' => 'W', 'Ẅ' => 'W',
        'ŵ' => 'w', 'ẁ' => 'w', 'ẃ' => 'w', 'ẅ' => 'w',
        'Ý' => 'Y', 'Ÿ' => 'Y', 'Ŷ' => 'Y',
        'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y',
        'Ž' => 'Z', 'Ź' => 'Z', 'Ż' => 'Z', 'Ž' => 'Z',
        'ž' => 'z', 'ź' => 'z', 'ż' => 'z', 'ž' => 'z',
        '“' => '"', '”' => '"', '‘' => "'", '’' => "'", '•' => '-', '…' => '...', '—' => '-', '–' => '-', '¿' => '?', '¡' => '!', '°' => ' degrees ',
        '¼' => ' 1/4 ', '½' => ' 1/2 ', '¾' => ' 3/4 ', '⅓' => ' 1/3 ', '⅔' => ' 2/3 ', '⅛' => ' 1/8 ', '⅜' => ' 3/8 ', '⅝' => ' 5/8 ', '⅞' => ' 7/8 ',
        '÷' => ' divided by ', '×' => ' times ', '±' => ' plus-minus ', '√' => ' square root ', '∞' => ' infinity ',
        '≈' => ' almost equal to ', '≠' => ' not equal to ', '≡' => ' identical to ', '≤' => ' less than or equal to ', '≥' => ' greater than or equal to ',
        '←' => ' left ', '→' => ' right ', '↑' => ' up ', '↓' => ' down ', '↔' => ' left and right ', '↕' => ' up and down ',
        '℅' => ' care of ', '℮' => ' estimated ',
        'Ω' => ' ohm ',
        '♀' => ' female ', '♂' => ' male ',
        '©' => ' Copyright ', '®' => ' Registered ', '™' => ' Trademark ',
        '<br>' => '_',
        '<' => '',
        '>' =>  '',
        '&' =>  ''
    );

    $string = strtr($string, $table);
    $string = preg_replace("/[^\x9\xA\xD\x20-\x7F]/u", "", $string);

    return $string;
}

function FileAvoidDuplicate($filepath, $storage) {
    if (!($storage->exists($filepath))) {
        return $filepath;
    } else {

        $filedirectory = pathinfo($filepath, PATHINFO_DIRNAME);
        $filename = pathinfo($filepath, PATHINFO_FILENAME);
        $fileextension = pathinfo($filepath, PATHINFO_EXTENSION);

        $filepath = $filedirectory . '/' . $filename . '_' . '.'.$fileextension;

        while ($storage->exists($filepath)) {
            $filepath = FileAvoidDuplicate($filepath, $storage);
        }
        return $filepath;

    }
}
