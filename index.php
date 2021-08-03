<?php
  session_start();
  include('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login - WebSystems</title>
  </head>
  <body>
    <div style="width: 100%; background-color: red; color: #fff; padding: 10px; margin-bottom: 20px">Login</div>


<?php
if(isset($_POST['logar'])){
  $login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'utf-8');
  $senha = htmlspecialchars($_POST['senha'], ENT_QUOTES, 'utf-8');
  $senha = md5($senha);
  if(empty($login) or empty($senha)){
    echo '
    <script>
      window.alert("Preencha todos os campos!");
    </script>
    ';
  }
  else{
    $query = "SELECT nomeCliente FROM clientes WHERE nomeCliente='$login'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
      $query = "SELECT * FROM clientes WHERE senhaCliente ='$senha'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) == 1){
        while($row = mysqli_fetch_assoc($result)) {
          $idUsuario = $row['idUsuario'];
          $funcaoUsuario = $row['funcao'];
        }
        $_SESSION['logado'] = true;
        $_SESSION['idUsuario'] = $idUsuario;
        $_SESSION['funcaoUsuario'] = $funcaoUsuario;
        header('Location: inserirCategoria.php');
      }
      else{
        echo '
        <script>
          window.alert("Usuário e senha incorretos");
        </script>
        ';
      }
    }
    else{
      echo '
      <script>
        window.alert("Usuário não existe");
      </script>
      ';
    }
  }
}
?>


      <section id="containerLogin">
        <form class="" method="post">
          <input class="inputLogin" type="text" name="login" placeholder="Usuário" autocomplete="off" required value="">
          <input class="inputLogin" type="password" name="senha" placeholder="Senha" autocomplete="off" required value="">

          <input class="btnLogin" type="submit" name="logar" value="Logar">
        </form>
      </section>
  </body>
</html>
