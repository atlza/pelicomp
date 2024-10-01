<x-layout pageTitle="Log d'utilisation" >

    <section  class="container mx-auto">

        <div id="destinationWrapper"></div>
        <table id="sourceTable" class="table">
            <thead>
            <tr>
                <th>#id</th>
                <th>Action</th>
                <th>By</th>
                <th>Model</th>
                <th>Model ID</th>
                <th tabulator-formatter="html" >Model infos</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->action }}</td>
                    <td>
                        @if (!empty($log->user_id))
                            {{ $log->user->email }}
                        @else
                            Automatic
                        @endif
                    </td>
                    <td>{{ $log->logable_type }}</td>
                    <td>{{ $log->logable_id }}</td>
                    <td>
                        @switch($log->logable_type)
                            @case('App\Models\Product')
                            <a class="text-secondary" href="{{ route('manage-products-edit', $log->logable_id) }}">
                            {{ $log->logable->brand->name }}&nbsp;
                            {{ $log->logable->name }}
                            {{ $log->logable->prop1 }}
                            {{ $log->logable->prop2 }}
                            </a>
                            @break

                            @case('App\Models\User')
                            {{ $log->logable->brand->email }}
                            @break

                            @case('App\Models\Offer')
                            <a class="text-secondary" target="_blank" href="{{ $log->logable->url }}">
                            {{ $log->logable->shop->name }}
                            </a>
                            @break

                            @default
                            {{ $log->logable->name }}
                        @endswitch
                    </td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </section>
</x-layout>
