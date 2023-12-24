<div class="items-center m-auto justify-center bg-transparent">
    <div class="mt-8 mb-12">
        <div class="p-0 text-sm md:text-base justify-items flex justify-between">
            @for($i = 1; $i <= 4; $i++)
                <livewire:torrents.components.create-progress-step :stage="$i" :isActiveStage="$i == ($variables['stage'] ?? false)" />
            @endfor
        </div>
    </div>
</div>