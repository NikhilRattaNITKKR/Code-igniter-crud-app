<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datamodifier
{
    public function getBackMappedData($arrayOfAssociativeArrays)
    {
        $arrayOfValuesArrays = array();

        foreach ($arrayOfAssociativeArrays as $associativeArray) {
            $arrayOfValuesArrays[] = array_values($associativeArray);
        }

        return $arrayOfValuesArrays;
    }
};
