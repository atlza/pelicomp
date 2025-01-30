<x-layout pageTitle="Liste des produits" >
    <section  class="container card mx-auto bg-white p-3">
        <div class="prose max-w-none">
            <h1 class="mb-3">Edition : {{ $product->brand->name }} {{ $product->name }}
                <small class="block text-sm text-gray-600">{{ array_keys($properties)[0] }} : {{ $product->prop1 }} - {{ array_keys($properties)[1] }} : {{ $product->prop2 }}</small>
            </h1>
            <div class="flex w-full flex-col lg:flex-row ">
                <div class="w-1/3 px-3">
                    <h2>Modifier le produit</h2>
                    <form action="{{ route('manage-products-add') }}" method="post">
                        @csrf

                        <input id="edit-product-id"
                               type="hidden"
                               value="{{ $product->id }}"
                               name="id" />

                        <label class="form-control w-full max-w-sm">
                            <div class="label">
                                <span class="label-text">Marque :</span>
                            </div>
                            <select id="edit-product-brand" class="select select-bordered  mb-3" name="brand_id" required="required">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {!! $product->brand_id == $brand->id ? 'selected="true"' : '' !!} >{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="form-control w-full max-w-sm">
                            <div class="label">
                                <span class="label-text">Nom du produit :</span>
                            </div>
                            <input id="edit-product-name"
                                   type="text"
                                   name="name"
                                   value="{{ $product->name }}"
                                   placeholder="Nom du produit"
                                   class="input input-bordered w-full  mb-3"
                                   required="required" />
                        </label>

                        @foreach( $properties as $propertyName => $propertyAttributes )
                            @php
                                $propertyLoopIndex = $loop->iteration;
                            @endphp
                            <label class="form-control w-full max-w-sm">
                                <div class="label">
                                    <span class="label-text">{{ $propertyName }} :</span>
                                </div>
                                @if( is_array($propertyAttributes['values']) )
                                    <select name="prop{{ $loop->iteration }}"
                                            id="edit-product-prop{{ $loop->iteration }}"
                                            class="select select-bordered w-full  mb-3"
                                        {!! $propertyAttributes['mandatory'] === true ? 'required="required"' : '' !!} >
                                            <option></option>
                                        @foreach( $propertyAttributes['values'] as $anAttribute )
                                            <option value="{{ $anAttribute  }}"
                                                {!! $anAttribute == $product->{'prop'.$propertyLoopIndex} ? 'selected="selected"' : '' !!}
                                            >{{ $anAttribute }} - {{ $product->{'prop'.$propertyLoopIndex} }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input placeholder="{{ $propertyName }}"
                                           id="edit-product-prop{{ $loop->iteration }}"
                                           type="{{ $propertyAttributes['values'] }}"
                                           name="prop{{ $loop->iteration }}"
                                           value="{{ $product->{'prop'.$loop->iteration} }}"
                                           class="input input-bordered w-full  mb-3"
                                        {!! $propertyAttributes['values'] === "number" ? 'step="1"' : '' !!}
                                        {!! !empty($propertyAttributes['default']) ? 'value="'.$propertyAttributes['default'].'"' : '' !!}
                                        {!! $propertyAttributes['mandatory'] === true ? 'required="required"' : '' !!} />
                                @endif
                            </label>

                        @endforeach

                        <button type="submit" class="btn btn-success w-1/2  btn-outline">Enregistrer</button>
                    </form>

                </div>

                <div class="w-2/3 p-3">
                    <h2>Offres liées</h2>
                    <div id="destinationWrapper"></div>
                    <table id="sourceTable" class="table">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>Boutique</th>
                            <th>Price</th>
                            <th>Mise à jour</th>

                            @if( in_array(auth()->user()->getRoleNames()->first(), ['admin', 'super admin']) )
                                <th tabulator-formatter="html">Actions</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($product->offers as $offer)
                            <tr>
                                <td>{{ $offer->id }}</td>
                                <td>{{ $offer->shop->name }}</td>
                                <td>{{ $offer->price }}</td>
                                <td>{{ $offer->updated_at }}</td>
                                <td>
                                    <a href="{{ $offer->url }}" title="Voir l'offre" target="_blank"
                                       class="text-neutral inline-block" >
                                        <i class="mr-4" data-lucide="link"></i>
                                    </a>
                                    <a href="{{ route('manage-offer-update', $offer->id)  }}" title="Mettre à jour"
                                       class="text-secondary inline-block" >
                                        <i class="mr-4" data-lucide="refresh-cw"></i>
                                    </a>
                                    <a href="#" title="Supprimer"
                                       class="text-error inline-block delete-offer"
                                        data-id="{{ $offer->id  }}">
                                        <i class="" data-lucide="delete"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h2>Ajout d'offres</h2>
                    <p class="text-gray-600 text-xs">
                        Vous pouvez ajouter plusieurs offres d'un coup, en ajoutant une URL par ligne.
                        Les offres provenant de boutiques non reconnues seront ignorées.
                    </p>
                    <form method="post" action="{{ route('manage-offer-add-multiple') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <textarea name="urls" placeholder="Max 10 URLs" class="h-32 textarea textarea-bordered w-full p-3 mb-3"></textarea>
                        <button type="submit" class="float-end btn btn-success w-1/3  btn-outline">Ajouter</button>
                    </form>

                </div>
            </div>

        </div>

    </section>


    <dialog id="modal-delete-offer" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Confirmation</h3>
            <p class="py-4">Voulez-vous vraiment supprimer cette offre ?</p>
            <div class="modal-action">
                <form method="dialog">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
                <form method="post" action="{{ route('manage-offer-delete') }}">
                    @csrf
                    <!-- if there is a button in form, it will close the modal -->
                    <input type="hidden" id="delete-offer-id" name="id" value="" />
                    <button class="btn btn-error">Supprimer</button>
                </form>
            </div>
        </div>
    </dialog>

</x-layout>
