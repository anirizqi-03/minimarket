{{--
    Modal Reusable
    ---------------
    Gunakan dengan JS: openModal('modalId') / closeModal('modalId')

    Contoh pemakaian:
    <div class="modal" id="modalTambah">
        <div class="modal-dialog">
            <div class="modal-head">
                <h3>Judul</h3>
                <button class="modal-close" onclick="closeModal('modalTambah')">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body">
                ... form ...
            </div>
            <div class="modal-foot">
                <button class="btn btn-outline" onclick="closeModal('modalTambah')">Batal</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
--}}

{{-- Modal Konfirmasi Hapus (Global) --}}
<div class="modal" id="modalHapus">
    <div class="modal-dialog" style="max-width: 420px;">
        <div class="modal-head">
            <h3>Konfirmasi Hapus</h3>
            <button class="modal-close" onclick="closeModal('modalHapus')">
                <i class="ti ti-x"></i>
            </button>
        </div>
        <div class="modal-body">
            <div style="display: flex; gap: 14px; align-items: flex-start;">
                <div style="width: 44px; height: 44px; border-radius: 12px; background: var(--red-soft); color: var(--red); display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
                    <i class="ti ti-alert-triangle"></i>
                </div>
                <div>
                    <p style="font-weight: 600; color: var(--text); margin-bottom: 4px;">Yakin ingin menghapus data ini?</p>
                    <p style="font-size: 13px; color: var(--text-3);">Data yang dihapus tidak dapat dikembalikan.</p>
                </div>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn btn-outline" onclick="closeModal('modalHapus')">Batal</button>
            <button class="btn btn-danger">
                <i class="ti ti-trash"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>
