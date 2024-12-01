<div>
  <div class="row gx-3 justify-content-between gy-2" style="width: 100%; height: 35vh;">
    <div class="col-12 col-md-8" style="height: 35vh;padding: 0 5px 0  5px;">
      <div class = "d-flex justify-content-between" style = "padding:1rem;height:100%;width:100%;border-radius:12px;border: 2px solid #b8b8b8;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.1);">
        <div class = "d-flex justify-content-center align-items-center" style = "width: 40%;height: 100%;font-size: 18px;font-weight: 600;">This Month</div>
        <div style = "width: 60%;height: 100%;overflow-x:hidden;overflow-y: auto;">
          <ul class="list-group list-group-flush">
            @for($i = 0; $i < 10; $i++)
              <li class="list-group-item">An item</li>
            @endfor
          </ul>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4" style="height: 35vh; padding: 0 5px 0 5px;">
      <div style = "height: 100%;width: 100%;border-radius: 12px;border: 2px solid #b8b8b8;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.1);padding: 1rem;">
        <span style = "font-size: 18px;font-weight: 600;">Today</span><br>
        aaaaaaaaaaa
      </div>
    </div>
  </div>
  <style>
    /* Style the scrollbar */
    ::-webkit-scrollbar {
      width: 8px; /* Set the width of the scrollbar */
    }

    ::-webkit-scrollbar-thumb {
      background-color: #888; /* Color of the scrollbar thumb */
      border-radius: 10px; /* Round the edges of the thumb */
    }

    ::-webkit-scrollbar-thumb:hover {
      background-color: #555; /* Darker color when hovered */
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1; /* Color of the track */
      border-radius: 10px; /* Round the edges of the track */
    }
  </style>
</div>
