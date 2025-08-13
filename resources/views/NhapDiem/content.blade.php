<form method="POST" action="{{ route('nhap-diem.store') }}">
    @csrf
    <input type="hidden" name="lop_hoc_phan_id"
        value="{{ optional($lopHocPhans->firstWhere('ma_lop', request('ma_lop')))->id }}">

    <div class="card">
        <div class="card-header">Danh sách sinh viên</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">STT</th>
                        <th>MSSV</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Lớp</th>
                        <th style="width: 120px;">Điểm hệ số 1</th>
                        <th style="width: 120px;">Điểm hệ số 2</th>
                        <th style="width: 140px;">Điểm thực hành</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sinhViens as $index => $sv)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $sv->mssv }}<input type="hidden" name="mssv[]" value="{{ $sv->mssv }}"></td>
                        <td>{{ $sv->Name }}</td>
                        <td>{{ $sv->Gender }}</td>
                        <td>{{ $sv->Classroom }}</td>
                        <td><input type="number" step="0.01" name="diem_he_so_1[]" value="{{ optional($sv->diem)->diem_he_so_1 }}" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="diem_he_so_2[]" value="{{ optional($sv->diem)->diem_he_so_2 }}" class="form-control form-control-sm"></td>
                        <td><input type="number" step="0.01" name="diem_thuc_hanh[]" value="{{ optional($sv->diem)->diem_thuc_hanh }}" class="form-control form-control-sm"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success">Lưu điểm</button>
        </div>
    </div>
</form>
