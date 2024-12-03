<div style="width: 100%;min-height: 100%;">
  <nav id="horizontal-list-example" class="nav nav-pills justify-content-start">
    <a class="nav-link" style="color:black;" data-scroll-to="#horizontal-list-item-1" href="javascript:void(0)">Pick
      up</a>
    <a class="nav-link" style="color:black;" data-scroll-to="#horizontal-list-item-2" href="javascript:void(0)">Send</a>
  </nav>
  <div id="horizontal-scroll-container"
    style="display: flex; overflow-x: auto; scroll-snap-type: x mandatory; padding: 0.5rem;">
    <div id="horizontal-list-item-1" style="flex: 0 0 100%; scroll-snap-align: start; padding: 0.5rem;">
      <div class="row" style="height: 50vh" style = "overflow-y:auto;">
        <div class="col-12 col-md-8" style="height: 100%;padding: 0 4px 0 4px;">
          <div
            style="width: 100%;border-radius: 12px;border: 2px solid #b8b8b8;box-shadow: 4px 7px 8px 0px rgba(163,163,163,0.1);height: 100%;padding:1rem;">
            <div class="d-flex justify-content-between" style = "overflow-y:auto;">
              <span style="font-size:20px;font-weight:600;">Waste Pick up Schedule</span>
              <span>2024</span>
            </div><br>
            <div>
              <ul class="list-group list-group-flush" style="width: 100%;">
                @if($pickup->isEmpty())
                  <li class="list-group-item text-center" style="font-style: italic; color: gray;">
                    You have no pickup schedules for this month
                  </li>
                      @else
                    @foreach ($pickup as $d)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span style = "padding-right:10px;width: 30%;">&bull; {{$d->FormattedScheduledDate}}    </span>
                      <span style = "width: 70%;">Waste Pickup for <strong>{{ $d->RecipientName }}</strong> (Restaurant) at <em>{{$d->location}}</em></span>
                    </li>
                  @endforeach
                  @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4" style="height: contain;padding: 0 4px 0 4px;">
          <div class="d-flex flex-column justify-content-between align-items-center"
            style="width: 100%;border-radius: 12px;border: 2px solid #b8b8b8;box-shadow: 4px 7px 8px 0px rgba(163,163,163,0.1);height: 100%;padding:1rem;">
            <span style="font-size:20px;font-weight:600;display: block;width: 100%;text-align:left;">Schedule a
              Pickup</span><br>
            <form style="width: 100%;display:flex;flex-direction:column;height: 100%;justify-content: space-evenly;"
              method="POST" action="#">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                  placeholder="enter your email">
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">date</label>
                <input type="date" class="form-control" id="date" name="date">
              </div><br>
              <button type="submit" class="btn" style="width: 100%;background-color:#43553D;color:white;">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="horizontal-list-item-2"
      style="flex: 0 0 100%; scroll-snap-align: start; padding: 0.5rem;margin-left: 10px;">
      <div class="row" style="height: 50vh;">
        <div class="col-12 col-md-8" style="height: 100%;padding: 0 4px 0 4px;">
          <div
            style="width: 100%;border-radius: 12px;border: 2px solid #b8b8b8;box-shadow: 4px 7px 8px 0px rgba(163,163,163,0.1);height: 100%;padding:1rem;">
            <div class="d-flex justify-content-between">
              <span style="font-size:20px;font-weight:600;">Compost Delivery Schedule</span>
              <span>2024</span>
            </div><br>
            <div>
              <ul class="list-group list-group-flush" style="width: 100%;">
                @if($delivery->isEmpty())
                  <li class="list-group-item text-center" style="font-style: italic; color: gray;">
                    You have no pickup schedules for this month
                  </li>
                      @else
                    @foreach ($delivery as $d)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span style = "padding-right:10px;width: 30%;">&bull; {{$d->FormattedScheduledDate}}    </span>
                      <span style = "width: 70%;">for <strong>{{ $d->RecipientName }}</strong> at <em>{{$d->location}}</em></span>
                    </li>
                  @endforeach
                  @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4" style="height: 100%;padding: 0 4px 0 4px;">
          <div class="d-flex flex-column justify-content-between align-items-center"
            style="width: 100%;border-radius: 12px;border: 2px solid #b8b8b8;box-shadow: 4px 7px 8px 0px rgba(163,163,163,0.1);height: 100%;padding:1rem;">
            <span style="font-size:20px;font-weight:600;display: block;width: 100%;text-align:left;">Schedule a
              Delivery</span><br>
            <form style="width: 100%;display:flex;flex-direction:column;height: 100%;justify-content: space-evenly;"
              method="POST" action="#">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                  placeholder="enter your email">
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">date</label>
                <input type="date" class="form-control" id="date" name="date">
              </div><br>
              <button type="submit" class="btn" style="width: 100%;background-color:#43553D;color:white;">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('#horizontal-list-example .nav-link').forEach(link => {
    link.addEventListener('click', function (e) {
      const targetId = this.getAttribute('data-scroll-to');
      const targetElement = document.querySelector(targetId);
      const container = document.getElementById('horizontal-scroll-container');

      if (targetElement && container) {
        container.scrollTo({
          left: targetElement.offsetLeft,
          behavior: 'smooth'
        });
      }
    });
  });
  document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('#horizontal-list-example .nav-link');
    const defaultLink = navLinks[0];
    defaultLink.style.fontWeight = 'bold';

    navLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        navLinks.forEach(nav => nav.style.fontWeight = 'normal');
        this.style.fontWeight = 'bold';

        const targetId = this.getAttribute('data-scroll-to');
        const targetElement = document.querySelector(targetId);
        const container = document.getElementById('horizontal-scroll-container');

        if (targetElement && container) {
          container.scrollTo({
            left: targetElement.offsetLeft,
            behavior: 'smooth'
          });
        }
      });
    });
  });
</script>
<style>
  #horizontal-scroll-container {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    padding: 0.5rem;
    scrollbar-width: none;
  }

  #horizontal-scroll-container::-webkit-scrollbar {
    display: none;
  }
</style>