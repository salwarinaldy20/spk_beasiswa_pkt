@extends('layout.app')

@section('customcss')

@endsection

@section('panelhead')
<div class="page-title d-flex flex-column me-3">
    <h1 class="d-flex text-white fw-bolder my-1 fs-3">Training</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
        <li class="breadcrumb-item text-white opacity-75">
            <a href="{{route('dashboard')}}" class="text-white text-hover-primary">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-white opacity-75">Master</li>
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-white opacity-75">Training</li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h2 class="mb-1">Data Training</h2>
            <div class="fs-6 fw-bold text-muted">Manage Data Training</div>
        </div>

    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">

        <div>
            @if (Omjin::permission('trainingCreate'))
            <button type="button" data-state="0" id="add" class="btn btn-md btn-outline btn-outline-warning btn-active-light-warning  me-2 hidex" onclick="toggleLayout($(this))">Add</button>
            @endif
            @if (Omjin::permission('trainingDelete'))
            <button type="button" class="btn btn-md btn-outline btn-outline-warning btn-active-light-warning  me-2 hidex dsblsel" disabled onclick="deleteAll()">Delete <span class="nsel"></span></button>
            @endif
            <button type="button" class="btn btn-md btn-outline btn-outline-warning  btn-active-light-warning  me-2 hidex refresh"  data-refreshx="tbltraining"><i class="fa fa-sync-alt text-warning"></i></button>
        </div>
        {{-- 7771235312V451 --}}
        <div class="separator separator-dashed my-4"></div>

        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6" style="display:none;">
            <li class="nav-item">
                <a class="nav-link active" id="dataxtbl-tab" data-bs-toggle="tab" href="#dataxtbl">Link 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="formx-tab" data-bs-toggle="tab" href="#formx">Link 2</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

                <div class="table-responsive">

                    <table class="table table-row-bordered display nowrap" id="tbltraining" style="width:100%">
                        <thead>
                            <tr>
                                <th width="1px">#</th>
                                <th width="1px">No</th>
                                <th width="150px">Pasien</th>
                                @foreach ($gejala as $key => $item)
                                <th width="50">G{{ $loop->iteration }}</th>
                                @endforeach
                                <th width="150px">Penyakit</th>
                                <th width="50px">Aksi</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <td class="p-1" style="align-items: center; width: 5px !important;"><input type="checkbox" class="ckbsa" id="satblpenyakit"/></td>
                                <td class="p-1"></td>
                                <td class="p-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="btn-group">
                                                <button class="btn btnf btn-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <span class="statefil">&#128270;</i></span>
                                                </button>
                                                <div class="dropdown-menu menuf">
                                                    @foreach (Omjin::dtFilterCategory('string') as $item)
                                                    <a class="dropdown-item itemfil" data-value="{{$item[0]}}" href="javascript:">{{$item[1]}}</a>
                                                    @endforeach
                                                </div>
                                              </div>
                                        </div>
                                        <input  id="flid_user" type="text" data-column="3" class="form-control py-0 fltable" placeholder="">
                                    </div>
                                </td>
                                <td class="p-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="btn-group">
                                                <button class="btn btnf btn-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <span class="statefil">&#128270;</i></span>
                                                </button>
                                                <div class="dropdown-menu menuf">
                                                    @foreach (Omjin::dtFilterCategory('string') as $item)
                                                    <a class="dropdown-item itemfil" data-value="{{$item[0]}}" href="javascript:">{{$item[1]}}</a>
                                                    @endforeach
                                                </div>
                                              </div>
                                        </div>
                                        <input  id="flid_user" type="text" data-column="3" class="form-control py-0 fltable" placeholder="">
                                    </div>
                                </td>
                            </tr>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

            </div>
            <div class="tab-pane fade" id="formx" role="tabpanel">


                <form id="reg" novalidate="novalidate">
                    <div class="form-group row fv-row mb-5">
                        <label for="example-text-input" class="col-md-2 col-form-label">Pasien</label>
                        <div class="col-md-10">
                            <select id="id_user"  class="form-select form-select-solid  s2x" data-control="select2" data-placeholder="*Pilih Pasien">
                                <option></option>
                                @foreach ($pasien as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row fv-row mb-5">
                        <label for="example-text-input" class="col-md-2 col-form-label">Penyakit</label>
                        <div class="col-md-10">
                            <select id="id_penyakit"  class="form-select form-select-solid s2x" data-control="select2" data-placeholder="*Pilih Penyakit">
                                <option></option>
                                @foreach ($penyakit as $item)
                                <option value="{{$item->id}}">{{$item->nama_penyakit}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row fv-row mb-5">
                        <label for="example-text-input" class="col-md-12 col-form-label">Gejala</label>
                        <div class="col-md-12">
                            <table class="table table-striped table-rounded table-row-bordered border">
                                <thead>
                                    <tr>
                                        <th>Kode Gejala</th>
                                        <th>Nama Gejala</th>
                                        <th>Dialami</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gejala as $item)
                                    <tr>
                                        <td>G{{ $loop->iteration }}</td>
                                        <td>{{ $item->gejala }}</td>
                                        <td>
                                            <div class="form-check form-check-custom form-check-solid">
                                                <label class="form-check-label">
                                                <input class="form-check-input ckb" type="checkbox" data-id="{{ $item->id }}" value="1" id="G{{ $loop->iteration }}"/>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="separator separator-dashed my-4"></div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" click="resetForm" class="btn btn-light btn-lg me-2 w-100 mb-5">Cancel</button>
                        <button type="submit" class="btn btn-lg btn-warning ms-2 w-100 mb-5">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>


            </div>
        </div>


    </div>
    <!--end::Card body-->
</div>


@endsection

@section('customjs')
<script>
    let gejala = {!! $gejala !!};
</script>
<script src="{{ asset('js/training.js') }}"></script>
@endsection
