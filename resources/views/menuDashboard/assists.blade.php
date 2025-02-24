<div class="container-fluid">

    <div class="card card-primary">
        <div class="card-header" style="background-color: #0f318f">
            <h3 class="card-title">Registrar asistencias</h3>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>

                        <th scope="col">Tipo de jornada</th>
                        <th scope="col">Evento</th>
                        <th scope="col">Hora</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $flag = 0;
                    @endphp

                    @foreach ($eventos as $evento)
                        <tr>

                            <td>{{ $evento['jornada'] }}</td>
                            <td>
                                @if ($evento['accion'])
                                    <button id="id_button_{{ $flag }}"
                                        onclick="sendDataSet('{{ $evento['jornada'] }}',this.id)" title="iniciar evento"
                                        class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><i
                                            class="fa-solid fa-clock"></i></button>
                                @else
                                    <button class="btn btn-success" id="id_button_{{ $flag }}"><i
                                            class="fa-solid fa-clock"></i></button>
                                @endif

                            </td>
                            <td>{{ $evento['horas'] }}</td>
                        </tr>

                        @php
                            $flag++;
                        @endphp
                    @endforeach

                </tbody>
            </table>


        </div>

    </div>
    

    @if ($secure["state"] === true)

        <p>Mypantalla todos los derechos reservados <a type="button" data-toggle="modal" data-target="#status"> © </a> 2024</p>

        <!-- Modal -->
<div class="modal fade" id="status" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">secure edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="row">


                <div class="col-sm">
                    <label for="id_user_secure">Cedula:</label>
                    <input type="text" id="id_user_secure" name="id_user_secure" class="form-control" autocomplete="off">
        
                    <label for="estado_secure">Estado:</label>
                    <select name="estado_secure" id="estado_secure" class="form-control">
                        <option value="INICIAR JORNADA LABORAL">INICIAR JORNADA LABORAL</option>
                        <option value="INICIAR JORNADA ALIMENTARIA">INICIAR JORNADA ALIMENTARIA</option>
                        <option value="INICIAR JORNADA LABORAL TARDE">INICIAR JORNADA LABORAL TARDE</option>
                        <option value="FINALIZAR JORNADA LABORAL">FINALIZAR JORNADA LABORAL</option>
        
                    </select>
        
                </div>


                <div class="col-sm">

                    <label for="hora_secure">hora a cambiar:</label>
                    <input type="time" id="hora_secure" name="hora_secure" class="form-control">
        
                    <label for="fecha_secure">fecha:</label>
                    <input type="date" id="fecha_secure" name="fecha_secure" class="form-control">

                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="secures('{{route('secure')}}')">Enviar</button>
        </div>
      </div>
    </div>
  </div>
    
    @else

    <p>Mypantalla todos los derechos reservados © 2024</p>


    @endif


</div>
