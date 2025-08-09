<div id="page-content">
    <div class="card bg-dark text-white">
        <div class="card-header">Nhập điểm thường kỳ</div>
        <div class="card-body">
            <form id="filter-form" method="GET" action="{{ route('nhap-diem.index') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="dot" class="form-label">Đợt <span class="text-danger">*</span></label>
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
                        <label for="mon_hoc" class="form-label">Môn học</label>
                        <input type="text" name="mon_hoc" id="mon_hoc" class="form-control" value="{{ request('mon_hoc') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="lop_hoc" class="form-label">Lớp học</label>
                        <input type="text" name="lop_hoc" id="lop_hoc" class="form-control" value="{{ request('lop_hoc') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="ma_lop_hoc_phan" class="form-label">Mã lớp học phần</label>
                        <input type="text" name="ma_lop_hoc_phan" id="ma_lop_hoc_phan" class="form-control" value="{{ request('ma_lop_hoc_phan') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-danger">Tìm kiếm</button>
            </form>
        </div>
    </div>

    <div class="mt-3 text-danger">Quy ước cột điểm: TT04-2022</div>

    @if(!empty($sinhViens) && count($sinhViens) > 0)
        <div class="mt-3 card bg-dark text-white">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Thông tin sinh viên</span>
                <div>
                    <button class="btn btn-primary btn-sm me-1">Lưu điểm</button>
                    <button class="btn btn-warning btn-sm me-1">Nhập bằng Excel</button>
                    <button class="btn btn-info btn-sm me-1">Khóa điểm & Xét điều kiện dự thi</button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-dark mb-0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>LHP- [{{ $lopHocPhan->id ?? '' }}] - {{ $lopHocPhan->ten_lop ?? '' }}</th>
                            <th colspan="3" class="text-center">Thông tin sinh viên</th>
                            <th colspan="6" class="text-center">Thường xuyên 40%</th>
                            <th>Được dự thi</th>
                            <th>Thực hành</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Mã sinh viên</th>
                            <th>Họ đệm</th>
                            <th>Tên</th>
                            <th>Giới tính</th>
                            <th>Lớp học</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sinhViens as $index => $sv)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sv->mssv }}</td>
                                <td>{{ $sv->ho_dem }}</td>
                                <td>{{ $sv->ten }}</td>
                                <td>{{ $sv->gioi_tinh }}</td>
                                <td>{{ $sv->lop_hoc }}</td>
                                <td><!-- điểm thường xuyên cột 1 --></td>
                                <td><!-- điểm thường xuyên cột 2 --></td>
                                <td><!-- điểm thường xuyên cột 3 --></td>
                                <td><!-- điểm thường xuyên cột 4 --></td>
                                <td><!-- điểm thường xuyên cột 5 --></td>
                                <td><!-- điểm thường xuyên cột 6 --></td>
                                <td>
                                    <input type="checkbox" name="duoc_du_thi[{{ $sv->id }}]" value="1" />
                                </td>
                                <td>
                                    <input type="checkbox" name="thuc_hanh[{{ $sv->id }}]" value="1" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
