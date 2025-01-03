<x-filament-panels::page>
    <div class="h-screen flex flex-col">
        <div class="flex-1 mx-auto w-full max-w-7xl p-6">
            <div class="bg-white shadow-2xl rounded-lg overflow-hidden h-full">
                <iframe
                    src="{{ url(config('web-tinker.path')) }}"
                    class="w-full h-full border-0"
                ></iframe>
            </div>
        </div>
    </div>
</x-filament-panels::page>
