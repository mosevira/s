@extends('layouts.sellerlayout')

@section('content')
<div class="container">
    <h2>Накладные</h2>

    @if($invoices->isEmpty())
        <div class="alert alert-info">Нет накладных для обработки</div>
    @else
        <table class="table">
            @foreach($invoices as $invoice)
            <tr>
                <td>Накладная #{{ $invoice->id }}</td>
                <td>{{ $invoice->created_at->format('d.m.Y') }}</td>
                <td>
                    <a href="{{ route('seller.invoices.show', $invoice) }}"
                       class="btn btn-sm btn-primary">
                       Просмотреть
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    @endif
</div>
@endsection
