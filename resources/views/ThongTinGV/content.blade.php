@extends('layouts.app')

@section('content')
@if (isset($getInfo))
<div id="page-content">
    <div class="container my-5">
        <div class="card shadow-lg bg-dark text-light">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Thông tin giáo viên: <strong>{{ $getInfo->Name }}</strong></h4>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- ẢNH GIÁO VIÊN -->
                    <div class="col-md-4 text-center">
                        <img src="https://via.placeholder.com/250x300.png?text=Ảnh+giáo+viên"
                            alt="Ảnh giáo viên"
                            class="img-fluid rounded border border-light shadow-sm"
                            style="max-height: 300px; object-fit: cover;">
                    </div>

                    <!-- THÔNG TIN -->
                    <div class="col-md-8">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <strong>📞 Phone:</strong> {{ $getInfo->Phone }}
                            </div>
                            <div class="col-sm-6">
                                <strong>📧 Email:</strong> {{ $getInfo->Email }}
                            </div>
                            <div class="col-sm-6">
                                <strong>🎂 Năm sinh:</strong> {{ $getInfo->YearOfBirth }}
                            </div>
                            <div class="col-sm-6">
                                <strong>👤 Giới tính:</strong> {{ $getInfo->Gender }}
                            </div>
                            <div class="col-sm-6">
                                <strong>💼 Chức vụ:</strong> {{ $getInfo->Position }}
                            </div>
                            <div class="col-sm-6">
                                <strong>🏢 Phòng ban:</strong> {{ $getInfo->Department }}
                            </div>
                            <div class="col-12">
                                <strong>📍 Địa chỉ:</strong><br>
                                {{ $getInfo->Address }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
