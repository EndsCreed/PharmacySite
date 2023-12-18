<?php
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
?>
<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="headerStyle-text">
                {{ __('Contract Details') }}
            </h2>
        </div>
    </x-slot>
    <!-- Content -->
    <div class="contentStyle">

        <x-model-field label="Company Name">
            {{ $this->companyName }}
        </x-model-field>

        <x-model-field label="Supervisor ID">
            {{ $this->contract->supervisorID }}
        </x-model-field>

        <x-model-field label="Issued">
            {{ $this->contract->issued }}
        </x-model-field>

        <x-model-field label="Expires">
            {{ $this->contract->expires }}
        </x-model-field>

    </div>

    {{ $drugs->links() }}

    <div class="contentStyle">
        <h2 class="headerStyle-text mx-4 border-b pb-2 border-gray-600">
            Contracted Drugs
        </h2>
        <ul class="p-2 divide-y divide-gray-600 rounded-none mx-4">
            @foreach($drugs as $drug)
                <div class="border-b border-gray-700">
                    <livewire:components.ModelListItem
                        :key="$drug->id"
                        :model_id="$drug->id"
                        modelName="product"
                        :topLeft="$drug->tradeName"
                        :bottomLeft="$drug->formula"
                    />
                </div>
            @endforeach
        </ul>
    </div>

</div>
