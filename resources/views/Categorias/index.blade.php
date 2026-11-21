<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <main class="container-fluid py-4">
      <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
          <h1 class="h4 mb-0">Categorías</h1>

          <button class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#agregarCategoria">
            Agregar categoría
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

      <div class="modal fade" id="agregarCategoria" tabindex="-1"
           aria-labelledby="agregarCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <h2 class="modal-title fs-5" id="agregarCategoriaLabel">
                Agregar categoría
              </h2>

              <button class="btn-close" data-bs-dismiss="modal"
                      aria-label="Cerrar"></button>
            </div>

            <form action="{{ route('categorias.store') }}" method="POST">
              @csrf

              <div class="modal-body">
                <div class="mb-3">

                  <label class="form-label" for="nombreCategoria">Nombre</label>
                  <input id="nombreCategoria" name="nombre" class="form-control"
                         maxlength="80" value="{{ old('nombre') }}" required>

                </div>

                <div class="mb-3">

                  <label class="form-label" for="descripcionCategoria">Descripción</label>
                  <textarea id="descripcionCategoria" name="descripcion"
                            class="form-control" maxlength="255">{{ old('descripcion') }}</textarea>

                </div>

                <div class="mb-3">
                  <label class="form-label" for="estadoCategoria">Estado</label>
                  <select id="estadoCategoria" name="estado"
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
                  Guardar categoría
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
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>
          </thead>

          <tbody>
            @forelse ($categorias as $categoria)

              <tr>

                <th>{{ $categoria->id }}</th>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion ?: '—' }}</td>
                <td>{{ ucfirst($categoria->estado) }}</td>
                <td>

                  <button class="btn btn-warning btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#editarCategoria{{ $categoria->id }}">
                    Modificar
                  </button>

                  <button class="btn btn-danger btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#eliminarCategoria{{ $categoria->id }}">
                    Eliminar
                  </button>

                </td>
              </tr>

            @empty

              <tr>

                <td colspan="5" class="text-center">
                  No hay categorías registradas.
                </td>

              </tr>

            @endforelse

          </tbody>
        </table>
      </div>

      @foreach ($categorias as $categoria)

        <div class="modal fade" id="editarCategoria{{ $categoria->id }}" tabindex="-1"
             aria-labelledby="editarCategoriaLabel{{ $categoria->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                
                <h2 class="modal-title fs-5" id="editarCategoriaLabel{{ $categoria->id }}">
                  Modificar categoría
                </h2>
                
                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
              </div>

              <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                  <div class="mb-3">

                    <label class="form-label" for="nombreCategoria{{ $categoria->id }}">
                      Nombre
                    </label>

                    <input id="nombreCategoria{{ $categoria->id }}" name="nombre"
                           class="form-control" maxlength="80"
                           value="{{ old('nombre', $categoria->nombre) }}" required>

                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="descripcionCategoria{{ $categoria->id }}">
                      Descripción
                    </label>

                    <textarea id="descripcionCategoria{{ $categoria->id }}"
                              name="descripcion" class="form-control" maxlength="255">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="estadoCategoria{{ $categoria->id }}">
                      Estado
                    </label>

                    <select id="estadoCategoria{{ $categoria->id }}" name="estado"
                            class="form-select" required>

                      <option value="activo"
                              @selected(old('estado', $categoria->estado) === 'activo')>
                        Activo
                      </option>

                      <option value="inactivo"
                              @selected(old('estado', $categoria->estado) === 'inactivo')>
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

        <div class="modal fade" id="eliminarCategoria{{ $categoria->id }}" tabindex="-1"
             aria-labelledby="eliminarCategoriaLabel{{ $categoria->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h2 class="modal-title fs-5" id="eliminarCategoriaLabel{{ $categoria->id }}">
                  Eliminar categoría
                </h2>

                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>

              </div>

              <form action="{{ route('categorias.destroy', $categoria) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                  ¿Seguro que deseas eliminar la categoría
                  <strong>{{ $categoria->nombre }}</strong>? También se eliminarán sus productos asociados.
                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary"
                          data-bs-dismiss="modal">
                    Cancelar
                  </button>

                  <button class="btn btn-danger" type="submit">
                    Eliminar categoría
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
