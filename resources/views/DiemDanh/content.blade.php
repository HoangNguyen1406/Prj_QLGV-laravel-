{{-- resources/views/DiemDanh/index.blade.php --}}
<div id="page-content">
    <div class="card bg-dark text-white">
        <div class="card-header">Thông tin điểm danh</div>
        <div class="card-body">
            <form id="filter-form" method="GET" action="{{ route('diem-danh.index') }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="dot" class="form-label">Chọn đợt</label>
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
                        <label for="ngay" class="form-label">Chọn ngày</label>
                        <input type="date" name="ngay" id="ngay" class="form-control" value="{{ request('ngay') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="lop_hoc_phan" class="form-label">Chọn lớp học phần</label>
                        <select name="lop_hoc_phan" id="lop_hoc_phan" class="form-control">
                            <option value="">-- Chọn lớp học phần --</option>
                            @foreach($dsLopHocPhan as $lhp)
                                <option value="{{ $lhp->id }}" {{ request('lop_hoc_phan') == $lhp->id ? 'selected' : '' }}>
                                    {{ $lhp->ten_lop }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lọc</button>
            </form>
        </div>
    </div>

    @if(!empty($sinhViens))
        <div class="mt-4 card bg-dark text-white">
            <div class="card-header">Thông tin sinh viên</div>
            <div class="card-body">
                <form action="{{ route('diem-danh.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ngay" value="{{ $ngay }}">
                    <input type="hidden" name="dot" value="{{ $dot }}">
                    <input type="hidden" name="lopHocPhan" value="{{ $lopHocPhan }}">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã SV</th>
                                <th>Họ tên</th>
                                <th>Trạng thái</th>
                                <th>Số tiết</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sinhViens as $index => $sv)
                                @php
                                    $diemDanh = $diemDanhData[$sv->id] ?? null;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sv->mssv  }}</td>
                                    <td>{{ $sv->Name }}</td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="trang_thai[{{ $sv->id }}]" value="co_mat"
                                                {{ $diemDanh && $diemDanh->co_mat ? 'checked' : '' }}>
                                            <label class="form-check-label">Có mặt</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="trang_thai[{{ $sv->id }}]" value="vang_co_phep"
                                                {{ $diemDanh && $diemDanh->vang_co_phep ? 'checked' : '' }}>
                                            <label class="form-check-label">Vắng có phép</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="trang_thai[{{ $sv->id }}]" value="vang_khong_phep"
                                                {{ $diemDanh && $diemDanh->vang_khong_phep ? 'checked' : '' }}>
                                            <label class="form-check-label">Vắng không phép</label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="nhap_so_tiet[{{ $sv->id }}]" class="form-control"
                                            value="{{ $diemDanh->nhap_so_tiet ?? 1 }}">
                                    </td>
                                    <td>
                                        <input type="text" name="ghi_chu[{{ $sv->id }}]" class="form-control"
                                            value="{{ $diemDanh->ghi_chu ?? '' }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Lưu điểm danh</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
