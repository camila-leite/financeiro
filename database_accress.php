<?php
//Dados do SGBD
//server
$servidor = 'localhost';
//user
$usuario = 'root';
//pass
$senha = 'CoelhO10TIgre22@&';
//database
$banco = 'financeiro';
// Conecta-se ao banco de dados MySQL
// var mysqli = objeto criado para estabelecer socket com o SGDB
$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
// Caso algo tenha dado errado o estabelecimento da comunicação do SGBD
if (mysqli_connect_errno()) {
	trigger_error(mysqli_connect_error());
	echo 'Sem Comunicação com a Base de Dados</br>';
	}
// Ação para listar os dados
// var sql_src = Codigo em sql
// var qerry = consulta enpasulada no socket
// var dafos = array de dados
if ($_GET['acao'] == 'home'){
	$sql_src = "SELECT `salario`,`outros` FROM `ganhos`;";
	$query = $mysqli->query($sql_src);
	while($dados = $query->fetch_array()){
		echo 'Salario: ' . $dados['salario'] . '   ';
		echo 'Outros: ' . $dados['outros'] . ' </br> </br>';
	}
	
	echo 'Registros encontrados: ' . $query->num_rows;
}
// Ação para addicionar um salario
// var salario = valor do salario a ser inserido
// var sql_src = Codigo em sql
// var qerry = consulta enpasulada no socket
if ($_GET['acao'] == 'addsalario'){
	$salario = $_GET['salario'];
	$sql_src = "INSERT INTO `ganhos` (salario,outros) VALUES ('$salario',0);";
	$query = $mysqli->query($sql_src);
	//Check if change
	if($mysqli->affected_rows>=1){
		echo 'Dados inseridos com sucesso </br>';
		echo 'Registros afetados ' . $mysqli->affected_rows . '  </br>';
        }else{
		echo 'Dados não inseridos';
        }
}
//Drop no socket do SGBD
$mysqli->close();
?>
