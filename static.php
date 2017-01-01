<?php

class foo
{
    public static $ddd = 'ccc';

    public function test()
    {
        echo self::$ddd;
    }

    public function teemo($arg){
        echo "总共 ".func_num_args()." 个参数<br>";
        var_dump(func_get_args());

    }
}

ccc
printf("select %s from %s where %s = %d",'*','table','id',5);