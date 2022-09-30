<?php
ini_set('display_errors', 0);
$users = json_decode(file_get_contents('http://localhost/api-get-all-users.php'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="app.css">
  <title>PHP + SurrealDB</title>
</head>
<body>
  
  <nav>
    <a href="/">
      PHP and SurrealDB
    </a>
  </nav>

  <main>
    <form autocomplete="off" onsubmit="create_user(); return false">
        <div>
          <label for="">User name ( min 2 max 20 characters)</label>
          <input name="user_name" type="text">
        </div>        
        <div>
          <label for="">User last name ( min 2 max 20 characters)</label>
          <input name="user_last_name" type="text">
        </div>        
      <button>
        Create user
      </button>
    </form>  


    <div id="users">
      <?php
      foreach($users as $user){
      ?>
        <form autocomplete="off" class="user" onsubmit="delete_user(); return false">
          <input name="user_id" type="text" value="<?= $user['id']; ?>">
          <input name="user_name" onblur="update_user()" type="text" value="<?= $user['user_name']; ?>">        
          <input name="user_last_name" onblur="update_user()" type="text" value="<?= $user['user_last_name']; ?>">        
          <button>🗑️</button>
        </form>  
      <?php
      }
      ?>
    </div>
  </main>

  <script>

    // ##############################
    async function create_user(){
      const frm = event.target
      console.log(frm)
      const conn = await fetch('api-create-user.php', {
        method : "POST",
        body : new FormData(frm)
      })
      const data = await conn.json()
      if(!conn.ok){
        alert('Cannot create user')
        return
      }   
      user = data.result[0]
      console.log(data)
      document.querySelector("#users").insertAdjacentHTML('afterbegin', `
        <form autocomplete="off" class="user" onsubmit="delete_user(); return false">
          <input name="user_id" type="text" value="${user.id}">
          <input name="user_name" onblur="update_user()" type="text" value="${user.user_name}">        
          <input name="user_last_name" onblur="update_user()" type="text" value="${user.user_last_name}">        
          <button>🗑️</button>
        </form>  
      `)      
    }

    // ##############################
    async function update_user(){
      const frm = event.target.form
      console.log(frm)
      const conn = await fetch('api-update-user.php', {
        method : "POST",
        body : new FormData(frm)
      })
      const data = await conn.json()
      if(!conn.ok){
        alert('Cannot update user')
        return
      }      
    }

    // ##############################
    async function delete_user(){
      const frm = event.target
      console.log(frm)
      const conn = await fetch('api-delete-user.php', {
        method : "POST",
        body : new FormData(frm)
      })
      const data = await conn.json()
      if(!conn.ok){
        alert('Cannot DELETE user')
        return
      }   
      frm.remove()
    }

  </script>


</body>
</html>