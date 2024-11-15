<x-layout pageTitle="Liste des produits" >

    <div class="justify-end flex my-8">
        <a href="#" id="add-product" class="justify-self-end btn btn-secondary btn-outline btn-sm">
            <i class="mr-2" data-lucide="plus"></i>
            Ajouter un produit</a>
    </div>

    <label class="input input-bordered flex items-center gap-2 mb-3">
        <input id="tabulatorSearch" type="search" class="grow" placeholder="Search" />
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
            class="h-4 w-4 opacity-70">
            <path
                fill-rule="evenodd"
                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                clip-rule="evenodd" />
        </svg>
    </label>

    <div class="drawer drawer-end">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">

            <div id="destinationWrapper"></div>
            <table id="sourceTable" class="table">
                <thead>
                    <tr>
                        <th>#id</th>
                        <th tabulator-sorter="string">Marque</th>
                        <th tabulator-formatter="html" tabulator-headerFilter="tabulatorSearch">Nom</th>
                        @foreach( $properties as $aPropertyName => $aPropertyValues )
                            <th>{{ $aPropertyName }}</th>
                        @endforeach

                        @if( in_array(auth()->user()->getRoleNames()->first(), ['admin', 'super admin']) )
                        <th tabulator-formatter="html" >Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->name }}</td>
                        @foreach( $properties as $aPropertyName => $aPropertyValues )
                            @if( !empty($aPropertyValues) )
                                <td>{{ $product->{ 'prop'.$loop->iteration } }}</td>
                            @endif
                        @endforeach
                        @if( in_array(auth()->user()->getRoleNames()->first(), ['admin', 'super admin']) )
                        <td class="flex justify-end">
                            <a href="#" title="Modifier le produit"
                                   class="edit-product text-secondary inline-block"
                                   data-id="{{ $product->id }}"
                                   data-name="{{ $product->name }}"
                                   data-brand-id="{{ $product->brand_id }}"
                                   data-prop1="{{ $product->prop1 }}"
                                   data-prop2="{{ $product->prop2 }}"
                                   data-prop3="{{ $product->prop3 }}"
                                   data-prop4="{{ $product->prop4 }}"
                                   data-prop5="{{ $product->prop5 }}"
                               >
                                <i class="mr-8" data-lucide="pencil"></i>
                            </a>
                            <a href="{{ route('manage-products-edit', $product->id)  }}" title="Modifier le produit"
                                   class="text-primary inline-block"
                               >
                                <i class="" data-lucide="eye"></i>
                            </a>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <x-connected.products.parts.add  :brands="$brands" :properties="$properties" />
    </div>

</x-layout>
