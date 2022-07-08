<?php

    require_once('connection.php');


    function fnAddMembro ($foto, $nome, $datanasc, $posicao, $descricao) {
        $con = getConnection();
        
        $sql = "insert into membros (foto, nome, datanasc, posicao, descricao) values (:pFoto, :pNome, :pDatanasc, :pPosicao, :pDescricao)";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pFoto", $foto); 
        $stmt->bindParam(":pNome", $nome); 
        $stmt->bindParam(":pDatanasc", $datanasc); 
        $stmt->bindParam(":pPosicao", $posicao); 
        $stmt->bindParam(":pDescricao", $descricao); 
        
        return $stmt->execute();
    }

    function fnListMembros() {
        $con = getConnection();

        $sql = "select * from membros";

        $result = $con->query($sql);

        $lstMembros = array();
        while($membros = $result->fetch(PDO::FETCH_OBJ)) {
            array_push($lstMembros, $membros);
        } 

        return $lstMembros;
    }

    function fnLocalizaMembroPorNome($nome) {

        $con = getConnection();

        $sql = "select * from membros where nome like :pNome limit 20";

        $stmt = $con->prepare($sql);

        $stmt->bindValue(":pNome", "%{$nome}%");

        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetchAll();
        }
    }



    function fnLocalizaMembroPorId($id) {
        $con = getConnection();

        $sql = "select * from membros where id = :pID";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID", $id);

        if($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        return null;
    }

    function fnUpdateMembro($id, $foto, $nome, $datanasc, $posicao, $descricao) {
        $con = getConnection();
                
        $sql = "update membros set foto = :pFoto, nome = :pNome, datanasc = :pDatanasc, posicao = :pPosicao, descricao = :pDescricao where id = :pID";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID", $id); 
        $stmt->bindParam(":pFoto", $foto); 
        $stmt->bindParam(":pNome", $nome); 
        $stmt->bindParam(":pDatanasc", $datanasc); 
        $stmt->bindParam(":pPosicao", $posicao);
        $stmt->bindParam(":pDescricao", $descricao);
        
        return $stmt->execute();
    }

    function fnDeleteMembro($id) {
        $con = getConnection();
                
        $sql = "delete from membros where id = :pID";
        
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":pID", $id);
        
        return $stmt->execute();
    }