@extends('layouts.app')

@section('title', 'Nhập Điểm Thường Kỳ')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">Lọc dữ liệu</div>
        <div class="card-body">
            <form method="GET" action="{{ route('nhap-diem.index') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="dot">Đợt</label>
                        <select name="dot" id="dot" class="form-control">
                            <option value="">-- Chọn đợt --</option>
                            @foreach($dsDot as $dot)
                                <option value="{{ $dot->id }}" {{ request('dot') == $dot->id ? 'selected' : '' }}>
                                    {{ $dot->ten_dot }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="ma_lop">Lớp học phần</label>
                        <select name="ma_lop" id="ma_lop" class="form-control">
                            <option value="">-- Chọn lớp --</option>
                            @foreach($lopHocPhans as $lop)
                                <option value="{{ $lop->ma_lop }}" {{ request('ma_lop') == $lop->ma_lop ? 'selected' : '' }}>
                                    {{ $lop->ten_lop }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(isset($sinhViens) && $sinhViens->count() > 0)
        @include('NhapDiem.content', [
            'sinhViens' => $sinhViens,
            'lopHocPhans' => $lopHocPhans
        ])
    @else
        <div class="alert alert-warning">Không tìm thấy sinh viên phù hợp</div>
    @endif
</div>
@endsection
