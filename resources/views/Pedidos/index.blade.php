<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <main class="container-fluid py-4">
      <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
          <h1 class="h4 mb-0">Pedidos</h1>

          <button class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#agregarPedido">
            Agregar pedido
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

      <div class="modal fade" id="agregarPedido" tabindex="-1"
           aria-labelledby="agregarPedidoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">

              <h2 class="modal-title fs-5" id="agregarPedidoLabel">
                Agregar pedido
              </h2>

              <button class="btn-close" data-bs-dismiss="modal"
                      aria-label="Cerrar"></button>
            </div>

            <form action="{{ route('pedidos.store') }}" method="POST">
              @csrf

              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6 mb-3">

                    <label class="form-label" for="clientePedido">Cliente</label>
                    <select id="clientePedido" name="cliente_id"
                            class="form-select" required>

                      <option value="">Selecciona un cliente</option>

                      @foreach ($clientes as $cliente)

                        <option value="{{ $cliente->id }}"
                                @selected(old('cliente_id') == $cliente->id)>
                          {{ $cliente->nombre }}
                        </option>

                      @endforeach

                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="empleadoPedido">Empleado</label>
                    <select id="empleadoPedido" name="empleado_id"
                            class="form-select" required>

                      <option value="">Selecciona un empleado</option>

                      @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}"
                                @selected(old('empleado_id') == $empleado->id)>
                          {{ $empleado->nombre }}

                        </option>

                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="numeroPedido">Número de pedido</label>
                    <input id="numeroPedido" name="numero_pedido"
                           class="form-control" maxlength="20"
                           value="{{ old('numero_pedido') }}" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="fechaPedido">Fecha del pedido</label>
                    <input id="fechaPedido" type="date" name="fecha_pedido"
                           class="form-control" value="{{ old('fecha_pedido') }}"
                           required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="fechaEntrega">Fecha de entrega</label>
                    <input id="fechaEntrega" type="date" name="fecha_entrega"
                           class="form-control" value="{{ old('fecha_entrega') }}">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="totalPedido">Total</label>
                    <input id="totalPedido" type="number" name="total"
                           class="form-control" min="0" step="0.01"
                           value="{{ old('total', '0.00') }}" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="estadoPedido">Estado</label>
                    <select id="estadoPedido" name="estado"
                            class="form-select" required>

                      <option value="pendiente"
                              @selected(old('estado', 'pendiente') === 'pendiente')>
                        Pendiente
                      </option>

                      <option value="en_proceso" @selected(old('estado') === 'en_proceso')>
                        En proceso
                      </option>

                      <option value="completado" @selected(old('estado') === 'completado')>
                        Completado
                      </option>

                      <option value="cancelado" @selected(old('estado') === 'cancelado')>
                        Cancelado
                      </option>

                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="observacionesPedido">
                      Observaciones
                    </label>

                    <textarea id="observacionesPedido" name="observaciones"
                              class="form-control" maxlength="255">{{ old('observaciones') }}</textarea>

                  </div>
                </div>
              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                  Cancelar
                </button>

                <button class="btn btn-primary" type="submit">
                  Guardar pedido
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
              <th>Número</th>
              <th>Cliente</th>
              <th>Empleado</th>
              <th>Fecha</th>
              <th>Entrega</th>
              <th>Total</th>
              <th>Estado</th>
              <th>Observaciones</th>
              <th>Acciones</th>
              
            </tr>
          </thead>

          <tbody>

            @forelse ($pedidos as $pedido)
              <tr>

                <th>{{ $pedido->id }}</th>
                <td>{{ $pedido->numero_pedido }}</td>
                <td>{{ $pedido->cliente->nombre }}</td>
                <td>{{ $pedido->empleado->nombre }}</td>
                <td>{{ $pedido->fecha_pedido->format('Y-m-d') }}</td>
                <td>{{ $pedido->fecha_entrega?->format('Y-m-d') ?? '—' }}</td>
                <td>{{ number_format((float) $pedido->total, 2) }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}</td>
                <td>{{ $pedido->observaciones ?: '—' }}</td>
                <td>


                  <button class="btn btn-warning btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#editarPedido{{ $pedido->id }}">
                    Modificar
                  </button>


                  <button class="btn btn-danger btn-sm"
                          data-bs-toggle="modal"
                          data-bs-target="#eliminarPedido{{ $pedido->id }}">
                    Eliminar
                  </button>


                </td>
              </tr>

            @empty

              <tr>

                <td colspan="10" class="text-center">
                  No hay pedidos registrados.
                </td>

              </tr>

            @endforelse

          </tbody>
        </table>
      </div>

      @foreach ($pedidos as $pedido)

        <div class="modal fade" id="editarPedido{{ $pedido->id }}" tabindex="-1"
             aria-labelledby="editarPedidoLabel{{ $pedido->id }}" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">

                <h2 class="modal-title fs-5" id="editarPedidoLabel{{ $pedido->id }}">
                  Modificar pedido
                </h2>

                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
              </div>

              <form action="{{ route('pedidos.update', $pedido) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6 mb-3">

                      <label class="form-label" for="clientePedido{{ $pedido->id }}">
                        Cliente
                      </label>

                      <select id="clientePedido{{ $pedido->id }}" name="cliente_id"
                              class="form-select" required>

                        @foreach ($clientes as $cliente)
                          <option value="{{ $cliente->id }}"
                                  @selected(old('cliente_id', $pedido->cliente_id) == $cliente->id)>
                            {{ $cliente->nombre }}
                          </option>

                        @endforeach

                      </select>
                    </div>

                    <div class="col-md-6 mb-3">

                      <label class="form-label" for="empleadoPedido{{ $pedido->id }}">
                        Empleado
                      </label>

                      <select id="empleadoPedido{{ $pedido->id }}" name="empleado_id"
                              class="form-select" required>

                        @foreach ($empleados as $empleado)

                          <option value="{{ $empleado->id }}"
                                  @selected(old('empleado_id', $pedido->empleado_id) == $empleado->id)>
                            {{ $empleado->nombre }}

                          </option>

                        @endforeach

                      </select>
                    </div>

                    <div class="col-md-6 mb-3">

                      <label class="form-label" for="numeroPedido{{ $pedido->id }}">
                        Número de pedido
                      </label>

                      <input id="numeroPedido{{ $pedido->id }}" name="numero_pedido"
                             class="form-control" maxlength="20"
                             value="{{ old('numero_pedido', $pedido->numero_pedido) }}"
                             required>
                    </div>

                    <div class="col-md-6 mb-3">

                      <label class="form-label" for="fechaPedido{{ $pedido->id }}">
                        Fecha del pedido
                      </label>

                      <input id="fechaPedido{{ $pedido->id }}" type="date"
                             name="fecha_pedido" class="form-control"
                             value="{{ $pedido->fecha_pedido->format('Y-m-d') }}"
                             required>

                    </div>

                    <div class="col-md-6 mb-3">

                      <label class="form-label" for="fechaEntrega{{ $pedido->id }}">
                        Fecha de entrega
                      </label>

                      <input id="fechaEntrega{{ $pedido->id }}" type="date"
                             name="fecha_entrega" class="form-control"
                             value="{{ $pedido->fecha_entrega?->format('Y-m-d') }}">
                    </div>

                    <div class="col-md-6 mb-3">

                      <label class="form-label" for="totalPedido{{ $pedido->id }}">
                        Total
                      </label>

                      <input id="totalPedido{{ $pedido->id }}" type="number"
                             name="total" class="form-control" min="0" step="0.01"
                             value="{{ old('total', $pedido->total) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">

                      <label class="form-label" for="estadoPedido{{ $pedido->id }}">
                        Estado
                      </label>

                      <select id="estadoPedido{{ $pedido->id }}" name="estado"
                              class="form-select" required>

                        <option value="pendiente"
                                @selected(old('estado', $pedido->estado) === 'pendiente')>
                          Pendiente
                        </option>

                        <option value="en_proceso"
                                @selected(old('estado', $pedido->estado) === 'en_proceso')>
                          En proceso
                        </option>

                        <option value="completado"
                                @selected(old('estado', $pedido->estado) === 'completado')>
                          Completado
                        </option>

                        <option value="cancelado"
                                @selected(old('estado', $pedido->estado) === 'cancelado')>
                          Cancelado
                        </option>

                      </select>
                    </div>

                    <div class="col-md-6 mb-3">

                      <label class="form-label" for="observacionesPedido{{ $pedido->id }}">
                        Observaciones
                      </label>

                      <textarea id="observacionesPedido{{ $pedido->id }}"
                                name="observaciones" class="form-control" maxlength="255">{{ old('observaciones', $pedido->observaciones) }}</textarea>

                    </div>
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

        <div class="modal fade" id="eliminarPedido{{ $pedido->id }}" tabindex="-1"
             aria-labelledby="eliminarPedidoLabel{{ $pedido->id }}" aria-hidden="true">

          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">

                <h2 class="modal-title fs-5" id="eliminarPedidoLabel{{ $pedido->id }}">
                  Eliminar pedido
                </h2>

                <button class="btn-close" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
              </div>

              <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                  ¿Seguro que deseas eliminar el pedido
                  <strong>{{ $pedido->numero_pedido }}</strong>?
                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary"
                          data-bs-dismiss="modal">
                    Cancelar
                  </button>

                  <button class="btn btn-danger" type="submit">
                    Eliminar pedido
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
