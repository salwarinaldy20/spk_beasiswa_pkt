@extends('layout.app')

@section('customcss')

@endsection

@section('panelhead')

<div class="page-title d-flex flex-column me-3"> 
    <h1 class="d-flex text-white fw-bolder my-1 fs-3">Access Control</h1> 
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1"> 
        <li class="breadcrumb-item text-white opacity-75">
            <a href="{{route('dashboard')}}" class="text-white text-hover-primary">Home</a>
        </li> 
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li> 
        <li class="breadcrumb-item text-white opacity-75">Setting</li> 
        <li class="breadcrumb-item">
            <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
        </li> 
        <li class="breadcrumb-item text-white opacity-75">Access Control</li> 
    </ul> 
</div>  

@endsection

@section('content')
 

<div class="row"> 
    <div class="col-xxl-12">
        <!--begin::Timeline widget 2-->
        <div class="card h-xl-100" id="kt_timeline_widget_2_card">
            <!--begin::Header-->
            <div class="card-header position-relative py-0 border-bottom-2">
                <!--begin::Nav-->
                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0 active" data-bs-toggle="tab"
                            href="#kt_timeline_widget_2_tab_1">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-bold fs-4 mb-3">Permissions List</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span
                                class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item p-0 ms-0 me-8">
                        <!--begin::Link-->
                        <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab"
                            href="#kt_timeline_widget_2_tab_2">
                            <!--begin::Subtitle-->
                            <span class="nav-text fw-bold fs-4 mb-3">Roles List</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span
                                class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li> 
                </ul>
                <!--end::Nav-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Tab Content-->
                <div class="tab-content">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade active show" id="kt_timeline_widget_2_tab_1">
                        
                        <div>
                            @if (Omjin::permission('permissionCreate'))
                            <button type="button" data-state="0" id="add1"
                                class="btn btn-outline btn-outline-primary btn-active-light-primary waves-effect waves-light"
                                onclick="toggleLayout($(this), 1)">Add</button>
                            @endif
                            @if (Omjin::permission('permissionDelete'))
                            <button type="button"
                                class="btn btn-outline btn-outline-primary btn-active-light-primary hidex1 dsblsel1" disabled
                                onclick="deleteAll1()">Delete <span class="nsel1"></span></button>
                            @endif 
                            <button type="button"
                                class="btn btn-outline btn-outline-primary btn-active-light-primary hidex1 refreshtbl pr-2"
                                data-refreshx="tblpermission"><i class="fa fa-sync-alt text-primary"></i></button>
                        </div>

                        <div class="separator separator-dashed my-4"></div>

                        
                        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6" style="display:none;">
                            <li class="nav-item">
                                <a class="nav-link active" id="dataxtbl1-tab" data-bs-toggle="tab" href="#dataxtbl1">Link 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="formx1-tab" data-bs-toggle="tab" href="#formx1">Link 2</a>
                            </li> 
                        </ul> 
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dataxtbl1" role="tabpanel">

                                <div class="table-responsive">
                                    <table class="table table-row-bordered" id="tblpermission" style="width:100%; margin-bottom:100px">
                                        <thead>
                                            <tr>
                                                <th style="align-items: center; width: 5px !important;">#</th>
                                                <th width="1px">No</th>
                                                <th>Kategori</th>  
                                                <th>Permission Key</th> 
                                                <th>Keterangan</th>
                                                <th width="50px">Aksi</th>
                                            </tr>
                                        </thead> 
                                        <thead>
                                            <tr>
                                                <td class="p-1" style="align-items: center; width: 5px !important;"><input type="checkbox" class="ckbsa" id="satblpermission"/></td>
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
                                                        <input  id="flkategori" type="text" data-column="2" class="form-control py-0 fltable1" placeholder="">
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
                                                        <input  id="flpermissionkey" type="text" data-column="3"  class="form-control py-0 fltable1" placeholder="">
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
                                                        <input  id="flketerangan" type="text" data-column="4" class="form-control py-0 fltable1" placeholder="">
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
                            <div class="tab-pane fade" id="formx1" role="tabpanel">

 
                                <form id="reg1" novalidate="novalidate">
                                    <div class="form-group row fv-row mb-5">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Kategori</label>
                                        <div class="col-md-10">
                                            <input class="form-control form-control-solid" id="kategori" name="kategori" type="search"
                                                placeholder="Kategori" required>
                                            <div class="errtext"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row fv-row mb-5">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Permission
                                            Key</label>
                                        <div class="col-md-10">
                                            <input class="form-control form-control-solid" id="permission_key" name="permission_key"
                                                type="search" placeholder="Permission Key" required>
                                            <div class="errtext"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row fv-row mb-5">
                                        <label for="example-text-input"
                                            class="col-md-2 col-form-label">Keterangan</label>
                                        <div class="col-md-10">
                                            <textarea name="keterangan" id="keterangan" placeholder="Keterangan" class="form-control form-control-solid" cols="30" rows="10"></textarea>
                                            <div class="errtext"></div>
                                        </div>
                                    </div>

                                    <div class="separator separator-dashed my-4"></div>

                                    <div class="d-flex justify-content-end">
                                        <button type="reset" click="resetForm" class="btn btn-light btn-lg me-2 w-100 mb-5">Cancel</button> 
                                        <button type="submit" id="btnsave" class="btn btn-lg btn-primary ms-2 w-100 mb-5">
                                            <span class="indicator-label">Save</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button> 
                                    </div>

                                </form>

                            </div> 
                        </div>
 

                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_timeline_widget_2_tab_2">
                        
                        <div>
                            @if (Omjin::permission('roleCreate'))
                            <button type="button" data-state="0" id="add2"
                                class="btn btn-outline btn-outline-primary btn-active-light-primary waves-effect waves-light"
                                onclick="toggleLayout($(this), 2)">Add</button>
                            @endif
                            @if (Omjin::permission('roleDelete'))
                            <button type="button"
                                class="btn btn-outline btn-outline-primary btn-active-light-primary hidex2 dsblsel2" disabled
                                onclick="deleteAll2()">Delete <span class="nsel2"></span></button>
                            @endif
                            <button type="button"
                                class="btn btn-outline btn-outline-primary btn-active-light-primary hidex2 refreshtbl pr-2"
                                data-refreshx="tblrole"><i class="fa fa-sync-alt text-primary"></i></button>
                        
                        </div>

                    
                        <div class="separator separator-dashed my-4"></div>


                        <ul class="nav nav-tabs" id="myTab" role="tablist" style="display:none;">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="dataxtbl2-tab" data-bs-toggle="tab" href="#dataxtbl2"
                                    role="tab" aria-controls="dataxtbl2" aria-selected="true">Data</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="formx2-tab" data-bs-toggle="tab" href="#formx2" role="tab"
                                    aria-controls="formx2" aria-selected="false">Form</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dataxtbl2" role="tabpanel"
                                aria-labelledby="dataxtbl2-tab">

                                <div class="table-responsive">
                                    <table class="table table-row-bordered" id="tblrole" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="align-items: center; width: 5px !important;">#</th>
                                                <th width="1px">No</th>
                                                <th>Role</th>
                                                <th width="70px">Aksi</th>
                                            </tr>
                                        </thead> 
                                        <thead>
                                            <tr>
                                                <td class="p-1" style="align-items: center; width: 5px !important;"><input type="checkbox" class="ckbsa" id="satblrole"/></td>
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
                                                        <input  id="flrole" type="text" data-column="1" class="form-control py-0 fltable2" placeholder="">
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


                            <div class="tab-pane fade" id="formx2" role="tabpanel" aria-labelledby="formx2-tab">

                                <form id="reg2" novalidate="novalidate">
                                    
                                    <div class="form-group row fv-row mb-5">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Role</label>
                                        <div class="col-md-10">
                                            <input class="form-control form-control-solid" id="role" name="role" type="search" placeholder="Role" required> 
                                        </div>
                                    </div>

                                    <div class="form-group row fv-row mb-5">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Permission</label>
                                        <div class="col-md-10">
                                            <div class="table-responsive">
                                                
                                                <table class="table table-row-bordered" id="tbllistpermission" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="align-items: center; width: 5px !important;">#</th>
                                                            <th width="1px">No</th>
                                                            <th>Kategori</th>  
                                                            <th>Permission Key</th> 
                                                            <th>Keterangan</th> 
                                                        </tr>
                                                    </thead> 
                                                    <thead>
                                                        <tr>
                                                            <td class="p-1" style="align-items: center; width: 5px !important;"></td>
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
                                                                    <input  id="flkategori3" type="text" data-column="2" class="form-control py-0 fltable3" placeholder="">
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
                                                                    <input  id="flpermissionkey3" type="text" data-column="3"  class="form-control py-0 fltable3" placeholder="">
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
                                                                    <input  id="flketerangan3" type="text" data-column="4" class="form-control py-0 fltable3" placeholder="">
                                                                </div>
                                                            </td> 
                                                        </tr>
                                                    </thead> 
                                                    <tbody>
        
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="separator separator-dashed my-4"></div>

                                    <div class="d-flex justify-content-end">
                                        <button type="reset" click="resetForm" class="btn btn-light btn-lg me-2 w-100 mb-5">Cancel</button> 
                                        <button type="submit" id="btnsave1" class="btn btn-lg btn-primary ms-2 w-100 mb-5">
                                            <span class="indicator-label">Save</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button> 
                                    </div> 
                                </form>


                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <!--end::Tab Content-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Tables Widget 2-->
    </div> 
</div>

 
@endsection

@section('modals')

@endsection

@section('customjs')

<script src="{{ asset('js/acl.js') }}"></script>  

<script>
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
  return new bootstrap.Dropdown(dropdownToggleEl)
})
</script>
@endsection

