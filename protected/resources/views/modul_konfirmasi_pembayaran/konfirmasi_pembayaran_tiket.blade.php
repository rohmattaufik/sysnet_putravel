@extends('layouts.app-admin')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Modul Konfirmasi Pembayaran
                <small>Tiket</small>
            </h1>
        </section>

        <!-- Main content -->

        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->

            <div class="row">
                <div class="col-lg-12">

                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs">
                            @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                                <li class="active">
                                    <a href="#tab_2" data-toggle="tab" aria-expanded="true">Konfirmasi Pembayaran Tiket</a>
                                </li>
                            @endif
                            @if(Auth::user()->role == 3)
                                <li class="active">
                                    <a href="#tab_3" data-toggle="tab" aria-expanded="true">User - Travel</a>
                                </li>
                            @endif
                        </ul>
                        @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                            <div class="tab-content">

                                <div class="tab-pane active" id="tab_2">

                                    {{--<h3 class="box-title">Form</h3>--}}
                                    @if(Session::get('sukses'))
                                        <div class="box box-info">

                                            <div class="box-header with-border">
                                                <div class="callout callout-success">
                                                    <h4>{{ Session::get('sukses') }}</h4>

                                                    <p>Data Anda berhasil masuk database.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(Session::get('sukses-delete'))
                                        <div class="box box-info">

                                            <div class="box-header with-border">
                                                <div class="callout callout-danger">
                                                    <h4>{{ Session::get('sukses-delete') }}</h4>

                                                    <p>Data Anda berhasil dihapus dari database.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="box box-primary">
                                                <div class="box-header">
                                                    <form method="post" action="{{ url(action('KonfirmasiPembayaranTiketController@pilihjenis')) }}">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="kota">
                                                                Pilih Jenis
                                                            </label>
                                                            <div class="col-lg-4">
                                                                <select id="kota" name="jenis" class="form-control select-data">
                                                                    <option value="tiket">
                                                                        Tiket
                                                                    </option>
                                                                    <option value="hotel">
                                                                        Hotel
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary btn-sm">Pilih</button>
                                                        </div>
                                                    </form>

                                                </div>
                                                <hr style="border-top: 10px solid grey;"/>

                                                <div class="box-body">
                                                    <div class="col-lg-12">

                                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                                            <ul></ul>
                                                        </div>


                                                        <div class="alert alert-success print-success-msg" style="display:none">
                                                            <ul></ul>
                                                        </div>

                                                        <div class="table-responsive">
                                                            <div class="row">
                                                                <div class="col-lg-12">

                                                                    @for($j=1,$i=0;$i<count($data_tiket_surat);$i++,$j++)
                                                                        @if(count($data_tiket_surat[$i]["pesanTiketD"]) > 0)
                                                                            <form method="post" action="{{ url(action('KonfirmasiPembayaranTiketController@update')) }}">
                                                                                {{ csrf_field() }}
                                                                            <table class="table table-bordered" id="dynamic_field">
                                                                                <thead class="">
                                                                                <th class="text-nowrap">No</th>
                                                                                <th class="text-nowrap">No Surat Tugas</th>
                                                                                <th class="text-nowrap">Total Harga</th>
                                                                                <th class="text-nowrap">Bank</th>
                                                                                <th class="text-nowrap">Check All</th>
                                                                                <th class="text-nowrap">Action</th>
                                                                                </thead>

                                                                                <tbody>

                                                                                <tr>
                                                                                    <td class="text-nowrap" rowspan="{{ count($data_tiket_surat[$i]["pesanTiketD"]) }}">
                                                                                        {{ $index++ }}
                                                                                    </td>
                                                                                    <td class="text-nowrap" rowspan="{{ count($data_tiket_surat[$i]["pesanTiketD"]) }}">
                                                                                        <p>{{ $data_tiket_surat[$i]["assigment_letter_code"] }}</p>
                                                                                    </td>
                                                                                    <td class="text-nowrap" rowspan="{{ count($data_tiket_surat[$i]["pesanTiketD"]) }}">
                                                                                        <p>Rp <span class="uang">{{ $totalarr[$indextotal++] }}</span></p>
                                                                                    </td>
                                                                                    <td class="text-nowrap" rowspan="{{ count($data_tiket_surat[$i]["pesanTiketD"]) }}">
                                                                                        <div class="form-group">
                                                                                            <div class="col-lg-12">
                                                                                                <select id="bank" name="bank" class="form-control select-data">
                                                                                                    @foreach($mbank as $data)
                                                                                                        <option value="{{ $data->id }}">
                                                                                                            {{ $data->bank_name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="text-nowrap" rowspan="{{ count($data_tiket_surat[$i]["pesanTiketD"]) }}">
                                                                                        <div class="form-group">
                                                                                            <div class="checkbox">
                                                                                                <label>
                                                                                                    <input onclick="toggle{{$i}}(this)"
                                                                                                           type="checkbox" name="title_{{$i}}" id="title_{{$i}}">
                                                                                                    Check All
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <script>
                                                                                            function toggle{{$i}}(source) {
                                                                                                var checkboxes = document.querySelectorAll('input[id="title_{{$i}}"]');
                                                                                                for (var i = 0; i < checkboxes.length; i++) {
                                                                                                    if (checkboxes[i] != source)
                                                                                                        checkboxes[i].checked = source.checked;
                                                                                                }
                                                                                            }
                                                                                        </script>
                                                                                    </td>
                                                                                    <td class="text-nowrap" rowspan="{{ count($data_tiket_surat[$i]["pesanTiketD"]) }}">
                                                                                        <button type="submit" class="btn btn-info">
                                                                                            Confirm Payment
                                                                                        </button>
                                                                                    </td>
                                                                                </tr>

                                                                                </tbody>
                                                                            </table>


                                                                            <table class="table table-bordered" id="dynamic_field">
                                                                                <thead class="">
                                                                                <th class="text-nowrap">Nama</th>
                                                                                <th class="text-nowrap">Kota</th>
                                                                                <th class="text-nowrap">Maskapai</th>
                                                                                <th class="text-nowrap">Tanggal Berangkat</th>
                                                                                <th class="text-nowrap">Tanggal Kembali</th>
                                                                                <th class="text-nowrap">Harga Per Tiket (PP)</th>
                                                                                <th class="text-nowrap">Check</th>
                                                                                </thead>
                                                                                <tbody>


                                                                                @foreach($data_tiket_surat[$i]["pesanTiketD"] as $data)
                                                                                    <tr>
                                                                                        <td class="text-nowrap">
                                                                                            <p>{{ $data->employee_name}}</p>
                                                                                        </td>
                                                                                        <td class="text-nowrap">
                                                                                            <p>{{ $data->city_name }}</p>
                                                                                        </td>
                                                                                        <td class="text-nowrap">
                                                                                            <p>{{ $data->supplier_name }}</p>
                                                                                        </td>
                                                                                        <td class="text-nowrap">
                                                                                            <p>{{ \Carbon\Carbon::parse($data->departure_date)->format('d-m-Y')  }}</p>
                                                                                        </td>
                                                                                        <td class="text-nowrap">
                                                                                            <p>{{ \Carbon\Carbon::parse($data->arrival_date)->format('d-m-Y')  }}</p>
                                                                                        </td>
                                                                                        <td class="text-nowrap">
                                                                                            <p>Rp <span class="uang">{{ $data->AP_ticket_price }}</span></p>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="input-group">
                                                                                                {{--<input type="hidden" value="{{$data->id}}" name="id_tiket_d[]" hidden>--}}
                                                                                                <div class="checkbox">
                                                                                                    <input type="checkbox" value="{{ $data->id }}" name="id_tiket_d[]" id="title_{{$i}}">
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                            <br/>
                                                                            <hr style="border-top: 10px solid grey;"/>
                                                                            </form>
                                                                        @endif
                                                                    @endfor


                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="box-footer">
                                                            <div class="callout callout-info">
                                                                Silahkan Approve tiket yang sesuai pada tombol paling kanan di atas.
                                                            </div>
                                                            {{--<a href="{{ url(action('TransaksiPesananController@index')) }}"--}}
                                                            {{--type="button" class="btn btn-danger btn-block">Batal</a>--}}
                                                            {{--<button type="submit" class="btn btn-primary btn-block">Pesan</button>--}}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            </form>
                                        </div>
                                    </div>



                                </div>
                                <!-- /.tab-pane -->
                                @endif


                            </div>
                            <!-- /.tab-content -->
                    </div>

                </div>
            </div>


            {{--<div class="row">--}}
            {{--<div class="col-lg-12">--}}
            {{--<div class="box box-primary">--}}
            {{--<div class="box-header with-border">--}}
            {{--<h1 class="box-title">List of Travel</h1>--}}
            {{--</div>--}}
            {{--<div class="box-body table-responsive no-padding">--}}
            {{----}}

            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop

@section('new-script')
    <script type="text/javascript">
        $(document).ready(function(){

            // Format mata uang.
            $( '.uang' ).mask('000.000.000', {reverse: true});

        });
    </script>
@stop