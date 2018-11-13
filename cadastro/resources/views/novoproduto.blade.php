@extends('layout.app',["current" => "produtos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos" method="post">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do Produto</label>
                    <input type="text" class="form-control" name="nomeProduto" id="nomeProduto"
                           placeholder="Produto">
                    <label for="precoProduto">Preço</label>
                    <input type="text" class="form-control" name="precoProduto" id="precoProduto"
                           placeholder="Preço">
                    <label for="estoqueProduto">Estoque</label>
                    <input type="text" class="form-control" name="estoqueProduto" id="estoqueProduto"
                           placeholder="Estoque">
                    <label for="estoqueProduto">Categoria</label>
                    <select class="custom-select mr-sm-2" id="categoriaProduto" name="categoriaProduto">
                        @foreach($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-primary btn-sm">Salvar</button>
                <button type="button" class="btn-danger btn-sm">Cancel</button>
            </form>
        </div>
    </div>
@endsection
