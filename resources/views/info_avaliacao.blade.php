
@extends('template_main')

@section('conteudo')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 243px; background-color: white;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-search"></i> Pesquisa
      <small>Avaliações</small>
    </h1>
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          @if($NPS >= 80 )
          <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $NPS }} <sup style="font-size: 20px">%</sup><p style="font-size:30px;">Meta Atingida</p></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
          @endif
          @if($NPS >= 60 && $NPS <= 79.99)
          <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $NPS }} <sup style="font-size: 20px">%</sup><p style="font-size:30px;">Meta dentro da tolerância</p></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
          @endif
          @if($NPS < 60)
          <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $NPS }} <sup style="font-size: 20px">%</sup><p style="font-size:30px;">Meta não atingida</p></h3>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
          @endif
      </div>
    </div>
    <div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary" style="background-color: #f2f2f2;">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-list-ol"></i> Informações 
                    <small>da avaliação</small>
                  </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID Cliente</th>
                    <th>Nome/Razão Social</th>
                    <th>Nota</th>
                    <th>Motivo</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($dadosAvaliacao as $d)
                  <tr>
                    <td><a href="pages/examples/invoice.html">{{ $d->id_cliente }} </a></td>
                    <td>{{ $d->nome_cliente }}</td>
                    <td>
                        @if($d->nota == 10 || $d->nota == 9)
                          <span class="label label-success">{{ $d->nota }}</span></>
                        @endif
                        @if($d->nota == 7 || $d->nota == 8)
                          <span class="label label-warning">{{ $d->nota }}</span></>
                        @endif
                        @if($d->nota <=6)
                          <span class="label label-danger">{{ $d->nota }}</span></>
                        @endif
                    <td>{{ $d->motivo }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- end box -->
      </div>
      <!-- end col -->
   </div>
    <!-- end row -->
  </section>
  <!-- end section -->
</div>
<!-- end tab-content -->



@stop

<!-- /.content-wrapper -->
