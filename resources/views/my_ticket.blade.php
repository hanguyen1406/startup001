@extends('layouts.app')

@section('content')
<style>
    .table {

        height: 300px;
    }
</style>
<div class="container mt-5">
    <h2>Vé Của Tôi</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tour</th>
                <th>Ngày Đi</th>
                <th>Số Vé</th>
                <th>Trạng Thái Thanh Toán</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->travelPackage->name }}</td>
                <td>{{ $order->travel_date }}</td>
                <td>{{ $order->count }}</td>
                <td>
                    @if($order->payment_status == 0)
                        Chưa thanh toán
                    @else
                        Đã thanh toán
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
