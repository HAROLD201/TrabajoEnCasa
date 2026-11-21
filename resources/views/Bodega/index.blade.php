<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bodega</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  </head>
  <body>

    <main class="container-fluid py-4 text-start">
      <h1 class="mb-4">Bodegas</h1>

      @if (session('success'))
      
        <div class="alert alert-success" role="alert">
          {{ session('success') }}
        </div>

      @endif

      <div class="mb-3">

        <button type="button" class="btn btn-primary"
                data-bs-toggle="modal" data-bs-target="#agregarBodega">
          Agregar

        </button>
      </div>

      <div class="modal fade" id="agregarBodega" tabindex="-1"
           aria-labelledby="agregarBodegaLabel" aria-hidden="true">

        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="agregarBodegaLabel">Agregar Bodega</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <form action="{{ route('bodegas.store') }}" method="POST">
              @csrf

              <div class="modal-body">
                <div class="mb-3">

                  <label for="nombreBodega" class="form-label">Nombre</label>
                  <input type="text" name="nombre" id="nombreBodega" class="form-control"
                         value="{{ old('nombre') }}" required>

                </div>

                <div class="mb-3">

                  <label for="codigoBodega" class="form-label">Código</label>
                  <input type="text" name="codigo" id="codigoBodega" class="form-control"
                         value="{{ old('codigo') }}" required>

                </div>

                <div class="mb-3">

                  <label for="descripcionBodega" class="form-label">Descripción</label>
                  <textarea name="descripcion" id="descripcionBodega" class="form-control"
                            rows="3">{{ old('descripcion') }}</textarea>

                </div>
              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Bodega</button>

              </div>
            </form>
          </div>

        </div>
      </div>

      <div class="table-responsive text-start">
            <table class="table text-start">
          <thead class="table-dark">

            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Código</th>
              <th scope="col">Descripción</th>
              <th scope="col">Acciones</th>
            </tr>

          </thead>

          <tbody>
            @forelse ($bodegas as $bodega)

              <tr>

                <th scope="row">{{ $bodega->id }}</th>
                <td>{{ $bodega->nombre }}</td>
                <td>{{ $bodega->codigo }}</td>
                <td>{{ $bodega->descripcion }}</td>
                <td>

                  <button type="button" class="btn btn-warning btn-sm"
                          data-bs-toggle="modal" data-bs-target="#modificarBodega{{ $bodega->id }}">
                    Modificar
                  </button>

                  <button type="button" class="btn btn-danger btn-sm"
                          data-bs-toggle="modal" data-bs-target="#eliminarBodega{{ $bodega->id }}">
                    Eliminar
                  </button>

                </td>
              </tr>

            @empty

              <tr>
                <td colspan="5">No hay bodegas registradas</td>
              </tr>

            @endforelse

          </tbody>
        </table>
      </div>

      @foreach ($bodegas as $bodega)

        <div class="modal fade" id="modificarBodega{{ $bodega->id }}" tabindex="-1"
             aria-labelledby="modificarBodegaLabel{{ $bodega->id }}" aria-hidden="true">

          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h5 class="modal-title" id="modificarBodegaLabel{{ $bodega->id }}">Modificar Bodega</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              </div>

              <form action="{{ route('bodegas.update', $bodega) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                  <div class="mb-3">
                    <label for="nombreBodega{{ $bodega->id }}" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombreBodega{{ $bodega->id }}" class="form-control"
                           value="{{ $bodega->nombre }}" required>

                  </div>
                  <div class="mb-3">
                    <label for="codigoBodega{{ $bodega->id }}" class="form-label">Código</label>
                    <input type="text" name="codigo" id="codigoBodega{{ $bodega->id }}" class="form-control"
                           value="{{ $bodega->codigo }}" required>

                  </div>
                  <div class="mb-3">
                    <label for="descripcionBodega{{ $bodega->id }}" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcionBodega{{ $bodega->id }}" class="form-control"
                              rows="3">{{ $bodega->descripcion }}</textarea>

                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>
              </form>
            </div>

          </div>
        </div>

        <div class="modal fade" id="eliminarBodega{{ $bodega->id }}" tabindex="-1"
             aria-labelledby="eliminarBodegaLabel{{ $bodega->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="eliminarBodegaLabel{{ $bodega->id }}">Eliminar Bodega</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <form action="{{ route('bodegas.destroy', $bodega) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                  ¿Estás seguro que deseas eliminar esta bodega?
                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-danger">Eliminar</button>

                </div>
              </form>
            </div>

          </div>
        </div>

      @endforeach

    </main>

</body>

</html>