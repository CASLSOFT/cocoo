@extends('layouts.requisiciones')

@section('title')
    Realizar Pedido
@endsection

@section('page-header')

@endsection
@section('page-content')
	@can('order.create')
    <vue-addarticleorder category="cafeteria"></vue-addarticleorder>
	@endcan
@endsection

@section('footer-scripts')


<script type="text/javascript">

    var vm = new Vue({
        el: '#main',
    });

</script>
@endsection