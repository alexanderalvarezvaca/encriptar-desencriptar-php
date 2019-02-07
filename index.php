<?php

/**/

function openCypher($action='encrypt',$string=false){
    
    $action = trim($action);
    $output = false;

    $myKey = 'oW%c76+jb2';
    $myIV = 'A)2!u467a^';
    $encrypt_method = 'AES-256-CBC';

    $secret_key = hash('sha256',$myKey);
    $secret_iv = substr(hash('sha256',$myIV),0,16);

    if ( $action && ($action == 'encrypt' || $action == 'decrypt') && $string )
    {
        $string = trim(strval($string));

        if ( $action == 'encrypt' )
        {
            $output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
        };

        if ( $action == 'decrypt' )
        {
            $output = openssl_decrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
        };
    };

    return $output;
};

/**/

if(@$_POST['text_area']){
	$resultado = trim(openCypher(@$_POST['select_tipo'],@$_POST['text_area']));
}

/**/

?>
<!DOCTYPE html>
<html>
<head>
	<title>Seguridad ITSRL.COMPANY</title>
</head>
<body>
	<br>
	<h1>Ejemplo de Encriptacion basica<br><small>INTELLIGENCE TECHNOLOGY COMPANY SRL</small><br><small><a href="http://it.srl.company/" target="_blank">www.it.srl.company/</a></small></h1>
	<h3>Ejemplo para encriptar y desencriptar</h3>
	<hr><br>
	<table>
		<tr>
			<td>Texto</td>
			<td>Resutado</td>
		</tr>
		<tr>
			<td>
				<form method="post"> 
					<textarea name="text_area" style="width: 500px; height: 500px;"><?php echo @$_POST['text_area'];  ?></textarea>
					<br>
					<select name="select_tipo">
						<option value="encrypt">Encriptar</option>
						<option value="decrypt">Desencriptar</option>
					</select>
					<input type="submit" name="Generar" id="Generar" value="Generar">
				</form>
			</td>
			<td style="margin-top: 0; padding-top: 0;">
				<textarea style="width: 500px; height: 500px;"><?php echo @$resultado;  ?></textarea>
				<br>
				<select name="select_tipo">
					<option value="0">Gracias</option>
				</select>
			</td>
		</tr>
	</table>
	<hr>
</body>
</html>

