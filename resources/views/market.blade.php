<x-layout>
    <x-navbar/>
    <div style = "padding: 2rem;">
        <span style = "width: 85vw;font-weight:bold;font-size: 24px;color: #43553D;">Search</span>
        <form class="d-flex" role="search" method = "GET" action = "#">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style = "width: 32rem;border-radius:12px;margin-top:1rem;" name = "search"/>
        </form>
        @for ($i = 1; $i <= 5; $i++)
            <a href = "/market/{{ $i }}" style = "text-decoration: none;">
            <div class = "card d-flex flex-row justify-content-start" style = "margin: 1rem 0;padding:1rem;box-shadow: 5px 7px 8px 0px rgba(163,163,163,0.15);border: none;height: 25vh;">
                <div style = "display: flex;object-fit: scale-down;width: 30vw;justify-content: center;" >
                    <img src = "{{ asset('images/image-placeholder.png') }}" style = "width: 100%;height: auto;object-fit:scale-down;"/>
                </div>
                <div style = "display: flex;width: 70vw;padding: 1rem;margin-left: 1rem;flex-direction: column;">
                    <span style = "font-size: 22px;font-weight: 600;color: #43553D;">Item Name #{{ $i }}</span>
                    <span >category</span><br>
                    <span style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;text-overflow: ellipsis;">
                        Sleigh bells ring, are you listening, In the lane, snow is glistening A beautiful sight, We're happy tonight, Walking in a winter wonderland.
                        Gone away is the bluebird, Here to stay is a new bird He sings a love song, As we go along, Walking in a winter wonderland. In the meadow we can build a snowman,Then pretend that he is Parson Brown
                        He'll say: Are you married? We'll say: No man, But you can do the job When you're in town.
                    </span>
                </div>
            </div>
        </a>
        @endfor

</x-layout>