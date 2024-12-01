<x-layout>
  <x-navbar />
  <div style="padding: 1rem 5rem;font-family:&quot;Inter&quot;, serif;">
    <div class="row gx-3 justify-content-between gy-2" style="width: 100%; height: 35vh;">
      <div class="col-12 col-md-8" style="height: 35vh;padding: 0 5px 0  5px;">
        <div class="d-flex justify-content-between"
          style="padding:1rem;height:100%;width:100%;border-radius:12px;border: 2px solid #b8b8b8;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.1);">
          <div class="d-flex justify-content-center align-items-center"
            style="width: 40%;height: 100%;font-size: 18px;font-weight: 600;">This Month</div>
          <div style="width: 60%;height: 100%;overflow-x:hidden;overflow-y: auto;">
            <ul class="list-group list-group-flush" style = "width: 75%;">  
            @foreach ($data as $d)
                <li class="list-group-item">&centerdot; {{$d->FormattedScheduledDate}}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4" style="height: 35vh; padding: 0 5px 0 5px;">
        <div
          style="height: 100%;width: 100%;border-radius: 12px;border: 2px solid #b8b8b8;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.1);padding: 1rem;">
          <span style="font-size: 18px;font-weight: 600;">Today</span><br>
          <div style="width: 60%;height: 100%;overflow-x:hidden;overflow-y: auto;">
            <ul class="list-group list-group-flush" style = "width: 100%;">  
              @foreach ($dataToday as $d)
                <li class="list-group-item">&centerdot; {{ \Carbon\Carbon::parse($d->ScheduledDate)->format('h:i A') }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div><br>
    
    <h5>Lanjut isi sini apus nanti</h5>

    <style>
      ::-webkit-scrollbar {
        width: 8px;
      }
      ::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 10px;
      }
      ::-webkit-scrollbar-thumb:hover {
        background-color: #555;
      }

      ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
      }
    </style>
  </div>
  
</x-layout>