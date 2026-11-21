<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <main class="container-fluid py-4">
      <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
          <h1 class="h4 mb-0">Empleados</h1>

          <button class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#agregarEmpleado">
            Agregar empleado
          </button>

        </div>
      </div>

      @if (session('success'))

        <div class="alert alert-success">
          {{ session('success') }}
        </div>

      @endif

      @if ($errors->any())

        <div class="alert alert-danger">
          <ul class="mb-0">

            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach

          </ul>
        </div>

      @endif

      <div class="modal fade" id="agregarEmpleado" tabindex="-1"
           aria-labelledby="agregarEmpleadoLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">

              <h2 class="modal-title fs-5" id="agregarEmpleadoLabel">
                Agregar empleado
              </h2>

              <button class="btn-close" data-bs-dismiss="modal"
                      aria-label="Cerrar"></button>

            </div>

            <form action="{{ route('empleados.store') }}" method="POST">
              @csrf

              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label" for="codigoEmpleado">Código</label>

                  <input id="codigoEmpleado" name="codigo" class="form-control"
                         maxlength="20" value="{{ old('codigo') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="nombreEmpleado">Nombre completo</label>

                  <input id="nombreEmpleado" name="nombre" class="form-control"
                         maxlength="100" value="{{ old('nombre') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="emailEmpleado">Email</label>

                  <input id="emailEmpleado" type="email" name="email"
                         class="form-control" maxlength="100"
                         value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="cargoEmpleado">Cargo</label>

                  <input id="cargoEmpleado" name="cargo" class="form-control"
                         maxlength="60" value="{{ old('cargo') }}" required>
                </div>

                <div class="mb-3">

                  <label class="form-label" for="fechaEmpleado">
                    Fecha de contratación
                  </label>

                  <input id="fechaEmpleado" type="date" name="fecha_contratacion"
                         class="form-control" value="{{ old('fecha_contratacion') }}"
                         required>

                </div>

                <div class="mb-3">
                  <label class="form-label" for="estadoEmpleado">Estado</label>
                  <select id="estadoEmpleado" name="estado"
                          class="form-select" required>

                    <option value="activo" @selected(old('estado', 'activo') === 'activo')>
                      Activo
                    </option>

                    <option value="inactivo" @selected(old('estado') === 'inactivo')>
                      Inactivo
                    </option>

                  </select>
                </div>
              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                  Cancelar
                </button>

                <button class="btn btn-primary" type="submit">
                  Guardar empleado
                </button>

              </div>
            </form>

          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">

          <thead>
            <tr>

              <th>#</th>
              <th>Código</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Cargo</th>
              <th>Fecha de contratación</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>
          </thead>

          <tbody>
            @forelse ($empleados as $empleado)
              <tr>

                <th>{{ $empleado->id }}</th>
                <td>{{ $empleado->codigo }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ $empleado->cargo }}</td>
                <td>{{ $empleado->fecha_contratacion->format('Y-m-d') }}</td>
                <td>{{ ucfirst($empleado->estado) }}</td>

                <td>

                    <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#editarEmpleado{{ $empleado->id }}">
                        Modificar
                    </button>

                  <button class="btn btn-danger btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#eliminarEmpleado{{ $empleado->id }}">
                    Eliminar
                  </button>

                </td>
              </tr>

            @empty
              
              <tr>
                <td colspan="8" class="text-center">
                  No hay empleados registrados.
                </td>
              </tr>

            @endforelse

          </tbody>
        </table>
      </div>

      @foreach ($empleados as $empleado)

        <div class="modal fade" id="editarEmpleado{{ $empleado->id }}" tabindex="-1"
             aria-labelledby="editarEmpleadoLabel{{ $empleado->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">

                <h2 class="modal-title fs-5" id="editarEmpleadoLabel{{ $empleado->id }}">
                  Modificar empleado
                </h2>

                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
              </div>

              <form action="{{ route('empleados.update', $empleado) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                  <div class="mb-3">

                    <label class="form-label" for="codigoEmpleado{{ $empleado->id }}">
                      Código
                    </label>

                    <input id="codigoEmpleado{{ $empleado->id }}" name="codigo"
                           class="form-control" maxlength="20"
                           value="{{ old('codigo', $empleado->codigo) }}" required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="nombreEmpleado{{ $empleado->id }}">
                      Nombre completo
                    </label>

                    <input id="nombreEmpleado{{ $empleado->id }}" name="nombre"
                           class="form-control" maxlength="100"
                           value="{{ old('nombre', $empleado->nombre) }}" required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="emailEmpleado{{ $empleado->id }}">
                      Email
                    </label>

                    <input id="emailEmpleado{{ $empleado->id }}" type="email"
                           name="email" class="form-control" maxlength="100"
                           value="{{ old('email', $empleado->email) }}" required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="cargoEmpleado{{ $empleado->id }}">
                      Cargo
                    </label>

                    <input id="cargoEmpleado{{ $empleado->id }}" name="cargo"
                           class="form-control" maxlength="60"
                           value="{{ old('cargo', $empleado->cargo) }}" required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="fechaEmpleado{{ $empleado->id }}">
                      Fecha de contratación
                    </label>

                    <input id="fechaEmpleado{{ $empleado->id }}" type="date"
                           name="fecha_contratacion" class="form-control"
                           value="{{ $empleado->fecha_contratacion->format('Y-m-d') }}"
                           required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="estadoEmpleado{{ $empleado->id }}">
                      Estado
                    </label>

                    <select id="estadoEmpleado{{ $empleado->id }}" name="estado"
                            class="form-select" required>

                      <option value="activo"
                              @selected(old('estado', $empleado->estado) === 'activo')>
                        Activo
                      </option>

                      <option value="inactivo"
                              @selected(old('estado', $empleado->estado) === 'inactivo')>
                        Inactivo
                      </option>

                    </select>
                  </div>
                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary"
                          data-bs-dismiss="modal">
                    Cancelar
                  </button>

                  <button class="btn btn-primary" type="submit">
                    Guardar cambios
                  </button>

                </div>
              </form>

            </div>
          </div>
        </div>

        <div class="modal fade" id="eliminarEmpleado{{ $empleado->id }}" tabindex="-1"
             aria-labelledby="eliminarEmpleadoLabel{{ $empleado->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">

                <h2 class="modal-title fs-5" id="eliminarEmpleadoLabel{{ $empleado->id }}">
                  Eliminar empleado
                </h2>

                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>

              </div>

              <form action="{{ route('empleados.destroy', $empleado) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                  ¿Seguro que deseas eliminar a <strong>{{ $empleado->nombre }}</strong>?
                  También se eliminarán sus pedidos asociados.
                </div>

                <div class="modal-footer">
                    
                  <button type="button" class="btn btn-secondary"
                          data-bs-dismiss="modal">
                    Cancelar
                  </button>

                  <button class="btn btn-danger" type="submit">
                    Eliminar empleado
                  </button>

                </div>
              </form>

            </div>
          </div>
        </div>

      @endforeach
      
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
