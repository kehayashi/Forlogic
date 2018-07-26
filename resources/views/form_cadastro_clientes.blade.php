@extends('template_main')

@section('conteudo')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 243px; background-color: white;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit"></i> Cadastrar
      <small>Clientes</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        @if(isset($ok))
          @if($ok == true)
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Cadastro realizado com sucesso!</h4>
                  </div>
                  <!-- end alert -->
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
         @endif
        @endif

        @if(isset($ok))
          @if($ok == false)
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-close"></i> Erro ao cadastrar cliente!</h4>
                  </div>
                  <!-- end alert -->
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
         @endif
        @endif

        @if(isset($cliente))
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-close"></i><b>{{ strtoupper($cliente->nome_cliente) }}</b> já consta no cadastro! categoria: <small class="label bg-red">{{ $cliente->categoria }}</small></h4>
                  </div>
                  <!-- end alert -->
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
         @endif

        @if(count($errors) > 0)
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                  </div>
                  <!-- end alert -->
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        @endif

        <form action="/cadastrar_cliente" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box box-primary" style="background-color: #f2f2f2;">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                  <b>Nome / Razão Social</b><br>
                  <input type="text" class="form-control" name="nome_cliente" placeholder="Nome/Razão Social" value="{{ old('nome_cliente') }}">
                  <br />
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
              <div class="row">
                <div class="col-lg-12">
                  <b>Nome do contato</b><br>
                  <input type="text" class="form-control" name="nome_contato" placeholder="Nome do contato" value="{{ old('nome_contato') }}">
                  <br />
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
              <div class="row">
                <div class="col-lg-12">
                  <b>Data</b><br>
                  <input type="text" class="form-control" id="campoData" name="data_cliente" placeholder="dd/mm/aaaa" value="{{ old('data_cliente') }}">
                  <br />
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
              <div class="row">
                <div class="col-lg-12">
                  <br />
                  <button type="submit" class="form-control btn btn-success">Cadastrar cliente  <i class="fa fa-check"></i></button>
                  <span
              </div>
              <!-- end col -->
              </div>
              <!-- end row -->
            </div>
            <!-- end box-body -->
          </div>
          <!-- end box-primary -->
        </form>
        <!-- end form -->
       </div>
       <!-- end col -->
     </div>
     <!-- end row -->
   </section>
   <!-- end section -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
  
    <script type="text/javascript"> 
        jQuery.noConflict();
        jQuery(function($){
            $("#campoData").mask("99/99/9999");
        });
    </script> 

@stop

<!-- /.content-wrapper -->
