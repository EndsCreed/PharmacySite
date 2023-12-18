<?php
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
?>
<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="headerStyle-text">
                {{ __('Patient Details') }}
            </h2>
            <x-dropdown>
                <x-slot name="trigger">
                    <button class="headerStyle-link text-white">Create Prescription</button>
                </x-slot>
                <x-slot name="content" class="contentStyle">
                    <livewire:components.create-prescription class="items-center"
                        :patient_id="$this->patient->sin"
                    />
                </x-slot>
            </x-dropdown>
{{--            <a href="{{ RouteServiceProvider::getRoute('prescription.create', ['patient_id' => $this->patient_id]) }}" class="headerStyle-link">--}}
{{--                {{ __('Create a Prescription') }}--}}
{{--            </a>--}}
        </div>
    </x-slot>
    <!-- Content -->
    <div class="contentStyle">

        <x-model-field label="Name">
            {{ $this->patient->name }}
        </x-model-field>

        <x-model-field label="SIN">
            {{ $this->patient->sin }}
        </x-model-field>

        <x-model-field label="Address">
            {{ $this->patient->address }}
        </x-model-field>

        <x-model-field label="Age">
            {{ $this->patient->age }}
        </x-model-field>

    </div>

    <div class="mt-4">
        <livewire:components.prescriptions-list :key="$this->key"
            :dSin="Auth::guard(Session::get('role'))->user()['sin']"
            :pSin="$this->patient->sin"
        />
    </div>
</div>
