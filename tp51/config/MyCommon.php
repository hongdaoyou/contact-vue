<?php
if (! defined('SUCCESS')) {
    define( 'SUCCESS' , 'success');

    define( 'FAILED' , 'failed');

    function expandArray($array) {
        foreach ($array as $key => $value) {
            $$key = $value;
        }
    }
}


