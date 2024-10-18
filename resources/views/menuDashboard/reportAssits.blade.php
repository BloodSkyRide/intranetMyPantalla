




<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Reporte de asistencias</h3>
            <div class="card-tools">

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


            <table class="table table-striped" id="report_table">
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
                            <td>{{ $item['nombre_user'] }}</td>
                            <td>{{ $item['apellido'] }}</td>
                            <td>{{ $item['sub_labor'] }}</td>
                            <td>{{ $item['hora'] }}</td>
                            <td>{{ $item['fecha'] }}</td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
            
                </tbody>
            </table>


        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_confirm">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg bg-info">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;Seguro de recoger las sub labores no realizadas?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¡Recuerda que para realizar esta operación es porque los colaboradores ya no van a laborar mas en el día de hoy!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i>&nbsp;&nbsp;Cerrar</button>
                    <button type="button" class="btn btn-info" onclick="collectSubLabors('{{route('collectSubLabors')}}')"><i class="fa-solid fa-check"></i>&nbsp;&nbsp;Confirmar</button>
                </div>
            </div>
        </div>
    </div>


</div>
