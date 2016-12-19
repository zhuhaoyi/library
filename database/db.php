<?php

class DB
{
    private static $instance;
    private $pdo;
    private $table;
    private $type;
    private $where;
    private $limit;


    public function __construct($url = 'localhost', $database = 'test', $username = 'root', $password = '')
    {
        if ($this->pdo = new \PDO("mysql:host=$url;dbname=$database", $username, $password)) {
//            echo "success";
        } else {
            echo "连接失败";
            var_dump($this->pdo->errorInfo());
        }
    }

    public function get()
    {
        $this->type='select';
        try {
            $st = $this->pdo->prepare($this->sql());
            echo $this->sql();
            $st->execute();
            var_dump($st->fetchAll());
            var_dump($st->errorInfo());
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function add($param)
    {
        $this->type='insert';
        try {
            echo $this->sql($param);
//            exit;
            $st = $this->pdo->prepare($this->sql($param));
            $st->execute();
            var_dump($st->errorInfo());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete($param)
    {
        $this->type='delete';
        try {
            $st = $this->pdo->exec($this->sql($param));
            echo $this->sql($param);
            var_dump($st);
            if($st==0){
                echo '删除失败';
            }elseif($st>0){
                echo '删除成功';
            }
            var_dump($st->errorInfo());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update()
    {
        $this->type='update';
        try {
            $st = $this->pdo->prepare($this->sql);
            $st->execute();
            var_dump($st->fetchAll());
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    //赋值给类变量
    public function where(array $param = [])
    {
        $this->where = $param;
        return $this;
    }

    /**
     * @param string $param 混合变量 根据查询构造器的需求传入
     * @return string sql语句
     */
    private function sql($param = '')
    {
        switch ($this->type) {
            case($this->type == 'insert'):
                if (is_array($param)) {
                    $keys=array_keys($param);
                    $values=array_values($param);
                    //todo 只能传入一个参数
                    return "insert into $this->table ($keys[0]) values ($values[0])";
                }
            case($this->type == 'delete'):
                //todo 只能使用一个参数 变量类型未加括号
                $keys=array_keys($param);
                $values=array_values($param);
                return "delete from $this->table where ($keys[0]) = ($values[0])";

            case($this->type == 'update'):
                return "update $this->table set";
            case($this->type == 'select'):
                if (is_array($this->where)) {
                    array_keys($this->where);
                    //组织where语句
                    foreach ($this->where as $k => $v) {
                        //判断数据类型 如果是文本则加引号
                        if (is_string($v)) {
                            $where = "where $k = '$v'";
                        } else {
                            $where = "where $k = $v";
                        }
                    }
                    return "select * from $this->table $where $this->limit";
                } else {
                    return "select * from $this->table $this->limit";
                }
        }
    }

    public function limit($num){
        $this->limit="limit $num";
        return $this;
    }


    //todo 把数组转化为sql语句中的and set ,
    private static function array2And(){

    }
    private static function array2Set(){

    }
    private static function array2comma(){

    }
    //实例化对象并获取表名
    public static function table($table = '')
    {
        self::$instance = new DB();
        self::$instance->table = $table;
        return self::$instance;
    }
}

exit();
//todo update delete
//todo where语句只能输入一个参数 limit不支持0,10写法
DB::table('ddd')->add(['text'=>111]);
DB::table('ddd')->where([ 'id' => 1])->limit(1)->get();
DB::table('ddd')->delete(['text'=>111]);

DB::table('ddd')->where(['text'=>111])->update(['ccc'=>333]);