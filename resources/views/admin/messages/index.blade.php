@extends('admin.layouts.admin')

@section('title', 'Pesan Masuk - Admin CMS')
@section('page-title', 'Pesan Masuk')

@section('content')

@if(session('success'))
  <div class="alert alert-success" style="background:rgba(16,185,129,0.15);border:1px solid #10b981;color:#10b981;padding:12px 18px;border-radius:8px;margin-bottom:20px;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
  </div>
@endif

<div class="admin-card">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <h3>Semua Pesan</h3>
    <span style="color:var(--text-muted);font-size:0.9rem;">
      Total: {{ $messages->total() }} pesan
      @if($unreadCount > 0)
        &nbsp;|&nbsp;<span style="color:#ef4444;">{{ $unreadCount }} belum dibaca</span>
      @endif
    </span>
  </div>

  <div class="table-responsive">
    <table class="admin-table">
      <thead>
        <tr>
          <th style="width:40px;">#</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Pesan</th>
          <th>Status</th>
          <th>Waktu</th>
          <th style="width:120px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($messages as $msg)
          <tr style="{{ !$msg->is_read ? 'background:rgba(99,102,241,0.07);' : '' }}">
            <td>{{ $loop->iteration + ($messages->currentPage() - 1) * $messages->perPage() }}</td>
            <td>
              @if(!$msg->is_read)
                <span style="display:inline-block;width:8px;height:8px;background:#ef4444;border-radius:50%;margin-right:6px;"></span>
              @endif
              <strong>{{ $msg->name }}</strong>
            </td>
            <td style="color:var(--text-muted);font-size:0.88rem;">{{ $msg->email }}</td>
            <td style="max-width:300px;">
              <span style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;line-height:1.5;">
                {{ Str::limit($msg->message, 100) }}
              </span>
            </td>
            <td>
              @if($msg->is_read)
                <span style="background:rgba(16,185,129,0.15);color:#10b981;padding:3px 10px;border-radius:20px;font-size:0.78rem;">Dibaca</span>
              @else
                <span style="background:rgba(239,68,68,0.15);color:#ef4444;padding:3px 10px;border-radius:20px;font-size:0.78rem;">Baru</span>
              @endif
            </td>
            <td style="color:var(--text-muted);font-size:0.83rem;">{{ $msg->created_at->diffForHumans() }}</td>
            <td>
              <div style="display:flex;gap:6px;">
                <button onclick="openMsg({{ $msg->id }}, '{{ addslashes($msg->name) }}', '{{ addslashes($msg->email) }}', `{{ addslashes($msg->message) }}`, '{{ $msg->created_at->format('d M Y, H:i') }}', {{ $msg->is_read ? 'true' : 'false' }}, '{{ route('admin.messages.markAsRead', $msg->id) }}')"
                  class="btn btn-sm" style="background:rgba(99,102,241,0.15);color:var(--accent-primary);border:none;cursor:pointer;padding:5px 10px;border-radius:6px;font-size:0.8rem;"
                  title="Lihat Detail">
                  <i class="fas fa-eye"></i>
                </button>
                <form method="POST" action="{{ route('admin.messages.destroy', $msg->id) }}" onsubmit="return confirm('Hapus pesan ini?');" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.15);color:#ef4444;border:none;cursor:pointer;padding:5px 10px;border-radius:6px;font-size:0.8rem;" title="Hapus">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" style="text-align:center;color:var(--text-muted);padding:40px 0;">
              <i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:10px;opacity:0.4;"></i>
              Belum ada pesan masuk.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  @if($messages->hasPages())
    <div style="margin-top:20px;display:flex;justify-content:center;">
      {{ $messages->links() }}
    </div>
  @endif
</div>

{{-- Detail Message Modal --}}
<div id="msg-modal-bg" onclick="closeMsgModal()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:9998;"></div>
<div id="msg-modal" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:9999;background:var(--bg-card);border:1px solid var(--border-color);border-radius:16px;padding:32px;max-width:560px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.5);">
  <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
    <div>
      <h3 id="modal-msg-name" style="margin:0;font-size:1.2rem;"></h3>
      <p id="modal-msg-email" style="color:var(--text-muted);font-size:0.88rem;margin:4px 0 0;"></p>
    </div>
    <div style="display:flex;gap:8px;align-items:center;">
      <span id="modal-msg-time" style="color:var(--text-muted);font-size:0.8rem;"></span>
      <button onclick="closeMsgModal()" style="background:none;border:none;color:var(--text-muted);font-size:1.3rem;cursor:pointer;padding:0 4px;">&times;</button>
    </div>
  </div>
  <div style="background:rgba(99,102,241,0.07);border-radius:10px;padding:18px;line-height:1.8;font-size:0.95rem;white-space:pre-wrap;word-break:break-word;max-height:260px;overflow-y:auto;" id="modal-msg-body"></div>
  <div style="display:flex;gap:10px;margin-top:20px;justify-content:flex-end;">
    <div id="modal-read-btn-container"></div>
    <button onclick="closeMsgModal()" style="background:rgba(255,255,255,0.07);border:1px solid var(--border-color);color:var(--text-primary);padding:8px 20px;border-radius:8px;cursor:pointer;">Tutup</button>
  </div>
</div>

<script>
function openMsg(id, name, email, message, time, isRead, markReadUrl) {
  document.getElementById('modal-msg-name').textContent = name;
  document.getElementById('modal-msg-email').textContent = email;
  document.getElementById('modal-msg-time').textContent = time;
  document.getElementById('modal-msg-body').textContent = message;

  const readBtn = document.getElementById('modal-read-btn-container');
  if (!isRead) {
    readBtn.innerHTML = `
      <form method="POST" action="${markReadUrl}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" style="background:rgba(16,185,129,0.15);color:#10b981;border:1px solid #10b981;padding:8px 16px;border-radius:8px;cursor:pointer;font-size:0.88rem;">
          <i class="fas fa-check"></i> Tandai Sudah Dibaca
        </button>
      </form>`;
  } else {
    readBtn.innerHTML = '';
  }

  document.getElementById('msg-modal-bg').style.display = 'block';
  document.getElementById('msg-modal').style.display = 'block';
}

function closeMsgModal() {
  document.getElementById('msg-modal-bg').style.display = 'none';
  document.getElementById('msg-modal').style.display = 'none';
}
</script>

@endsection
