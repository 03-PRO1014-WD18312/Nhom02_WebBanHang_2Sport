<?php 
    // Kiểm tra mật user / pass để login
    function check_login($enterUsername,$enterPassword){
        $sql="SELECT * FROM account WHERE username='".$enterUsername."' AND password='".$enterPassword."'";
        $check_login=pdo_query_one($sql);
        return $check_login;
    }
    //đăng kí khách hàng
    function register_kh($user,$pass,$email){
        $sql="INSERT INTO `account`(`username`, `password`, `email`) VALUES ('$user','$pass','$email')";
        pdo_execute($sql);
    }
    //Hiển thị danh sách khách hàng
    function list_kh(){
        $sql ="SELECT * FROM account ORDER BY id DESC";
        $dskh=pdo_query($sql);
        return $dskh;
    }
?>