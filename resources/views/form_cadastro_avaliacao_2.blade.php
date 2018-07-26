@extends('template_main')

@section('conteudo')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 243px; background-color: white;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit"></i> Cadastrar
      <small>Avaliação</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        @if(isset($stored))
          @if($stored == true)
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Evento criado com sucesso!</h4>
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

        @if(isset($stored))
          @if($stored == false)
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-close"></i> Erro ao criar evento!</h4>
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

        <form action="cadastrar_avaliacao" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="box box-primary" style="background-color: #f2f2f2;">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <b>Mês</b><br>
                    <select class="form-control select2 select2-hidden-accessible" id="mes" name="mes" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
                      <select class="form-control select2 select2-hidden-accessible" id="ano" name="ano" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
                   <div class="box-header with-border">
                      <h3 class="box-title">Respostas dos clientes</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                     <div class="table-responsive">
                       <table class="table no-margin">
                         <thead>
                           <tr>
                             <th class="text-center">Cliente ID</th>
                             <th class="text-center">Nome/Razão Social</th>
                             <th class="text-center">Nota</th>
                             <th class="text-center">Motivo</th>
                           </tr>
                         </thead>
                         <tbody>
                        @for($i=0; $i<count($clientes); $i++)
                           <tr>
                             <input type="hidden" name="clientes[]" value="{{ $clientes[$i][0]->id_cliente }}">
                             <td class="text-center">{{ $clientes[$i][0]->id_cliente }}</td>
                             <td class="text-center">{{ $clientes[$i][0]->nome_cliente }}</td>
                             <td><input class="form-control" name="notas[]"></td>
                             <td><input class="form-control" name="motivos[]"></td>
                           </tr> 
                          @endfor                          
                         </tbody>
                       </table>
                    </div>
                    <!-- end table-responsive -->
                  </div>
                  <!-- end box-body -->
                  <br />
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
              <br>
              <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="form-control btn btn-success">Cadastrar pesquisa  <i class="fa fa-check"></i></button>
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
        $("#mes").each(function () { 
            $(this).select2('val', ['{{ $mes }}']);
        });
        $("#ano").each(function () {
            $(this).select2('val', ['{{ $ano }}']);
        });
    });
  </script>
  <!-- END SELECT MULTI, LIMITA A 20% -->
@stop

<!-- /.content-wrapper -->
