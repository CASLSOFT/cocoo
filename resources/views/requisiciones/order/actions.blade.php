@if ($status == 'BORRADOR')
@can('order.edit')
    <a href="{{ route('order.edit', $id) }}" class="col-md-5" style="margin: 0px; padding: 0px;">
        <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
            <i class="material-icons" alter="Adiciona comentario">chat</i>
        </button>
    </a>
@endcan
@can('order.sendorder')
    <a href="#" class="col-md-4" style="margin: 0px; padding: 0px;">
    	<form method="post" action="{{ route('order.send', $id) }}" >
        @csrf()
        @method('PUT')
            <input type="hidden" name="draft" value="0">
            <input type="hidden" name="status" value="APROBACION">
            <input type="hidden" name="puntuacion" value="2">
            <input type="hidden" name="responsable" value="DIRECTOR DE AREA">
            <button type="submit" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
            	<i class="material-icons">send</i>
            </button>
    	</form>
    </a>
@endcan
@endif
@if ($status != 'BORRADOR')
    <a href="{{ route('order.show', $id) }}" class="col-md-5" style="margin: 0px; padding: 0px;">
    	<button type="button" class="btn bg-purple btn-circle waves-effect waves-circle waves-float">
            <i class="material-icons">search</i>
        </button>
    </a>
@endif
@if ($status == 'COMPRANDO')
@can('order.despachoorder')
    <a href="#"  class="col-md-4" style="margin: 0px; padding: 0px;">
        <form method="post" action="{{ route('order.despacho', $id) }}" >
        @csrf()
        @method('PUT')
            <input type="hidden" name="status" value="DESPACHO">
            <input type="hidden" name="puntuacion" value="4">
            <input type="hidden" name="responsable" value="AUX. ADMINISTRATIVO">
            <button type="submit" class="btn bg-pink btn-circle waves-effect waves-circle waves-float">
                <i class="material-icons">local_shipping</i>
            </button>
        </form>
    </a>
@endcan
@endif
@if ($status == 'DESPACHO')
@can('order.receivedorder')
    <a href="#" class="col-md-4" style="margin: 0px; padding: 0px;">
        <form method="post" action="{{ route('order.recived', $id) }}" >
        @csrf()
        @method('PUT')
            <input type="hidden" name="status" value="DESPACHO">
            <input type="hidden" name="puntuacion" value="4">
            <input type="hidden" name="responsable" value="AUX. ADMINISTRATIVO">
            <button type="submit" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                <i class="material-icons">home</i>
            </button>
        </form>
    </a>
@endcan
@endif