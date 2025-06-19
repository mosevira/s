@extends('layouts.sellerlayout')

@section('content')
<div class="container">
    <h2>Списание товара</h2>

    <form method="POST" action="{{ route('seller.products.writeOff') }}">
        @csrf
        <div class="form-group">
            <label>Выберите товар:</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Количество:</label>
            <input type="number" name="quantity" class="form-control" required min="1">
        </div>

        <div class="form-group">
            <label>Причина списания:</label>
            <textarea name="reason" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-danger">Списать</button>
    </form>
</div>
@endsection
