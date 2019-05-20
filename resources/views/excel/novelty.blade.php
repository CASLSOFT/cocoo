<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <table >
      <tr>
        <td colspan="2" width="10" >
            <img width="10"  height="30" src="logo.png">
        </td>
        <td colspan="6"  align="center" style="border: 1em medium #5B5A5A">NOVEDADES DE NOMINA</td>
      </tr>
      <tr>
        <td colspan="2" ></td>
        <td colspan="2" width="28" align="center"  style="border: 1px medium #5B5A5A">Código</td>
        <td colspan="2" width="28" align="center" style="border: 1px medium #5B5A5A">Versión</td>
        <td colspan="2" width="28" align="center" style="border: 1px medium #5B5A5A">Fecha de Emisión</td>
      </tr>
      <tr width="81">
        <td colspan="2" ></td>
        <td colspan="2" width="28" align="center" style="border: 1px medium #5B5A5A">FO-400-59</td>
        <td colspan="2" width="28" align="center" style="border: 1px medium #5B5A5A">2</td>
        <td colspan="2" width="28" align="center" style="border: 1px medium #5B5A5A">16/11/2017</td>
      </tr>
    </table>
    <table>
        <tr width="120" style="border: 0.1px medium #5B5A5A;">
            <td colspan="2" width="40" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Período liquidado en la nómina:</td>
            <td width="14" align="center" >Desde:</td>
            <td colspan="2" width="28" align="center" >{{ $novelty->f_initial }}</td>
            <td width="14" align="center" > hasta:</td>
            <td colspan="2" width="28" align="center" >{{ $novelty->f_final }}</td>
        </tr>
    </table>
    <!-- Tablde Ingresos Y Retiros  align="center"-->
    <table>
        <tr>
            <td colspan="8" width="40" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">INGRESOS Y RETIROS</td>
        </tr>
        <tr>
            <td width="10" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Centro de Operación</td>
            <td width="30" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Nombre del Funcionario</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Fecha Ingreso</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Fecha Retiro</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;" >Cargo</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Tipo de Contrato</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Salario</td>
        </tr>
        @foreach ($ingresos as $item)
            <tr>
                <td width="10" align="center" style="border: 1px medium #5B5A5A;">{{ $item->CO }}</td>
                <td width="30" style="border: 1px medium #5B5A5A;">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;">{{ $item->admissiondate }}</td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td colspan="2" width="14" align="center"  style="border: 1px medium #5B5A5A;">{{ $item->position }}</td>
                <td width="14" align="center"  style="border: 1px medium #5B5A5A;">{{ $item->contract }}</td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;">{{ $item->salary }}</td>
            </tr>
        @endforeach
        @foreach ($retiros as $item)
            <tr>
                <td width="10"  align="center"style="border: 1px medium #5B5A5A;">{{ $item->CO }}</td>
                <td width="30"  style="border: 1px medium #5B5A5A;">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td width="14"  style="border: 1px medium #5B5A5A;">{{ $item->admissiondate }}</td>
                <td width="14"  style="border: 1px medium #5B5A5A;"></td>
                <td colspan="2" width="14" style="border: 1px medium #5B5A5A;">{{ $item->position }}</td>
                <td width="14"   style="border: 1px medium #5B5A5A;">{{ $item->contract }}</td>
                <td width="14"  style="border: 1px medium #5B5A5A;">{{ $item->salary }}</td>
            </tr>
        @endforeach
    </table>
    <br>
    <!-- Tablde Libranzas -->
    <table>
        <tr>
            <td colspan="8" width="40" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">CREDITOS POR LIBRANZA</td>
        </tr>
        <tr>
            <td width="10" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Centro de Operación</td>
            <td width="30" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Nombre del Funcionario</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Cuota Mensual</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Cuota Quincenal</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Cuota de</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Cuota Hasta</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Entidad Financiera</td>
        </tr>
        @forelse ($amortizacion as $item)
            @if ($item->category == 'LIBRANZA')
                <tr>
                    <td width="10" align="center" style="border: 1px medium #5B5A5A;">{{ $item->CO }}</td>
                    <td width="30" style="border: 1px medium #5B5A5A;">{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A;">{{ $item->cuota_mensual }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A;">{{ $item->cuota_quincenal }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A;">{{ $item->cuota_de }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A;">{{ $item->cuota_hasta }}</td>
                    <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A;">{{ $item->entidad }}</td>
                </tr>
            @endif
        @empty
            <tr>
                <td width="10" align="center" style="border: 1px medium #5B5A5A;">&nbsp;</td>
                <td width="30" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
            </tr>
        @endforelse
    </table>
    <br>
    <!-- Tablde Descuentos Voluntarios -->
    <table>
        <tr>
            <td colspan="8" width="40" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">DESCUENTOS VOLUNTARIOS</td>
        </tr>
        <tr>
            <td width="10" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Centro de Operación</td>
            <td width="30" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Nombre del Funcionario</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Cuota Mensual</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Cuota Quincenal</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Cuota de</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Cuota Hasta</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Entidad Financiera</td>
        </tr>

        @forelse ($amortizacion as $item)
            @if ($item->category == 'DESCUENTO')
                <tr>
                    <td width="10" align="center"  style="border: 1px medium #5B5A5A;">{{ $item->CO }}</td>
                    <td width="30"  style="border: 1px medium #5B5A5A;">{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td width="14"  style="border: 1px medium #5B5A5A;">{{ $item->cuota_mensual }}</td>
                    <td width="14"  style="border: 1px medium #5B5A5A;">{{ $item->cuota_quincenal }}</td>
                    <td width="14"  style="border: 1px medium #5B5A5A;">{{ $item->cuota_de }}</td>
                    <td width="14"  style="border: 1px medium #5B5A5A;">{{ $item->cuota_hasta }}</td>
                    <td colspan="2" width="14"  style="border: 1px medium #5B5A5A;">{{ $item->entidad }}</td>
                </tr>
            @endif
        @empty
            <tr>
                <td width="10" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="30" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
                <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
            </tr>
        @endforelse
        <tr>
            <td width="10" align="center" style="border: 1px medium #5B5A5A;"></td>
            <td width="30" align="center" style="border: 1px medium #5B5A5A;"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
            <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A;"></td>
        </tr>
    </table>
    <br>
    <!-- Tablde vACACIONES -->
    <table >
        <tr>
            <td colspan="8" width="40" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">VACACIONES</td>
        </tr>
        <tr>
            <td width="10" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Centro de Operación</td>
            <td colspan="2" width="30" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Nombre del Funcionario</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Desde</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Hasta</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Días Disfrutados</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Fecha de Reintegro</td>
        </tr>
        @forelse ($vacaciones as $item)
            <tr>
                <td width="10" align="center" style="border: 1px medium #5B5A5A">{{ $item->CO }}</td>
                <td colspan="2" width="30" style="border: 1px medium #5B5A5A">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td width="14" style="border: 1px medium #5B5A5A">{!! \Carbon\Carbon::parse($item->since)->format('d-m-Y') !!}</td>
                <td width="14" style="border: 1px medium #5B5A5A">{!! \Carbon\Carbon::parse($item->until)->format('d-m-Y') !!}</td>
                <td width="14" style="border: 1px medium #5B5A5A">{{ $item->days }}</td>
                <td colspan="2" width="14" style="border: 1px medium #5B5A5A">{!! \Carbon\Carbon::parse($item->until)->addDay()->format('d-m-Y') !!}</td>
            </tr>
        @empty
            <tr>
                <td width="10" align="center" style="border: 1px medium #5B5A5A"></td>
                <td colspan="2" width="30" align="center" style="border: 1px medium #5B5A5A"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
                <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            </tr>
        @endforelse
    </table>
    <br>
    <!-- Tablde Tiempos no Laborados -->
    <table>
        <tr>
            <td colspan="8" width="40" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">TIEMPOS NO LABORADOS</td>
        </tr>
        <tr>
            <td width="10" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Centro de Operación</td>
            <td width="30" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Nombre del Funcionario</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Desde</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Hasta</td>
            <td colspan="3" width="28" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Tipo: EG: Enfermedad General LM: Licencia de Maternidad LP: Licencia de Paternidad LL: Ley de Luto S:Suspensión PNR: Permiso No Remunerado</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Número de días</td>
        </tr>
        @if (count($lms) > 0)
            @foreach ($lms as $item)
                <tr>
                    <td width="10" align="center" style="border: 1px medium #5B5A5A">{{ $item->CO }}</td>
                    <td width="30" style="border: 1px medium #5B5A5A">{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->since }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->until }}</td>
                    <td colspan="3" align="center" width="14" style="border: 1px medium #5B5A5A">{{ $item->typeTNL }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->days }}</td>
                </tr>
            @endforeach
        @endif
        @forelse ($tnls as $item)
            <tr>
                <td width="10" align="center" style="border: 1px medium #5B5A5A">{{ $item->CO }}</td>
                <td width="30" style="border: 1px medium #5B5A5A">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->since }}</td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->until }}</td>
                <td colspan="3" width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->typeTNL }}</td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->days }}</td>
            </tr>
        @empty
            <tr>
            <td width="10" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="30" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="3" width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
        </tr>
        @endforelse
    </table>
    <br>
    <!-- Tabla HE y Comisiones -->
    <table>
        <tr>
            <td colspan="8" width="40" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">HORAS EXTRAS Y COMISIONES</td>
        </tr>
        <tr>
            <td width="10" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Centro de Operación</td>
            <td colspan="2" width="30" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Nombre del Funcionario</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Fecha o Mes</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Valor Comisión ó # HE</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Tipo</td>
        </tr>
        @forelse ($hec as $item)
            <tr>
                <td width="10" style="border: 1px medium #5B5A5A">{{ $item->CO }}</td>
                <td colspan="2" width="30" style="border: 1px medium #5B5A5A">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td colspan="2" align="center" width="14" style="border: 1px medium #5B5A5A">{{ $item->lapso }}</td>
                <td colspan="2" align="center" width="14" style="border: 1px medium #5B5A5A">{{ $item->value }}</td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->typeHE }}</td>
            </tr>
        @empty
            <tr>
            <td width="10" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="2" width="30" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
        </tr>
        @endforelse
    </table>
    <br>
    <!-- Tabla Retención en la Fuente -->
    <table>
        <tr>
            <td colspan="8" width="40" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">RETENCION EN LA FUENTE</td>
        </tr>
        <tr>
            <td width="10" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Centro de Operación</td>
            <td colspan="2" width="30" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Nombre del Funcionario</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Ingresos (en pesos)</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Valor (en pesos)</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Procedimiento</td>
        </tr>
        @forelse ($retencion as $item)
            <tr>
                <td width="10" align="center" style="border: 1px medium #5B5A5A">{{ $item->CO }}</td>
                <td colspan="2" width="30" style="border: 1px medium #5B5A5A">{{ $item->firstname }} {{ $item->lastname }}</td>
                <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->income }}</td>
                <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->value}}</td>
                <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->process }}</td>
            </tr>
        @empty
            <tr>
            <td width="10" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="2" width="30" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
        </tr>
        @endforelse
    </table>
    <br>
    <!-- Embargos -->
    <table>
        <tr>
            <td colspan="8" width="40" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">EMBARGOS</td>
        </tr>
        <tr>
            <td width="10" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Centro de Operación</td>
            <td colspan="2" width="30" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Nombre del Funcionario</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Primera Quincena</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Segunda Quincena</td>
            <td width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Total</td>
            <td colspan="2" width="14" align="center" style="background-color: #D3D3D3; border: 1px medium #5B5A5A">Entidad</td>
        </tr>
        @forelse ($amortizacion as $item)
            @if ($item->category == 'EMBARGO')
                <tr>
                    <td width="10" align="center" style="border: 1px medium #5B5A5A">{{ $item->CO }}</td>
                    <td colspan="2" width="30" style="border: 1px medium #5B5A5A">{{ $item->firstname }} {{ $item->lastname }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->cuota_mensual }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->cuota_quincenal }}</td>
                    <td width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->cuota_mensual + $item->cuota_quincenal }}</td>
                    <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A">{{ $item->entidad }}</td>
                </tr>
            @endif
        @empty
        @endforelse
        <tr>
            <td width="10" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="2" width="30" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td width="14" align="center" style="border: 1px medium #5B5A5A"></td>
            <td colspan="2" width="14" align="center" style="border: 1px medium #5B5A5A"></td>
        </tr>
    </table>
    <br>
    <!-- Observaciones -->
    <table>
        <tr>
            <td colspan="8" style="background-color: #D3D3D3; border: 1px medium #5B5A5A;">Observaciones</td>
        </tr>
        <tr>
            <td colspan="8" style="border: 1px medium #5B5A5A;">{{ $novelty->observation }}</td>
        </tr>
    </table>
</body>
</html>