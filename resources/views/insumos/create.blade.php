@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Agregar Insumo</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Corrige los siguientes errores:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('insumos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Modelo del Vehículo</label>
            <select name="nombre" id="nombre" class="form-select" required>
                <option value="" disabled selected>Selecciona un vehículo</option>
                @foreach($modelos as $modelo)
                    <option value="{{ $modelo->nombre }}" {{ $modelo->registrados >= $modelo->stock_maximo ? 'disabled' : '' }}>
                        {{ $modelo->nombre }} ({{ $modelo->stock_maximo - $modelo->registrados }} disponibles)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <select name="marca" id="marca" class="form-select" required>
                <option value="" disabled selected>Selecciona una marca</option>
                <option value="Mazda">Mazda</option>
                <option value="Kia">Kia</option>
                <option value="Ford">Ford</option>
                <option value="Ferrari">Ferrari</option>
                <option value="Toyota">Toyota</option>
                <option value="Chevrolet">Chevrolet</option>
                <option value="BMW">BMW</option>
                <option value="Lamborghini">Lamborghini</option>
                <option value="Hyundai">Hyundai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Año del Vehículo</label>
            <select name="descripcion" id="descripcion" class="form-select" required>
                <option value="" disabled selected>Selecciona el año</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <select name="cantidad" id="cantidad" class="form-select" required>
                <option value="" disabled selected>Selecciona la cantidad</option>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="disponible">Disponible</option>
                <option value="prestado">Prestado</option>
                <option value="averiado">Averiado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Insumo</button>
        <a href="{{ route('insumos.index') }}" class="btn btn-secondary">Cancelar</a>

        <script>
            const modeloMarcaMap = {
                'CX-30': 'Mazda',
                'Sportage': 'Kia',
                'Fiesta': 'Ford',
                'F40': 'Ferrari',
                'Hilux': 'Toyota',
                'Onix': 'Chevrolet',
                'Serie 3': 'BMW',
                'Aventador SVJ': 'Lamborghini',
                'Tucson': 'Hyundai'
            };

            const modeloSelect = document.getElementById('nombre');
            const marcaSelect = document.getElementById('marca');
            const form = document.querySelector('form');

            modeloSelect.addEventListener('change', function () {
                const modelo = this.value;
                const marca = modeloMarcaMap[modelo];
                if (marca) {
                    marcaSelect.value = marca;
                }
            });

            form.addEventListener('submit', function (e) {
                const modelo = modeloSelect.value;
                const marcaEsperada = modeloMarcaMap[modelo];
                const marcaSeleccionada = marcaSelect.value;

                if (marcaEsperada && marcaSeleccionada !== marcaEsperada) {
                    alert('⚠️ La marca seleccionada no coincide con el modelo de vehículo. Asegúrate de verificar que sea correcto.');
                    // No cancelamos el submit
                }
            });
        </script>
    </form>
</div>
@endsection