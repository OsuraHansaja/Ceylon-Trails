@extends('layouts.ct')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Travel Tips</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>

        <div class="container">

            <!-- Information Section -->
            <div class="essential-info">
                <h3>Essential Information</h3>
                <p>Prepare for an unforgettable journey to Sri Lanka – get important information, tips, and advice to maximize your experience and make the most of your visit.</p>
            </div>


            <h1>Travel Tips</h1>

            <div class="tips">
                <!-- Weather & Timezone -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Weather" alt="Weather Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Weather & Timezone</h2>
                        <p>Sri Lanka has a tropical climate with two main monsoon seasons. The southwest monsoon brings rain to the southern and western regions from May to September, while the northeast monsoon affects the northern and eastern regions from December to February. The country follows Sri Lanka Standard Time (GMT +5:30), so adjust your watches accordingly.</p>
                    </div>
                </div>

                <!-- Visa & Entry Requirements -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Visa" alt="Visa Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Visa & Entry Requirements</h2>
                        <p>Most visitors to Sri Lanka need an Electronic Travel Authorization (ETA) before arrival. Be sure to check the specific visa requirements for your nationality and apply online in advance for a smooth entry.</p>
                    </div>
                </div>

                <!-- Safe Drinking Water -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Water" alt="Water Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Safe Drinking Water</h2>
                        <p>Tap water in Sri Lanka is not recommended for drinking unless boiled or filtered. Bottled water is widely available and is a safer option for tourists.</p>
                    </div>
                </div>

                <!-- Power Plug -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Power" alt="Power Plug Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Power Plug</h2>
                        <p>The standard voltage in Sri Lanka is 230V, and the frequency is 50Hz. You can use power plugs with three round pins or two round pins. Check if your devices are compatible or bring an adapter.</p>
                    </div>
                </div>

                <!-- Language -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Language" alt="Language Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Language</h2>
                        <p>The official languages of Sri Lanka are Sinhala and Tamil. English is widely spoken, especially in tourist areas and cities, so communicating should not be difficult for visitors.</p>
                    </div>
                </div>

                <!-- Smoking Area -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Smoking" alt="Smoking Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Smoking Area</h2>
                        <p>Smoking is banned in public places in Sri Lanka, including restaurants, public transport, and government buildings. Designated smoking areas are marked, so be sure to smoke only in these areas to avoid fines.</p>
                    </div>
                </div>


                <!-- Useful Numbers -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Phone" alt="Phone Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Useful Numbers</h2>
                        <p><strong>Police:</strong> 119</p>
                        <p><strong>Ambulance & Fire Brigade:</strong> 110</p>
                        <p><strong>Flight Information:</strong> +94 11 225 2861</p>
                    </div>
                </div>

                <!-- Prayer Facilities -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Prayer" alt="Prayer Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Prayer Facilities</h2>
                        <p>Sri Lanka is a diverse country with facilities for different religious practices. There are mosques, temples, and churches conveniently located in major cities. Please check with your hotel or local guides for prayer facilities.</p>
                        <a href="#">FIND OUT MORE →</a>
                    </div>
                </div>

                <!-- Wi-Fi -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Wi-Fi" alt="Wi-Fi Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Wi-Fi</h2>
                        <p>Visitors can access free Wi-Fi at selected public places such as airports and some cafes. For convenience, purchase a local SIM card with data or access Wi-Fi at your hotel.</p>
                    </div>
                </div>

                <!-- Sri Lanka Visitor Centre -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Info" alt="Info Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Sri Lanka Visitor Centre</h2>
                        <p>If you need assistance or have any queries, drop by any of the Sri Lanka Tourist Information Centres. You can get help with planning itineraries, ticket bookings, and accommodation reservations.</p>
                        <a href="#">FIND OUT MORE →</a>
                    </div>
                </div>

                <!-- Public Dining Places -->
                <div class="tip">
                    <div class="tip-icon">
                        <img src="https://via.placeholder.com/80x80?text=Dining" alt="Dining Icon">
                    </div>
                    <div class="tip-content">
                        <h2>Public Dining Places</h2>
                        <p>It’s considered polite to clean up after yourself in public dining places such as food courts and cafes. Many places offer tray return services. Please ensure you follow the local guidelines to maintain cleanliness.</p>
                        <a href="#">FIND OUT MORE →</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
