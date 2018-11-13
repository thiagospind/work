@extends('layout.app',["current" => "categorias"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/categorias/{{$cat->id}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nomeCategoria">Nome da Categoria</label>
                    <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria" value="{{$cat->nome}}"
                           placeholder="Categoria">
                </div>
                <button type="submit" class="btn-primary btn-sm">Salvar</button>
                <button type="button" class="btn-danger btn-sm">Cancel</button>
            </form>
        </div>
    </div>
@endsection
