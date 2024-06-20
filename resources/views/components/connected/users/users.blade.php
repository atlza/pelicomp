<x-layout pageTitle="Gestion des utilisateurs">
    <section  class="container mx-auto">

        <div class="drawer drawer-end">
            <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">

                <div id="destinationWrapper"></div>
                <table id="sourceTable" class="table">
                    <thead>
                    <tr>
                        <th>#id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Date inscription</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $aUser)
                        <tr>
                            <td>{{ $aUser->id }}</td>
                            <td>{{ $aUser->name }}</td>
                            <td>{{ $aUser->email }}</td>
                            <td>
                                @if( !in_array($aUser->getRoleNames()->first(), ['admin', 'super admin']) || auth()->user()->can('Manage admins') )
                                <a href="#" class="edit-user-role flex flex-row" data-user="{{ $aUser->id }}">
                                    <i data-lucide="pencil" class="mr-2"></i>
                                    {{ $aUser->getRoleNames()->first() }}
                                </a>
                                @else
                                    {{ $aUser->getRoleNames()->first() }}
                                @endif
                            </td>
                            <td>{{ $aUser->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

            <dialog id="user_edit_modal" class="modal modal-bottom sm:modal-middle">
                <div class="modal-box w-11/12 max-w-5xl ">
                    <h3 class="font-bold text-lg">Changer le rôle de l'utilisateur</h3>
                    <form action="{{ route('manage-users-edit') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="" id="user_id">
                        <select name="user_role" class="select select-bordered w-full max-w-xs my-4 w-full">
                            <option disabled selected>Sélectionnez un rôle</option>
                            @foreach( $roles as $aRole )
                                @if( !in_array($aRole, ['admin', 'super admin']) || auth()->user()->can('Manage admins') ) )
                                <option value="{{ $aRole  }}">{{ $aRole }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success mb-6 w-full justify-self-end">Enregistrer</button>
                    </form>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>

        </div>

    </section>
</x-layout>
