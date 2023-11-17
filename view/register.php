<?php

echo "<h1>Registrarse</h1>";
echo "<h3>Ya tienes una cuenta? <a href='index.php'>Inicia sesión</a></h3>";
echo '<form method="post" action="index.php">
            <input type="text" name="newusername" placeholder="Nombre de usuario" required><br>
            <input type="password" name="newpassword" placeholder="Contraseña" required><br>
            <input type="submit" value="Registrarse">
            </form>';
