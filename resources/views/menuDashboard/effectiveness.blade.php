<div class="container-fluid">

    <div class="card card-primary">
        <div class="card-header" style="background-color: #0f318f">
            <h3 class="card-title"><i class="fa-solid fa-newspaper"></i>&nbsp;&nbsp;Efectividad colaboradores</h3>
        </div>
        <div class="card-body">
            <hr>

            <center class="m-2"><button class="btn btn-info" onclick="openModalEfectivesness()"><i
                        class="fa-solid fa-plus"></i>&nbsp;&nbsp;Eliminar/Editar atributo</button></center>

            <button class="btn btn-success mb-3" onclick="saveDay('{{route('saveAtribute')}}')"><i class="fa-solid fa-floppy-disk"></i>&nbsp;&nbsp;Guardar día</button>

                <div class="table-responsive" style="overflow-y: scroll; max-height: 450px;">
                    <table class="table" id="table_efectiveness">
                        <thead class="thead-dark" style="width: 100%; border-collapse: collapse;">
        
                            <tr>
                                <th style="position: sticky; top: 0; z-index: 1;">Nombre</th>
                                <th style="position: sticky; top: 0; z-index: 1;">Total ponderado</th>
                                @foreach ($atributos as $atributo)
                                    <th scope="col" style="position: sticky; top: 0; z-index: 1;"> <center>{{ $atributo['nombre_atributo'] }} <br> <span class="badge badge-info">{{ $atributo['porcentaje_efectividad'] }}%</span></center></th>
                                @endforeach
                            </tr>
        
                        </thead>
        
                        @php
        
                        @endphp
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    
                                    <th scope="row" class="d-flex align-items-center">
                                        <span class="badge badge-success">{{ $user['cedula'] }}-{{ $user['nombre'] }}</span>
                                        
                                        </th>
                                        <th>

                                            @foreach ($ponderados as $ponderado)

                                            @if ($user['cedula'] == $ponderado['id_user'])
                                                
                                            {{ $ponderado['nombre_atributo_ponderado'] }}: <span class="badge badge-info">{{ $ponderado['ponderado'] }} %</span><br>

                                            @endif
                                            @endforeach


                                        </th>
                                    @foreach ($atributos as $atributo)
                                        <td>
                                            @php
        
                                                $dias = [
                                                    'Lunes',
                                                    'Martes',
                                                    'Miércoles',
                                                    'Jueves',
                                                    'Viernes',
                                                    'Sábado',
                                                    'Domingo',
                                                ];
                                                $dias_html = '';
                                                for ($i = 0; $i < count($dias); $i++) {
                                                    $dias_html .=
                                                        "<div class='form-check'>
                                                <input class='form-check-input' type='checkbox' id='checkbox_efectividad' data-date='" .
                                                        $dias[$i] .
                                                        '-' .
                                                        $atributo['id_atributo'] ."-".$user['cedula']."-".$atributo['nombre_atributo'].
                                                        "'>
                                                <label class='form-check-label'>" .
                                                        $dias[$i] .
                                                        "</label>
                                                </div>";
                                                }
                                            @endphp
        
                                            {!! $dias_html !!}
                                        </td>
                                    @endforeach
        
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="modal_efectiveness" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar atributos de evaluación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">


                        <div class="col-sm">

                            <label for="id_user_secure">Nombre Atributo:</label>
                            <input type="text" id="atribute" name="atribute" class="form-control" autocomplete="off"
                                placeholder="Nombre atributo">

                            <label for="estado_secure">Porcentaje efectividad:</label>
                            <input type="number" id="%_efectiveness" name="atribute" class="form-control"
                                autocomplete="off" placeholder="Porcentaje para este atributo %...">

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="insertAtribute('{{ route('insertAtribute') }}')">Enviar</button>
                </div>
            </div>
        </div>
    </div>

</div>
