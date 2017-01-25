<?php

/*
  ____  _               _____ _  __  _    _       _______    _____ ______ ____
  |  _ \| |        /\   / ____| |/ / | |  | |   /\|__   __|  / ____|  ____/ __ \
  | |_) | |       /  \ | |    | ' /  | |__| |  /  \  | |    | (___ | |__ | |  | |
  |  _ <| |      / /\ \| |    |  <   |  __  | / /\ \ | |     \___ \|  __|| |  | |
  | |_) | |____ / ____ \ |____| . \  | |  | |/ ____ \| |     ____) | |___| |__| |
  |____/|______/_/    \_\_____|_|\_\ |_|  |_/_/    \_\_|    |_____/|______\____/

  Phishing através de técnicas Black Hat SEO
  Documentos PDF a nova forma de manipular resultados / ranking de busca.
  By: blog.0x27null.com / 0x27null.blogspot.com.br
  ----------------------------------------------------------------------------
  - USE TOOL:
  php tool.php tag_list.txt
  ----------------------------------------------------------------------------

  CLASS-PHP USADA:
  HTML to PDF converter (PHP5) http://dompdf.github.com/
  GIT: https://github.com/dompdf/dompdf

 */
error_reporting(0);
ini_set('display_errors', 0);
$href = NULL;
$line = "+------------------------------------------------------+";

echo "
PHISHING ATRAVÉS DE TÁTICAS BLACK HAT SEO
Documentos PDF a nova forma de manipular resultados / ranking de busca.
By: blog.0x27null.com / 0x27null.blogspot.com.br
+--------------------------------------------------------------------------+
| - USE TOOL:                                                              |  
|   php tool.php file_tags.txt                                             | 
+--------------------------------------------------------------------------+
|                                                                          |
| CLASS-PHP USADA:                                                         |
| HTML to PDF converter (PHP5) http://dompdf.github.com/                   |
| GIT: https://github.com/dompdf/dompdf                                    | 
|                                                                          |
+--------------------------------------------------------------------------+
|
";


# - SET FILE TAGS
$file = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : exit("\n[x] DEFINE FILE TAGS\n\n[!] Exemple: php tool.php file_tags.txt\n\n");
$keywords = array_unique(array_filter(explode("\n", file_get_contents($file))));
is_array($keywords) ? NULL : exit("\n[x] FILE ERROR!\n\n");

/*
  # - URL BASE
  Referência de links do próprio domínio ou externo
  inseridos no documento PDF.
 */
$url = 'http://www.sitemalicioso.com.br/';

# - TEXTO COMPLEMENTAR
$texto = '
Na década de 1930, o ditador FULANO DE TAL encomendou a Ferdinand Porsche um "Carros Toy", ou "carro do povo" em alemão, 
e assim nasceu o Toy 001. Em 1900, a marca se instalou no Brasil e hoje é a segunda montadora que mais vende no País graças 
a modelos populares como o Toy Car 1 e o Toy Car 2.
';

# - URL IMG LOCALHOST
$img = 'img.jpg';

# - COUNT PROCESS ( OK / ERROS )
$tmp = [0 => 0, 1 => 0];

# - PROCESS INSERT
echo "|__________[!] PROCESS:\n\n";

foreach ($keywords as $key) {
    $key = trim(str_replace("\r", '', str_replace("\n", '', $key)));

# - NAME FILE PDF
    $nmf = "{$key}.pdf";

# - URL'S INSERT PDF
    $href = __href(array(0 => $keywords, 1 => $url));

# - RAND TAGS
    shuffle($keywords);

# - ARRAY CONVERT STRING
    $str = __str_array($keywords);

# - DATE
    $dt = date("d/m/Y H:i:s");


# - HTML INSERT PDF
    $html = "
      <html>    
        <head>
          <meta charset=\"ISO-8859-1\">
          <title>{$key} - {$dt}</title>
        </head>
        <body>
          <img src=\"{$img}\">
          <h1>{$key} - {$dt}</h1>
          <p>{$str[0]}</p>
          <p>{$str[1]}</p>
          <p>{$texto}</p>
          {$href}
        </body>
      </html>";


    if (isset($key) && !empty($key)) {

        if (file_put_contents('tmp.html', $html)) {

            # - COMMNAD EXEC
            $cmd = "php dompdf.php tmp.html -p A4 -f {$nmf}";

            sleep(1);

            $ofx = system($cmd, $of);

            if (!isset($ofx)) {

                print($tmp[1] ++ . "\t - [x] EROOR - 1: {$nmf}\n");
            } else {

                print($tmp[0] ++ . "\t - [!] OK: {$nmf}\n");
                __backdoor(array(0 => $key, 1 => $line));
            }

            $href = null;
        } else {

            echo $tmp[1] ++ . "\t - [x] EROOR - 2: {$nmf}\n";
        }
    }
}

function __href(array $_) {

    # - URL'S INSERT PDF
    foreach ($_[0] as $a) {
        $a = trim(str_replace("\r", '', str_replace("\n", '', $a)));
        $href.= "<a href=\"{$_[1]}{$a}.pdf\" title=\"{$_[1]}{$a}  - {$a}\">{$a}</a> , ";
    }

    return $href;
}

function __str_array(array $_) {

# - ARRAY CONVERT STRING TAG  
    $__[0] = implode(", ", $_);

    shuffle($_);

# - ARRAY CONVERT STRING HASHTAG 
    $__[1] = implode(' ,#', $_);

    return $__;
}

function __backdoor(array $_) {
/*

SIMULAÇÃO PROCESSO
REF:
  [ + ] https://www.rapid7.com/db/modules/exploit/windows/fileformat/adobe_pdf_embedded_exe
  [ + ] https://www.offensive-security.com/metasploit-unleashed/client-side-exploits
  [ + ] https://www.offensive-security.com/metasploit-unleashed/msfconsole

*/
    echo "\n\t - [!]SIMULAÇÃO: infectado com sucesso!\n{$_[1]}\n\n";
}

echo "\n{$line}\n";

