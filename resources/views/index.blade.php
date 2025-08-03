@extends('layouts.app')
@section('content')
    <div id="contain-index">
        <div class="block">
            <p>Số lượng thông báo</p>
            <p style="color: #ff5050">5</p>
        </div>
        <div class="block">
            <p>Số lượng lớp quản lý</p>
            <p style="color: #ff5050">5</p>
        </div>
        <div class="block">
            <p>Số lượng ??</p>
            <p style="color: #ff5050">5</p>
        </div>
        <div class="block">
            <p>Số lượng ??</p>
            <p style="color: #ff5050">5</p>
        </div>
        <div class="block">
            <p>Số lượng ??</p>
            <p style="color: #ff5050">5</p>
        </div>
    </div>
@endsection

<style>
#contain-index{
    display: grid;
    gap: 10px;
    grid-template-columns: 1fr 1fr 1fr;
}
.block{
    align-content: center;
    text-align: center;
    width: 100%;
    height: 100%;
    border: 3px #444 solid;
}
</style>