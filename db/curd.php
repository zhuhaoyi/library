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
            $st->execute();
            var_dump($st->fetchAll());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function add()
    {
        try {
            $st = $this->pdo->prepare($this->buildSql('select'));
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

    private function buildSql($type)
    {
        switch ($type) {
            case($type='insert'):
                return $sql = "select * from $this->table";
            case($type='delete'):
                return $sql = "select * from $this->table";
            case($type='update'):
                return $sql = "select * from $this->table";
            case($type='select'):
                return $sql = "select * from $this->table";

        }
        return $sql = "select * from $this->table";
    }

    public static function table($table = '')
    {
        self::$instance = new DB();
        self::$instance->table = $table;
        return self::$instance;
    }
}


DB::table('ddd')->get();