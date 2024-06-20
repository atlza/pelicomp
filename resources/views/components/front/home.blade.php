<x-layout pageTitle="Comparateur de prix des pellicules photos sur internet" >
    <div class="content py-8">
        <div id="wrapper">
            <div id="destinationWrapper"></div>

            <table id="sourceTable" class="table">
                <thead>
                    <tr>
                        <th>Marque</th>
                        <th>Nom</th>
                        @foreach( $properties as $aPropertyName => $aPropertyValues )
                            <th>{{ $aPropertyName }}</th>
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
                                @if( Auth::check() && auth()->user()->can('Manage offers') && empty($offers[$product->id][$shop->id]) )
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
                    <form action="{{ route('manage-offer-add') }}" method="post">
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
</x-layout>
