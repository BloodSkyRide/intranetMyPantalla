




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
                        <th scope="col">Cédula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Inició jornada</th>
                        <th scope="col">Inició alimentación</th>
                        <th scope="col">Inició jornada tarde</th>
                        <th scope="col">Fin Jornada</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total laborado</th>

                    </tr>
            
                </thead>
                <tbody>
            
                    @foreach ($history as $item)
                        <tr>
                            <td>{{ $item['cedula'] }}</td>
                            <td>{{ $item['nombre'] }}</td>
                            <td>{{ $item['apellido'] }}</td>
                            <td>{{ $item['inicio_jornada'] }}</td>
                            <td>{{ $item['inicio_jornada_a'] }}</td>
                            <td>{{ $item['inicio_jornada_t'] }}</td>
                            <td>{{ $item['finalizar_jornada'] }}</td>
                            <td>{{ $item['fecha'] }}</td>
                            <td>
                                
                                @php

                                $hour = ($item['total'])[0];

                                $color = ($hour >= 8) ? "success": "warning";
                                    
                                @endphp
                                
                                <span class="badge bg-{{$color}}" >{{ $item['total'] }}</span>
                            
                            </td>
                        </tr>
                    @endforeach
            
                </tbody>
            </table>


        </div>

    </div>
</div>
