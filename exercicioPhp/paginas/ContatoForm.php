<?php
 include '../EX.class.php';
 $conn = new EX();

 if(!empty($_POST)){
    try {

        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST['nome'])) {  
            throw new Exception(" Somente letras e espaços em branco são permitidos. ");
        }
        
        if (!filter_var($_POST['data'], FILTER_VALIDATE_DATE)) {
            throw new Exception(" Formato de data inválido. ");
        }

        if(empty($_POST['id'])){
          $conn->inserir($_POST);
        } else {
          $conn->atualizar($_POST);
        }
        header("location: ContatoList.php");

    } catch (Exception $e){
        $id = $_POST['id'];
        header("location: ContatoForm.php?id=$id&erro=".$e->getMessage());
    }
 }
 if(!empty($_GET['id'])){
   $data = $conn->buscar($_GET['id']);
   //var_dump($data);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ContatoForm.php" method="post">
        <h3>Formulário Musica</h3>
        <?php echo(!empty($_GET["erro"])? $_GET["erro"]:"") ?><br>
        <input type="hidden" name="id" value="<?php echo(!empty($data->id) ? $data->id:"")?>" />
        <label for="">Nome</label>
        <input type="text" name="nome" value="<?php echo(!empty($data->nome) ? $data->nome : "" ) ?>"><br>

        <label for="">Cantor</label>
        <input type="text" name="cantor" value="<?php echo(!empty($data->cantor) ? $data->cantor : "" ) ?>"><br>

        <label for="">Data</label>
        <input type="date" name="data" value="<?php echo(!empty($data->data) ? $data->data : "" ) ?>"><br>

        <button type="submit"><?php echo(empty($_GET['id'])?"Salvar":"Atualizar")?></button><br>
        <a href="ContatoList.php">Voltar</a><br><br>
    </form>
</body>
</html>
