<h1>Warning - The SeAT instance {domain} is running with outdated package !</h1>

<ul>
@foreach($packages as $package)
    <li><b>{{ $package->vendor }}/{{ $package->name }}</b> : installed = {{ $package->installed }}; latest = {{ $package->latest }}</li>
@endforeach
</ul>