<?php
 include '../EX.class.php';
 $conn = new EX();

    $load = $conn->select();

    if(!empty($_GET['id'])){
        $conn->deletar($_GET['id']);
        header("location: MusicaList.php");
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
    <a href="MusicaForm.php">Cadastrar</a><br><br>
<table border="1">
    <tr>
        <th>Nome</th>
        <th>Cantor</th>
        <th>Data</th>
        <th></th>
        <th></th>
    </tr>
    <?php
        foreach($load as $item){
            echo "<tr>";
                echo "<td>".$item->nome."</td>";
                echo "<td>".$item->cantor."</td>";
                echo "<td>".$item->data."</td>";
                 echo "<td><a href='MusicaForm.php?id=$item->id'>Editar</a></td>";
                echo "<td><a onclick='return confirm(\"Deseja Excluir? \")' href='MusicaList.php?id=$item->id'>Deletar</a></td>";
            echo "<tr>";
        }
    ?>
</table>
</body>
</html>
