<div class="col-12 col-lg-7">
    <!-- notif -->
    <div class="tempat-notif">

    </div>
    <!-- end notif -->
    <div class="card">
    </div>
</div>

<div class="alert alert-info alert-dismissible show fade">
    This is a info alert.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui tenetur facilis incidunt vel. Neque aut eos nostrum
deleniti.
Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem enim delectus est voluptas eligendi corporis qui iste
doloribus non sint, at accusamus nulla accusantium voluptatem sequi totam itaque nostrum fuga minus reprehenderit
mollitia omnis unde a.
Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt officiis temporibus quos odio minima, dignissimos
rerum dolore quibusdam aspernatur voluptate?
Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora maiores pariatur possimus molestiae quia quam placeat
fugit laboriosam, tempore quisquam odit obcaecati vitae autem! Culpa assumenda laudantium ex excepturi iure!

protected $fillable = [
        'siswa_id',
        'kelompok_id',
        'pembimbing_id',
        'sikap',
        'pengetahuan',
        'keterampilan',
        'laporan_akhir',
        'form_bukti',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'pembimbing_id');
    }