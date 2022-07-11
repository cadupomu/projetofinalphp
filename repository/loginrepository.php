<?php

    require_once('connection.php');

    function fnLogin($email, $senha) {
        $con = getConnection();

        $sql = "select id, email, cargos, created_at as createdAt from usuarios where email = :pEmail and senha = :pSenha";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pEmail", $email);
        $stmt->bindValue(":pSenha", md5($senha));

        if($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        return null;
    }

    function fnAtualizaSenha($email, $senha) {
        $con = getConnection();

        $sql = "update usuarios set senha = :pSenha where email = :pEmail";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pEmail", $email);
        $stmt->bindValue(":pSenha", md5($senha));

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    function fnAddUser ($email, $senha) {
        $con = getConnection();
        
        $sql = "insert into usuarios (email, senha) values (:pEmail, :pSenha)";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pEmail", $email); 
        $stmt->bindValue(":pSenha", md5($senha));
        
        return $stmt->execute();
    }


