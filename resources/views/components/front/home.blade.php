<x-front.layout>
    <x-slot name="frontContent">

        <x-parts.message type="error" />

        <div class="content py-8">
            <label class="input input-bordered flex items-center gap-2 mb-4">
                <input type="text" class="grow" placeholder="Search" />
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg>
            </label>
            <div id="wrapper">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Marque</th>
                        <th>Nom</th>
                        @foreach( $properties as $aPropertyName => $aPropertyValues )
                            <td>{{ $aPropertyName }}</td>
                        @endforeach
                        @foreach ($shops as $shop)
                            <th class="w-3">{{ $shop->name }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->name }}</td>
                            @foreach( $properties as $aPropertyName => $aPropertyValues )
                                @if( !empty($aPropertyValues) )
                                    <td>{{ $product->{ 'prop'.$loop->iteration } }}</td>
                                @endif
                            @endforeach
                            @foreach ($shops as $shop)
                                <td class="w-3 text-center">
                                    @if( Auth::check() && empty($offers[$product->id][$shop->id]) )
                                        <a href="#" title="Ajouter une offre" class="add-offer text-secondary flex"
                                           id="offer_{{ $shop->id }}_{{ $product->id }}"
                                           data-shop="{{ $shop->id }}" data-product="{{ $product->id }}">
                                            <i class="h-4 mx-auto" data-lucide="plus"></i>
                                        </a>
                                    @elseif( !empty($offers[$product->id][$shop->id]) )
                                        <a href="{{ $offers[$product->id][$shop->id]->url }}" target="_blank" title="Voir l'offre">{{ $offers[$product->id][$shop->id]->price }}€</a>
                                    @else
                                        <i class="h-4 mx-auto" data-lucide="minus"></i>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <dialog id="add_offer_modal" class="modal modal-bottom sm:modal-middle">
                    <div class="modal-box w-11/12 max-w-5xl ">
                        <h3 class="font-bold text-lg">Ajouter une offre</h3>
                        <p class="py-4 text-base-500">Collez simplement ici l'url de l'offre, si nous arrivons à la lire, elle sera ajoutée et mise à jour quotidiennement.</p>
                        <form action="{{ route('connected-offer-add') }}" method="post">
                            @csrf
                            <input type="hidden" name="shop_id" value="" id="offer_shop">
                            <input type="hidden" name="product_id" value="" id="offer_product">
                            <label class="form-control w-full mb-6">
                                <input type="url" name="url" placeholder="https://" class="input w-full" />
                            </label>
                            <button type="submit" class="btn btn-success mb-6 w-full justify-self-end">Ajouter</button>
                        </form>
                    </div>
                    <form method="dialog" class="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>

            </div>
        </div>
    </x-slot>
</x-front.layout>
