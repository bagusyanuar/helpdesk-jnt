@extends('member.layout')

@section('content')
    <div class="hero-dark d-flex align-items-center">
        <div class="w-50 p-5 left-hero pr-5">
            <p style="font-size: 46px;" class="font-weight-bold">Helpdesk J&T Express</p>
            <p style="font-size: 24px; color: #f6f6f6;" class="mb-1">Selamat datang di sistem informasi helpdesk J&T
                Express</p>
            <p style="font-size: 16px; color: #f6f6f6; font-weight: lighter;" class="mb-4">Kami menyediakan fitur untuk
                melacak paket dan membuat ticket keluhan atau pertanyaan seputar paket anda.</p>
            <a href="#lacak" class="d-inline-block btn-register"><i class="fa fa-search mr-3"></i>Lacak Paket</a>
        </div>
        <div class="w-50 p-3 right-hero">
            <div class="w-100 text-center">
                <img src="{{ asset('/assets/hero.png') }}" height="400" alt="hero image">
            </div>
        </div>
    </div>
    <div class="text-center p-3" id="lacak">
        <p style="font-size: 20px; color: #777777; font-weight: bold; letter-spacing: 2px;">Lacak Paket</p>
        <div class="row">
            <div class="col-8">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="flex-grow-1 mr-2">
                        <div class="input-group w-100">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" id="awb" class="form-control" placeholder="No. Resi"
                                   aria-label="No. Resi"
                                   aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" id="btn-lacak"><i class="fa fa-search"></i></button>
                </div>
                <div class="w-100 mt-2" id="panel-result">
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            @csrf
                            <p class="font-weight-bold">Buat Ticket</p>
                            <hr>
                            <div class="w-100 mb-1 text-left">
                                <label for="resi" class="form-label">No. Resi</label>
                                <input type="text" class="form-control" id="resi" placeholder="No. Resi"
                                       name="resi">
                            </div>
                            <div class="w-100 mb-1 text-left">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea type="text" class="form-control" id="deskripsi" placeholder="Deskripsi"
                                          name="deskripsi"></textarea>
                            </div>
                            <hr>
                            @auth()
                                <button type="submit" class="btn btn-danger w-100" id="btn-ticket"><i
                                        class="fa fa-send mr-2"></i>Buat
                                    Ticket
                                </button>
                            @else
                                <button type="button" class="btn btn-danger w-100" id="btn-no-auth-ticket"><i
                                        class="fa fa-send mr-2"></i>Buat
                                    Ticket
                                </button>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        async function getTrack() {
            let el = $('#panel-result');
            try {
                el.empty();
                el.append(createLoader('Sedang melacak paket...', 300));
                let awb = $('#awb').val();
                let url = '/track?awb=' + awb;
                let response = await $.get(url);
                el.empty();
                console.log(response);
                if (response['payload']['status'] === 200) {
                    let data = response['payload']['data'];
                    el.append(createResultElement(data));
                } else {
                    alert(response['payload']['message']);
                }
            } catch (e) {
                console.log(e);
                alert('terjadi kesalahan...')
            }
        }

        function createResultElement(data) {
            let awb = $('#awb').val();
            let status = data['summary']['status'];
            let history = data['history'];
            let elHistory = '';
            $.each(history, function (k, v) {
                let vDate = new Date(v['date']);
                let date = '<td>' + vDate.toLocaleString() + '</td>';
                let location = '<td>' + v['location'] + '</td>';
                let desc = '<td class="text-left">' + v['desc'] + '</td>';
                elHistory += '<tr>' + date + location + desc + '</tr>'
            });
            return '<p class="w-100 text-center font-weight-bold mb-0" style="color: #36454F;">' + awb + '</p>\n' +
                '                    <p class="w-100 text-center font-weight-bold" style="color: #097969; font-size: 24px;">' + status + '</p>\n' +
                '                    <hr>\n' +
                '                    <table class="w-100 table table-bordered">\n' +
                '                        <thead>' +
                '                               <tr>\n' +
                '                            <th width="15%">Tanggal</th>\n' +
                '                            <th width="15%">Lokasi</th>\n' +
                '                            <th class="text-left">Deskripsi</th>' +
                '                           </tr>\n' +
                '                        </thead>\n' +
                '                        <tbody>' + elHistory + '</tbody>\n' +
                '                    </table>'
        }

        $(document).ready(function () {
            $('#btn-lacak').on('click', function (e) {
                getTrack();
            })

            $('#btn-no-auth-ticket').on('click', function (e) {
                Swal.fire({
                    title: "Login!",
                    text: "Silahkan login untuk melajutkan proses!",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = '/login';
                });
            })
        });
    </script>
@endsection
