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

                  @foreach ($eventos as $evento)
                      
                  <tr>
                      
                      <td>{{$evento["jornada"]}}</td>
                      <td>
                        @if ($evento["accion"])
                            
                        <button onclick="sendDataSet('{{$evento['jornada']}}')" title="iniciar evento" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-clock" ></i></button>

                        @else

                        <button class="btn btn-success"><i class="fa-solid fa-clock" ></i></button>
                        
                        @endif
                      
                      </td>
                      <td>{{$evento["horas"]}}</td>
                  </tr>

                  @endforeach

                </tbody>
            </table>


        </div>

    </div>


</div>


