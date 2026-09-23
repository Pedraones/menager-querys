<link rel="stylesheet" href="../Styles/home-styles.css">

<body>
   <table>

      <tr>
         <th>Querys disponíveis</th>
         <th>Adicionar query</th>
      </tr>

      <tr>
         <td>
            <?php
               $dir_root = getenv("dir_menager_querys");      
               require_once $dir_root . "app/Routes.php";

               $route = new Routes();

               $querys = $route->listQuerys();

               for($count = 0; $count < count($querys); $count++){
                  echo "Nome: " . $querys[$count]["name"];
                  echo "<br>";
                  echo "Descrição: " . $querys[$count]["description"] . "<br>";

                  if($querys[$count]["content"] != null) echo "Conteúdo: " . $querys[$count]["content"] . "<br>";
                  if($querys[$count]["archive"] != null) echo "Arquivo: <a href='#'>LINK</a>";
                  
                  if($querys[$count]["code_referred_HDK"] != null) echo "<br>Código: HDK-" . $querys[$count]['code_referred_HDK'];
                  if($querys[$count]["code_referred_ESUS"] != null) echo "<br>Código: ESUS-". $querys[$count]["code_referred_ESUS"];
                  
                  echo "<br>";
               }
            ?>
         </td>

         <td>
            <form action="./home-page.php" method='POST' enctype="multipart/form-data">
               <input type="hidden" name="action" value="addQuery">
               <label>
                  Nome:
               </label>
               <input type="text" name="name" required>

               <br>
                  
               <label>
                  Arquivo:
               </label>
               <input type="file" name="file_query">

               <br>

               <label>
                  Texto da query:
               </label>
               <input type="text" name="content">

               <br>

               <label>
                  Descrição (o que retorna):
               </label>
               <input type="text" name="description" required>

               <br>

               <label>
                  Todos podem visualizar o arquivo ? (caso não, apenas usuarios do mesmo cargo/area poderão visualizar):
               </label>
               <select name="public_view">
                  <option value=1>Sim</option>
                  <option value=0>Não</option>
               </select>

               <br>

               <label>
                  Código do chamado:
               </label>
               <select name="referred">
                  <option value="hdk">HDK</option>
                  <option value="esus">ESUS</option>
               </select>
               <input type="number" name="code">

               <button type="submit">Adicionar</button>
            </form>
         </td>
      </tr>

   </table>
</body>
