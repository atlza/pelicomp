<x-front.layout>
    <x-slot name="frontContent">
        <section  class="container mx-auto">

            <div class="drawer drawer-end">
                <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">

                    <table class="table">
                        <thead>
                        <tr>
                            <td>#id</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Rôle</td>
                            <td>Date inscription</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $aUser)
                            <tr>
                                <td>{{ $aUser->id }}</td>
                                <td>{{ $aUser->name }}</td>
                                <td>{{ $aUser->email }}</td>
                                <td>{{ $aUser->getRoleNames()->first() }}</td>
                                <td>{{ $aUser->created_at->format('d/m/Y') }}</td>
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
    </x-slot>
</x-front.layout>
