<div>
    <ul class="mt-4 space-y-2">
        @foreach ($anggota as $item)
            <h6>{{ $item->siswa->nama_siswa }}</h6>
        @endforeach
    </ul>
</div>