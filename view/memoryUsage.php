<?php
//function optionList($rezisMin, $resisMax, $parinkta = Null){
//   $o = "";
//
//    for($i = $rezisMin; $i<=$resisMax; $i++){
//        $prk = ($i=== (int)$parinkta)?' SELECTED="SELECTED" ':'';
//        $o .= "<option value=\"{$i}\" {$prk}>{$i}</option>\n";
//    }
//    return $o;
//}
$klaida= array(
    "parametrai"=> "<span>Klaidingai parinkti parametrai</span>"
);
?>
    <script type="text/javascript">
        setInterval(function(){fcija();},1000);

        function isNumber(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }
<!--        function fcija(){-->
<!--            var x1 = --><?php //echo 11; ?><!--;-->
<!--            var y2 = --><?php //echo 15; ?><!--;-->
<!---->
<!--            var sel = document.getElementById('tem1');-->
<!--            var x=sel.options[sel.selectedIndex].value;-->
<!--            var sel2 = document.getElementById('tem2');-->
<!--            var y=sel2.options[sel2.selectedIndex].value;-->
<!---->
<!--            document.getElementById("klaida").innerHTML = (x>=y)?"--><?php ////print $klaida['parametrai'];?><!--":"";-->
<!--            var tempToServer = "?tem1="+x+"&tem2="+y;-->
<!--            $.post( "/sk.php"+tempToServer, function(data) {-->
<!---->
               // var onOff =(data <= x)?"<b>Šildytuvas:&nbsp </b><b style='color:green;'>Įjungtas</b>":(data >= y)?"<b>Šildytuvas:&nbsp </b> <b style='color:red;'>Išjungtas</b>":"";-->
<!--                document.getElementById("skaicius").innerHTML = onOff;-->
                //document.getElementById("sk").innerHTML=data;-->
<!--            });-->
<!--        }-->
    </script>
    <script type="text/javascript">
        // Configure the plot
        $(function() {
            var temperature = document.getElementById("sk");
            var chart = new Highcharts.Chart({
                chart: {
                    renderTo: 'container',
                    defaultSeriesType: 'spline',
                    events: {
                        load: getData
                    }
                },
                title: {
                    text: 'Akvariumo temperatūra'
                },
                xAxis: {
                    type: 'datetime',
//                    tickPixelInterval: 150,
                    tickPixelInterval: 150,
//                    maxZoom: 20 * 1000,
                    maxZoom: 20 * 1000,
                    title: {
                        text: 'Laikas (atnaujinama sekundės intervalu)',
                        margin: 15
                    }
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Temperatūra \u00B0C',
                        margin: 15
                    }
                },
                series: [{
                    name: 'DS18B20 termojutiklis (\u00B10.5\u00B0C)',
                    data: []
                }]
            });
            function getData(){ // gauna iš servo duomenis
                $.getJSON('/graph/test' /*serverio failas Į kurį kreipaisi*/, function(data /*atsakymas išserverio (json failas)*/) {
                    // Create the series
                    var series  = chart.series[0],
                        shift = series.data.length > 20; // shift if the series longer than 20 //nustatymai grafiko
                    // Add the point
                    chart.series[0].addPoint([data.temperature_record[0].unix_time, data.temperature_record[0].celsius], true, shift); //taško pridėjimas grafike
                    temperature.innerHTML=data.temperature_record[0].celsius;
                    // Repeat this function call after 1 second
                    setTimeout(getData, 1000);
                });
            }
        });
    </script>
<div><b>Temperatūra:</b><span id="sk"> &nbsp;</span></div>
<!--<div><span>Būsena:</span><span id="skaicius"></span></div>-->
<div id="klaida" class="klaida"></div>
<center>
    Nustatykite kada turėtų įsijungti šildytuvas
    <select name = "temp1" id="tem1">
<!--        --><?php //print optionList(15,30,15);?>
    </select>

    <br>Nustatykite kada turėtų išsijungti šildytuvas
    <select name = "temp2" id="tem2">
<!--        --><?php //print optionList(15,30,19);?>
    </select>
</center>

<div id="container" style="width: 100%; height: 400px"></div>

