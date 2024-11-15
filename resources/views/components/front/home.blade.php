<x-layout pageTitle="Comparateur de prix des pellicules photos sur internet" >

    <div id="destinationWrapper"></div>

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

    <table id="sourceTable" class="table mb-6">
        <thead>
        <tr>
            <th tabulator-sorter="string">Marque</th>
            <th tabulator-formatter="html" tabulator-headerFilter="tabulatorSearch" >Nom</th>
            @foreach( $properties as $aPropertyName => $aPropertyValues )
                <th>{{ $aPropertyName }}</th>
            @endforeach
            @foreach ($shops as $shop)
                <th tabulator-formatter="html" tabulator-sorter="alphanum" >{{ $shop->name }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->brand->name }}</td>
                <td>
                    <a class="text-secondary" href="{{ route('front-product', $product->slug) }}">
                        <i data-lucid="eye" class="mr-2"></i>
                        {{ $product->name }}</a>
                </td>
                @foreach( $properties as $aPropertyName => $aPropertyValues )
                    @if( !empty($aPropertyValues) )
                        <td>{{ $product->{ 'prop'.$loop->iteration } }}</td>
                    @endif
                @endforeach
                @foreach ($shops as $shop)
                    <td>
                        @if( Auth::check() && auth()->user()->can('Manage offers') &&
                              (empty($offers[$product->id][$shop->id]) || $offers[$product->id][$shop->id]->price == 0) )
                            <span class="hidden">0</span>
                            <a href="#" title="Ajouter une offre" class="add-offer text-secondary flex"
                               id="offer_{{ $shop->id }}_{{ $product->id }}"
                               data-shop="{{ $shop->id }}" data-product="{{ $product->id }}">
                                <i class="h-4 mx-auto" data-lucide="plus"></i>
                            </a>
                        @elseif( !empty($offers[$product->id][$shop->id]->price) )
                            <span class="hidden">{{ $offers[$product->id][$shop->id]->price }}</span>
                            <a href="{{ $offers[$product->id][$shop->id]->url }}"
                               class="text-info"
                               target="_blank"
                               title="Mis à jour le {{ date('d/m/Y', strtotime($offers[$product->id][$shop->id]->updated_at)) }}">
                                {{ $offers[$product->id][$shop->id]->price }}€
                            </a>
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
        <div class="modal-box  max-w-5xl ">
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

</x-layout>
