<?php

class validNumRange
{   
    /**
     * @param  string $str
     * 
     * @return bool
     * 
     * @throws Exception
     */
    
    public static function isValidNumRange($str)
    {   
        if (! is_string($str) || empty($str)) {
            throw new Exception(
                sprintf('Bad input! Non-empty string expected! %s given', $str)
            );
        } 
        
        // check if N-M has one hyphen or more
        if (substr_count($str, '-') > 1) {
            throw new Exception(
                sprintf('Too many hyphens! %s given', $str)
            );
        // check if single numeric exists
        } elseif (substr_count($str, '-') < 1) {
            if(is_numeric($str)) {
              return true;
            }
        // having N-M ... need to check if valid
        } elseif (substr_count($str, '-') == 1) {
	    $param = explode("-", $str);
            if ($param[0] > $param[1]) {
                throw new Exception(
                    sprintf('Range must increase! %s given', $str)
                );
            } elseif (is_numeric($param[0]) && is_null($param[1])) {
                throw new Exception(
                    sprintf('Param2 is null or not an integer! %s given', $str)
                );
            } else {
	 	return true;
            }
        }
    }
}

$sequence[0] = '100-200';
$sequence[1] = '200-100';
$sequence[2] = '100.11-200';
$sequence[3] = '200-100.11';
$sequence[4] = '100-200.22';
$sequence[5] = '200.22-100';
$sequence[6] = '100.11-200.22';
$sequence[7] = '200.22-100.11';
$sequence[8] = 'A-200';
$sequence[9] = '200.22-A';
$sequence[10] = '100200';
$sequence[11] = '?&#(*&';
$sequence[12] = '';
$sequence[13] = '-100';
$sequence[14] = '-200.22';

for ($i=0;$i<count($sequence);$i++) {
  $parser = new validNumRange();
  try {
    $node = $parser->isValidNumRange($sequence[$i]);
    echo $sequence[$i] . ' = ' . ($node ? 'true' : 'false') . "\n";
  }
  catch(Exception $e){
    echo $e . "\n";
  }
}

/* RESULTS BELOW
* 100-200 = true
* Exception: Range must increase! 200-100 given in /Users/jack/Documents/validNumeric/validNumRange.php:35
* Stack trace:
* #0 /Users/jack/Documents/validNumeric/validNumRange.php(66): validNumRange::isValidNumRange('200-100')
* #1 {main}
* 100.11-200 = true
* Exception: Range must increase! 200-100.11 given in /Users/jack/Documents/validNumeric/validNumRange.php:35
* Stack trace:
* #0 /Users/jack/Documents/validNumeric/validNumRange.php(66): validNumRange::isValidNumRange('200-100.11')
* #1 {main}
* 100-200.22 = true
* Exception: Range must increase! 200.22-100 given in /Users/jack/Documents/validNumeric/validNumRange.php:35
* Stack trace:
* #0 /Users/jack/Documents/validNumeric/validNumRange.php(66): validNumRange::isValidNumRange('200.22-100')
* #1 {main}
* 100.11-200.22 = true
* Exception: Range must increase! 200.22-100.11 given in /Users/jack/Documents/validNumeric/validNumRange.php:35
* Stack trace:
* #0 /Users/jack/Documents/validNumeric/validNumRange.php(66): validNumRange::isValidNumRange('200.22-100.11')
* #1 {main}
* Exception: Range must increase! A-200 given in /Users/jack/Documents/validNumeric/validNumRange.php:35
* Stack trace:
* #0 /Users/jack/Documents/validNumeric/validNumRange.php(66): validNumRange::isValidNumRange('A-200')
* #1 {main}
* 200.22-A = true
* 100200 = true
* ?&#(*& = false
* Exception: Bad input! Non-empty string expected!  given in /Users/jack/Documents/validNumeric/validNumRange.php:16
* Stack trace:
* #0 /Users/jack/Documents/validNumeric/validNumRange.php(66): validNumRange::isValidNumRange('')
* #1 {main}
* -100 = true
* -200.22 = true
*/

