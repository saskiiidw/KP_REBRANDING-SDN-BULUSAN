@extends('layouts.admin')

@section('title', $album->nama_album)

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.galeri-foto.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">{{ $album->nama_album }}</h2>
            <p class="text-on-surface-variant mt-1">{{ $album->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
        </div>
    </div>

    <!-- Upload Photos Panel -->
    <div class="bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
        <h3 class="font-headline-sm text-xl font-bold text-primary border-b border-outline-variant/20 pb-4">Unggah Foto Baru (Bisa Pilih Banyak)</h3>
        
        <form action="{{ route('admin.galeri-foto.photos.store', $album->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="border-2 border-dashed border-outline-variant/60 rounded-[20px] p-8 text-center bg-surface-variant/10 relative hover:bg-surface-variant/20 transition-colors">
                <input type="file" name="photos[]" id="photos-input" multiple required
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"/>
                <div class="space-y-2 pointer-events-none">
                    <span class="material-symbols-outlined text-5xl text-on-surface-low">cloud_upload</span>
                    <h4 class="font-semibold text-primary">Seret foto ke sini atau klik untuk memilih file</h4>
                    <p class="text-xs text-on-surface-low">Format: JPG, JPEG, PNG, WEBP (Max 3MB per foto)</p>
                </div>
            </div>

            <!-- Previews Container -->
            <div id="previews-container" class="grid grid-cols-2 sm:grid-cols-4 gap-4 hidden">
                <!-- Javascript will render preview cards here -->
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                    Unggah & Simpan Foto
                </button>
            </div>
        </form>
    </div>

    <!-- Photos Grid -->
    <div class="space-y-6">
        <h3 class="font-headline-sm text-xl font-bold text-primary border-b border-outline-variant/20 pb-4">Foto Terunggah ({{ $album->foto->count() }})</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($album->foto as $foto)
                <div class="bg-white rounded-[20px] shadow-sm border border-outline-variant/30 overflow-hidden relative group">
                    <div class="aspect-square relative overflow-hidden">
                        <img src="{{ asset('storage/' . $foto->path_foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                        
                        <!-- Hover Delete Overlay -->
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <form action="{{ route('admin.galeri-foto.photos.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-error text-white p-3 rounded-full hover:bg-error/90 transition-colors shadow-lg">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    @if($foto->caption)
                        <div class="p-4">
                            <p class="text-xs text-on-surface-variant font-medium line-clamp-2">{{ $foto->caption }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-1 sm:col-span-4 bg-white p-16 text-center text-on-surface-low rounded-[24px] border border-outline-variant/30 shadow-sm">
                    <span class="material-symbols-outlined text-5xl block mb-2">image</span>
                    Belum ada foto di album ini. Silakan unggah foto di atas.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const input = document.getElementById('photos-input');
    const container = document.getElementById('previews-container');

    if (input && container) {
        input.addEventListener('change', () => {
            container.innerHTML = '';
            const files = input.files;
            
            if (files.length > 0) {
                container.classList.remove('hidden');
                
                Array.from(files).forEach((file, index) => {
                    const reader = new FileReader();
                    
                    reader.onload = (e) => {
                        const card = document.createElement('div');
                        card.className = 'bg-surface-variant/30 rounded-xl p-3 border border-outline-variant/30 relative flex flex-col gap-2';
                        card.innerHTML = `
                            <div class="aspect-video rounded-lg overflow-hidden border">
                                <img src="${e.target.result}" class="w-full h-full object-cover"/>
                            </div>
                            <input type="text" name="caption[${index}]" placeholder="Keterangan..." class="w-full px-2 py-1.5 rounded-lg border text-xs outline-none bg-white"/>
                        `;
                        container.appendChild(card);
                    };
                    
                    reader.readAsDataURL(file);
                });
            } else {
                container.classList.add('hidden');
            }
        });
    }
</script>
@endsection
