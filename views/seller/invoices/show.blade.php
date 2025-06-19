@extends('layouts.sellerlayout')

@section('content')
<div class="container">
    <h2>Накладная #{{ $invoice->id }}</h2>

    <table class="table">
        @foreach($invoice->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }} шт.</td>
            <td>
                <form action="{{ route('seller.invoices.accept', $invoice) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Принять</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
