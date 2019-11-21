<?php 
// 用的时oop思想来开发，还用pdo，不会可以基础内容
    class Database{

        private $dsn="mysql:host=localhost;dbname=php_oops_curd";
        private $username="root";
        private $password="";
        public $conn;

        public function __construct()
        {
            try
            {
                $this->conn=new PDO($this->dsn,$this->username,$this->password);
                // echo "success connected..";
            }
            catch(PDOException $e){
                echo $e->getMessage();
                echo "error";
            }
            
        }

        // 添加用户
        public function insert($fname,$lname,$email,$phone){
            $sql="INSERT INTO users (first_name,last_name,email,phone) VALUES (:fname,:lname,:email,:phone)";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['fname'=>$fname,'lname'=>$lname,'email'=>$email,'phone'=>$phone]);
            return true;
        }
        // 获取全部数据
        public function read(){
            $data=array();
            $sql="SELECT * FROM users";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $data[]=$row; 
            }
            return $data;
        }
        // 获取单个用户信息
        public function getUserById($id){
            $sql="SELECT * FROM users WHERE id = :id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        // 更新信息
        public function update($id,$fname,$lname,$email,$phone){
            $sql="UPDATE users SET first_name= :fname,last_name= :lname,email=:email,phone=:phone WHERE id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['fname'=>$fname,'lname'=>$lname,'email'=>$email,'phone'=>$email,'id'=>$id]);
            return true;
        }
        // 删除用户
        public function deleteById($id){
            $sql="DELETE FROM users WHERE id =:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
             return true; 
        }
        // 通过函数用户数
        public function totalRowcCount(){
             $sql="SELECT * FROM users";
             $stmt=$this->conn->prepare($sql);
             $stmt->execute();
             $t_rows=$stmt->rowCount();
             return $t_rows;
        }
    }


  ?>