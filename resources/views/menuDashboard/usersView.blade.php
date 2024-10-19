<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Administrador de usuarios</h3>
            <div class="card-tools">

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table class="table table-striped" id="report_table">
                <thead class="thead-dark">

                    <tr>
                        <th scope="col">Cédula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Labor Asignada</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">E-mail</th>
                        <th scope="col"># Emergencia</th>
                        <th scope="col">Nombre Emergencia</th>
                        <th scope="col"># Telefono</th>
                        <th scope="col">Fecha Registro</th>

                    </tr>

                </thead>
                <tbody>

                    @foreach ($users as $item)
                        <tr>
                            <td>

                                <a type="button"
                                    onclick="openModalUser('{{ $item['cedula'] }}','{{ route('getUserForId') }}')"><i
                                        class="fa-solid fa-user-pen"></i>&nbsp;&nbsp;<span
                                        class="badge bg-success">{{ $item['cedula'] }}</span></a>

                            </td>

                            <td>{{ $item['nombre'] }}</td>
                            <td>{{ $item['apellido'] }}</td>
                            <td>{{ $item['nombre_labor'] }}</td>
                            <td>{{ $item['direccion'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['contacto_emergencia'] }}</td>
                            <td>{{ $item['nombre_contacto'] }}</td>
                            <td>{{ $item['telefono'] }}</td>
                            <td>{{ $item['fecha_registro'] }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>


        </div>

    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal_edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg bg-info">
                <h5 class="modal-title" id="title_modal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="select_labor">Seleccionar labor:</label>
                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                                style="width: 100%;" id="select_labor_edit">
                                <option selected="selected">Seleccionar labor</option>

                                @foreach ($labores as $labor)
                                    <option value="{{ $labor['id_labor'] }}">{{ $labor['nombre_labor'] }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Cerrar</button>
                <button type="button" class="btn btn-info"
                    onclick="collectSubLabors('{{ route('collectSubLabors') }}')"><i
                        class="fa-solid fa-check"></i>&nbsp;&nbsp;Confirmar</button>
            </div>
        </div>
    </div>
</div>
