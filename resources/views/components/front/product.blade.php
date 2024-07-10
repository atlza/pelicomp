<x-layout pageTitle="Liste des produits" >
    <section  class="container card mx-auto bg-white p-3">
        <div class="prose max-w-none">
            <div class="flex w-full flex-col lg:flex-row ">
                <div class="w-1/3 px-3 pt-6">
                    <span class="font-bold text-xl">Taris et offres :</span>
                    <h1 class="my-3">{{ $product->brand->name }} {{ $product->name }}
                        <small class="block text-sm text-gray-600">{{ array_keys($properties)[0] }} : {{ $product->prop1 }} - {{ array_keys($properties)[1] }} : {{ $product->prop2 }}</small>
                    </h1>
                    <p>
                        <small class="block text-sm text-gray-600">
                            {{ array_keys($properties)[2] }} : {{ $product->prop3 }}<br />
                            {{ array_keys($properties)[3] }} : {{ $product->prop4 }}<br />
                            {{ array_keys($properties)[4] }} : {{ $product->prop5 }}
                        </small>
                    </p>
                </div>

                <div class="w-2/3 p-3">
                    <h2>Offres liées</h2>
                    <div id="destinationWrapper"></div>
                    <table id="sourceTable" class="table">
                        <thead>
                        <tr>
                            <th>Boutique</th>
                            <th>Price</th>
                            <th>Mise à jour</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($product->offers as $offer)
                            <tr>
                                <td>{{ $offer->shop->name }}</td>
                                <td>
                                    <a class="text-secondary" href="{{ $offer->url  }}" target="_blank">
                                        {{ $offer->price }}
                                    </a>
                                </td>
                                <td>{{ $offer->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>

        </div>

    </section>


</x-layout>
