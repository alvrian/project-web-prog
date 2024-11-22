<x-layout>
    <x-navbar/>
    <div style = "width: 100%;min-height:93vh;">
        <div class = "d-flex flex-column justify-content-center align-items-center" style = "background-color: #EBCF7B;height:20rem">
            <h2 style = "color:white;font-weight:600;">Looking for Something?</h2>
            <form class="d-flex" role="search" method = "GET" action = "/compost">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style = "width: 32rem;border-radius:15px;margin-top:1rem;" name = "search"/>
            </form>
        </div>
        <div style ="padding: 2rem">
            <span style = "font-size: 18px;font-weight:500;">Restaurant Around You</span>
            
        </div>
    </div>
</x-layout>