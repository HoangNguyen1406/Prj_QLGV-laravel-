@extends('layouts.app')

@section('content')
<div id="page-content">
    <div class="container my-5">
        <div class="card shadow-lg bg-dark text-light">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Thông tin giáo viên: <strong>Đậu Đoàn Hải</strong></h4>
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
                                <strong>📞 Phone:</strong> (84) (54)952-9892
                            </div>
                            <div class="col-sm-6">
                                <strong>📧 Email:</strong> tcung@example.org
                            </div>
                            <div class="col-sm-6">
                                <strong>🎂 Năm sinh:</strong> 1995
                            </div>
                            <div class="col-sm-6">
                                <strong>👤 Giới tính:</strong> Nam
                            </div>
                            <div class="col-sm-6">
                                <strong>💼 Chức vụ:</strong> Tổ Trưởng Bộ Môn
                            </div>
                            <div class="col-sm-6">
                                <strong>🏢 Phòng ban:</strong> Chuyên Viên Hành Chính
                            </div>
                            <div class="col-12">
                                <strong>📍 Địa chỉ:</strong><br>
                                8, Ấp 8, Phường Phú Bộ, Huyện Trụ Thịnh, Ninh Bình
                            </div>
                            <div class="col-sm-6">
                                <strong>📅 Ngày tạo:</strong> 2025-08-02 04:24:33
                            </div>
                            <div class="col-sm-6">
                                <strong>🕒 Cập nhật:</strong> 2025-08-02 04:24:33
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection