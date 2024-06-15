<?php

namespace App\Livewire\System\Company;

use App\Services\System\CompanyService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCompany extends Component
{
    use WithFileUploads;
    public $breadcrumbs = [['title' => "Empresa", "url" => "company.edit"]];
    public $companyArray = [];

    public $company;
    public $foto;
    public $logo;

    public $validate = [
        'companyArray.nombre' => 'required',
        'companyArray.direccion' => 'required',
        'companyArray.telefono' => 'required',
        'companyArray.correo' => 'required',
        'companyArray.slogan' => 'required',
        'companyArray.descripcion' => 'required',
        'companyArray.meta_access_token' => 'required',
        'companyArray.meta_page_id_meta' => 'required',
        'companyArray.meta_app_id_meta' => 'required',
        'companyArray.meta_app_secret' => 'required',
        'foto' => 'nullable|image',
        'logo' => 'nullable|image',
    ];

    public $message = [
        'companyArray.nombre.required' => 'El nombre es requerido',
        'companyArray.direccion.required' => 'La direccion es requerida',
        'companyArray.telefono.required' => 'El telefono es requerido',
        'companyArray.correo.required' => 'El correo es requerido',
        'companyArray.slogan.required' => 'El slogan es requerido',
        'companyArray.descripcion.required' => 'La descripcion es requerida',
        'companyArray.meta_access_token.required' => 'El token de acceso es requerido',
        'companyArray.meta_page_id_meta.required' => 'El identificador de pagina es requerido',
        'companyArray.meta_app_id_meta.required' => 'El identificador de aplicacion es requerido',
        'companyArray.meta_app_secret.required' => 'El codigo secreto de la aplicacion es requerido',
        'foto.required' => 'La foto es requerida',
        'foto.image' => 'La foto debe ser una imagen',
    ];

    public function mount($company)
    {
        $this->company = CompanyService::getOne(auth()->user()->company_id);
        $this->companyArray = $this->company->toArray();
    }

    private function saveFile($file, $path)
    {
        $filePath = $file->store($path, 's3', 'public');
        $fileUrl = Storage::disk('s3')->url($filePath);
        return $fileUrl;
    }

    private function deleteFile($path)
    {
        $pathFileOld = str_replace('storage/', '', $path);
        if (Storage::exists($pathFileOld)) Storage::disk('public')->delete($pathFileOld);
    }


    public function save()
    {
        $this->validate($this->validate, $this->message);
        if ($this->foto) {
            $this->companyArray['foto'] = $this->saveFile($this->foto, 'marketing/company');
            // $this->deleteFile($this->companyArray['foto']);
        }
        if ($this->logo) {
            $this->companyArray['logo'] = $this->saveFile($this->logo, 'marketing/company');
            // $this->deleteFile($this->companyArray['logo']);
        }
        CompanyService::update($this->company->id, $this->companyArray);
        return redirect()->route('company.edit', ['company' => $this->company->id]);
    }

    public function render()
    {
        return view('livewire.system.company.edit-company');
    }
}
