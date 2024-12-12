<x-layout>
    <x-navbar />
    <div class="d-flex flex-column flex-wrap" style="background-color: #43553D; min-height: 100vh;max-width: 100vw; padding: 2rem;">
        <div class="d-flex flex-wrap" style="flex-grow: 1;">
            <!-- About Us Section -->
            <div class="d-flex flex-column" style="flex: 1; max-width: 60%; padding-right: 1rem;">
                <h1 style="font-weight: bold; font-size: 96px; color: #EBCF7B;">
                    About Us
                </h1>
                <p  style="color: white; font-size: 18px; line-height: 1.8; text-align: justify;">
                    Welcome to FarmByte, the platform that connects farmers, compost producers, and restaurants to foster a sustainable and collaborative ecosystem. Our mission is to create a seamless way for these essential players in the food and agriculture industry to work together, ensuring mutual benefit while promoting eco-conscious practices. 
                    Farmers can showcase and sell their fresh, locally grown produce directly to restaurants, reducing the need for intermediaries and supporting farm-to-table initiatives. Compost producers contribute by providing organic, sustainable solutions to enrich the soil and minimize waste. Restaurants, in turn, can source high-quality ingredients
                    and participate in a sustainable supply chain that supports local communities and the environment.
                </p>
                <p style="color: white; font-size: 18px; line-height: 1.8; text-align: justify;">
                    But FarmByte doesn’t stop there. We understand the importance of convenience and efficiency, which is why we offer a delivery scheduling feature. Whether you're a restaurant looking to restock on fresh ingredients or a farmer needing compost for your crops, you can plan your deliveries to suit your schedule. 
                    Additionally, FarmByte rewards you for supporting sustainability. Every transaction earns points that you can redeem for discounts on future purchases, making it easier to save while contributing to a greener future. Join FarmByte today and be part of a growing community that values quality, sustainability, and collaboration. Together, we’re creating a smarter, more efficient food supply chain that benefits everyone involved.
                </p>
                    <div class="d-flex flex-column gap-3 mt-4" style="color: white; width: 100%;">
                <h1 style="font-weight: bold; font-size: 40px; color: #EBCF7B;">
                    Contact Us
                </h1>
                <div class="d-flex align-items-center gap-3" style="font-size: 18px;">
                    <img src="{{ asset('images/email-icon.png') }}" alt="Email Icon" style="width: 24px; height: 24px;" />
                    <span>customerContact@farmByte.com</span>
                </div>
                <div class="d-flex align-items-center gap-3" style="font-size: 18px;">
                    <img src="{{ asset('images/instagram-icon.png') }}" alt="Instagram Icon" style="width: 24px; height: 24px;" />
                    <span>@farmByte.id</span>
                </div>
                <div class="d-flex align-items-center gap-3" style="font-size: 18px;">
                    <img src="{{ asset('images/phone-icon.png') }}" alt="Phone Icon" style="width: 24px; height: 24px;" />
                    <span>(+62) 81291231234</span>
                </div>
        </div>
            </div>
            <div class="d-flex align-items-start flex-column" 
                style="flex: 1; max-width: 40%;">
                <img src="{{ asset('images/aboutus.png') }}" 
                    style="width: 30vw; border-radius: 8px; min-width: 300px;margin-top: 10vh;" 
                    alt="About Us Image" />
                <img src="{{ asset('images/a-Sustainable-Way-to-Manage-Organic-Waste.jpg') }}"
                    style="width: 30vw; border-radius: 8px; min-width: 300px;margin-top: 10vh;"
                    alt="About Us Image_2">
            </div>


        </div>
    </div>
</x-layout>
