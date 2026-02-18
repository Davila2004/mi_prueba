<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">📦 Lista de Productos</h1>

        <div class="alert alert-info d-flex align-items-center" role="alert">
    <img id="foto-cliente" src="" class="rounded-circle me-3" width="50" style="display:none;">
    <div>
        <strong>🏆 Cliente del Mes:</strong>
        <span id="nombre-cliente">Cargando...</span>
    </div>
</div>
        
        <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Producto</a>

        <div class="mb-3">
    <input type="text" id="buscador" class="form-control" placeholder="🔍 Escribe para buscar...">
</div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>Q. {{ $producto->precio }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE') <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar esto?')">
        Borrar
    </button>
</form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
    // 1. Buscamos la cajita y la tabla
    const input = document.getElementById('buscador');
    const filas = document.querySelectorAll('tbody tr');

    // 2. Escuchamos cuando escribes algo
    input.addEventListener('keyup', function(e) {
        const texto = e.target.value.toLowerCase(); // Lo que escribiste (en minúsculas)

        // 3. Recorremos cada fila para ver si coincide
        filas.forEach(fila => {
            const contenido = fila.innerText.toLowerCase();
            
            if (contenido.includes(texto)) {
                fila.style.display = ''; // Si coincide, se muestra
            } else {
                fila.style.display = 'none'; // Si no, se oculta
            }
        });
    });

    // --- CÓDIGO NUEVO PARA API ---
    // 1. Llamamos a una API gratuita de personas
    fetch('https://randomuser.me/api/')
        .then(response => response.json()) // Convertimos la respuesta a JSON
        .then(data => {
            // 2. Sacamos la información que nos interesa
            const persona = data.results[0];
            const nombre = persona.name.first + ' ' + persona.name.last;
            const foto = persona.picture.medium;

            // 3. Lo mostramos en pantalla
            document.getElementById('nombre-cliente').innerText = nombre;
            const img = document.getElementById('foto-cliente');
            img.src = foto;
            img.style.display = 'block'; // Hacemos visible la foto
        })
        .catch(error => console.log('Error:', error));
        
</script>

</body>
</html>