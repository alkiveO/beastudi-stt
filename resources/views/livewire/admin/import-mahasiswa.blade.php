<div>
    <div>
        <a href="{{ route('admin.index') }}" class="btn btn-sm btn-success">Download</a>
        <input type="file" style="border:1px solid red;width:17%;" id="file" class="p-2" wire:model.lazy='file'>
    </div>
    <span class="required">
        @error('file')
            {{ $message }}
        @enderror
    </span>
    <span wire:loading>proses import data...</span>
</div>
