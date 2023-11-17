<?php

echo "<h1>Iniciar sesión</h1>";
echo "<h3>No tienes una cuenta? <a href='index.php?registro'>Regístrate</a></h3>";
echo '<form method="post" action="index.php">
            <input type="text" name="username" placeholder="Nombre de usuario" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciar sesión">
            </form>';
