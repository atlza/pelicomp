<x-layout pageTitle="Liste des boutiques" >

    @can('Manage shops')
    <div class="justify-end flex my-8">
        <label for="my-drawer-4" class="justify-self-end drawer-button btn btn-secondary btn-outline btn-sm">
            <i class="mr-2" data-lucide="plus"></i>
            Ajouter une boutique</label>
    </div>
    @endcan

    <section  class="container mx-auto">

        <div class="drawer drawer-end">
            <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <div id="destinationWrapper"></div>
                <table id="sourceTable" class="table">
                    <thead>
                    <tr>
                        <th>#id</th>
                        <th>name</th>
                        <th tabulator-formatter="html">url</th>
                        <th >Visible</th>
                        <th tabulator-formatter="html">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($shops as $shop)
                        <tr>
                            <td>{{ $shop->id }}</td>
                            <td>{{ $shop->name }}</td>
                            <td><a class="text-secondary" href="https://{{ $shop->url }}" target="_blank">{{ $shop->url }}</a></td>
                            <td>{{ $shop->hidden ? 'non' : 'oui' }}</td>
                            <td class="flex justify-end">
                                <a href="#" title="Modifier la boutique"
                                   class="edit-shop text-secondary inline-block"
                                   data-id="{{ $shop->id }}"
                                   data-name="{{ $shop->name }}"
                                   data-url="{{ $shop->url }}"
                                   data-code="{{ $shop->code }}"
                                   data-hidden="{{ $shop->hidden }}"
                                >
                                    <i class="mr-8" data-lucide="pencil"></i>
                                </a>
                                <a href="#" title="Ajout d'une liste de produits" class="add-products text-secondary inline-block" data-shop="{{ $shop->id }}" ><i class="mr-2" data-lucide="copy-plus"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @can('Manage shops')
            <div class="drawer-side">
                <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                <div class="menu p-4 w-80 min-h-full bg-base-200 text-base-content prose">
                    <h2>Ajouter une boutique</h2>
                    <form action="{{ route('manage-shops-add') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="edit-shop-id" />
                        <input type="text" name="name" id="edit-shop-name" placeholder="Nom de la boutique" class="input input-bordered w-full max-w-xs mb-3" />
                        <input type="text" name="url" id="edit-shop-url" placeholder="Url de la boutique" class="input input-bordered w-full max-w-xs mb-3" />
                        <input type="text" name="code" id="edit-shop-code" placeholder="Code affiliation" class="input input-bordered w-full max-w-xs mb-3" />

                        <select name="hidden" id="edit-shop-hidden" class="select select-bordered w-full max-w-xs mb-3">
                            <option value="" disabled selected>Masquée</option>
                            <option value="true">Oui</option>
                            <option value="false">Non</option>
                        </select>

                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </form>
                </div>
            </div>
            @endcan

            <dialog id="add_products_modal" class="modal modal-bottom sm:modal-middle">
                <div class="modal-box  max-w-5xl ">
                    <h3 class="font-bold text-lg">Ajouter d'une liste d'offres</h3>
                    <p class="py-4 text-base-500">Collez simplement ici l'url d'une page liste de produits, si nous arrivons à la lire, nous vous proposerons d'ajouter tous les produits.</p>
                    <form action="{{ route('manage-shops-products') }}" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="" id="shop_id">
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

    </section>
</x-layout>
