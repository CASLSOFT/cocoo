<!DOCTYPE html>
<html>
<head>
    <title>Novedades PDF</title>
    <!-- PDF CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row bordecompleto">
            <div class="col-md-4">
                <img src="{{ asset('img/logo.png') }}">
            </div>
            <div class="col-md-8 text-center">
                <div class="row">
                    <div class="col-md-12 bordeizquierdo">
                        NOVEDADES DE NOMINA
                    </div>                    
                </div>
                <div class="row bordecompleto">
                    <div class="col-md-4">Código</div>
                    <div class="col-md-4 bordeizquierdo">Versión</div>
                    <div class="col-md-4 bordeizquierdo">Fecha de Emisión</div>
                </div>
                <div class="row">
                    <div class="col-md-4 bordeizquierdo">FO-400-59</div>
                    <div class="col-md-4 bordeizquierdo">2</div>
                    <div class="col-md-4 bordeizquierdo">16/11/2017</div>
                </div>
            </div>
        </div>
        <br>
        <div class="row bordecompleto">
            <div class="col-md-4">Periodo Liquidado en la Nomina</div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 bordeizquierdo">Desde:   1/01/2018</div>
                    <div class="col-md-6">Hasta:  15/01/2018</div>
                </div>
            </div>
        </div>
        <br>
        <!-- Tablde Ingresos Y Rteiros -->
        <div class="row ">
            <div class="col-md-12 text-center bordeizquierdo bordederecho bordesuperior">
                INGRESOS Y RETIROS
            </div>
            <table class="text-center" >
                <tr>
                    <th>Centro de Operación</th>
                    <th class="col-md-2">Nombre del Funcionario</th>
                    <th class="col-md-3">Fecha Ingreso</th>
                    <th class="col-md-1">Fecha Retiro</th>
                    
                    <th class="col-md-1">Tipo de Contrato</th>
                    <th class="col-md-1">Salario (SMMLV)</th>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td></td>
                    <td>13/01/2018</td>
                    
                    <td>INDEFINIDO</td>
                    <td>1.2</td>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>4/01/2018</td>
                    <td></td>
                    
                    <td>INDEFINIDO</td>
                    <td>1.17</td>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>13/01/2018</td>
                    <td></td>
                    
                    <td>INDEFINIDO</td>
                    <td>1.08</td>
                </tr>
            </table>
        </div>        
        <br>
        <!-- Tablde Libranzas -->
        <div class="row">
            <div class="col-md-12 text-center bordeizquierdo bordederecho bordesuperior">
                CREDITOS POR LIBRANZA
            </div>
            <table class="text-center" style="border: 1px solid black;">
                <tr>
                    <th style="width: 10px;">Centro de Operación</th>
                    <th class="col-md-2">Nombre del Funcionario</th>
                    <th class="col-md-1">Cuota Mensual</th>
                    <th class="col-md-1">Cuota Quincenal</th>
                    <th class="col-md-1">Cuota de</th>
                    <th class="col-md-1">Cuota Hasta</th>
                    <th class="col-md-2">Entidad Financiera</th>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>170.762</td>
                    <td>85.381</td>
                    <td>51</td>
                    <td>96</td>
                    <td>CFA</td>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>170.762</td>
                    <td>85.381</td>
                    <td>51</td>
                    <td>96</td>
                    <td>CFA</td>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>170.762</td>
                    <td>85.381</td>
                    <td>51</td>
                    <td>96</td>
                    <td>BANCO DE BOGOTA</td>
                </tr>
            </table>
        </div>
        <br>
        <!-- Tablde Descuentos Voluntarios -->
        <div class="row bordeizquierdo bordesuperior">
            <div class="col-md-12 text-center bordeizquierdo bordederecho bordesuperior">
                DESCUENTOS VOLUNTARIOS
            </div>
            <table class="text-center" style="border: 1px solid black;">
                <tr>
                    <th style="width: 10px;">Centro de Operación</th>
                    <th class="col-md-2">Nombre del Funcionario</th>
                    <th class="col-md-1">Cuota Mensual</th>
                    <th class="col-md-1">Cuota Quincenal</th>
                    <th class="col-md-1">Cuota de</th>
                    <th class="col-md-1">Cuota Hasta</th>
                    <th class="col-md-2">Entidad Financiera</th>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>170.762</td>
                    <td>85.381</td>
                    <td>51</td>
                    <td>96</td>
                    <td>LOS OLIVOS</td>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>170.762</td>
                    <td>85.381</td>
                    <td>51</td>
                    <td>96</td>
                    <td>LOS OLIVOS</td>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>170.762</td>
                    <td>85.381</td>
                    <td>51</td>
                    <td>96</td>
                    <td>PAPELERIA TAURO</td>
                </tr>
            </table>
        </div>
        <br>
        <!-- Tablde vACACIONES -->
        <div class="row">
            <div class="col-md-12 text-center bordeizquierdo bordederecho bordesuperior">
                VACACIONES
            </div>
            <table class="text-center col-md-12" >
                <tr>
                    <th>Centro de Operación</th>
                    <th class="col-md-2">Nombre del Funcionario</th>
                    <th class="col-md-2">Desde</th>
                    <th class="col-md-2">Hasta</th>
                    <th class="col-md-1">Días Disfrutados</th>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>  
                    <td>13/01/2018</td>
                    <td>13/01/2018</td> 
                    <td>18</td>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>4/01/2018</td>
                    <td>4/01/2018</td>
                    <td>17</td>
                </tr>
                <tr>
                    <td>001</td>
                    <td class="text-left">CARLOS SIBAJA</td>
                    <td>13/01/2018</td>
                    <td>13/01/2018</td>
                    <td>10</td>
                </tr>
            </table>
        </div>        
    </div>
</body>
</html>