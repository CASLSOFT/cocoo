<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pdf.css') }}">
</head>
<body>
    <header>
        <table>
          <tr>
            <td rowspan="3" style="padding: 0;">
                <img src="{{ asset('img/logo.png') }}">
            </td>
            <td colspan="3" class="negrita">NOVEDADES DE NOMINA</td>
          </tr>
          <tr>
            <td>Código</td>
            <td>Versión</td>
            <td style="width: 180px">Fecha de Emisión</td>
          </tr>
          <tr>
            <td>FO-400-59</td>
            <td>2</td>
            <td>16/11/2017</td>
          </tr>
        </table>
        <br>
        <table>
            <tr>
                <td style="width: 30%;" class="negritagris">Período liquidado en la nómina:</td>
                <td>
                    <div style="width: 25%; float:left;">Desde:</div>
                    <div style="width: 25%; float:left;">1/01/2018</div>
                    <div style="width: 25%; float:left;">Hasta:</div>
                    <div style="width: 25%; float:left;">15/01/2018</div>
                </td>                
            </tr>
        </table>
    </header>

    <br>    
    <!-- Tablde Ingresos Y Retiros -->
    <div class="titulotabla">
        INGRESOS Y RETIROS
    </div>
    <table>
        <tr>
            <th style="width: 70px">Centro de Operación</th>
            <th style="width: 180px">Nombre del Funcionario</th>
            <th style="width: 90px">Fecha Ingreso</th>
            <th style="width: 90px">Fecha Retiro</th>                    
            <th style="width: 120px">Cargo</th>                    
            <th >Tipo de Contrato</th>
            <th >Salario</th>
        </tr>
        @foreach ($ingresos as $item)
            <tr>
                <td>{{ $item->CO }}</td>
                <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td>{{ $item->admissiondate }}</td>
                <td></td>
                <td>{{ $item->position }}</td>
                <td>{{ $item->contract }}</td>
                <td>{{ number_format($item->salary, 0, ".", ",") }}</td>
            </tr>
        @endforeach
        @forelse ($retiros as $item)
            <tr>
                <td>{{ $item->CO }}</td>
                <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td></td>
                <td>{{ $item->admissiondate }}</td>
                <td>{{ $item->position }}</td>
                <td>{{ $item->contract }}</td>
                <td>{{ number_format($item->salary, 0, ".", ",") }}</td>
            </tr>
        @empty
            <tr>
                <td>&nbsp;</td>
                <td class="textleft textmayusc"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforelse
    </table>
    <br>
    <!-- Tablde Libranzas -->
    <div class="titulotabla">
        CREDITOS POR LIBRANZA
    </div>
    <table>
        <tr>
            <th style="width: 70px">Centro de Operación</th>
            <th style="width: 180px">Nombre del Funcionario</th>
            <th style="width: 90px">Cuota Mensual</th>
            <th style="width: 90px">Cuota Quincenal</th>
            <th style="width: 60px">Cuota de</th>
            <th style="width: 60px">Cuota Hasta</th>
            <th >Entidad Financiera</th>
        </tr>        
        @forelse ($amortizacion as $item)
            @if ($item->category == 'LIBRANZA')
                <tr>
                    <td>{{ $item->CO }}</td>
                    <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td>{{ number_format($item->cuota_mensual, 0, ".", ",") }}</td>
                    <td>{{ number_format($item->cuota_quincenal, 0, ".", ",") }}</td>
                    <td>{{ $item->cuota_de }}</td>
                    <td>{{ $item->cuota_hasta }}</td>
                    <td>{{ $item->entidad }}</td>
                </tr>   
            @endif
        @empty
            <tr>
                <td>&nbsp;</td>
                <td class="textleft"></td>  
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforelse 
            <tr>
                <td>&nbsp;</td>
                <td class="textleft"></td>  
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
                <td></td>
            </tr>       
    </table>
    <br>
    <!-- Tablde Descuentos Voluntarios -->
        <div class="titulotabla">
            DESCUENTOS VOLUNTARIOS
        </div>
        <table>
            <tr>
                <th style="width: 70px">Centro de Operación</th>
                <th style="width: 180px">Nombre del Funcionario</th>
                <th style="width: 90px">Cuota Mensual</th>
                <th style="width: 90px">Cuota Quincenal</th>
                <th style="width: 60px">Cuota de</th>
                <th style="width: 60px">Cuota Hasta</th>
                <th >Entidad Financiera</th>
            </tr>
            
        @forelse ($amortizacion as $item)
            @if ($item->category == 'DESCUENTO')
                <tr>
                    <td>{{ $item->CO }}</td>
                    <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td>{{ number_format($item->cuota_mensual, 0, ".", ",") }}</td>
                    <td>{{ number_format($item->cuota_quincenal, 0, ".", ",") }}</td>
                    <td>{{ $item->cuota_de }}</td>
                    <td>{{ $item->cuota_hasta }}</td>
                    <td>{{ $item->entidad }}</td>
                </tr>               
            @endif
        @empty
            <tr>
                <td>&nbsp;</td>
                <td class="textleft"></td>  
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforelse 
            <tr>
                <td>&nbsp;</td>
                <td class="textleft"></td>  
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        
        
        <br>
        <!-- Tablde vACACIONES -->
        <div class="titulotabla">
            VACACIONES
        </div>
        <table >
            <tr>
                <th style="width: 70px">Centro de Operación</th>
                <th style="width: 270px">Nombre del Funcionario</th>
                <th style="width: 90px">Desde</th>
                <th style="width: 90px">Hasta</th>
                <th >Días Disfrutados</th>
                <th >Fecha de Reintegro</th>
            </tr>
            @forelse ($vacaciones as $item)
                <tr>
                    <td>{{ $item->CO }}</td>
                    <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td>{{ $item->since }}</td>
                    <td>{{ $item->until }}</td>
                    <td>{{ $item->days }}</td>
                    <td>{{ $item->until }}</td>
                </tr>                
            @empty
                <tr>
                <td>&nbsp;</td>
                <td class="textleft"></td>  
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
            </tr>
            @endforelse
            
        </table>
    <br>
    <!-- Tablde Tiempos no Laborados -->
    <div class="titulotabla">
        TIEMPOS NO LABORADOS
    </div>
    <table>
        <tr>
            <th style="width: 70px">Centro de Operación</th>
            <th style="width: 180px">Nombre del Funcionario</th>
            <th style="width: 90px">Desde</th>
            <th style="width: 90px">Hasta</th>                    
            <th style="width: 230px">Tipo: EG: Enfermedad General LM: Licencia de Maternidad LP: Licencia de Paternidad LL: Ley de Luto S:Suspensión PNR: Permiso No Remunerado</th>
            <th >Número de días</th>
        </tr>
        @forelse ($tnls as $item)
            <tr>
                <td>{{ $item->CO }}</td>
                <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td>{{ $item->since }}</td>
                <td>{{ $item->until }}</td>
                <td>{{ $item->typeTNL }}</td>
                <td>{{ $item->days }}</td>
            </tr>                
        @empty
            <tr>
            <td>&nbsp;</td>
            <td class="textleft"></td>  
            <td></td>
            <td></td> 
            <td></td>
            <td></td>
        </tr>
        @endforelse
    </table>
    <br>
    <!-- Tabla HE y Comisiones -->
    <div class="titulotabla">
        HORAS EXTRAS Y COMISIONES
    </div>
    <table>
        <tr>
            <th style="width: 70px">Centro de Operación</th>
            <th style="width: 270px">Nombre del Funcionario</th>
            <th >Fecha o Mes</th>
            <th >Valor Comisión ó # HE</th>
            <th >Tipo</th>
        </tr>        
        @forelse ($hec as $item)
            <tr>
                <td>{{ $item->CO }}</td>
                <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td>{{ $item->lapso }}</td>
                <td>{{ number_format($item->value, 0, ".", ",") }}</td>
                <td>{{ $item->typeHE }}</td>
            </tr>                
        @empty
            <tr>
            <td>&nbsp;</td>
            <td class="textleft"></td>  
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforelse
    </table>
    <br>
    <!-- Tabla Retención en la Fuente -->
    <div class="titulotabla">
        RETENCION EN LA FUENTE
    </div>
    <table>
        <tr>
            <th style="width: 70px">Centro de Operación</th>
            <th style="width: 270px">Nombre del Funcionario</th>
            <th >Ingresos (en pesos)</th>
            <th >Valor (en pesos)</th>
            <th >Procedimiento</th>
        </tr>
        @forelse ($retencion as $item)
            <tr>
                <td>{{ $item->CO }}</td>
                <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td>{{ number_format($item->income, 0, ".", ",") }}</td>
                <td>{{ number_format($item->value, 0, ".", ",") }}</td>
                <td>{{ $item->process }}</td>
            </tr>                
        @empty
            <tr>
            <td>&nbsp;</td>
            <td class="textleft"></td>  
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforelse
    </table>
    <br>
    <!-- Embargos -->
    <div class="titulotabla">
        EMBARGOS
    </div>
    <table>
        <tr>
            <th style="width: 70px">Centro de Operación</th>
            <th style="width: 180px">Nombre del Funcionario</th>
            <th style="width: 90px">Primera Quincena</th>
            <th style="width: 90px">Segunda Quincena</th>                    
            <th style="width: 90px">Total</th>
            <th >Entidad</th>
        </tr> 
        @forelse ($amortizacion as $item)
            @if ($item->category == 'EMBARGO')
                <tr>
                    <td>{{ $item->CO }}</td>
                    <td class="textleft textmayusc">{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td>{{ number_format($item->cuota_mensual, 0, ".", ",") }}</td>
                    <td>{{ number_format($item->cuota_quincenal, 0, ".", ",") }}</td>
                    <td>{{ number_format($item->cuota_mensual + $item->cuota_quincenal, 0, ".", ",") }}</td>
                    <td>{{ $item->entidad }}</td>
                </tr>
            @endif
        @empty
            <tr>
                <td>&nbsp;</td>
                <td class="textleft"></td>  
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
            </tr>
        @endforelse
            <tr>
                <td>&nbsp;</td>
                <td class="textleft"></td>  
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
            </tr>
    </table>
    <br>
    <!-- Observaciones -->
    <div class="titulotabla" style="text-align:left;">
        Observaciones
    </div>
    <div style="border: 1px solid black; padding: 1em;">
        <p>
            {!! $novelty->observation !!}
        </p>
    </div>
</body>
</html>