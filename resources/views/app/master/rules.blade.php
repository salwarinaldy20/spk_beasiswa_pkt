@extends('layout.app')

@section('customcss')

@endsection

@section('panelhead')
<div class="page-title d-flex flex-column me-3">
    <h1 class="d-flex text-white fw-bolder my-1 fs-3">Rules</h1>
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
        <li class="breadcrumb-item text-white opacity-75">Rules</li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h2 class="mb-1">List Rules</h2>
            <div class="fs-6 fw-bold text-muted">Manage Rules</div>
        </div>

    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">

        <div>
            @if (Omjin::permission('ruleCreate'))
            <button type="button" data-state="0" id="add" class="btn btn-md btn-outline btn-outline-warning btn-active-light-warning  me-2 hidex" onclick="toggleLayout($(this))">Add</button>
            @endif
            @if (Omjin::permission('ruleDelete'))
            <button type="button" class="btn btn-md btn-outline btn-outline-warning  btn-active-light-warning  me-2 hidex dsblsel" disabled onclick="deleteAll()">Delete <span class="nsel"></span></button>
            @endif
            <button type="button" class="btn btn-md btn-outline btn-outline-warning  btn-active-light-warning  me-2 hidex refresh"  data-refreshx="tblrules"><i class="fa fa-sync-alt text-warning"></i></button>
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

                    <table class="table table-row-bordered display nowrap" id="tblrules" style="width:100%">
                        <thead>
                            <tr>
                                <th style="align-items: center; width: 5px !important;">#</th>
                                <th width="1px">No</th>
                                <th width="150px">Nama Penyakit</th>
                                <th width="150px">Gejala</th>
                                <th width="150px">Bobot</th>
                                <th width="50px">Aksi</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <td class="p-1" style="align-items: center; width: 5px !important;"><input type="checkbox" class="ckbsa" id="satblrules"/></td>
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
                                        <input  id="flid_penyakit" type="text" data-column="3" class="form-control py-0 fltable" placeholder="">
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
                                        <input  id="flid_gejala" type="text" data-column="3" class="form-control py-0 fltable" placeholder="">
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
                                                    @foreach (Omjin::dtFilterCategory('numeric') as $item)
                                                    <a class="dropdown-item itemfil" data-value="{{$item[0]}}" href="javascript:">{{$item[1]}}</a>
                                                    @endforeach
                                                </div>
                                              </div>
                                        </div>
                                        <input  id="flbobot" type="text" data-column="4" class="form-control py-0 fltable" placeholder="">
                                    </div>
                                </td>
                                <td class="p-1"></td>
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
                        <label for="example-text-input" class="col-md-2 col-form-label">Nama Penyakit</label>
                        <div class="col-md-10">
                            <select id="id_penyakit"  class="form-select form-select-solid s2x" data-control="select2" data-placeholder="*Pilih Nama Penyakit">
                                <option></option>
                                @foreach ($penyakit as $item)
                                <option value="{{$item->id}}">{{$item->nama_penyakit}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row fv-row mb-5">
                        <label for="example-text-input" class="col-md-2 col-form-label">Gejala</label>
                        <div class="col-md-10">
                            <select id="id_gejala"  class="form-select form-select-solid s2x" data-control="select2" data-placeholder="*Pilih Gejala">
                                <option></option>
                                @foreach ($gejala as $item)
                                <option value="{{$item->id}}">{{$item->gejala}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row fv-row mb-5 d-none">
                        <label for="example-text-input" class="col-md-2 col-form-label">Bobot</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control form-control-solid" autocomplete="off" id="bobot" name="bobot" placeholder="Bobot" required>

                        </div>
                    </div>


                    <div class="separator separator-dashed my-4"></div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" click="resetForm" class="btn btn-light btn-lg me-2 w-100 mb-5">Cancel</button>
                        <button type="submit" class="btn btn-lg btn-primary ms-2 w-100 mb-5">
                            <span class="indicator-label">Save</span>
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
<script src="{{ asset('js/rules.js') }}"></script>
@endsection
