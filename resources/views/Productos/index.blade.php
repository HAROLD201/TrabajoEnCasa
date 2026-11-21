<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <main class="container-fluid py-4">
      <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">

          <h1 class="h4 mb-0">Productos</h1>

          <button class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#agregarProducto">
            Agregar producto
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

      <div class="modal fade" id="agregarProducto" tabindex="-1"
           aria-labelledby="agregarProductoLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">

              <h2 class="modal-title fs-5" id="agregarProductoLabel">
                Agregar producto
              </h2>

              <button class="btn-close" data-bs-dismiss="modal"
                      aria-label="Cerrar"></button>
            </div>

            <form action="{{ route('productos.store') }}" method="POST">
              @csrf

              <div class="modal-body">
                <div class="mb-3">
                  
                  <label class="form-label" for="categoriaProducto">Categoría</label>
                  <select id="categoriaProducto" name="categoria_id"
                          class="form-select" required>

                    <option value="">Selecciona una categoría</option>

                    @foreach ($categorias as $categoria)

                      <option value="{{ $categoria->id }}"
                              @selected(old('categoria_id') == $categoria->id)>
                        {{ $categoria->nombre }}
                      </option>

                    @endforeach

                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="codigoProducto">Código</label>

                  <input id="codigoProducto" name="codigo" class="form-control"
                         maxlength="20" value="{{ old('codigo') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="nombreProducto">Nombre</label>

                  <input id="nombreProducto" name="nombre" class="form-control"
                         maxlength="100" value="{{ old('nombre') }}" required>
                </div>

                <div class="mb-3">

                  <label class="form-label" for="descripcionProducto">
                    Descripción
                  </label>

                  <textarea id="descripcionProducto" name="descripcion"
                            class="form-control" maxlength="255">{{ old('descripcion') }}</textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="precioProducto">Precio</label>

                  <input id="precioProducto" type="number" name="precio"
                         class="form-control" min="0" step="0.01"
                         value="{{ old('precio') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="stockProducto">Stock</label>

                  <input id="stockProducto" type="number" name="stock"
                         class="form-control" min="0" step="1"
                         value="{{ old('stock') }}" required>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="estadoProducto">Estado</label>

                  <select id="estadoProducto" name="estado"
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
                  Guardar producto
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
              <th>Categoría</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            @forelse ($productos as $producto)
              <tr>

                <th>{{ $producto->id }}</th>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                <td>{{ $producto->descripcion ?: '—' }}</td>
                <td>{{ number_format((float) $producto->precio, 2) }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ ucfirst($producto->estado) }}</td>

                <td>

                  <button class="btn btn-warning btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#editarProducto{{ $producto->id }}">
                    Modificar
                  </button>

                  <button class="btn btn-danger btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#eliminarProducto{{ $producto->id }}">
                    Eliminar
                  </button>
                  
                </td>
              </tr>

            @empty

              <tr>
                <td colspan="9" class="text-center">
                  No hay productos registrados.
                </td>
              </tr>
              
            @endforelse

          </tbody>
        </table>
      </div>

      @foreach ($productos as $producto)

        <div class="modal fade" id="editarProducto{{ $producto->id }}" tabindex="-1"
             aria-labelledby="editarProductoLabel{{ $producto->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">

                <h2 class="modal-title fs-5" id="editarProductoLabel{{ $producto->id }}">
                  Modificar producto
                </h2>

                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>

              </div>

              <form action="{{ route('productos.update', $producto) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                  <div class="mb-3">

                    <label class="form-label" for="categoriaProducto{{ $producto->id }}">
                      Categoría
                    </label>

                    <select id="categoriaProducto{{ $producto->id }}" name="categoria_id"
                            class="form-select" required>

                      @foreach ($categorias as $categoria)

                        <option value="{{ $categoria->id }}"
                                @selected(old('categoria_id', $producto->categoria_id) == $categoria->id)>
                          {{ $categoria->nombre }}
                        </option>

                      @endforeach

                    </select>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="codigoProducto{{ $producto->id }}">
                      Código
                    </label>

                    <input id="codigoProducto{{ $producto->id }}" name="codigo"
                           class="form-control" maxlength="20"
                           value="{{ old('codigo', $producto->codigo) }}" required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="nombreProducto{{ $producto->id }}">
                      Nombre
                    </label>

                    <input id="nombreProducto{{ $producto->id }}" name="nombre"
                           class="form-control" maxlength="100"
                           value="{{ old('nombre', $producto->nombre) }}" required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="descripcionProducto{{ $producto->id }}">
                      Descripción
                    </label>

                    <textarea id="descripcionProducto{{ $producto->id }}"
                              name="descripcion" class="form-control" maxlength="255">{{ old('descripcion', $producto->descripcion) }}</textarea>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="precioProducto{{ $producto->id }}">
                      Precio
                    </label>

                    <input id="precioProducto{{ $producto->id }}" type="number"
                           name="precio" class="form-control" min="0" step="0.01"
                           value="{{ old('precio', $producto->precio) }}" required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="stockProducto{{ $producto->id }}">
                      Stock
                    </label>

                    <input id="stockProducto{{ $producto->id }}" type="number"
                           name="stock" class="form-control" min="0" step="1"
                           value="{{ old('stock', $producto->stock) }}" required>
                  </div>

                  <div class="mb-3">

                    <label class="form-label" for="estadoProducto{{ $producto->id }}">
                      Estado
                    </label>

                    <select id="estadoProducto{{ $producto->id }}" name="estado"
                            class="form-select" required>

                      <option value="activo"
                              @selected(old('estado', $producto->estado) === 'activo')>
                        Activo
                      </option>

                      <option value="inactivo"
                              @selected(old('estado', $producto->estado) === 'inactivo')>
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

        <div class="modal fade" id="eliminarProducto{{ $producto->id }}" tabindex="-1"
             aria-labelledby="eliminarProductoLabel{{ $producto->id }}" aria-hidden="true">

          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">

                <h2 class="modal-title fs-5" id="eliminarProductoLabel{{ $producto->id }}">
                  Eliminar producto
                </h2>

                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
              </div>

              <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                  
                  ¿Seguro que deseas eliminar el producto
                  <strong>{{ $producto->nombre }}</strong>?

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary"
                          data-bs-dismiss="modal">
                    Cancelar
                  </button>

                  <button class="btn btn-danger" type="submit">
                    Eliminar producto
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
