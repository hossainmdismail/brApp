<div id="searchForm">
    <div class="form-group">
        <label for="searchInput">Search</label>
        <input type="text" wire:model.live="search" class="form-control" id="searchInput"
            placeholder="Enter product name...">
    </div>
    <div class="result">
        {{-- {{ $product }} --}}
        <table class="table table-striped">
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="d-flex">
                            <a href="{{ route('product.view', $product->slugs) }}">
                                <a class="mr-5" href="{{ route('product.view', $product->slugs) }}">
                                    @if ($product->attributes && $product->attributes->first())
                                        @foreach ($product->attributes->take(1) as $key => $image)
                                            <img class="{{ $key + 1 == 1 ? 'default-img' : 'hover-img' }}"
                                                src="{{ asset('files/product/' . $image->image) }}" width="60">
                                        @endforeach
                                    @else
                                        <img class="default-img" src="{{ asset('noAvatar.png') }}" width="60">
                                    @endif
                                </a>
                                <div>
                                    <a href="{{ route('product.view', $product->slugs) }}">{{ $product->name }}</a>
                                    <br>
                                    <span style="font-size: 11px">৳
                                        {{ number_format($product->getFinalPrice()) }}</span>
                                </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>

    </div>
</div>
