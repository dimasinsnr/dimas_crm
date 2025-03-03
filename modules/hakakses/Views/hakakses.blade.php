@extends('layouts.user_type.auth')

@section('content')
  <div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card p-4" style="min-height: 500px; max-height: 500px">
        {{-- <div class="card mb-4 mx-4"> --}}
          <div class="card-header p-0 pb-3">
              <div class="d-flex flex-row justify-content-between">
                  <div>
                      <h5 class="mb-0">{{ $title ?? __('Data Hak Akses') }}</h5>
                  </div>
                  @php
                  $menuRoles = session('menuRoles') ? unserialize(base64_decode(session('menuRoles'))) : null;
                  @endphp
                  @if ($menuRoles)
                      @foreach($menuRoles as $menu)
                          @if($menu->menu_kode == 'hakakses-Create')
                              <a href="#" class="btn bg-gradient-primary btn-sm mb-0" onclick="openModal()" type="button">+&nbsp; Tambah</a>
                          @endif
                      @endforeach
                  @endif
              </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                  <table id="tableHakakses" class="table mb-0" style="min-height: 300px">
                      <thead>
                          <tr>
                              <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                  No
                              </th>
                              <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                  Nama
                              </th>
                              <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                  Kode
                              </th>
                              <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
              </div>
          </div>
      {{-- </div> --}}
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card p-4" style="min-height: 500px; max-height: 500px; overflow-y: auto;"">
        <form action="javascript:onSaveAkses()" method="post" id="formAkses" name="formAkses" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
          <div class="card-header p-0 pb-3">
            <div class="d-flex flex-row justify-content-end">
                <button type="submit" id="btnSaveAkses" class="btn bg-gradient-primary btn-sm mb-0" style="display: none;">&nbsp; Simpan</button>
            </div>
          </div>
          <input type="hidden" name="akses_hak_akses_id" id="akses_hak_akses_id">
          <div class="card-body px-0 pt-0 pb-2" id="menu-container">
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modalAddHakakses" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="javascript:onSave()" method="post" id="formHakakses" name="formHakakses" autocomplete="off" enctype="multipart/form-data" data-tour-add="1-ini adalah form anda" data-tour-update="4-mulai edit data">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tambah Hak Akses</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="hak_akses_id" id="hak_akses_id">

                    <div class="fv-row mb-2">
                        <label for="" class="form-label" style="font-size: 15px">Nama Hak Akses <span class="text-danger">*</span></label>
                        <input type="text" id="hak_akses_nama" name="hak_akses_nama" class="form-control form-control-solid" required placeholder="Silahkan isi Nama Hak Akses" />
                    </div>
                    <div class="fv-row mb-2">
                        <label for="" class="form-label" style="font-size: 15px">Kode Hak Akses <span class="text-danger">*</span></label>
                        <input type="text" id="hak_akses_kode" name="hak_akses_kode" class="form-control form-control-solid" required placeholder="Silahkan isi Kode Hak Akses" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModal" onclick="$('#modalAddHakakses').modal('hide');">Close</button>
                    <button type="submit" class="btn" style="background-color: #19184d; color: white;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  @include('hakakses::javascript')
@endsection

