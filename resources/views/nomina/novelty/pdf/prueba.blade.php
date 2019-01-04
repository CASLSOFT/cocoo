<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>
		prueba
	</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="http://localhost:8000/css/pdf.css" rel="stylesheet">
{{-- <style>
	body {
		margin: 0px;
		padding: 0px;
	}
	
	div {
		padding: 0px;
		font-size: small;
	}

	table {
	    border-collapse: collapse;
		font-size: small;
	}

	table, td, th {
	    border: 1px solid black;
	}

	th {
	    background-color: #D3D3D3;    
	}

	.container {	    
	    padding-right: 15px;
	    padding-left: 15px;
	    margin-right: 5%;
	    margin-left: 5%;
	}
	
	.bordecompleto {
		border: 0.1px solid black;
	}

	.bordeizquierdo {
		border-left: 0.1px solid black;
	}

	.bordesuperior {
		border-top: 0.1px solid black;
	}

	.bordederecho {
		border-right: 0.1px solid black;
	}

	.bordeinferior {
		border-bottom: 0.1px solid black;
	}

	.bordelaterales {
		border-left: 0.1px solid black;
		border-right: : 0.1px solid black;
	}

	img {
		padding-top: 2px;
		width: 50%;
		height: 49%;
	}

	.container {
		border: 0px;
	}

	.row {
	 /*   display: -webkit-box;
	    display: -ms-flexbox;*/
	    display: flex;
	    /*-ms-flex-wrap: wrap;*/
	    flex-wrap: wrap;
	    margin-right: -15px;
	    margin-left: -15px;
	}

	.col-md-1 {
	    -webkit-box-flex: 0;
	    /*-ms-flex: 0 0 8.333333%;*/
	    flex: 0 0 8.333333%;
	    max-width: 8.333333%;
	}

	.col-md-2 {
	    -webkit-box-flex: 0;
	    /*-ms-flex: 0 0 16.666667%;*/
	    flex: 0 0 16.666667%;
	    max-width: 16.666667%;
	}

	.col-md-3 {
	    -webkit-box-flex: 0;
	    /*-ms-flex: 0 0 25%;*/
	    flex: 0 0 25%;
	    max-width: 25%;
	}

	.col-md-4 {
		webkit-box-flex: 0;
	/*    -ms-flex: 0 0 33.333333%;*/
	    flex: 0 0 33.333333%;
	    max-width: 33.333333%;
	    
	}

	.col-md-6 {
	    -webkit-box-flex: 0;
	 /*   -ms-flex: 0 0 50%;*/
	    flex: 0 0 50%;
	    max-width: 50%;
	}

	.col-md-8 {
	    -webkit-box-flex: 0;
	    /*-ms-flex: 0 0 66.666667%;*/
	    flex: 0 0 66.666667%;
	    max-width: 66.666667%;
	}

	.col-md-12 {
	    -webkit-box-flex: 0;
	    /*-ms-flex: 0 0 100%;*/
	    flex: 0 0 100%;
	    max-width: 100%;
	}

	.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
		position: relative;
	    width: 100%;
	    min-height: 1px;
	    /*padding-right: 15px;
	    padding-left: 15px;*/
	} 

	.text-center {
	    text-align: center;
	}
</style> --}}
</head>
<body>
	<div class="container">
        <div class="row bordecompleto">
            <div class="col-md-4">
                {{-- <img src="http://localhost:8000/img/logo.png"> --}}
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
    </div>
</body>
</html>