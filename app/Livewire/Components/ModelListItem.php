<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ModelListItem extends Component
{
    public $model_id;
    public $modelName;
    public $viewRoute;
    public $editRoute;
    public $topLeft = '';
    public $bottomLeft = '';
    public $topRight = '';
    public $bottomRight = '';
    public $useDelete = false;
    public $useEdit = false;

    public function mount($model_id) {
        $this->model_id = $model_id;
        if (!isset($this->viewRoute))
            $this->viewRoute = $this->modelName . '.view';
        if (!isset($this->editRoute))
            $this->editRoute = $this->modelName . '.edit';
    }

    public function render() {
        return view('livewire.components.model-list-item');
    }
}
