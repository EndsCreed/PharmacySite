<?php use App\Providers\RouteServiceProvider; ?>
<div>
    <li class="flex max-w-full">
        <!-- Desktop/Tablet Display -->
        <div class="hidden sm:block basis-full grow">
            <a wire:navigate href="{{ RouteServiceProvider::getRoute($viewRoute, [$modelName . '_id' => encrypt($model_id)]) }}" class="flex text-gray-300 py-2 my-2 px-2 pr-4 hover:bg-gray-900 rounded-l-md">
                <div class="basis-full justify-center">
                    <div class="font-semibold">
                        {{ $topLeft }}
                    </div>
                    <div class="row-start-2">
                        {{ $bottomLeft }}
                    </div>
                </div>
                <div class="shrink-0">
                    <div class="flex justify-end font-semibold">
                        {{ $topRight }}
                    </div>
                    <div class="flex justify-end">
                        {{ $bottomRight }}
                    </div>
                </div>
            </a>
        </div>
        <div class="flex justify-between grow">
            <!-- Mobile Display -->
            <div class="sm:hidden w-full">
                <a wire:navigate href="{{ RouteServiceProvider::getRoute($viewRoute, [$modelName . '_id' => encrypt($model_id)]) }}" class="flex text-gray-300 py-2 my-2 px-2 pr-4 hover:bg-gray-900 rounded-l-md">
                    <div class="shrink-0">
                        <div class="font-semibold">
                            {{ $topLeft }}
                        </div>
                        <div class="font-semibold">
                            {{ $topRight }}
                        </div>
                    </div>
                </a>
            </div>
            <!-- End Buttons -->
            @if($useDelete)
                <button type="submit" wire:click="$parent.destroy({{ $this->model_id }})" class="px-4 grid items-center rounded-r-md hover:bg-gray-900 text-white my-2 py-2">
                    <i class="fa-solid fa-trash"></i>
                </button>
            @endif
        </div>
    </li>
</div>
