@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card p-4">
                <div class="card-header p-0 pt-1 pb-4">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">{{ $title ?? __('Data Customer') }}</h5>
                        </div>
                        @php
                            $menuRoles = session('menuRoles') ? unserialize(base64_decode(session('menuRoles'))) : null;
                        @endphp
                        @if ($menuRoles)
                            @foreach($menuRoles as $menu)
                                @if($menu->menu_kode == 'customer-Create')
                                    <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" onclick="openModal()">+&nbsp; Tambah</a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tableCustomer">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Produk
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Status
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
<div class="modal fade bd-example-modal-lg" id="modalAddCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="width: 800px;">
            <form action="javascript:onSave()" method="post" id="formCustomer" name="formCustomer" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tambah Customer</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="customer_id" id="customer_id">
                    <div class="row">
                        <div class="col-6">
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Nama <span class="text-danger">*</span></label>
                                <input type="text" id="customer_nama" name="customer_nama" class="form-control form-control-solid" required placeholder="Silahkan isi Nama" />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Produk <span class="text-danger">*</span></label>
                                <select id="customer_produk_id" name="customer_produk_id" class="custom-select form-control form-control-solid">
                                </select>
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">NIK  <span class="text-danger">*</span></label>
                                <input type="number" id="customer_nik" name="customer_nik" class="form-control form-control-solid" required placeholder="Silahkan isi Harga" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">No. HP  <span class="text-danger">*</span></label>
                                <input type="number" id="customer_phone" name="customer_phone" class="form-control form-control-solid" required placeholder="Silahkan isi Harga" />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Email  <span class="text-danger">*</span></label>
                                <input type="email" id="customer_email" name="customer_email" class="form-control form-control-solid" required placeholder="Silahkan isi Harga" />
                            </div>
                            <div class="fv-row mb-2">
                                <label for="" class="form-label mb-1" style="font-size: 15px">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="5" id="customer_address" name="customer_address" placeholder="Masukkan detail..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#modalAddCustomer').modal('hide');">Close</button>
                    <button type="submit" class="btn" style="background-color: #19184d; color: white;">Simpan</button>
                    <button type="button" id="btn_ajukan" class="btn" style="background-color: #5793d8; color: white; display: none;" onclick="onAjukan()">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal History -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historyModalLabel">History Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Loader / Teks Menunggu -->
                <div id="loadingHistory" class="text-center" style="display: none;">
                    <p>Loading history...</p>
                </div>

                <!-- Tabel Riwayat -->
                <div id="historyContent">
                    <!-- Data history akan dimuat di sini -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Ditindaklanjuti oleh</th>
                                <th>Tanggal Approval</th>
                            </tr>
                        </thead>
                        <tbody id="historyTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 
@include('customer::javascript')
@endsection