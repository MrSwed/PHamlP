<?

// echo PHP_EOL;

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

?>
