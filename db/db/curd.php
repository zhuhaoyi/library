<?php
namespace zhuhaoyi\db;

class DB
{
    private static $instance;
    private $pdo;
    private static $sql;
    public $table;
    private $type;
    private $where;
    private $param;

    public function __construct($url = 'localhost', $database = 'test', $username = 'root', $password = '')
    {
        if ($this->pdo = new \PDO("mysql:host=$url;dbname=$database", $username, $password)) {
            echo "连接成功";
        } else {
            echo "连接失败";
            var_dump($this->pdo->errorInfo());
        }
    }

    public function get()
    {
        try {
            $st = $this->pdo->prepare($this->buildSql('select'));
            echo $this->buildSql('select');
            $st->execute();
            var_dump($st->fetchAll());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function add($param)
    {

        try {
            $st = $this->pdo->prepare($this->buildSql('insert',$param));
            $st->execute();
            var_dump($st->fetchAll());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete()
    {
        try {
            $st = $this->pdo->prepare($this->buildSql('select'));
            $st->execute();
            var_dump($st->fetchAll());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update()
    {
        try {
            $st = $this->pdo->prepare($this->buildSql('select'));
            $st->execute();
            var_dump($st->fetchAll());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function where(){

        return $this;
    }

    private function buildSql($type,$param='')
    {
        switch ($type) {
            case($type=='insert'):
                if(is_array($param)) {
                    return $sql = "insert into $this->table () values ()";
                }
            case($type=='delete'):
                return $sql = "delete from $this->table";
            case($type=='update'):
                return $sql = "update $this->table set";
            case($type=='select'):
                return $sql = "select * from $this->table";
        }
    }

    public static function table($table = '')
    {
        self::$instance = new DB();
        self::$instance->table = $table;
        return self::$instance;
    }
}


DB::table('ddd')->where()->get();