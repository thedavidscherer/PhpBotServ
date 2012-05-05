<html>

  <head>
    <title>PHP-BotServ for IRC 0.1.1 Web Installer</title>
  </head>
  
  <body>
  
    <h3> PHP-BotServ Web Install </h3> <br />
    
    <br />
    
    <form name="setup" method="post" action="setup.php">
      <table>
        <tr>
          <td> <h4> [program] </h4> </td>
        </tr>
        
        <tr> 
          <td> <strong>Root Path</strong> </td>
          <td> <input type="text" name="program_path" /> </td>
        </tr> 
        
        <tr>
          <td> <br /> <h4> [network] </h4> </td>
        </tr>
        
        <tr>
          <td> <strong>Server</strong>: </td>
          <td> <input type="text" name="network_server" /> </td>
        </tr>
        
        <tr>
          <td> <strong>Port</strong>: </td>
          <td> <input type="text" name="network_port" /> </td>
        </tr>
        
        <tr>
          <td> <strong>Nick</strong>: </td>
          <td> <input type="text" name="network_nick" /> </td>
        </tr>
        
        <tr>
          <td> <strong>Pass</strong>: </td>
          <td> <input type="text" name="network_pass" /> </td>
        </tr>
           
        <tr>
          <td> <strong>Real Name</strong>: </td>
          <td> <input type="text" name="network_real" /> </td>
        </tr>
        
        <tr>
          <td> <strong>E-mail</strong>: </td>
          <td> <input type="text" name="network_email" /> </td>
        </tr>
          
        <tr>
          <td> <strong>Identity</strong>: </td>
          <td> <input type="text" name="network_ident" /> </td>
        </tr>
        
        <tr>
          <td> <strong>Oper Name</strong>: </td>
          <td> <input type="text" name="network_oper" /> </td>
        </tr>
        
        <tr>
          <td> <br /> <h4> [mysql] </h4> </td> 
        </tr>  
        
        <tr>
          <td> <strong>Server</strong>: </td>
          <td> <input type="text" name="mysql_server" /> </td>
        </tr>
          
        <tr>
          <td> <strong>User</strong>: </td>
          <td> <input type="text" name="mysql_user" /> </td>
        </tr>
          
        <tr>
          <td> <strong>Password</strong>: </td>
          <td> <input type="text" name="mysql_password" /> </td>
        </tr>
          
        <tr>
          <td> <strong>Database</strong>: </td>
          <td> <input type="text" name="mysql_database" /> </td>
        </tr>
          
        <tr>
          <td> <input type="submit" value="Install" /> </td>
        </tr>
          
      </form>

  
  </body>
    
</html>