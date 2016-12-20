<?php
require_once "vendor/autoload.php";


use database\my_db\DB;
DB::table('ddd')->where([ 'id' => 1])->limit(1)->get();


