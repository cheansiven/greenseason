<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }
/**
 * Created by PsThea.
 * Date: 5/22/14
 * Time: 11:38 AM
 */

if( ! function_exists('trace'))
{
    function trace($object)
    {
        echo('<pre>');
        print_r($object);
        echo('</pre>');

    }
}
