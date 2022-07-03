@extends('layout.app')

@section('customcss')

@endsection

@section('panelhead')
<div class="page-title d-flex flex-column me-3 d-none">
    <h1 class="d-flex text-white fw-bolder my-1 fs-3">Diagnosa</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-white opacity-75">
            <a href="{{route('dashboard')}}" class="text-white text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-white opacity-75">Transaksi</li>
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-white opacity-75">Diagnosa</li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <!--begin::Card header-->
    <div class="d-flex px-8 pt-8 justify-content-between">
        <h2 class="steptitle">Mulai Diagnosa</h2>
        <div class="d-flex justify-content-end gap-3">
            <div class="text-end">
                <small class="text-muted stepsubtitle">Personal Data</small>
            </div>
            <div class="btn btn-icon btn-circle btn-twitter ml-2 p-2 d-none">
                <span class="stepnumb">1</span>
            </div>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">

        <div class="progress mt-0 mb-7" style="height: 3px;">
            <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="prorgessbarstep"></div>
        </div>

        <div>
            @if (Omjin::permission('ruleCreate'))
            <button type="button" data-state="0" id="add" class="btn btn-md btn-outline btn-outline-primary btn-active-light-primary me-2 hidex d-none" onclick="toggleLayout($(this))">Add</button>
            @endif
        </div>


        <ul id="tabform1" class="nav nav-tabs nav-line-tabs mb-5 fs-6" style="display:none;">
            <li class="nav-item">
                <a class="nav-link active" id="dataxtbl-tab" data-bs-toggle="tab" href="#dataxtbl">Link 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="formx-tab" data-bs-toggle="tab" href="#formx">Link 2</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

                <div class="mb-10">

                    <ul class="nav nav-tabs d-none" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-title="Mulai Diagnosa" data-subtitle="Personal Data" data-prev="0" data-next="1" data-save="0" data-no="0" data-count="1" href="#tab1">1</a>
                        </li>

                        @foreach ($gejala as $key => $item)
                        @php
                            $next = $loop->last ? 0 : 1;
                            // $save = $loop->last ? 1 : 0;
                            $iterate = $loop->iteration;
                            $urut = $loop->iteration + 1;
                            $count = $loop->count;

                        @endphp
                        <li class="nav-item">
                            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab"  data-title="Gejala" data-subtitle="Pertanyaan ke {{$loop->iteration}} dari {{$loop->count}}" data-prev="1" data-next="1" data-save="0" data-no="{{$loop->iteration}}" data-count="{{$loop->count}}" href="#tab{{$urut}}">{{$urut}}</a>
                        </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab"  data-title="Catatan" data-subtitle="Catatan untuk psikiater" data-prev="1" data-next="0" data-save="1" data-no="{{($iterate+1)}}" data-count="{{($count+1)}}" href="#tab{{($urut+1)}}">{{($urut+1)}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel">

                            <form id="form1">
                                <div class="form-group row fv-row mb-5">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Usia</label>
                                    <div class="col-md-10">
                                        <input class="form-control form-control-solid" autocomplete="off" id="usia" name="usia" type="search"
                                            placeholder="Usia" required>
                                    </div>
                                </div>
                                <div class="form-group row fv-row mb-5">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Pekerjaan</label>
                                    <div class="col-md-10">
                                        <input class="form-control form-control-solid" autocomplete="off" id="pekerjaan" name="pekerjaan" type="search"
                                            placeholder="Pekerjaan" required>
                                    </div>
                                </div>
                                <div class="form-group row fv-row mb-5">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-md-10">
                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="jk" id="jk1" value="L" required autocomplete="off">
                                            <label class="btn btn-outline btn-outline-primary btn-active-primary" for="jk1">Laki-laki</label>

                                            <input type="radio" class="btn-check" name="jk" id="jk2" value="P" required autocomplete="off">
                                            <label class="btn btn-outline btn-outline-primary btn-active-primary" for="jk2">Perempuan</label>

                                          </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                        @foreach ($gejala as $key => $item)
                        @php
                            $urut = $loop->iteration + 1;
                            $nourut = $loop->iteration;
                        @endphp
                        <div class="tab-pane fade" id="tab{{$urut}}" role="tabpanel">
                            <h4>{{$item->pertanyaan}}</h4>

                            <form class="formx">
                                <div class="row boxed-check-group boxed-check-primary mt-10">
                                    <label class="boxed-check">
                                        <input class="boxed-check-input" type="radio" name="radio-overview" data-gejala="{{ $item->id }}" data-urut="{{ $nourut }}" value="1" required>
                                        <div class="boxed-check-label">Ya</div>
                                    </label>
                                    <label class="boxed-check">
                                        <input class="boxed-check-input" type="radio" name="radio-overview" data-gejala="{{ $item->id }}" data-urut="{{ $nourut }}" value="0" required>
                                        <div class="boxed-check-label">Tidak</div>
                                    </label>
                                </div>
                            </form>

                        </div>
                        @endforeach
                        {{-- <div class="tab-pane fade" id="tab{{($urut+1)}}" role="tabpanel">
                            <h4>Silakan berikan tambahan catatan untuk psikiater mengenai gejala dan keluhan yang Anda alami</h4>

                            <form class="formx">
                                <div class="row boxed-check-group boxed-check-primary mt-10">
                                    <textarea class="" name="catatan" id="catatan" cols="30" rows="3"></textarea>
                                </div>
                            </form>

                        </div> --}}
                    </div>

                </div>

                <div class="progress mt-0 mb-7" style="height: 2px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="d-flex w-100 gap-10">
                    <button type="reset" click="resetForm" class="btn btn-light btn-lg me-2 flex-fill mb-5 d-none btnprev" data-tabx="#myTab">Prev</button>
                    <button type="button" class="btn btn-lg btn-primary ms-2 flex-fill mb-5 btnnext" data-tabx="#myTab">
                        <span class="indicator-label">Next</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <button type="button" class="btn btn-lg btn-primary ms-2 flex-fill mb-5 btnsave d-none" id="btnsave">
                        <span class="indicator-label">Diagnosis</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>


            </div>

            <div class="tab-pane fade" id="formx" role="tabpanel">

            </div>
        </div>


    </div>
    <!--end::Card body-->
</div>


@endsection

@section('customjs')
<script src="{{ asset('js/diagnosa.js') }}"></script>
@endsection
