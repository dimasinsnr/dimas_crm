@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card p-4">
                <div class="card-header p-0 pt-1 pb-4">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ $title ?? __('Data Produk') }}</h5>
                        </div>
                        @php
                        $menuRoles = session('menuRoles') ? unserialize(base64_decode(session('menuRoles'))) : null;
                        @endphp
                        @if ($menuRoles)
                            @foreach($menuRoles as $menu)
                                @if($menu->menu_kode == 'produk-Create')
                                    <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" onclick="openModal()">+&nbsp; Tambah</a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tableProduk">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        kode
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        nama
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        harga
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
<div class="modal fade bd-example-modal-lg" id="modalAddProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 800px;">
            <form action="javascript:onSave()" method="post" id="formProduk" name="formProduk" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tambah Produk</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="produk_id" id="produk_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Nama <span class="text-danger">*</span></label>
                                <input type="text" id="produk_nama" name="produk_nama" class="form-control form-control-solid" required placeholder="Silahkan isi Nama" />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Kode <span class="text-danger">*</span></label>
                                <input type="text" id="produk_kode" name="produk_kode" class="form-control form-control-solid" required placeholder="Silahkan isi Kode" />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Harga  <span class="text-danger">*</span></label>
                                <input type="number" id="produk_harga" name="produk_harga" class="form-control form-control-solid" required placeholder="Silahkan isi Harga" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="5" id="produk_deskripsi" name="produk_deskripsi" placeholder="Masukkan detail..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modalAddProduk').modal('hide');">Close</button>
                    <button type="submit" class="btn" style="background-color: #19184d; color: white;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
@include('produk::javascript')
@endsection