    <div class="col-md-6">
        <!-- Modal Color add -->
        <div class="modal fade" id="color" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Color attributes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="save">
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" wire:model="name" class="form-control" placeholder="Color name">

                                @error('name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="color" wire:model="code" class="form-control" placeholder="Color code">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Color</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#color">
                    Add color
                </button>
            </div>
            <div class="card-bodys"></div>
        </div>
    </div>

    @script
        <script>
            console.log('hi');
            $wire.on('stayModal', () => {
                console.log('hi');
            });
        </script>
    @endscript
