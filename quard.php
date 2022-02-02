<?php
$args = [7, 6, 4, -1, 1, 2];
$targetSum = 16;


/**
 * Get quardruple for the sum 
 *  
 */
function getQuardRupple($args, $targetSum)
{
    $result = array();
    if (!empty($args)) {
        for ($i = 0; $i < count($args); $i++) {
            for ($j = $i + 1; $j < count($args); $j++) {
                for ($k = $j + 1; $k < count($args); $k++) {
                    for ($l = $k + 1; $l < count($args); $l++) {
                        if( $args[$i] + $args[$j] + $args[$k] + $args[$l] == $targetSum)
                            $result[] = [$args[$i] , $args[$j] , $args[$k] , $args[$l]]; 

                    }
                }
            }
        }
    }

    return $result;
}


