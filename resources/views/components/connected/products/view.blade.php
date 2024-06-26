<x-layout pageTitle="Liste des produits" >
    <section  class="container mx-auto">

        <div class="drawer drawer-end">
            <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">

                <div class="justify-end flex my-8">
                    <label for="my-drawer-4" class="justify-self-end drawer-button btn btn-secondary btn-outline btn-sm">
                        <i class="mr-2" data-lucide="plus"></i>
                        Ajouter un produit</label>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <td>#id</td>
                        <td>Marque</td>
                        <td>Nom</td>
                        @foreach( $properties as $aPropertyName => $aPropertyValues )
                            <td>{{ $aPropertyName }}</td>
                        @endforeach
                        <td>Offres</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $aProduct)
                        <tr>
                            <td>{{ $aProduct->id }}</td>
                            <td>{{ $aProduct->brand->name }}</td>
                            <td>{{ $aProduct->name }}</td>
                            @foreach( $properties as $aPropertyName => $aPropertyValues )
                                @if( !empty($aPropertyValues) )
                                <td>{{ $aProduct->{ 'prop'.$loop->iteration } }}</td>
                                @endif
                            @endforeach
                            <td>
                                <a href="" title="voir les offres" class="text-secondary flex">
                                    <i class="mr-2" data-lucide="eye"></i>
                                    Détails et offres
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            <x-connected.products.parts.add  :brands="$brands" :properties="$properties" />
        </div>

    </section>
</x-layout>
