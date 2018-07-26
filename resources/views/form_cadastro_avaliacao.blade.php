@extends('template_main')

@section('conteudo')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 243px; background-color: white;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit"></i> Dados
      <small>Avaliação</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

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

        <form action="gerar_formulario" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box box-primary" style="background-color: #f2f2f2;">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <b>Mês</b><br>
                    <select class="form-control select2 select2-hidden-accessible" name="mes" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="null">- - - </option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                  </div>
                </div>
              <!-- end col -->
              </div>
              <!-- end row -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                      <b>Ano</b><br>
                      <select class="form-control select2 select2-hidden-accessible" name="ano" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="null" selected>- - - </option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                      </select>
                  </div>
                </div>
              <!-- end col -->
              </div>
              <!-- end row -->
              <div class="row">
                <div class="col-lg-12">
                    <b>Clientes</b><br>
                      <select class="form-control select2 select2-hidden-accessible" id="tags" name="clientes[]" multiple="" data-placeholder="Selecione participantes" style="width: 100%;" tabindex="-1" aria-hidden="true" >
                        @foreach($clientes as $c)
                          <option value="{{ $c->id_cliente }}">{{ $c->nome_cliente }}</option>
                        @endforeach
                      </select>
                  <br />
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
              <br>
              <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="form-control btn btn-success">Gerar formulário com clientes  <i class="fa fa-refresh"></i></button>
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

  <script src="{{ asset("/bower_components/adminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>

  <!-- SELECT MULTI, LIMITA A 20% -->
  <script>
    $(document).ready(function() {
        $(".select2").select2();
        $("#tags").select2({
            maximumSelectionLength: {{ $limite }}
        });
    });
  </script>
  <!-- END SELECT MULTI, LIMITA A 20% -->

@stop

<!-- /.content-wrapper -->
