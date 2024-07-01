<x-layout pageTitle="Liste des boutiques" >

    <div class="justify-end flex my-8">
        <label for="my-drawer-4" class="justify-self-end drawer-button btn btn-secondary btn-outline btn-sm">
            <i class="mr-2" data-lucide="plus"></i>
            Ajouter une boutique</label>
    </div>

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
                        <th>url</th>
                        <th>Ajouté par</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($shops as $shop)
                        <tr>
                            <td>{{ $shop->id }}</td>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->url }}</td>
                            <td>{{ $shop->user->fullname() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="drawer-side">
                <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                <div class="menu p-4 w-80 min-h-full bg-base-200 text-base-content prose">
                    <h2>Ajouter une boutique</h2>
                    <form action="{{ route('manage-shops-add') }}" method="post">
                        @csrf
                        <input type="text" name="name" placeholder="Nom de la boutique" class="input input-bordered w-full max-w-xs mb-3" />
                        <input type="url" name="url" placeholder="Url de la boutique" class="input input-bordered w-full max-w-xs mb-3" />
                        <input type="text" name="code" placeholder="Code affiliation" class="input input-bordered w-full max-w-xs mb-3" />
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </form>
                </div>
            </div>

        </div>

    </section>
</x-layout>
