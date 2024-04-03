<?php
function clDump($cad){
    ob_start();
    var_dump($cad);
    $result = ob_get_clean();
    
    $result = preg_replace('#\R+#', " ", $result);
    echo "<script>console.log('".$result."');</script>";
}
function cl($cad){
    echo "<script>console.log('".$cad."');</script>";
}

function queryBDD($q,$bdd){
    $link = mysqli_connect('localhost', 'root', '3t3j2r1s.',$bdd);
    mysqli_set_charset($link,"utf8");
    $res = mysqli_query($link,$q);
    $arr=mysqli_fetch_all($res);
    mysqli_close($link);
    return $arr;
}

function insertBDD($q,$bdd){
    $link = mysqli_connect('localhost', 'root', '3t3j2r1s.',$bdd);
    mysqli_set_charset($link,"utf8");
    mysqli_query($link,$q);
    //$arr=mysqli_fetch_all($res);
    mysqli_close($link);
    //return $arr;
}

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

function nAsign($codigo){
    $qDec="select nombre,semestre from asignaturasDeGrados where codigo=$codigo;";
    $arrDec=queryBDD($qDec,'decanato');
    $arrDec=$arrDec[0];
    return $arrDec[0];
}

function obtenerFicha($codigo){
    $url="http://asignaturas2.uca.es/wuca_asignaturasttg1617_asignatura?titul=40210&asign=$codigo";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $cad=curl_exec($ch);
    curl_close($ch);
    
    $pos=strpos($cad,"<div id=\"b_competencias\">");
    $cad=substr($cad,$pos);
    $pos=strpos($cad,"<table");
    $cad=substr($cad,$pos);

    $pos=strpos($cad,"</table>");
    $cad=substr($cad,0,$pos+8);
    
    echo "<div class='w3-border w3-white w3-panel' id='divC'>";
    echo "<h4>Competencias que aparecen en la ficha de ".nAsign($codigo)." ($codigo)</h4>";
    echo $cad;
    echo "</div>";
    
    return $cad;
}

function obtenerCodigos($codigo){
    $arr=array();
    $cad=obtenerFicha($codigo);
    $pos=strpos($cad,'<td class="fichasig" align="center"><span class="fichasig">');
    while($pos!==false){
        $cad=substr($cad,$pos+59);
        //echo substr($cad,0,10)."\n";
        if($cad[3]=='<')
            $comp=substr($cad,0,3);
        else
            $comp=substr($cad,0,4);
        array_push($arr,$comp);
        $pos=strpos($cad,'<td class="fichasig" align="center"><span class="fichasig">');
    }
    return $arr;
}

function crearSelect($vselect,$nombre,$arr){
    //$arr=obtenerCodigos($codigo);
    $cad="<select name='$nombre' class='w3-border w3-input'>\n";
    $cad=$cad."<option value=''>--</option>";
    for($i=0;$i<sizeof($arr);$i++){
        echo ">>>".$vselect==$arr[$i];
        if($vselect==$arr[$i])
            $cad=$cad."<option value='$arr[$i]' selected>$arr[$i]</option>\n";
        else
            $cad=$cad."<option value='$arr[$i]'>$arr[$i]</option>\n";
    }
    $cad=$cad."</select>\n";
    return $cad;
}
?>