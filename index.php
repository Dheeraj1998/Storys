<html>
    <head>
        <title>Web App</title>
        <?php echo 'Hey there this is Shantanu!!!' ?>
    </head>
    
    <body>
        <div id = "main-title">
            <center><h1>Web Application</h1></center>
        </div>
        
        <div id = "main-content">
            <center>
                <form action = "web_app_server.php" method="get">
                    <h2>Login</h2>
                    <table border="0">
                        <tr>
                            <td><label for="username">Username</label></td>
                            <td><input type="text" name="username" id="username"></td>
                        </tr>
                        
                        <tr>
                            <td><label for="password">Password</label></td>
                            <td><input name="password" type="password" id="password"></td>
                        </tr>
                        
                        <tr>
                            <td><input type="submit" value="Submit"/>
                            <td><input type="reset" value="Reset"/>
                        </tr>
                    </table>
                </form>
            </center>
        </div>
    </body>
</html>
