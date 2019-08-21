@extends('layouts.requisiciones')

@section('title')
    Pedido en Borrador
@endsection

@section('page-header')

@endsection
@section('page-content')

<div class="row clearfix">
    <!-- Visitors -->
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
        <div class="card">
            <div class="body bg-pink">
                <div class="m-b--35 font-bold">PEDIDOS EN BORRADOR DE PAPALERIA</div>
                <vue-ordersdraft category="papeleria" ></vue-ordersdraft>
            </div>
        </div>
    </div>
    <!-- #END# Visitors -->
    <!-- Latest Social Trends -->
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
        <div class="card">
            <div class="body bg-cyan">
                <div class="m-b--35 font-bold">PEDIDOS EN BORRADOR DE ASEO</div>
                <vue-ordersdraft category="aseo"></vue-ordersdraft>
            </div>
        </div>
    </div>
    <!-- #END# Latest Social Trends -->
    <!-- Answered Tickets -->
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
        <div class="card">
            <div class="body bg-teal">
                <div class="font-bold m-b--35">PEDIDOS EN BORRADOR DE CAFETERIA</div>
                <vue-ordersdraft category="cafeteria"></vue-ordersdraft>
            </div>
        </div>
    </div>
    <!-- #END# Answered Tickets -->
</div>

@endsection

@section('footer-scripts')

<script type="text/javascript">

    var vm = new Vue({
        el: '#main',
    });

</script>
@endsection