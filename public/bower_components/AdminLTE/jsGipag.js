

  $(function () {
    $(".select2").select2();
  });


  $('#nextTab').click(function(e){
    e.preventDefault();
    $('.nav-tabs > .active').next('li').find('a').trigger('click');

    var barra = document.getElementById('progress-bar').style.width;
    var percentual = parseInt(barra) + parseInt(17);

    document.getElementById('buttonPrev').style.display = "block";
    document.getElementById('progress-bar').style.width = percentual + '%';
    document.getElementById('li').style.color = "green";
  });


  $('#prevTab').click(function(e){
    e.preventDefault();
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');

    var barra = document.getElementById('progress-bar').style.width;
    var percentual = parseInt(barra) - parseInt(17);

    if(percentual == 0){
      document.getElementById('buttonPrev').style.display = "none";
    }

    document.getElementById('progress-bar').style.width = percentual + '%';
    document.getElementById('li').style.color = "green";
  });


      $(document).ready(function(){
          var input =  '<br><select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">'+
                        '<option>Selecione as atividades da propriedade</option>'+
                        '@foreach($atividades as $a)'+
                          '<option value="{{ $a->cod_ativ }}">{{ $a->descricao }}</option>'+
                        '@endforeach'+
                      '</select><br>';
          $("button[name='add']").click(function( e ){
              $('#selects_adicionais').append( input );
              $(".select2").select2();
          });
      });


        $(document).ready(function(){
            var input =  '<br><select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >'+
                          '<option>Selecione as atividades da propriedade</option>'+
                          '@foreach($atividades as $a)'+
                            '<option value="{{ $a->cod_ativ }}">{{ $a->descricao }}</option>'+
                          '@endforeach'+
                        '</select><br>';
            $("button[name='add']").click(function( e ){
                $('#selects_adicionais').append( input );
                $(".select2").select2();
            });
        });


      $(document).ready(function(){
          var input =  '<br><select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="importancia">'+
                        '<option>Selecione atividades</option>'+
                      '</select><br>';
          $("button[name='add3']").click(function( e ){
              $('#selects_adicionais3').append( input );
              $(".select2").select2();
          });
      });

 
      var center = new google.maps.LatLng(-29.721194, -53.719274);

      function initMap() {
         var mapDiv = document.getElementById('map');
         var latitude = document.getElementById('latitude').value;
         var longitude = document.getElementById('longitude').value;

         var t1 = document.getElementById('latitude').value.length;
         var t2 = document.getElementById('longitude').value.length;

         if( (t1 > 0) && ( t2 > 0) ){
           var LatLong = new google.maps.LatLng(latitude, longitude);

           var map = new google.maps.Map(mapDiv, {
               center: new google.maps.LatLng(latitude, longitude),
               zoom: 9
           });

           var marker = new google.maps.Marker ({
             position: LatLong,
             map: map,
             title: 'Propriedade'
           });

           marker.setMap(map);
         }
         else{
           var LatLong = new google.maps.LatLng(-29.72119, -53.719274);

           var map = new google.maps.Map(mapDiv, {
               center: new google.maps.LatLng(-29.72119, -53.719274),
               zoom: 4
           });
         }
     }


    function teste2(){
      $('#myModal1').modal({
        }).on('shown.bs.modal', function () {
          google.maps.event.trigger(map, 'resize');
          initMap();
        });
    }


    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQalLzBKBjsXnHcP6ixo87rnHJOv2DaBI&callback=initMap">


    $(document).ready(function(){
      $.ajax({
          url: "/municipio/lista",
          type: "GET",
          dataType: "json"
      }).done(function(municipios) {
            $("#municipios").empty();
            $("#municipios").append(new Option("Selecione municipio", "null"));
            $("#distritos").append(new Option("Selecione distrito", "null"));
            $("#localidades").append(new Option("Selecione localidade", "null"));
            console.log(municipios);
            for(x=0; x<municipios.length; x++){
                $("#municipios").append(new Option(municipios[x].nome_municipio, municipios[x].cod_municipio));
            }
            $("#municipios").on("change", function(){
                $("#distritos").empty();
                $("#distritos").append(new Option("Selecione distrito", "null"));
                 $.getJSON("/distritos/lista", {cod_municipio:$("#municipios option:selected").val()}, function(distritos){
                    for(x=0; x<distritos.length; x++){
                        console.log(distritos);
                        $("#distritos").append(new Option(distritos[x].nome_distrito, distritos[x].cod_distrito));
                    }
                })
                $("#localidades").empty();
                $("#localidades").append(new Option("Selecione localidade", "null"));
                $.getJSON("/localidades/lista", {cod_municipio:$("#municipios option:selected").val()}, function(localidades){
                   for(x=0; x<localidades.length; x++){
                       console.log(localidades);
                       $("#localidades").append(new Option(localidades[x].nome_local, localidades[x].cod_local));
                   }
               })
            })
      }).fail(function(jqXHR, textStatus ) {
          console.log("Request failed: " + textStatus);

      }).always(function() {

      });
    })

          // Função responsável por inserir linhas na tabela
          function inserirLinhaTabela() {

              var table = document.getElementById("minhaTabela");

              // Captura a quantidade de linhas já existentes na tabela
              var numOfRows = table.rows.length;

              // Captura a quantidade de colunas da última linha da tabela
              var numOfCols = table.rows[numOfRows-1].cells.length;

              // Insere uma linha no fim da tabela.
              var newRow = table.insertRow(numOfRows);

              var cont = document.getElementById("cont").value;
              var cont = parseInt(cont) + parseInt(1);
              // Faz um loop para criar as colunas
              for (var j = 0; j < numOfCols; j++) {
                  // Insere uma coluna na nova linha
                  newCell = newRow.insertCell(j);
                  // Insere um conteúdo na coluna
                  if(j == 0){
                    var td0 = '<td style="width: 260px;">'+
                                '<input type="text" class="form-control" name="nome[]" placeholder="ex: nome">'+
                              '</td>';
                    newCell.innerHTML = td0;
                  }
                  if(j == 1){
                    var td1 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="cod_parentesco[]">'+
                                    '<option>Selecione</option>'+
                                    '@foreach($parentescos as $p)'+
                                      '<option value="{{ $p->cod_parentesco }}">{{ $p->parentesco }}</option>'+
                                    '@endforeach'+
                                  '</select>'+
                                '</td>';
                    newCell.innerHTML = td1;
                  }
                  if(j == 2){
                    var td2 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sexo[]">'+
                                    '<option>Selecione</option>'+
                                    '<option value="M">Masculino</option>'+
                                    '<option value="F">Feminino</option>'+
                                  '</select>'+
                                '</td>';
                    newCell.innerHTML = td2;
                  }
                  if(j == 3){
                    var td3 = '<td>'+
                                '<input type="text" class="form-control" name="dt_nasc[]" maxlength = "10" onkeyup = "barra(this)" placeholder="dd/mm/aaaa" />'+
                              '</td>';
                    newCell.innerHTML = td3;
                  }
                  if(j == 4){
                    var td4 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="cod_escolaridade[]">'+
                                    '<option>Selecione</option>'+
                                    '@foreach($escolaridades as $e)'+
                                      '<option value="{{ $e->cod_escolaridade }}">{{ $e->escolaridade }}</option>'+
                                    '@endforeach'+
                                  '</select>'+
                                '</td>';
                    newCell.innerHTML = td4;

                  }
                  if(j == 5){
                    var td5 = '<td style="width: 380px;">'+
                                  '<select class="form-control select2 select2-hidden-accessible" multiple="multiple" data-placeholder="Selecione" style="width: 95%;" tabindex="-1" aria-hidden="true" name="cod_ocupacao'+cont+'[]">'+
                                     '@foreach($ocupacoes as $o)'+
                                       '<option value="{{ $o->cod_ocupacao }}">{{ $o->ocupacao }}</option>'+
                                     '@endforeach'+
                                 '</select>';
                    newCell.innerHTML = td5;
                  }
              }
              $(".select2").select2();
              document.getElementById("cont").value = cont;
          }


   function somentenumero(o,f){
         v_obj=o
         v_fun=f
         setTimeout("execmascara()",1)
     }
     function execmascara(){
         v_obj.value=v_fun(v_obj.value)
     }
     function numero(v){
          v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
          v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos 3 primeiros dígitos
          v=v.replace(/(\d)(\d{8})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
          return v;
     }

      function barra(objeto){
        if (objeto.value.length == 2 || objeto.value.length == 5 ){
          objeto.value = objeto.value+"-";
          }
        }


      $(document).ready(function(){
        $("#checkPropria").on('click', function(){
          if( $("#areaPropria").prop( "disabled") ) {
            $("#areaPropria").prop( "disabled", false);
          }else{
            $("#areaPropria").prop( "disabled", true);
          }
        });
      });


      $(document).ready(function(){
        $("#checkArrendada").on('click', function(){
          if( $("#areaArrendada").prop( "disabled") ) {
            $("#areaArrendada").prop( "disabled", false);
          }else{
            $("#areaArrendada").prop( "disabled", true);
          }
        });
      });


      $(document).ready(function(){
        $("#checkParceria").on('click', function(){
          if( $("#areaParceria").prop( "disabled") ) {
            $("#areaParceria").prop( "disabled", false);
          }else{
            $("#areaParceria").prop( "disabled", true);
          }
        });
      });


      $(document).ready(function(){
        $("#maoFamiliar").on('click', function(){
          if( $("#numFamiliar").prop( "disabled") ) {
            $("#numFamiliar").prop( "disabled", false);
            $("#mesFamiliar").prop( "disabled", false);
          }else{
            $("#numFamiliar").prop( "disabled", true);
            $("#mesFamiliar").prop( "disabled", true);
          }
        });
      });


      $(document).ready(function(){
        $("#maoContratada").on('click', function(){
          if( $("#numContratada").prop( "disabled") ) {
            $("#numContratada").prop( "disabled", false);
            $("#mesContratada").prop( "disabled", false);
          }else{
            $("#numContratada").prop( "disabled", true);
            $("#mesContratada").prop( "disabled", true);
          }
        });
      });


      $(document).ready(function(){
        $("#maoDiarista").on('click', function(){
          if( $("#numDiarista").prop( "disabled") ) {
            $("#numDiarista").prop( "disabled", false);
            $("#mesDiarista").prop( "disabled", false);
          }else{
            $("#numDiarista").prop( "disabled", true);
            $("#mesDiarista").prop( "disabled", true);
          }
        });
      });


            // Função responsável por inserir linhas na tabela
            function inserirLinhaTabela2() {

                var table = document.getElementById("minhaTabela2");

                // Captura a quantidade de linhas já existentes na tabela
                var numOfRows = table.rows.length;

                // Captura a quantidade de colunas da última linha da tabela
                var numOfCols = table.rows[numOfRows-1].cells.length;

                // Insere uma linha no fim da tabela.
                var newRow = table.insertRow(numOfRows);

                var cont = document.getElementById("cont2").value;
                var cont = parseInt(cont) + parseInt(1);
                // Faz um loop para criar as colunas
                for (var j = 0; j < numOfCols; j++) {
                    // Insere uma coluna na nova linha
                    newCell = newRow.insertCell(j);
                    // Insere um conteúdo na coluna
                    if(j == 0){
                      var td0 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="importancia">'+
                                      '<option>Selecione</option>'+
                                      '<option>Fruticultura</option>'+
                                      '<option>Olericultura</option'+
                                  '</select>'+
                                '</td>';
                      newCell.innerHTML = td0;
                    }
                    if(j == 1){
                      var td1 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="importancia">'+
                                      '<option>Selecione</option>'+
                                  '</select>'+
                                '</td>';
                      newCell.innerHTML = td1;
                    }
                    if(j == 2){
                      var td2 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="importancia">'+
                                      '<option>Selecione</option>'+
                                      '<option>Fruticultura</option>'+
                                      '<option>Olericultura</option>'+
                                  '</select>'+
                                '</td>';
                      newCell.innerHTML = td2;
                    }
                    if(j == 3){
                      var td3 = '<td>'+
                                  '<input type="text" class="form-control" name="" placeholder="0" value="">'+
                                '</td>';
                      newCell.innerHTML = td3;
                    }
                    if(j == 4){
                      var td4 = '<td>'+
                                  '<input type="text" class="form-control" placeholder="0" name="" value="">'+
                                '</td>';
                      newCell.innerHTML = td4;

                    }
                    if(j == 5){
                      var td5 = '<td>'+
                                  '<input type="text" class="form-control" placeholder="0" name="" value="">'+
                                '</td>';
                      newCell.innerHTML = td5;
                    }
                    if(j == 6){
                      var td6 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="importancia">'+
                                    '<option>Selecione</option>'+
                                    '<option>ha</option>'+
                                    '<option>m</option>'+
                                    '<option>m²</option>'+
                                  '</select>'+
                                '</td>';
                      newCell.innerHTML = td6;
                    }
                    if(j == 7){
                      var td7 = '<td>'+
                                    '<input type="text" class="form-control" placeholder="0" name="" value="">'+
                                '</td>';
                      newCell.innerHTML = td7;
                    }
                    if(j == 8){
                      var td8 = '<td>'+
                                  '<input type="text" class="form-control" placeholder="0" name="" value="">'+
                                '</td>';
                      newCell.innerHTML = td8;
                    }
                    if(j == 9){
                      var td9 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="importancia">'+
                                      '<option>Selecione</option>'+
                                      '<option>Kilos</option>'+
                                      '<option>Toneladas</option>'+
                                      '<option>Maços</option>'+
                                      '<option>Pés</option>'+
                                      '<option>Litros</option>'+
                                      '<option>Unidades</option>'+
                                      '<option>Caixas</option>'+
                                      '<option>Barris</option>'+
                                  '</select>'+
                                '</td>';
                      newCell.innerHTML = td9;
                    }
                    if(j == 10){
                      var td10 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="importancia">'+
                                      '<option>Selecione</option>'+
                                      '<option>Sim</option>'+
                                      '<option>Não</option>'+
                                  '</select>'+
                                '</td>';
                      newCell.innerHTML = td10;
                    }
                    if(j == 11){
                      var td11 = '<td>'+
                                  '<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="importancia">'+
                                      '<option>Selecione</option>'+
                                      '<option>Sim</option>'+
                                      '<option>Não</option>'+
                                  '</select>'+
                                '</td>';
                      newCell.innerHTML = td11;
                    }
                }
                $(".select2").select2();
                document.getElementById("cont2").value = cont;
            }



           function mostraativ2(){
             if(document.getElementById('ativimport2').style.display=='block'){
                   document.getElementById('ativimport2').style.display=='none';
                 }
                 else{
                   document.getElementById('ativimport2').style.display='block';
                 }
           }
           function mostraativ3(){
             var ativ1 = document.getElementById('atividade1').value;
             var ativ2 = document.getElementById('atividade2').value;
             if(ativ1 == ativ2){
               alert('ATIVIDADES IGUAIS! escolha outra!');
               $("#atividade2").each(function () { //added a each loop here
                   $(this).select2('val', ['null']);
               });
             }
             if((ativ1 != ativ2) && (ativ2 != 'null')){
                document.getElementById("atividade2").style.border = "none";
                if(document.getElementById('ativimport3').style.display=='block'){
                      document.getElementById('ativimport3').style.display=='none';
                 }
                 else{
                      document.getElementById('ativimport3').style.display='block';
                 }
             }
           }
           function mostraativ4(){
             var ativ1 = document.getElementById('atividade1').value;
             var ativ2 = document.getElementById('atividade2').value;
             var ativ3 = document.getElementById('atividade3').value;
             if((ativ3 == ativ1) || (ativ3 == ativ2)){
               alert('ATIVIDADES IGUAIS! escolha outra!');
               $("#atividade3").each(function () { //added a each loop here
                   $(this).select2('val', ['null']);
               });
             }
            if((ativ3 != ativ1) && (ativ3 != ativ2) && (ativ3 != 'null')) {
                   document.getElementById("atividade3").style.border = "none";
                   if(document.getElementById('ativimport4').style.display=='block'){
                   document.getElementById('ativimport4').style.display=='none';
                 }
                 else{
                   document.getElementById('ativimport4').style.display='block';
                 }
             }
           }
           function mostraativ5(){
             var ativ1 = document.getElementById('atividade1').value;
             var ativ2 = document.getElementById('atividade2').value;
             var ativ3 = document.getElementById('atividade3').value;
             var ativ4 = document.getElementById('atividade4').value;
             if((ativ4 == ativ1) || (ativ4 == ativ2) || (ativ4 == ativ3)){
               alert('ATIVIDADES IGUAIS! escolha outra!');
               $("#atividade4").each(function () { //added a each loop here
                   $(this).select2('val', ['null']);
               });
             }
            if((ativ4 != ativ1) && (ativ4 != ativ2) && (ativ4 != ativ3) && (ativ4 != 'null')){
               document.getElementById("atividade4").style.border = "none";
             if(document.getElementById('ativimport5').style.display=='block'){
                   document.getElementById('ativimport5').style.display=='none';
                 }
                 else{
                   document.getElementById('ativimport5').style.display='block';
                 }
               }
           }
           function mostraativ6(){
             var ativ1 = document.getElementById('atividade1').value;
             var ativ2 = document.getElementById('atividade2').value;
             var ativ3 = document.getElementById('atividade3').value;
             var ativ4 = document.getElementById('atividade4').value;
             var ativ5 = document.getElementById('atividade5').value;
             if((ativ5 == ativ1) || (ativ5 == ativ2) || (ativ5 == ativ3) || (ativ5 == ativ4)){
               alert('ATIVIDADES IGUAIS! escolha outra!');
               $("#atividade5").each(function () { //added a each loop here
                   $(this).select2('val', ['null']);
               });
             }
             if((ativ5 != ativ1) && (ativ5 != ativ2) && (ativ5 != ativ3) && (ativ5 != ativ4) && (ativ5 != 'null')){
               document.getElementById("atividade5").style.border = "none";
             if(document.getElementById('ativimport6').style.display=='block'){
                   document.getElementById('ativimport6').style.display=='none';
                 }
                 else{
                   document.getElementById('ativimport6').style.display='block';
                 }
               }
           }
           function mostraativ7(){
             var ativ1 = document.getElementById('atividade1').value;
             var ativ2 = document.getElementById('atividade2').value;
             var ativ3 = document.getElementById('atividade3').value;
             var ativ4 = document.getElementById('atividade4').value;
             var ativ5 = document.getElementById('atividade5').value;
             var ativ6 = document.getElementById('atividade6').value;
             if((ativ6 == ativ1) || (ativ6 == ativ2) || (ativ6 == ativ3) || (ativ6 == ativ4) || (ativ6 == ativ5)){
               alert('ATIVIDADES IGUAIS! escolha outra!');
               $("#atividade6").each(function () { //added a each loop here
                   $(this).select2('val', ['null']);
               });

             }
            if((ativ6 != ativ1) && (ativ6 != ativ2) && (ativ6 != ativ3) && (ativ6 != ativ4) && (ativ6 != ativ5) && (ativ6 != 'null')){
               document.getElementById("atividade6").style.border = "none";
             if(document.getElementById('ativimport6').style.display=='block'){
                   document.getElementById('ativimport6').style.display=='none';
                 }
                 else{
                   document.getElementById('ativimport6').style.display='block';
                 }
               }
           }



             function mostramotiv2(){
               if(document.getElementById('motiv2').style.display=='block'){
                     document.getElementById('motiv2').style.display=='none';
                   }
                   else{
                     document.getElementById('motiv2').style.display='block';
                   }
             }
             function mostramotiv3(){
               var motiv1 = document.getElementById('motivacao1').value;
               var motiv2 = document.getElementById('motivacao2').value;
               if(motiv1 == motiv2){
                 alert('ATIVIDADES IGUAIS! escolha outra!');
                 $("#motivacao2").each(function () { //added a each loop here
                     $(this).select2('val', ['null']);
                 });
               }
               if((motiv1 != motiv2) && (motiv2 != 'null')){
                  if(document.getElementById('motiv3').style.display=='block'){
                        document.getElementById('motiv3').style.display=='none';
                   }
                   else{
                        document.getElementById('motiv3').style.display='block';
                   }
               }
             }
             function mostramotiv4(){
               var motiv1 = document.getElementById('motivacao1').value;
               var motiv2 = document.getElementById('motivacao2').value;
               var motiv3 = document.getElementById('motivacao3').value;
               if((motiv3 == motiv1) || (motiv3 == motiv2)){
                 alert('ATIVIDADES IGUAIS! escolha outra!');
                 $("#motivacao3").each(function () { //added a each loop here
                     $(this).select2('val', ['null']);
                 });
               }
              if((motiv3 != motiv1) && (motiv3 != motiv2) && (motiv3 != 'null')) {
                     if(document.getElementById('motiv4').style.display=='block'){
                     document.getElementById('motiv4').style.display=='none';
                   }
                   else{
                     document.getElementById('motiv4').style.display='block';
                   }
               }
             }
             function mostramotiv5(){
               var motiv1 = document.getElementById('motivacao1').value;
               var motiv2 = document.getElementById('motivacao2').value;
               var motiv3 = document.getElementById('motivacao3').value;
               var motiv4 = document.getElementById('motivacao4').value;
               if((motiv4 == motiv1) || (motiv4 == motiv2) || (motiv4 == motiv3)){
                 alert('ATIVIDADES IGUAIS! escolha outra!');
                 $("#motivacao4").each(function () { //added a each loop here
                     $(this).select2('val', ['null']);
                 });
               }
              if((motiv4 != motiv1) && (motiv4 != motiv2) && (motiv4 != motiv3) && (motiv4 != 'null')){
               if(document.getElementById('motiv5').style.display=='block'){
                     document.getElementById('motiv5').style.display=='none';
                   }
                   else{
                     document.getElementById('motiv5').style.display='block';
                   }
                 }
             }
             function mostramotiv6(){
               var motiv1 = document.getElementById('motivacao1').value;
               var motiv2 = document.getElementById('motivacao2').value;
               var motiv3 = document.getElementById('motivacao3').value;
               var motiv4 = document.getElementById('motivacao4').value;
               var motiv5 = document.getElementById('motivacao5').value;
               if((motiv5 == motiv1) || (motiv5 == motiv2) || (motiv5 == motiv3) || (motiv5 == motiv4)){
                 alert('ATIVIDADES IGUAIS! escolha outra!');
                 $("#motivacao5").each(function () { //added a each loop here
                     $(this).select2('val', ['null']);
                 });
               }
               if((motiv5 != motiv1) && (motiv5 != motiv2) && (motiv5 != motiv3) && (motiv5 != motiv4) && (motiv5 != 'null')){
                 if(document.getElementById('motiv6').style.display=='block'){
                     document.getElementById('motiv6').style.display=='none';
                   }
                   else{
                     document.getElementById('motiv6').style.display='block';
                   }
                 }
             }
             function mostramotiv7(){
               var motiv1 = document.getElementById('motivacao1').value;
               var motiv2 = document.getElementById('motivacao2').value;
               var motiv3 = document.getElementById('motivacao3').value;
               var motiv4 = document.getElementById('motivacao4').value;
               var motiv5 = document.getElementById('motivacao5').value;
               var motiv6 = document.getElementById('motivacao6').value;
               if((motiv6 == motiv1) || (motiv6 == motiv2) || (motiv6 == motiv3) || (motiv6 == motiv4) || (motiv6 == motiv5)){
                 alert('ATIVIDADES IGUAIS! escolha outra!');
                 $("#motivacao6").each(function () { //added a each loop here
                     $(this).select2('val', ['null']);
                 });

               }
              if((motiv6 != motiv1) && (motiv6 != motiv2) && (motiv6 != motiv3) && (motiv6 != motiv4) && (motiv6 != motiv5) && (motiv6 != 'null')){
               if(document.getElementById('motiv6').style.display=='block'){
                     document.getElementById('motiv6').style.display=='none';
                   }
                   else{
                     document.getElementById('motiv6').style.display='block';
                   }
                 }
             }

