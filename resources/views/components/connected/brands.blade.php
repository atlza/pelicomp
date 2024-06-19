<x-front.layout>
    <x-slot name="frontContent">
        <section  class="container mx-auto">

            <div class="drawer drawer-end">
                <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">

                    <div class="justify-end flex my-8">
                        <label for="my-drawer-4" class="justify-self-end drawer-button btn btn-secondary btn-outline btn-sm">
                            <i class="mr-2" data-lucide="plus"></i>
                            Ajouter une marque</label>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>#id</th>
                            <th>name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
{{--                                <td class="text-end">
                                    <a href="" title="voir les offres" class="text-secondary flex">
                                        <i data-lucide="aperture" class="mr-2"></i>
                                        voir les produits
                                    </a>
                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="drawer-side">
                    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                    <div class="menu p-4 w-80 min-h-full bg-base-200 text-base-content prose">
                        <h2>Ajouter une marque</h2>
                        <form action="{{ route('connected-products-add') }}" method="post">
                            @csrf
                            <input type="text" name="name" placeholder="Nom de la marque" class="input input-bordered w-full max-w-xs mb-3" />
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </form>
                    </div>
                </div>

            </div>

        </section>
    </x-slot>
</x-front.layout>
