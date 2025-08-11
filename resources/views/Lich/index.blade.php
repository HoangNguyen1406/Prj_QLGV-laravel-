@extends('layouts.app')

@section('content')
    <div id="page-content">
        <div class="contain container mt-4">
            <div class="card p-4 bg-dark text-white">
                <h3 class="mb-3">Lịch dạy theo tuần: <span></span></h3>

                <div class="function d-flex gap-2 mb-4">
                    <input type="date" class="form-control w-auto" value="">
                    <button class="btn btn-primary">Hiện tại</button>
                    <button class="btn btn-secondary">Trở về</button>
                    <button class="btn btn-secondary" onclick="btnNext()">Tiếp</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle text-white rounded">
                        <thead style="background-color: #1f1f2e;" class="text-white">
                            <tr>
                                <th class="p-3">Ca học</th>
                                @for ($i = 2; $i <= 8; $i++)
                                    @if ($i == 8)
                                        <th class="p-3">
                                            <span>Chủ nhật</span><br><span></span>
                                        </th>
                                        @break
                                    @endif
                                    <th class="p-3">
                                        <span>Thứ {{ $i }}</span><br><span></span>
                                    </th>
                                @endfor
                                {{-- <th class="p-3">
                                    <span>Thứ 2</span><br>{{ $startWeek }}
                                </th>
                                {{-- --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (['Sáng', 'Chiều', 'Tối'] as $session)
                                <tr>
                                    <td class="p-3">{{ $session }}</td>
                                    @for ($i = 0; $i < 7; $i++)
                                        <td class="p-3">

                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        if (document.querySelector('.contain')) {
            const dataList = @json($lichday);
            const datePicker = document.querySelector('.function input');
            const now = new Date();
            //hiển thị ngày theo thứ trong tuần
            function dayOfWeek(now) {
                const monday = new Date(now);
                monday.setDate(monday.getDate() - ((monday.getDay() + 6) % 7));
                document.querySelectorAll('table th').forEach((day, index) => {
                    if (index > 1) {
                        monday.setDate(monday.getDate() + 1);
                    }
                    const d = String(monday.getDate()).padStart(2, '0');
                    const m = String(monday.getMonth() + 1).padStart(2, '0');
                    const y = monday.getFullYear();
                    datePicker.value = `${y}-${m}-${d}`;
                    day.querySelectorAll('span').forEach((span, index) => {
                        if (index > 0)
                            span.innerHTML = `${d}/${m}/${y}`;
                    });
                });
            }
            dayOfWeek(now);
            //thay đổi theo lịch
            datePicker.addEventListener('change', () => {
                const getDate = new Date(datePicker.value);
                dayOfWeek(getDate);
                dataWeek();
            });

            const dateBtn = document.querySelectorAll('.function button');
            dateBtn.forEach((btn, index) => {
                //--
                if (index == 0) btn.addEventListener('click',()=>{
                    const d = String(now.getDate()).padStart(2, '0');
                    const m = String(now.getMonth() + 1).padStart(2, '0');
                    const y = now.getFullYear();
                    datePicker.value = `${y}-${m}-${d}`;
                    dayOfWeek(datePicker.value);
                    dataWeek();
                });
                //--
                if(index == 1) btn.addEventListener('click',()=>{
                    getBack = new Date(datePicker.value);
                    getBack.setDate(getBack.getDate()-7);
                    const d = String(getBack.getDate()).padStart(2, '0');
                    const m = String(getBack.getMonth() + 1).padStart(2, '0');
                    const y = getBack.getFullYear();
                    datePicker.value = `${y}-${m}-${d}`;
                    dayOfWeek(datePicker.value);
                    dataWeek();
                });
                if(index == 2) btn.addEventListener('click',()=>{
                    getNext = new Date(datePicker.value);
                    getNext.setDate(getNext.getDate()+7);
                    const d = String(getNext.getDate()).padStart(2, '0');
                    const m = String(getNext.getMonth() + 1).padStart(2, '0');
                    const y = getNext.getFullYear();
                    datePicker.value = `${y}-${m}-${d}`;
                    dayOfWeek(datePicker.value);
                    dataWeek();
                });
            })

            //--xử lí data từ controller vào lịch
            function dataWeek() {
                let ngay = [];
                document.querySelectorAll('table th').forEach((th, index) => {
                    th.querySelectorAll('span').forEach((span, index) => {
                        if (index != 0) {
                            const get = span.textContent.trim();
                            const parts = get.split('/');
                            ngay.push(`${parts[2]}-${parts[1]}-${parts[0]}`);
                        }
                    });
                });
                document.querySelectorAll('table tr').forEach((tr, index) => {
                    let first = '';
                    tr.querySelectorAll('td').forEach((td, index) => {
                        if (index == 0)
                            first = td.textContent.trim();
                        else {
                            const today = dataList[ngay[index - 1]]?.[first];
                            if (today) {
                                td.innerHTML =
                                `
                                <div style="border: 1px black solid; padding:5px; border-radius:5px">
                                Lớp: ${today[0].LopHoc}<br/>
                                Môn: ${today[0].MonHoc}<br/>
                                Phòng học: ${today[0].PhongHoc}<br/>
                                Số tiết: ${today[0].SoTiet}<br/>
                                GV: ${today[0].NguoiDay}<br/>
                                </div>
                                `;
                            }
                            else{
                                td.innerHTML = "";
                            }
                        }
                    });
                });
            }
            dataWeek();
        }
    </script>
@endsection