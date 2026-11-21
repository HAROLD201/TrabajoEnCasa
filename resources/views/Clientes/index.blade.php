<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>

  <body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
</body>

</html>


    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <form class="d-flex" role="search">

        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>

            </form>
        </div>
    </nav>

@error('record')
    
@enderror



    <div class="card w-75 mb-3">
    <div class="card-body">
    <h5 class="card-title">Agregar Cliente</h5>

    <button type="button" class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#AgregarCliente">
        Agregar
    </button>

    <div class="modal fade" id="AgregarCliente" tabindex="-1"
     aria-labelledby="AgregarClienteLabel" aria-hidden="true">

    <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title" id="AgregarClienteLabel">
            Agregar Cliente
        </h5>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

    </div>

            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                    <div class="modal-body">

                    <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text">Nombre Completo:</span>
                    <input type="text" name="nombre"
                           value="{{ old('nombre') }}"
                           class="form-control"
                           placeholder="Matteo Homenick" required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Código:</span>
                        <input type="text" name="codigo"
                               value="{{ old('codigo') }}"
                               class="form-control"
                               placeholder="CLI-0484" required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Email:</span>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               class="form-control"
                               placeholder="flatley.arden@example.org" required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Teléfono:</span>
                        <input type="tel" name="telefono"
                               value="{{ old('telefono') }}"
                               class="form-control"
                               placeholder="364-395-7653" required>
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Dirección:</span>
                        <input type="text" name="direccion"
                               value="{{ old('direccion') }}"
                               class="form-control"
                               placeholder="Boulevar Las Colinas" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado:</label>

                        <div class="d-flex gap-2">
                            <input type="radio" class="btn-check"
                                   name="estado" id="estadoActivo"
                                   value="Activo" checked>

                            <label class="btn btn-outline-success"
                                   for="estadoActivo">
                                Activo
                            </label>

                            <input type="radio" class="btn-check"
                                   name="estado" id="estadoInactivo"
                                   value="Inactivo">

                            <label class="btn btn-outline-danger"
                                   for="estadoInactivo">
                                Inactivo
                            </label>

                        </div>
                    </div>

                </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Guardar cliente
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>
        </div>
    @endif
    
        <table class="table">
    <thead>

        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Codigo</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Direccion</th>
            <th scope="col">Estado</th>
        </tr>
        
    </thead>

    <tbody>
         @forelse ($clientes as $cliente)

            <tr>
                <th scope="row">{{ $cliente->id }}</th>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->codigo }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->estado }}</td>

                <td>
                <button type="button" class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modificarcliente{{ $cliente->id }}">
                    Modificar
                </button>

                <button type="button" class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#eliminarCliente{{ $cliente->id }}">
                    Eliminar
                </button>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7">No hay clientes registrados</td>
            </tr>

        @endforelse

    </tbody>
</table>

    @foreach ($clientes as $cliente)

        <div class="modal fade" id="modificarcliente{{ $cliente->id }}" tabindex="-1"
         aria-labelledby="modificarclienteLabel{{ $cliente->id }}" aria-hidden="true">

        <div class="modal-dialog">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modificarcliente{{ $cliente->id }}">
                        Modificar cliente
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <form action="{{ route('clientes.update', $cliente) }}" method="PUT">
                    @csrf

                    <div class="modal-body">

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Nombre Completo:</span>
                            <input type="text" name="nombre"
                                   value="{{ old('nombre', $cliente->nombre) }}"
                                   class="form-control"
                                   placeholder="Matteo Homenick" required>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Código:</span>
                            <input type="text" name="codigo"
                                   value="{{ old('codigo', $cliente->codigo) }}"
                                   class="form-control"
                                   placeholder="CLI-0484" required>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Email:</span>
                            <input type="email" name="email"
                                   value="{{ old('email', $cliente->email) }}"
                                   class="form-control"
                                   placeholder="flatley.arden@example.org" required>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Teléfono:</span>
                            <input type="tel" name="telefono"
                                   value="{{ old('telefono', $cliente->telefono) }}"
                                   class="form-control"
                                   placeholder="364-395-7653" required>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Dirección:</span>
                            <input type="text" name="direccion"
                                   value="{{ old('direccion', $cliente->direccion) }}"
                                   class="form-control"
                                   placeholder="Boulevar Las Colinas" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado:</label>

                            <div class="d-flex gap-2">
                                <input type="radio" class="btn-check"
                                       name="estado" id="estadoActivo{{ $cliente->id }}"
                                       value="Activo"
                                       @checked(old('estado', $cliente->estado) === 'Activo')>

                                <label class="btn btn-outline-success"
                                       for="estadoActivo{{ $cliente->id }}">
                                    Activo
                                </label>

                                <input type="radio" class="btn-check"
                                       name="estado" id="estadoInactivo{{ $cliente->id }}"
                                       value="Inactivo"
                                       @checked(old('estado', $cliente->estado) === 'Inactivo')>

                                <label class="btn btn-outline-danger"
                                       for="estadoInactivo{{ $cliente->id }}">
                                    Inactivo
                                </label>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Guardar cambios
                        </button>
                    
                    </div>
                </form>

                </div>
            </div>
        </div>

        <div class="modal fade" id="eliminarCliente{{ $cliente->id }}" tabindex="-1"
         aria-labelledby="eliminarClienteLabel{{ $cliente->id }}" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    
                    <h5 class="modal-title" id="eliminarClienteLabel{{ $cliente->id }}">
                        Eliminar cliente
                    </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                
                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body">
                        ¿Estás seguro que deseas eliminar a {{ $cliente->nombre }}?
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-danger">
                            Eliminar cliente
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach

