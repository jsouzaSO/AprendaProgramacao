<?php
   $pdo = new PDO("mysql:host=localhost;dbname=nome_banco", "root", "sua_senha");
   if(!$pdo){
       die('Erro ao criar a conexão');
   }

   $executa = $pdo->query("INSERT INTO cliente(idcliente, nome) VALUES ('1', 'Rafael')");
   if($executa){
      echo 'Dados inseridos com sucesso!';
   }
   else{
      print_r($pdo->errorInfo());
   }

   $rs = $pdo->query("SELECT idcliente, nome FROM cliente")->fetchAll();
   if(!$rs){
      print_r($pdo->errorInfo());
   }
 
   foreach ($rs as $reg){
      echo 'Código: ' . $reg['idcliente'] . '<br />';
      echo 'Nome: ' . $reg['nome'] . '<br /><br />';
   }

   $idcliente = 100;
   $nome = "Junior Souza";
   try{
       $stmte = $pdo->prepare("INSERT INTO cliente(idcliente, nome) VALUES (?, ?)");
       $stmte->bindParam(1, $idcliente , PDO::PARAM_INT);
       $stmte->bindParam(2, $nome , PDO::PARAM_STR);
       $executa = $stmte->execute();
 
       if($executa){
           echo 'Dados inseridos com sucesso';
       }
       else{
           echo 'Erro ao inserir os dados';
       }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }

   $idcliente = 100;
   $nome = "Junior Souza";
   try{
       $stmte = $pdo->prepare("INSERT INTO cliente(idcliente, nome) VALUES (:idcliente, :nome)");
       $stmte->bindParam(":idcliente", $idcliente , PDO::PARAM_INT);
       $stmte->bindParam(":nome", $nome , PDO::PARAM_STR);
       $executa = $stmte->execute();
 
       if($executa){
           echo 'Dados inseridos com sucesso';
       }
       else{
           echo 'Erro ao inserir os dados';
       }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }

   $nome = "Junior Souza";
   try{
       $stmte = $pdo->prepare("SELECT idcliente, nome FROM cliente WHERE nome = ?");
       $stmte->bindParam(1, $nome , PDO::PARAM_STR);
       $executa = $stmte->execute();
 
       if($executa){
           while($reg = $stmte->fetch(PDO::FETCH_OBJ)){ /* Para recuperar um ARRAY utilize PDO::FETCH_ASSOC */
                echo 'Código: ' . $reg->idcliente . '<br />';
                echo 'Nome: ' . $reg->nome . '<br /><br />';
           }
       }
       else{
           echo 'Erro ao inserir os dados';
       }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }