<x-layout pageTitle="Boutique ajout de produits" >

    <form method="post" action="">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}" />

        <div class="bg-white flex flex-row align-bottom w-full rounded p-4">
            <div class="basis-3/4 ">
                <div class="prose max-w-none">
                    <h2 class="">Ajout/liaison des produits existants avec ceux importés</h2>
                    <p class="">
                        Choisissez un produit déjà en base pour l'associer ou laissez vide pour en créer un nouveau.<br />
                        Si le produit existe déjà l'offre sera mise à jour avec le tarif importé.
                    </p>
                </div>
            </div>
            <div class="basis-1/4 text-right relative">
                <button type="submit" class="btn btn-success absolute bottom-0 right-0">Save products & offers</button>
            </div>
        </div>

        <div id="destinationWrapper"></div>
        <table id="" class="mt-4 table text-right">
            <thead>
                <tr>
                    <th class="text-left">Nom</th>
                    <th class="">GTIN</th>
                    <th class="">Price</th>
                    <th class="">Product</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($newProducts as $newProduct)
                <tr>
                    <td class="text-left">
                        <a href="{{ $newProduct['url'] }}" target="_blank">{{ $newProduct['name'] }} </a>
                        <input type="hidden" name="product_id[{{ $loop->index }}]" value="" />
                        <input type="hidden" name="product_offer_price[{{ $loop->index }}]" value="{{ $newProduct['price'] }}" />
                        <input type="hidden" name="product_offer_url[{{ $loop->index }}]" value="{{ $newProduct['url'] }}" />
                    </td>
                    <td class="">
                        <select id="add-product-from-shop-product-exists" class="select select-bordered w-64">
                            <option>None</option>
                            @foreach( $products as $product)
                                <option value="{{ $product->id }}">{{ $product->brand->name }} {{ $product->name  }} {{ $product->prop1  }}mm {{ $product->prop2  }}Iso {{ $product->prop3  }} - x{{ $product->prop4  }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="link-product btn btn-outline btn-neutral btn-sm mt-1"
                                data-product-name="{{ $newProduct['name'] }}"
                                data-product-gtin="{{ $newProduct['gtin'] }}"
                                data-loop-index="{{ $loop->index }}"
                        >
                            <i data-lucide="plus" class="mr-2"></i>Add a product
                        </button>
                    </td>
                    <td class="">{{ $newProduct['gtin'] }}</td>
                    <td class="">{{ $newProduct['price'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>


    <dialog id="modal-link-product" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box  max-w-5xl ">
            <h3 id="add-product-modal-title" class="font-bold text-lg"></h3>
            <p class="py-4 text-base-500">
                Si le produit n'existe pas dans la liste, créez-en un grâce au formulaire en dessous.<br />
                Il sera créé, ajouté à la liste et automatiquement sélectionné.
            </p>
            <form action="" method="post">
                @csrf
                <input type="hidden" name="shop_id" value="" id="shop_id">
                <input type="hidden" id="loop_index" value="" >

                <div class="grid place-items-center">
                    <div class="grid grid-cols-2 place-items-center gap-2">
                        <select id="edit-product-brand" class="select select-bordered w-full max-w-xs mb-3" name="brand_id" required="required">
                            <option disabled selected>Marque</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" >{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        <input id="add-product-name"
                               type="text"
                               name="name"
                               placeholder="Nom du produit"
                               class="input input-bordered w-full max-w-xs mb-3"
                               required="required" />

                        @foreach( $properties as $propertyName => $propertyAttributes )
                            @if( is_array($propertyAttributes['values']) )
                                <select name="prop{{ $loop->iteration }}"
                                        id="add-product-prop{{ $loop->iteration }}"
                                        class="select select-bordered w-full max-w-xs mb-3"
                                    {!! $propertyAttributes['mandatory'] === true ? 'required="required"' : '' !!} >
                                    <option disabled selected>{{ $propertyName }}</option>
                                    @foreach( $propertyAttributes['values'] as $anAttribute )
                                        <option value="{{ $anAttribute  }}">{{ $anAttribute }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input placeholder="{{ $propertyName }}"
                                       id="edit-product-prop{{ $loop->iteration }}"
                                       type="{{ $propertyAttributes['values'] }}"
                                       name="prop{{ $loop->iteration }}"
                                       class="input input-bordered w-full max-w-xs mb-3"
                                    {!! $propertyAttributes['values'] === "number" ? 'step="1"' : '' !!}
                                    {!! !empty($propertyAttributes['default']) ? 'value="'.$propertyAttributes['default'].'"' : '' !!}
                                    {!! $propertyAttributes['mandatory'] === true ? 'required="required"' : '' !!} />
                            @endif
                        @endforeach

                        <input id="add-product-gtin"
                               type="integer"
                               step="1"
                               min="0"
                               name="gtin"
                               placeholder="Gtin du produit"
                               class="input input-bordered w-full max-w-xs mb-3" />
                    </div>
                </div>

                <button id="add-product-from-shop" type="submit" class="btn btn-success mb-6 w-full justify-self-end">Ajouter</button>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

</x-layout>
