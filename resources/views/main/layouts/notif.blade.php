 @php
     
     use App\Models\Notification;
     $notifs = Notification::where('to', Auth::user()->user_id)
         ->with('sender')
         ->orderBy('created_at', 'desc')
         ->get();
 @endphp


 @forelse ($notifs as $notif)
     <a class="dropdown-item d-flex align-items-center bg-light" href="#">
         <div class="me-3 col-3">
             <div class=" "><img src="{{ asset('/uploads/logos/' . $notif->sender->avatar) }}"
                     class="rounded-circle shadow-sm" width="45px" alt="">
             </div>
         </div>
         <div class="col text-wrap" style="width: 100%;">
             <h6 class="fw-bold fs-5">{{ $notif->title }}</h6>
             <p style="">{{ $notif->content }}</p>
             <span class="small text-gray-500 " style="text-align: right" id="date{{ $notif->id }}"></span>
             <script>
                 $("#date{{ $notif->id }}").html(moment("{{ $notif->created_at }}").fromNow())
             </script>

         </div>
     </a>
     <hr>
 @empty
     <div style="zoom: 0.95">
         @include('main/layouts/notfound')
         <p class="text-center">No notifications yet</p>
     </div>
 @endforelse
