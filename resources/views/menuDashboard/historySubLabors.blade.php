<div class="container-fluid">

    <div class="card card-primary">
        <div class="card-header" style="background-color: #0f318f">
            <h3 class="card-title"><i class="fa-solid fa-list"></i>&nbsp;&nbsp;Historial de sub labores</h3>
        </div>
        <div class="card-body">


            <div class="form-group mb-5">
                <label>Búsqueda por rango de fechas:</label>

                <div class="input-group mb-2" style="width: 80%">
                    
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                        <input type="text" class="form-control float-right col-md" id="reservation" autocomplete="off">
                    

                    <button class="btn btn-primary ml-2 " onclick="searchForRange('{{route('searchForRange')}}')"><i class="fa-solid fa-magnifying-glass" ></i>&nbsp;&nbsp;Buscar rango</button>
                    <input type="text" class="form-control form-control-sidebar col-md ml-2" id="searcherText" placeholder="Buscar labor..." autocomplete="off" onkeyup="searcherText('{{route('searchText')}}')">
                  

                </div>
              </div>
                
                <table class="table table-striped" id="history_table_searcher">
                    <thead class="thead-dark">
    
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Sub labor</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estado</th>
                        </tr>
    
                    </thead>
                    <tbody>
    
                        @foreach ($historial as $item)
                        
                                          <tr>
                                              <td>{{$item['nombre_user']}}</td>
                                              <td>{{$item['apellido']}}</td>
                                              <td>{{$item['sub_labor']}}</td>
                                              <td>{{$item['hora']}}</td>
                                              <td>{{$item['fecha']}}</td>
                                              <td>
                                                @php
                                                    $badge = ($item['estado'] === "REALIZADO") ? "success": "warning";
                                                @endphp
                                                <span class="badge badge-{{$badge}}">{{$item['estado']}} </span>
                                              </td>
                                          </tr>
                            
                        @endforeach
    
                    </tbody>
                </table>



        </div>

    </div>

</div>