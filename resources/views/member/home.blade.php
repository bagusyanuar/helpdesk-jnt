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
                            <input type="text" class="form-control" placeholder="No. Resi" aria-label="No. Resi" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" id="btn-lacak"><i class="fa fa-search"></i></button>
                </div>

            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
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
                        <button type="submit" class="btn btn-danger w-100"><i class="fa fa-send mr-2"></i>Buat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
