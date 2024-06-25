<div class="drawer-side">
    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="menu p-4 w-80 min-h-full bg-base-200 text-base-content prose">
        <h2>Ajouter un produit</h2>
        <form action="{{ route('manage-products-add') }}" method="post">
            @csrf

            <select class="select select-bordered w-full max-w-xs mb-3" name="brand_id">
                <option disabled selected>Marque</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" >{{ $brand->name }}</option>
                @endforeach
            </select>
            <input type="text" name="name" placeholder="Nom du produit" class="input input-bordered w-full max-w-xs mb-3" />

            @foreach( $properties as $propertyName => $propertyAttributes )
                @if( is_array($propertyAttributes) )
                    <select name="prop{{ $loop->iteration }}" class="select select-bordered w-full max-w-xs mb-3">
                        <option disabled selected>{{ $propertyName }}</option>
                        @foreach( $propertyAttributes as $anAttribute )
                            <option value="{{ $anAttribute  }}">{{ $anAttribute }}</option>
                        @endforeach
                    </select>
                @else
                    <input placeholder="{{ $propertyName }}"
                           type="{{ $propertyAttributes }}"
                           name="prop{{ $loop->iteration }}"
                           class="input input-bordered w-full max-w-xs mb-3"
                        {{ $propertyAttributes === "number" ? 'step="1"' : '' }} />
                @endif
            @endforeach

            <button type="submit" class="btn btn-success btn-outline">Enregistrer</button>
        </form>
    </div>
</div>
