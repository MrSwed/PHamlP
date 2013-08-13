<?

//var_dump($argv);

echo PHP_EOL;

if (empty($argv[1])) {
 echo " .PHP_EOLUsage php ".basename($argv[0])." [filename.sass] <filename.css>".PHP_EOL;
 exit;
}

if (!file_exists($argv[1])) {
 echo $argv[1]. " not exists ".PHP_EOL;
}
if (!empty($argv[2])) {
 $outfile = $argv[2];
} else {
 $outfile = pathinfo($argv[1]);
 $outfile = $outfile['dirname']."/".$outfile['filename'].".css";
}

echo $argv[1]. " to $outfile ".PHP_EOL;
// exit;

include_once(dirname($argv[0]).'/sass/SassParser.php');

$sass = new SassParser(array(
 'cache'=>false,
 'style'=>'expanded',
 'vendor_properties'=>array(
  'border-radius' => array(
   '-moz-border-radius',
   '-webkit-border-radius',
   '-khtml-border-radius'
   ),
  'border-top-right-radius' => array(
   '-moz-border-radius-topright',
   '-webkit-border-top-right-radius',
   '-khtml-border-top-right-radius'
   ),
  'border-bottom-right-radius' => array(
   '-moz-border-radius-bottomright', 
   '-webkit-border-bottom-right-radius',
   '-khtml-border-bottom-right-radius'
   ),
  'border-bottom-left-radius' => array(
   '-moz-border-radius-bottomleft',
   '-webkit-border-bottom-left-radius',
   '-khtml-border-bottom-left-radius'
   ),
  'border-top-left-radius' => array(
   '-moz-border-radius-topleft',
   '-webkit-border-top-left-radius',
   '-khtml-border-top-left-radius'
   ),
  'box-shadow' => array('-moz-box-shadow', '-webkit-box-shadow'),
  'box-sizing' => array('-moz-box-sizing', '-webkit-box-sizing'),
  'opacity' => array('-moz-opacity', '-webkit-opacity', '-khtml-opacity'),
  )
));


file_put_contents($outfile, $sass->toCss($argv[1]));


exit;

// директория со стилями (в конце слэш обязательно)
$style_dir = MODX_BASE_PATH.'assets/css/'; 

    // сканирование содержимого
$files = scandir(rtrim($style_dir,'/'));

    // выбор файлов с расширением sass
foreach ($files as $sass_file) 
 if (is_file($style_dir.$sass_file) && (strtolower(pathinfo($style_dir.$sass_file,PATHINFO_EXTENSION))=='sass')) {

            // вычисление проверочного md5 хэша содержимого .sass файла
  $sass_hash = hash('md5',file_get_contents($style_dir.$sass_file));

            // при отсутствии записанного (в .sasshash файл) хэша или его несовпадении с записанным - генерация css
  if (!file_exists($style_dir.$sass_file.'hash')||($sass_hash!=file_get_contents($style_dir.$sass_file.'hash'))) {

                // подключение библиотеки phamlp
   include_once(MODX_BASE_PATH.'assets/plugins/phamlp/sass/SassParser.php');

                // инициализация и настройка класса работы с sass форматом  
   $sass = new SassParser(array(
    'cache'=>false,
    'style'=>'expanded',
    'vendor_properties'=>array(
     'border-radius' => array(
      '-moz-border-radius',
      '-webkit-border-radius',
      '-khtml-border-radius'
      ),
     'border-top-right-radius' => array(
      '-moz-border-radius-topright',
      '-webkit-border-top-right-radius',
      '-khtml-border-top-right-radius'
      ),
     'border-bottom-right-radius' => array(
      '-moz-border-radius-bottomright', 
      '-webkit-border-bottom-right-radius',
      '-khtml-border-bottom-right-radius'
      ),
     'border-bottom-left-radius' => array(
      '-moz-border-radius-bottomleft',
      '-webkit-border-bottom-left-radius',
      '-khtml-border-bottom-left-radius'
      ),
     'border-top-left-radius' => array(
      '-moz-border-radius-topleft',
      '-webkit-border-top-left-radius',
      '-khtml-border-top-left-radius'
      ),
     'box-shadow' => array('-moz-box-shadow', '-webkit-box-shadow'),
     'box-sizing' => array('-moz-box-sizing', '-webkit-box-sizing'),
     'opacity' => array('-moz-opacity', '-webkit-opacity', '-khtml-opacity'),
     )
));

                // генерация css файла        
file_put_contents( $style_dir.substr($sass_file,0,-4).'css', $sass->toCss($style_dir.$sass_file) );

                // запись хэша
file_put_contents( $style_dir.$sass_file.'hash', $sass_hash );
}
}
?>
