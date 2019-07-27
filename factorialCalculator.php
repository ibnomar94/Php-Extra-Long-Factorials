<?php

function getFactorialOf($number) {
    if($number <= 1){
        return 1 ;
    }else{
        $factorialOfPrev = extraLongFactorials($number-1) ;
        // The order of multiplication is reversed to save excution time
        // eg. 2 * 2000000 is not as 2000000 * 2, in the second form we only loop two times
        $result = multiplier((string)$factorialOfPrev,(string)$number) ;
        return  $result ;
    }

}
function multiplier($number,$times){
    $base = $number ;
    $result = $number ;
    for($i = 0 ; $i < $times-1 ; $i++){
        $result = getStringedSumOfTwoBigInt($result,$base) ;
    }
    return $result ;
}


function getStringedSumOfTwoBigInt($firstNumber,$secondNumber){
    $stringedFirstNumber = strval($firstNumber) ;
    $stringedSecondNumber = (string)$secondNumber ;
    $numberOfDigitsOfFirstNumber = strlen($stringedFirstNumber);
    $numberOfDigitsOfSecondNumber = strlen($stringedSecondNumber);
    $reminder = 0 ;
    $result = '' ;
    if($numberOfDigitsOfFirstNumber > $numberOfDigitsOfSecondNumber){
        $difference = $numberOfDigitsOfFirstNumber - $numberOfDigitsOfSecondNumber ;
        $postfixZeros = '' ;
        for($i = 0 ; $i < $difference ; $i++){$postfixZeros .= '0' ;}
        $stringedSecondNumber = $postfixZeros.$stringedSecondNumber ;
    }elseif($numberOfDigitsOfSecondNumber > $numberOfDigitsOfFirstNumber){
        $difference = $numberOfDigitsOfSecondNumber - $numberOfDigitsOfFirstNumber ;
        $postfixZeros = '' ;
        for($i = 0 ; $i < $difference ;  $i++){$postfixZeros .= '0' ;}
        $stringedFirstNumber = $postfixZeros.$stringedFirstNumber ;
    }

    for($k = strlen($stringedFirstNumber)-1 ; $k >= 0 ; $k-- ){
        $tempResult = (int)$stringedFirstNumber[$k] + (int)$stringedSecondNumber[$k] + $reminder;
        $tempResult = (string)$tempResult ;
        if(strlen($tempResult) > 1){
            $reminder = (int)$tempResult[0] ;
            $result = $tempResult[1].$result ;
        }else{
            $reminder = 0 ;
            $result = $tempResult.$result ;
        }
    }

    if($reminder != 0){
        $result = $reminder.$result ;
    }
    return $result ;
}

$result = '' ;
$result = getFactorialOf($n);
echo $result ;
