<?php
//pasa tkts de filtro $TKTS

$data = array();
$i = 0;

$GenPorSistemas = 0;
$GenASistemas = 0;
$GenAProces = 0;

foreach ($TKTS as $TKT) {
    /*
      $nombre = $TKT->get_prop("equipo")->get_prop("nombre");

      if($nombre=="Gestion De La Demanda Procesos")
      {
      $contador++;

      }
      if (strtolower($nombre) =="sistemas de ventas")
      {
      $contador2++;

      }
     * $data[$i]["fechaalta"]=$TKT->get_prop("FA");
     */

    $usr_ap = $TKT->get_prop("usr_o");
    //echo $usr_ap->get_prop("nombre");

    $ventas = $TKT->get_prop("equipo")->get_prop("nombre");

    foreach ($usr_ap->get_prop("equiposobj") as $t) {
        //echo "--".$t->get_prop("nombre");
        $equipo = $t->get_prop("nombre");
        if ($equipo == $postV["origen"]) {
            $GenPorSistemas++; //total generado por sistemas de ventas

            if ($ventas == "Sistemas De Ventas") {
                $GenASistemas++;
            }
            if ($ventas == "Gestion De La Demanda Procesos") {
                $GenAProces++;
            }
        }

    }
    //$contador2++;
    //echo $contador2." ";
    //echo "<br/>";
    //$i++;
    //  echo $ventas;
}
/*
  echo "Gest de la demanda = ".$contador."<br/>";
  echo "Sistemas = ".$contador2;
 *
 */
$porcasist = round(($GenASistemas * 100) / $GenPorSistemas, 2);
$porproceso= round (($GenAProces * 100) / $GenPorSistemas, 2);

echo "Cantidad Generado por Sistemas de Ventas - " . $GenPorSistemas . "<br/>"; //


echo "Cantidad para SV- " . $GenASistemas. " (".$porcasist. "%)<br/>";

echo "Cantidad para GD - " . $GenAProces. " (".$porproceso ."%)<br/>";
//echo $contador;


exit();
?>
<!-- 
Header
-->

<table border="1">
    <tr>
        <td>
            nro de ticket
        </td>
        <td>
            fecha alta
        </td>
    </tr>

    <!-- 
    Datos
    -->
    <?
    foreach ($data as $el) {
        ?>

        <tr>
            <td>
                <?= $el["id"] ?>
            </td>
            <td>
                <?= $el["fechaalta"] ?>
            </td>
        </tr>

        <?
    }
    ?>