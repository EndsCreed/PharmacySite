<?php
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
?>
<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Home') }}
            </h2>
        </div>
    </x-slot>
    <p class="text-white mt-5 mx-5">Welcome {{ Auth::guard(Session::get('role'))->user()->name }}!</p>
    <p class="text-white mt-2 mx-5">Your guard is {{ Auth::guard(Session::get('role'))->user()->getGuarded() }}</p>
</div>
