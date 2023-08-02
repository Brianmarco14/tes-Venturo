@extends('index')
@section('content')
<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-header">
            Venturo - Laporan penjualan tahunan per menu
        </div>
        <div class="card-body">
            <form action="{{ route('ambildata') }}" method="POST">
                <div class="container-fluid d-flex flex-row">
                    <div class="">
                        @csrf
                        <select name="tahun" class="form-select" aria-label="Default select example">
                            <option selected disabled>Pilih Tahun</option>
                            <option value="2021" @selected($tahun == 2021)>2021</option>
                            <option value="2022" @selected($tahun == 2022)>2022</option>
                        </select>
                    </div>
                    <div class="ms-4">
                        <button type="submit" class="btn btn-primary ms-3">Tampilkan</button>
                    </div>
                    @isset($data)
                        <div class="">
                            <a href="http://tes-web.landa.id/intermediate/menu" class="btn btn-secondary ms-1">JSON Menu</a>
                        </div>
                        <div class="">
                            <a href="{{ url('http://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun) }}" class="btn btn-secondary ms-1">JSON Transaksi</a>
                        </div>
                        <div class="">
                            <a href="{{ route('download') }}" class="btn btn-secondary ms-1">Download Example</a>
                        </div>
                    @endisset
                </div>
            </form>

            <hr>

            @isset($data)
            <div class="container-fluid">
                <table class="table table-bordered fs-6">
                    <thead>
                        <tr class="table-dark">
                            <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;font-size:11px;">
                                Menu</th>
                            <th colspan="12" style="text-align: center;font-size:11px;">Periode Pada {{ $tahun }}</th>
                            <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px;font-size:11px;">Total
                            </th>
                        </tr>
                        <tr class="table-dark" style="font-size: 11px">
                            <th style="text-align: center;width: 75px;">Jan</th>
                            <th style="text-align: center;width: 75px;">Feb</th>
                            <th style="text-align: center;width: 75px;">Mar</th>
                            <th style="text-align: center;width: 75px;">Apr</th>
                            <th style="text-align: center;width: 75px;">Mei</th>
                            <th style="text-align: center;width: 75px;">Jun</th>
                            <th style="text-align: center;width: 75px;">Jul</th>
                            <th style="text-align: center;width: 75px;">Ags</th>
                            <th style="text-align: center;width: 75px;">Sep</th>
                            <th style="text-align: center;width: 75px;">Okt</th>
                            <th style="text-align: center;width: 75px;">Nov</th>
                            <th style="text-align: center;width: 75px;">Des</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-secondary" id="kategori" colspan="14"><b>Makanan</b></td>
                        </tr>
                        @include('components.makanan')
                        <tr>
                            <td class="table-secondary" id="kategori" colspan="14"><b>Minuman</b></td>
                        </tr>
                        @include('components.minuman')
                        
                    </tbody>
                    <tfoot class="table-dark ">
                        <tr style="font-size: 11px">
                            <td class="fw-bold">Total</td>

                            {{-- Pengulangan untuk mengambil nilai bulan --}}
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="fw-bold text-end">{{ number_format($jumlah[$i], 0, ',', '.') }}</td>
                            @endfor

                            {{-- Hasil Total --}}
                            <td class="fw-bold text-end">{{ number_format($nilai, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

            </div>
            @endisset
        </div>

    </div>
@endsection
