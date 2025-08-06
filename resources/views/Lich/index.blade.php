@extends('layouts.app')

@section('content')

<div id="page-content">
    <div class="container mt-4">
    <div class="card p-4 bg-dark text-white">
        <h3 class="mb-3">Lịch dạy theo tuần: {{ $startWeek }}</h3>

        <div class="d-flex gap-2 mb-4">
            <input type="date" class="form-control w-auto" value="{{ $now }}">
            <button class="btn btn-primary">Hiện tại</button>
            <button class="btn btn-secondary">Trở về</button>
            <button class="btn btn-secondary">Tiếp</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle bg-white rounded">
                <thead class="table-light">
                    <tr>
                        <th class="p-3">Các ngày</th>
                        <th class="p-3">
                            <span>Thứ 2</span><br>{{ $startWeek }}
                        </th>
                        @for ($i = 1; $i < 7; $i++)
                            <th class="p-3">
                                <span>Thứ {{ $i+2 }}</span><br>{{ $days[$i] }}
                            </th>
                        @endfor
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td class="p-3">Sáng</td>
                            @for ($i = 0; $i < 7; $i++)
                                <td class="p-3"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-3">Chiều</td>
                            @for ($i = 0; $i < 7; $i++)
                                <td class="p-3"></td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="p-3">Tối</td>
                            @for ($i = 0; $i < 7; $i++)
                                <td class="p-3"></td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection