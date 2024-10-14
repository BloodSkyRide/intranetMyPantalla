<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
        <div class="card-header" >
            <h3 class="card-title">Administrador de labores</h3>
            <div class="card-tools">

          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

            <div class="card card-primary" > 
              <div class="card-header" style="background-color: #0f318f">
                <h3 class="card-title">Crear labor y sub labores</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">

                    <div class="row">


                    <div class="col-sm">

                      <div class="form-group">
                        <label for="exampleInputEmail1">Nombre Labor:</label>
                        <div class="input-group input-group">
                          <input type="text" class="form-control" placeholder="nombre labor">
                          <span class="input-group-append">
                            <button type="button" class="btn_add_labor btn btn-success btn-flat"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;añadir labor</button>
                          </span>
                        </div>

                      </div>



                      <div class="form-group mt-5">
                        <label for="exampleInputEmail1">Nombre sub labor:</label>
                        <div class="input-group input-group">
                          <input type="text" class="form-control" placeholder="nombre labor" id="item_labor">
                          <span class="input-group-append">
                            <button onclick="addSubLabors()" type="button" class="btn_add_labor btn btn-success btn-flat"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;añadir sub labor</button>
                          </span>
                        </div>

                      </div>

                    </div>

                    <div class="col-sm">

                      <div class="form-group">
                        <label for="select_labor">Seleccionar labor:</label>
                        <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                            style="width: 100%;" id="select_labor">
                            <option selected="selected">Seleccionar labor</option>

                            @foreach ($labores as $labor)
                                <option value="{{ $labor['id_labor'] }}">{{ $labor['nombre_labor'] }}</option>
                            @endforeach

                        </select>
                    </div>


                      <div class="card card-primary success card-outline">
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            
                            Sub labor a añadir
                          </h3>
                        </div>
                        <div class="card-body">
                          <div class="trash d-flex justify-content-end"><a type="button" onclick="deleteSubLaborsDashborad()" title="Borrar todo."><i class="fa-solid fa-trash" style="color: rgb(177, 14, 14)"></i></a></div>
                          
                          <div id="add_labors"></div>
                          
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>


                    
                    
                  </div>
                  
                  <button class="btn btn-secondary" onclick="sendSubLabors('{{route('insertSubLabor')}}')">Enviar</button>
                </div>
                <!-- /.card-body -->
{{-- 
                <div class="card-footer">
                  <button  class="btn btn-primary">Submit</button>
                </div> --}}

            </div>
            <hr>
            {{-- <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label for="select_labor">Seleccionar labor:</label>
                        <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                            style="width: 100%;" id="select_labor">
                            <option selected="selected">Seleccionar labor</option>

                            @foreach ($labores as $labor)
                                <option value="{{ $labor['id_labor'] }}">{{ $labor['nombre_labor'] }}</option>
                            @endforeach

                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Seleccionar grupo de sublabores:</label>
                        <div class="select2-purple">
                            <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                data-dropdown-css-class="select2-purple" style="width: 100%;">
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.form-group -->


                </div>



                <!-- /.col -->
            </div> --}}
            {{-- <hr> --}}
            <center>
                <h2>Tabla de labores</h2>
            </center>

            <div>
                <button class="dropdown btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>&nbsp;&nbsp;Opciones
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i class="fa-solid fa-trash" style="color: rgb(182, 3, 3)">&nbsp;&nbsp;</i>Eliminar</a>
                    <a class="dropdown-item" href="#"><i class="fa-solid fa-link-slash" style="color: 	#28a745"></i>&nbsp;&nbsp;Desvincular</a>
                </div>
            </div>


          <div class="mt-4">

                <table class="table table-striped">
                    <thead class="table-warning" style="background-color: #0f318f; color: white">
                        <tr>
                            <th scope="col">#</th>



                            <th scope="col">Nombre labor</th>




                            <th scope="col">Grupo Labores</th>

                      </tr>
                  </thead>
                  <tbody>
                      @php
                          $bandera = 1;
                      @endphp
                      <tr>

                          @foreach ($labores as $labor)
                              <th scope="row">#{{ $bandera }}</th>
                              @php
                                  $bandera++;
                              @endphp

                                <td>{{ $labor['nombre_labor'] }}</td>


                                <td>

                                    @php
                                        $flag = 0;
                                    @endphp

                                    @foreach ($sublabores as $sublabor)
                                        @if ($labor['id_labor'] === $sublabor['id_labor'])
                                            <div class="div_checknox custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-danger"
                                                    type="checkbox" id="customCheckbox{{ $flag }}"
                                                    value="{{ $sublabor['id_labor'] }}">
                                                <label for="customCheckbox{{ $flag }}"
                                                    class="custom-control-label">{{ $sublabor['nombre_sub_labor'] }}</label>
                                            </div>
                                        @endif
                                        @php
                                            $flag++;
                                        @endphp
                                    @endforeach


                                </td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.row -->

            <!-- /.card-body -->
            <div class="card-footer">
                Mypantalla todos los derechos reservados © 2024
            </div>
        </div>
    </div>

</div>