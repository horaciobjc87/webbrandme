<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EnvioCorreo;
use Illuminate\Support\Facades\Mail;


class TokenRefresh extends Controller
{
    //Función donde se crea un token aleatorio de manera automatica
    public function renewtoken(){
      $abecedario = "ABCDEFGHJKLMNOPQRSTUVWXYZ";
      $mayusculas = str_split($abecedario);
      $numeros =  range(0,9);
      shuffle($mayusculas);
		  shuffle($numeros);
      $arregloCadena = array_merge($mayusculas,$numeros);
      $newToken = "";

      for($i=0;$i<=12;$i++) {
				$arreg = self::obtenercaractertoken($arregloCadena);
				$newToken .= self::obtenCaracterMd5($arreg);
		  }
      if($newToken != ""){ //Si el token no esta vacio entonces manda a llamar a la vista y envia el correo
        Mail::to('horacio.barros@live.com.mx')->send(new EnvioCorreo());
		      return view('brandme')
          ->with('newToken',$newToken)
          ->with('message', 'Se ha notificado al Administrador');
      }else{
        return "Error";
      }
    }

    function obtenercaractertoken($arreglo){ //Se obtiene el caracter para formar el array del token
      $clave_aleatoria = array_rand($arreglo, 1);
      return  $arreglo[ $clave_aleatoria];
    }

    function obtenCaracterMd5($arreglo) { //Se genera el MD5 para poder dar seguridad al token
  		$md5 = md5($arreglo);
  		$arr = str_split(strtoupper($md5));
      $arrToken = self::obtenercaractertoken($arr);
  		return 	$arrToken;
  	}


}
