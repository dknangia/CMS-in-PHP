<?php
$args = [7, 6, 4, -1, 1, 2];
$targetSum = 16;


/**
 * Get quardruple for the sum.  
 *  
 * @param array $args Array on which computation needs to be done e.g. [7, 6, 1, 2, 3, 4, -1]
 * @param  integer $targetSum Sum required for the computaiton e.g. 16
 * 
 * @return array Array of quardruple  
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


