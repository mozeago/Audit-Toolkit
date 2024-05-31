<x-app-layout>
    <h1>Analytics</h1>
    <!-- First 3 Categories -->
    <div class="w-full p-4 mt-2">
        <div class="grid w-full gap-4 transition-all duration-300 ease sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3">
            <div
                class="relative grid grid-cols-12 gap-0 p-4 bg-white border-l-4 border-orange-500 shadow-xl rounded-3xl hover:shadow-none min-h-50">
                <span class="absolute top-0 left-0 mt-2 ml-2 material-icons-sharp">account_tree</span>
                <div class="col-span-1"></div>
                <div class="col-span-7">
                    <h3 class="text-lg">Type of processing activity conducted by controller/processor.</h3>
                </div>
                <div class="flex items-center justify-center col-span-4 p-0 m-0">
                    <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24" width="48px"
                        fill="#C8000B">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                    </svg>
                </div>
            </div>

            <div class="p-4 bg-gray-300 min-h-36">
                Column 2
            </div>
            <div class="p-4 bg-gray-400 min-h-36">
                Column 3
            </div>
        </div>
    </div>
    <!-- End of First 3 categories -->
    <div class="analyse">
        <div class="sales">
            <div class="status">
                <div class="info">
                    <h3>Type of
                        processing activity
                        conducted
                        by
                        controller/processor.</h3>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p class="font-medium">+81%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="visits">
            <div class="status">
                <div class="info">
                    <h3>Type of personal data processed by the organisation.</h3>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p>-48%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="searches">
            <div class="status">
                <div class="info">
                    <h3>Processing of sensitive personal data.</h3>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="percentage">
                        <p>+21%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Users Section -->
    <div class="new-users">
        <h2>New Users</h2>
        <div class="user-list">
            <div class="user">
                <img src="images/profile-2.jpg" />
                <h2>Jack</h2>
                <p>54 Min Ago</p>
            </div>
            <div class="user">
                <img src="images/profile-3.jpg" />
                <h2>Amir</h2>
                <p>3 Hours Ago</p>
            </div>
            <div class="user">
                <img src="images/profile-4.jpg" />
                <h2>Ember</h2>
                <p>6 Hours Ago</p>
            </div>
            <div class="user">
                <img src="images/plus.png" />
                <h2>More</h2>
                <p>New User</p>
            </div>
        </div>
    </div>
    <!-- End of New Users Section -->

    <!-- Recent Orders Table -->
    <div class="recent-orders">
        <h2>Recent Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Course Number</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <a href="#">Show All</a>
    </div>
    <!-- End of Recent Orders -->
</x-app-layout>
