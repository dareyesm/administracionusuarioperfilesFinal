<?php

require'../class/sessions.php';
$objses = new Sessions();
$objses->init();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null ;

if($user == ''){
	header('Location: http://localhost:8888/CodigosVideos/5-ControlRolesFinal/index.php?error=2');
}

?>
<?php
//Llamado de los archivos clase
require'../class/config.php';
require'../class/profiles.php';
require'../class/roles.php';
require'../class/dbactions.php';
require'../class/Pmenu.php';
require'../global/constants.php';

//realizamos la conexión a la base de datos
$objCon = new Connection();
$objCon->get_connected();

//consultamos el listado de los usuarios!!
$objRol = new Roles();
$list_roles = $objRol->show_roles();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administrar Roles!!</title>
    </head>
    
    <body>
    	
        <?php echo "Bienvenido, " . $_SESSION['user'];?>
        
        <?php require'../global/menu.php';?>
        
        <table align="center" border="1">
        	
            <thead>
            	<tr>
                    <?php if(in_array('13', $_SESSION['roles'])){ ?>
                        <td colspan="9" align="center"><a href="new_role.php">Nuevo Rol</a></td></tr>
                    <?php }else{ ?>
                        <td onclick="return false" colspan="9" align="center"><a href="new_role.php">Nuevo Rol</a></td></tr>
                    <?php } ?>
                <tr><th colspan="9" align="center">Listado de Roles!!!</th></tr>
                <tr>
                	<td>ID</td>
                	<td>Código</td>
                    <td>Nombre del Role</td>
                    <td>Modulo</td>
                    <td>Descripción</td>
                    <td>Creado el</td>
                    <td>Estado</td>
                    <td colspan="2" align="center">Acciones</td></tr>
                
            </thead>
            <tbody>
            
            	<?php
        	
				$numrows = mysql_num_rows($list_roles);
				
				if($numrows > 0){
					
					while($row=mysql_fetch_array($list_roles)){?>
                    
                    	<tr>
                        	<td><?php echo $row["idRole"];?></td>
                            <td><?php echo $row["codeRole"];?></td>
                            <td><?php echo $row["nameRole"]; ?></td>
                            <td><?php echo $row["nameModule"]; ?></td>                            
                            <td><?php echo $row["descRole"]; ?></td>
                            <td><?php echo $row["dateRole"]; ?></td>
                            <td><?php echo $row["statRole"]; ?></td>
                            <td><?php if(in_array('14', $_SESSION['roles'])){ ?>
                                <a href="modify_role.php?idrole=<?php echo $row["idRole"];?>">Modificar</a></td><?php }else{ ?>
                                <a onclick="return false" href="modify_role.php?idrole=<?php echo $row["idRole"];?>">Modificar</a></td> <?php } ?>
                                
							<td><?php if(in_array('15', $_SESSION['roles'])){ ?>
                                <a href="delete_role.php?idrole=<?php echo $row["idRole"];?>">Eliminar</a></td><?php } else{ ?>
                                <a onclick="return false" href="delete_role.php?idrole=<?php echo $row["idRole"];?>">Eliminar</a></td><?php } ?>
                        </tr>
                        
						<?php
					}
					
				}
			
				?>
            
            </tbody>
        
        </table>
        
    </body>
</html>