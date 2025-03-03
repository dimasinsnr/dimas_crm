@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card p-4">
                <div class="card-header p-0 pt-1 pb-4">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ $title ?? __('Data Users') }}</h5>
                        </div>
                        @php
                        $menuRoles = session('menuRoles') ? unserialize(base64_decode(session('menuRoles'))) : null;
                        @endphp
                        @if ($menuRoles)
                            @foreach($menuRoles as $menu)
                                @if($menu->menu_kode == 'user-Create')
                                    <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" onclick="openModal()">+&nbsp; Tambah</a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tableUser">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 800px;">
            <form action="javascript:onSave()" method="post" id="formUser" name="formUser" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tambah User</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-6">
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Nama <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control form-control-solid" required placeholder="Silahkan isi Nama" />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Hak Akses <span class="text-danger">*</span></label>
                                <select id="hak_akses_id" name="hak_akses_id" class="custom-select form-control form-control-solid">
                                </select>
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Phone  <span class="text-danger">*</span></label>
                                <input type="number" id="phone" name="phone" class="form-control form-control-solid" required placeholder="Silahkan isi No. Phone" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control form-control-solid" required placeholder="Silahkan isi Email" />
                            </div>
                            <div class="fv-row mb-2" id="password_id">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Password <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" class="form-control form-control-solid" required placeholder="Silahkan isi password" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modalAddUser').modal('hide');">Close</button>
                    <button type="submit" class="btn" style="background-color: #19184d; color: white;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
@include('user::javascript')
@endsection