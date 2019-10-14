@if ($errors->any())
<div class="my-2 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-inner rounded" role="alert">
    <p class="font-bold py-2">Issue(s) saving this record:</p>
    <ul>
        @foreach ($errors->all() as $error)
        <li clas="py-2">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
