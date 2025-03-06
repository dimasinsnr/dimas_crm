<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Membuat module baru dengan struktur yang sudah ditentukan';

    public function handle()
    {
        $name = ucfirst($this->argument('name')); // Nama module
        $nameView = $this->argument('name');
        $modulePath = base_path("modules/{$nameView}");

        $filesystem = new Filesystem();

        // Buat struktur folder
        $folders = [
            "{$modulePath}/Controllers",
            "{$modulePath}/Models",
            "{$modulePath}/Views",
            "{$modulePath}/Services",
            "{$modulePath}/Routes",
        ];

        foreach ($folders as $folder) {
            if (!$filesystem->isDirectory($folder)) {
                $filesystem->makeDirectory($folder, 0777, true);
                $this->info("Folder created: {$folder}");
            }
        }

        // Buat file Controller
        $controllerPath = "{$modulePath}/Controllers/{$name}Controller.php";
        if (!$filesystem->exists($controllerPath)) {
            $filesystem->put($controllerPath, $this->getControllerTemplate($name, $nameView));
            $this->info("Controller created: {$controllerPath}");
        }

        // Buat file Service
        $servicePath = "{$modulePath}/Services/{$name}Service.php";
        if (!$filesystem->exists($servicePath)) {
            $filesystem->put($servicePath, $this->getServiceTemplate($name));
            $this->info("Service created: {$servicePath}");
        }

        // Buat file Model
        $modelPath = "{$modulePath}/Models/{$name}Model.php";
        if (!$filesystem->exists($modelPath)) {
            $filesystem->put($modelPath, $this->getModelTemplate($name));
            $this->info("Model created: {$modelPath}");
        }

        // Buat file View
        $viewPath = "{$modulePath}/Views/{$nameView}.blade.php";
        if (!$filesystem->exists($viewPath)) {
            $filesystem->put($viewPath, "<h1>Halaman {$nameView}</h1>");
            $this->info("View created: {$viewPath}");
        }

        // Create javascript.blade.php
        $jsViewPath = "{$modulePath}/Views/javascript.blade.php";
        if (!$filesystem->exists($jsViewPath)) {
            $filesystem->put($jsViewPath, $this->getJsTemplate($name));
            $this->info("View created: {$jsViewPath}");
        }

        // Create ul-action.blade.php
        $ulActionViewPath = "{$modulePath}/Views/ul-action.blade.php";
        if (!$filesystem->exists($ulActionViewPath)) {
            $filesystem->put($ulActionViewPath, $this->getUlTemplate($name));
            $this->info("View created: {$ulActionViewPath}");
        }

        // Buat file Routes
        $routePath = "{$modulePath}/Routes/Route.php";
        if (!$filesystem->exists($routePath)) {
            $filesystem->put($routePath, $this->getRouteTemplate($name, $nameView));
            $this->info("Routes file created: {$routePath}");
        }

        $this->info("Module {$name} berhasil dibuat!");
    }

    private function getControllerTemplate($name, $nameView)
    {
        return <<<EOT
        <?php

            namespace Modules\\{$name}\\Controllers;

            use Illuminate\\Http\\Request;
            use App\\Http\\Controllers\\Controller;
            use Yajra\\DataTables\\DataTables;
            use Modules\\{$name}\\Services\\{$name}Service;

            class {$name}Controller extends Controller
            {
                protected \${$name}Service;

                public function __construct({$name}Service \${$name}Service)
                {
                    \$this->{$name}Service = \${$name}Service;
                }

                public function index()
                {
                    return view('{$nameView}::{$nameView}', [
                        'title' => 'Data {$name}'
                    ]);
                }

                public function initTable()
                {
                    \${$name} = \$this->{$name}Service->getAll{$name}();

                    return DataTables::of(\${$name})
                        ->addColumn('action', '{$name}::ul-action')
                        ->rawColumns(['action'])
                        ->addIndexColumn(function (\$data) {
                            return \$data->firstItem();
                        })
                        ->make(true);
                }

                public function storeData(Request \$request)
                {
                    try {
                        \$data = \$request->only(['{$nameView}_id', '{$nameView}_kode', '{$nameView}_nama', '{$nameView}_deskripsi', '{$nameView}_harga']);
                        \${$name} = \$this->{$name}Service->storeOrUpdate{$name}(\$data);

                        return response()->json([
                            'success' => true,
                            'message' => \$data['{$name}_id'] ? 'Data {$name} berhasil diperbarui.' : 'Data {$name} berhasil disimpan.',
                            'user' => \${$name}
                        ]);
                    } catch (\Exception \$e) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Gagal menyimpan data {$name}.',
                            'error' => \$e->getMessage()
                        ], 500);
                    }
                }

                public function deleteData(Request \$request)
                {
                    try {
                        \${$name} = \$this->{$name}Service->delete{$name}ById(\$request->{$name}_id);

                        return response()->json([
                            'success' => true,
                            'message' => 'Data {$name} berhasil dihapus.',
                            'user' => \${$name}
                        ]);
                    } catch (\Exception \$e) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Terjadi kesalahan saat menghapus data.',
                            'error' => \$e->getMessage()
                        ], 500);
                    }
                }
            }
        EOT;
    }

    private function getServiceTemplate($name)
    {
        return <<<EOT
        <?php

            namespace Modules\\{$name}\\Services;

            use Modules\\{$name}\\Models\\{$name}Model;
            use Ramsey\Uuid\Uuid;
            use Exception;

            class {$name}Service
            {
                /**
                 * Get all {$name} that are not deleted.
                 *
                 * @return \Illuminate\Database\Eloquent\Collection
                 */
                public function getAll{$name}()
                {
                    return {$name}Model::query()
                        ->whereNull('{$name}_deleted_at')
                        ->orderByDesc('{$name}_created_at')
                        ->get();
                }

                /**
                 * Store or update a {$name}.
                 *
                 * @param  array  \$data
                 * @return \\Modules\\{$name}\\Models\\{$name}Model
                 */
                public function storeOrUpdate{$name}(array \$data)
                {
                    try {
                        if (!empty(\$data['{$name}_id'])) {
                            // Update existing {$name}
                            \${$name} = {$name}Model::find(\$data['{$name}_id']);

                            if (!\${$name}) {
                                throw new Exception('{$name} tidak ditemukan.');
                            }

                            \${$name}->{$name}_nama = \$data['{$name}_nama'];
                            \${$name}->{$name}_kode = \$data['{$name}_kode'];
                            \${$name}->{$name}_harga = \$data['{$name}_harga'];
                            \${$name}->{$name}_deskripsi = \$data['{$name}_deskripsi'];
                            \${$name}->{$name}_updated_at = now();

                            \${$name}->save();

                            return \${$name};
                        } else {
                            // Create new {$name}
                            \${$name}Id = Uuid::uuid4()->toString();

                            return {$name}Model::create([
                                '{$name}_id' => \${$name}Id,
                                '{$name}_kode' => \$data['{$name}_kode'],
                                '{$name}_nama' => \$data['{$name}_nama'],
                                '{$name}_deskripsi' => \$data['{$name}_deskripsi'],
                                '{$name}_harga' => \$data['{$name}_harga'],
                                'created_at' => now(),
                                'updated_at' => null,
                                'deleted_at' => null
                            ]);
                        }
                    } catch (Exception \$e) {
                        throw new Exception('Gagal menyimpan data {$name}: ' . \$e->getMessage());
                    }
                }

                /**
                 * Delete a {$name} by its ID.
                 *
                 * @param  string  \${$name}_id
                 * @return \\Modules\\{$name}\\Models\\{$name}Model
                 */
                public function delete{$name}ById(\${$name}_id)
                {
                    \${$name} = {$name}Model::find(\${$name}_id);

                    if (!\${$name}) {
                        throw new Exception('{$name} tidak ditemukan.');
                    }

                    \${$name}->delete();

                    return \${$name};
                }
            }
        EOT;
    }

    private function getModelTemplate($name)
    {
        return <<<EOT
        <?php

            namespace Modules\\{$name}\\Models;

            use Illuminate\Database\Eloquent\Factories\HasFactory;
            use Illuminate\Database\Eloquent\Model;
            use Illuminate\Database\Eloquent\SoftDeletes;

            class {$name}Model extends Model
            {
                use HasFactory, SoftDeletes;

                protected \$table = '{$name}';

                protected \$primaryKey = '{$name}_id';

                public \$incrementing = false;

                protected \$fillable = [
                    '{$name}_id',
                    '{$name}_kode',
                    '{$name}_nama',
                    '{$name}_deskripsi',
                    '{$name}_harga',
                ];

                protected \$hidden = [
                    'updated_at', 'deleted_at',
                ];

                protected \$casts = [
                    'created_at' => 'datetime',
                    'updated_at' => 'datetime',
                    'deleted_at' => 'datetime',
                ];

                public \$timestamps = true;

                const CREATED_AT = '{$name}_created_at';
                const UPDATED_AT = '{$name}_updated_at';
                const DELETED_AT = '{$name}_deleted_at';
            }
        EOT;
    }

    private function getRouteTemplate($name, $nameView)
    {
        return <<<EOT
        <?php

            use Illuminate\Support\Facades\Route;
            use Modules\\{$name}\\Controllers\\{$name}Controller;

            Route::prefix('{$name}')->middleware('auth')->group(function () {
                \$actions = ['storeData', 'deleteData',];
                Route::get('/', [{$name}Controller::class, 'index'])->name('{$nameView}.index');
                Route::get('initTable', [{$name}Controller::class, 'initTable']);
                foreach (\$actions as \$action) {
                    Route::post(\$action, [{$name}Controller::class, \$action]);
                }
            });
        EOT;
    }

    private function getJsTemplate($name)
    {
        return <<<EOT
            <script type="text/javascript">
                $(() => {
                    HELPER.api = {
                        table{$name}: BASE_URL + '{$name}/initTable',
                        store{$name}: BASE_URL + '{$name}/storeData',
                        delete{$name}: BASE_URL + '{$name}/deleteData',
                    };

                    init();
                });

                init = async () => {
                    await initTable();
                    await HELPER.unblock(100);
                }

                initTable = () => {
                    $('#table{$name}').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: HELPER.api.table{$name},
                        columns: [
                            {
                                data: null,
                                searchable: false,
                                orderable: false,
                                render: function (data, type, row, meta) {
                                    return meta.row + 1;
                                }
                            },
                            { data: '{$name}_kode'},
                            { data: '{$name}_nama'},
                            { data: '{$name}_harga'},
                            {
                                data: 'created_at',
                                render: function(data, type, row) {
                                    return moment(data).format('DD-MM-YYYY');
                                }
                            },
                            { data: 'action', name: 'action', orderable: false},
                        ],
                        order: [[1, 'asc']]
                    });
                    $('.dropdown-toggle').dropdown();
                }

                onRefresh = () => {
                    $('#table{$name}').DataTable().destroy(); 
                    initTable();
                }

                onSave = () => {
                    var formData = new FormData($('[name="form{$name}"]')[0]);
                    HELPER.confirm({
                        message: 'Anda yakin ingin menyimpan data ?',
                        callback: (result) => {
                            if (result) {
                                HELPER.block();
                                $.ajax({
                                    url: HELPER.api.store{$name},
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false, 
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: (response) => {
                                        if (response.success == true) {
                                            $('#modalAdd{$name}').modal('hide');
                                            $('#table{$name}').DataTable().destroy(); 
                                            initTable();
                                            HELPER.showMessage({
                                                success: true,
                                                message: response.message,
                                                title: 'Success'
                                            });
                                        } else {
                                            $('#modalAdd{$name}').hide();
                                            HELPER.showMessage({
                                                success: false,
                                                message: response.message,
                                                title: 'False'
                                            });
                                        }
                                    },
                                    complete: (response) => {
                                        HELPER.unblock(500);
                                    }
                                });
                            }
                        }
                    })
                }

                onEdit = ({$name}_id, {$name}_kode, {$name}_nama, {$name}_deskripsi, {$name}_harga) => {
                    $('#{$name}_id').val({$name}_id);
                    $('#{$name}_kode').val({$name}_kode);
                    $('#{$name}_nama').val({$name}_nama);
                    $('#{$name}_deskripsi').val({$name}_deskripsi);
                    $('#{$name}_harga').val({$name}_harga);
                    $('#modalAdd{$name}').modal('show');
                }

                onDelete = ({$name}_id) => {
                    HELPER.confirm({
                        message: 'Anda yakin ingin menghapus data ?',
                        callback: (result) => {
                            if (result) {
                                HELPER.block();
                                $.ajax({
                                    url: HELPER.api.delete{$name},
                                    type: 'POST',
                                    data: {
                                        {$name}_id: {$name}_id,
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: (response) => {
                                        if (response.success == true) {
                                            $('#modalAdd{$name}').modal('hide');
                                            $('#table{$name}').DataTable().destroy(); 
                                            initTable();
                                            HELPER.showMessage({
                                                success: true,
                                                message: response.message,
                                                title: 'Success'
                                            });
                                        } else {
                                            $('#modalAdd{$name}').hide();
                                            HELPER.showMessage({
                                                success: false,
                                                message: response.message,
                                                title: 'False'
                                            });
                                        }
                                    },
                                    complete: (response) => {
                                        HELPER.unblock(500);
                                    }
                                });
                            }
                        }
                    })
                }

                openModal = () => {
                    $('#{$name}_id').val('');
                    $('#{$name}_kode').val('');
                    $('#{$name}_nama').val('');
                    $('#{$name}_deskripsi').val('');
                    $('#{$name}_harga').val('');
                    $('#modalAdd{$name}').modal('show');
                }
            </script>
        EOT;
    }

    private function getUlTemplate($name)
    {
        return <<<EOT
            @php
            \$menuRoles = session('menuRoles') ? unserialize(base64_decode(session('menuRoles'))) : null;
            @endphp

            @if (\$menuRoles)
                @foreach(\$menuRoles as \$menu)
                    @if(\$menu->menu_kode == '{$name}-Update')
                        <td class="text-center">
                            <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="Edit {{ \$name }}" onclick="onEdit('{{ strval(\$produk_id) }}', '{{ strval(\$produk_kode) }}', '{{ strval(\$produk_nama) }}', '{{ strval(\$produk_deskripsi) }}', '{{ strval(\$produk_harga) }}')">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    @endif
                    @if(\$menu->menu_kode == '{$name}-Delete')
                        <td class="text-center">
                            <a href="javascript:void(0)" class="ms-3" data-bs-toggle="tooltip" data-bs-original-title="Delete {{ \$name }}" onclick="onDelete('{{ strval(\$produk_id) }}')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    @endif
                @endforeach
            @endif
        EOT;
    }
}
