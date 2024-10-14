<div class="container-fluid">

    <div class="card card-primary">
        <div class="card-header" style="background-color: #0f318f">
            <h3 class="card-title">Mis labores asignadas</h3>
        </div>
        <div class="card-body">



            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Tareas</th>
                        <th>Acción</th>
                        <th style="width: 40px">Estado</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $flag = 1;
                    @endphp

                    @foreach ($sublabors as $sublabor)
                        <tr>
                            <td>{{ $flag }}</td>
                            <td>{{ $sublabor['nombre_sub_labor'] }}</td>
                            <td>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary{{ $sublabor['id_sub_labor'] }}"
                                        value="{{ $sublabor['id_sub_labor'] }}">
                                    <label
                                        for="checkboxPrimary{{ $sublabor['id_sub_labor'] }}">{{ $sublabor['nombre_sub_labor'] }}</label>
                                </div>
                            </td>
                            <td><span class="badge bg-warning">Pendiente</span></td>
                        </tr>

                        @php
                            $flag++;
                        @endphp
                    @endforeach

                </tbody>
            </table>




        </div>

    </div>


</div>
