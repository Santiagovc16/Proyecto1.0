@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Insumo</h2>

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

    <form action="{{ route('insumos.update', $insumo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Modelo del Vehículo</label>
            <select name="nombre" id="nombre" class="form-select" required>
                <option value="CX-30" {{ $insumo->nombre == 'CX-30' ? 'selected' : '' }}>CX-30</option>
                <option value="Sportage" {{ $insumo->nombre == 'Sportage' ? 'selected' : '' }}>Sportage</option>
                <option value="Fiesta" {{ $insumo->nombre == 'Fiesta' ? 'selected' : '' }}>Fiesta</option>
                <option value="F40" {{ $insumo->nombre == 'F40' ? 'selected' : '' }}>F40</option>
                <option value="Hilux" {{ $insumo->nombre == 'Hilux' ? 'selected' : '' }}>Hilux</option>
                <option value="Onix" {{ $insumo->nombre == 'Onix' ? 'selected' : '' }}>Onix</option>
                <option value="Serie 3" {{ $insumo->nombre == 'Serie 3' ? 'selected' : '' }}>Serie 3</option>
                <option value="Aventador SVJ" {{ $insumo->nombre == 'Aventador SVJ' ? 'selected' : '' }}>Aventador SVJ</option>
                <option value="Tucson" {{ $insumo->nombre == 'Tucson' ? 'selected' : '' }}>Tucson</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Año del Vehículo</label>
            <select name="descripcion" id="descripcion" class="form-select" required>
                <option value="año 1975" {{ $insumo->descripcion == 'año 1975' ? 'selected' : '' }}>1975</option>
                <option value="año 1987" {{ $insumo->descripcion == 'año 1987' ? 'selected' : '' }}>1987</option>
                <option value="año 2000" {{ $insumo->descripcion == 'año 2000' ? 'selected' : '' }}>2000</option>
                <option value="año 2012" {{ $insumo->descripcion == 'año 2012' ? 'selected' : '' }}>2012</option>
                <option value="año 2020" {{ $insumo->descripcion == 'año 2020' ? 'selected' : '' }}>2020</option>
                <option value="año 2021" {{ $insumo->descripcion == 'año 2021' ? 'selected' : '' }}>2021</option>
                <option value="año 2022" {{ $insumo->descripcion == 'año 2022' ? 'selected' : '' }}>2022</option>
                <option value="año 2023" {{ $insumo->descripcion == 'año 2023' ? 'selected' : '' }}>2023</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <select name="cantidad" id="cantidad" class="form-select" required>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" {{ $insumo->cantidad == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="marca">Marca</label>
            <select name="marca" id="marca" class="form-select" required>
                <option value="Mazda" {{ $insumo->marca == 'Mazda' ? 'selected' : '' }}>Mazda</option>
                <option value="Kia" {{ $insumo->marca == 'Kia' ? 'selected' : '' }}>Kia</option>
                <option value="Ford" {{ $insumo->marca == 'Ford' ? 'selected' : '' }}>Ford</option>
                <option value="Ferrari" {{ $insumo->marca == 'Ferrari' ? 'selected' : '' }}>Ferrari</option>
                <option value="Toyota" {{ $insumo->marca == 'Toyota' ? 'selected' : '' }}>Toyota</option>
                <option value="Chevrolet" {{ $insumo->marca == 'Chevrolet' ? 'selected' : '' }}>Chevrolet</option>
                <option value="BMW" {{ $insumo->marca == 'BMW' ? 'selected' : '' }}>BMW</option>
                <option value="Lamborghini" {{ $insumo->marca == 'Lamborghini' ? 'selected' : '' }}>Lamborghini</option>
                <option value="Hyundai" {{ $insumo->marca == 'Hyundai' ? 'selected' : '' }}>Hyundai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="disponible" {{ $insumo->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="prestado" {{ $insumo->estado == 'prestado' ? 'selected' : '' }}>Prestado</option>
                <option value="averiado" {{ $insumo->estado == 'averiado' ? 'selected' : '' }}>Averiado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('insumos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection