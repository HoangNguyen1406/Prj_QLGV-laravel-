@extends('layouts.app')

@section('title', 'Nhập Điểm Thường Kỳ')

@section('content')
    <div class="container">
        @if(isset($dsDot) && isset($lopHocPhans))
            @include('NhapDiem.content')
        @else
            <div class="alert alert-danger">Không có dữ liệu đợt/lớp học phần</div>
        @endif
    </div>
@endsection
