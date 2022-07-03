@extends('layout.app')

@section('customcss')

@endsection

@section('panelhead')
<div class="page-title d-flex flex-column me-3">
    <h1 class="d-flex text-white fw-bolder my-1 fs-3">User</h1>
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
        <li class="breadcrumb-item text-white opacity-75">Users List</li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h2 class="mb-1">Users List</h2>
            <div class="fs-6 fw-bold text-muted">Manage users</div>
        </div>

    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">

        <div>
            @if (Omjin::permission('userCreate'))
            <button type="button" data-state="0" id="add" class="btn btn-md btn-outline btn-outline-warning btn-active-light-warning me-2 hidex" onclick="toggleLayout($(this))">Add</button>
            @endif
            @if (Omjin::permission('userDelete'))
            <button type="button" class="btn btn-md btn-outline btn-outline-warning btn-active-light-warning me-2 hidex dsblsel" disabled onclick="deleteAll()">Delete <span class="nsel"></span></button>
            @endif
            @if (Omjin::permission('userUpdate'))
            <button type="button" class="btn btn-md btn-outline btn-outline-warning btn-active-light-warning me-2 hidex dsblsel" onclick="activeDeactive()" disabled>Activate / Deactivate <span class="nsel"></span></button>
            @endif
            <button type="button" class="btn btn-md btn-outline btn-outline-warning btn-active-light-warning me-2 hidex refresh"  data-refreshx="tbluser"><i class="fa fa-sync-alt text-warning"></i></button>
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

                    <table class="table table-row-bordered display nowrap" id="tbluser" style="width:100%">
                        <thead>
                            <tr>
                                <th style="align-items: center; width: 5px !important;">#</th>
                                <th width="1px">No</th>
                                <th width="50px">Aktif</th>
                                <th width="150px">Nama</th>
                                <th width="70px">Username</th>
                                <th width="150px">Email</th>
                                <th width="70px">Role</th>
                                <th width="70px">Gender</th>
                                <th width="70px">Last Login</th>
                                <th width="50px">Aksi</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <td class="p-1" style="align-items: center; width: 5px !important;"><input type="checkbox" class="ckbsa" id="satbluser"/></td>
                                <td class="p-1"></td>
                                <td class="p-1">
                                    <select id="fllocked" data-column="2" class="form-select fltable" data-control="select2" data-placeholder="Aktif">
                                        <option></option>
                                        <option value="&nbsp;">All</option>
                                        <option value="0">Active</option>
                                        <option value="1">Non Active</option>
                                    </select>
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
                                        <input  id="flnama" type="text" data-column="3" class="form-control py-0 fltable" placeholder="">
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
                                        <input  id="flusername" type="text" data-column="4" class="form-control py-0 fltable" placeholder="">
                                    </div>
                                </td>
                                <td class="p-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="btn-group">
                                                <button class="btn btnf btn-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <span class="statefil">&#128270;</span>
                                                </button>
                                                <div class="dropdown-menu menuf">
                                                    @foreach (Omjin::dtFilterCategory('string') as $item)
                                                    <a class="dropdown-item itemfil" data-value="{{$item[0]}}" href="javascript:">{{$item[1]}}</a>
                                                    @endforeach
                                                </div>
                                              </div>
                                        </div>
                                        <input  id="flemail" type="text" data-column="5" class="form-control py-0 fltable" placeholder="">
                                    </div>
                                </td>
                                <td class="p-1">
                                    <select id="flrole" data-column="10" class="form-select fltable" data-control="select2" data-placeholder="Role">
                                        <option></option>
                                        <option value="&nbsp;">All</option>
                                        @foreach ($role as $item)
                                        <option value="{{$item->id}}">{{$item->role}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-1">
                                    <select id="fljenis_kelamin" data-column="7" class="form-select fltable" data-control="select2" data-placeholder="Gender">
                                        <option></option>
                                        <option value="&nbsp;">All</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </td>
                                <td class="p-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="btn-group">
                                                <button class="btn btnf btn-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <span class="statefil">&#128270;</span>
                                                </button>
                                                <div class="dropdown-menu menuf">
                                                    @foreach (Omjin::dtFilterCategory('date1') as $item)
                                                    <a class="dropdown-item itemfil" data-value="{{$item[0]}}" href="javascript:">{{$item[1]}}</a>
                                                    @endforeach
                                                </div>
                                              </div>
                                        </div>
                                        <input  id="fllastlogin" type="text" data-column="8" class="form-control py-0 datepicker fltable" autocomplete="off" placeholder="">
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
                        <label for="example-text-input" class="col-md-2 col-form-label">Role</label>
                        <div class="col-md-10">
                            <select id="id_role"  class="form-select form-select-solid s2x" data-control="select2" data-placeholder="*Pilih Role">
                                <option></option>
                                @foreach ($role as $item)
                                <option value="{{$item->id}}">{{$item->role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row fv-row mb-5">
                        <label for="example-text-input" class="col-md-2 col-form-label">Nama Lengkap</label>
                        <div class="col-md-10">
                            <input class="form-control form-control-solid" autocomplete="off" id="nama" name="nama" type="search"
                                placeholder="Nama Lengkap" required>
                        </div>
                    </div>

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
                                <input type="radio" class="btn-check" name="jk" id="jk1" value="L" autocomplete="off">
                                <label class="btn btn-outline btn-outline-primary btn-active-primary" for="jk1">Laki-laki</label>

                                <input type="radio" class="btn-check" name="jk" id="jk2" value="P" autocomplete="off">
                                <label class="btn btn-outline btn-outline-primary btn-active-primary" for="jk2">Perempuan</label>

                              </div>
                        </div>
                    </div>
                    <div class="form-group row fv-row mb-5">
                        <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input class="form-control form-control-solid" autocomplete="off" id="email" name="email" type="email"
                                placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row fv-row mb-5">
                        <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
                        <div class="col-md-10">
                            <input class="form-control form-control-solid" autocomplete="off" id="username" name="username" type="search"
                                placeholder="Username" required>
                        </div>
                    </div>

                    <div class="form-group row fv-row mb-5">
                        <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
                        <div class="col-md-10">
                                <div>
                                    <input class="form-control form-control-lg form-control-solid pswd" type="password" id="password" name="password" placeholder="Type to create or change Password" autocomplete="off" style="padding-right:45px;" />
                                    <span class="hint spass tpass"></span>
                                </div>
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
<script src="{{ asset('js/user.js') }}"></script>
@endsection
